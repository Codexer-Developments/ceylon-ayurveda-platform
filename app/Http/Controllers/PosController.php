<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostOrderRequest;
use App\Models\Centers;
use App\Models\Patients;
use App\Models\ProductManagement;
use App\Models\Products;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\User;
use App\Services\PosAccessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PosController extends Controller
{
    public function pos(Centers $centers, Request $request)
    {
        $doctors = User::where('center_id', $centers->id)->where('role', 'doctor')->get();;
        return view('pos.index',[
            'center' => $centers,
            'doctors' => $doctors
        ]);
    }

    public function invoicePos(Centers $centers,SalesOrder $salesorder, Request $request)
    {
        $patientDetails = Patients::where('id', $salesorder->patient_id)->first();

        return view('pos.invoice',[
            'center' => $centers,
            'patient' => $patientDetails,
            'salesOrder' => $salesorder,
        ]);

    }

    public function getPatients(Request $request)
    {
        $patients = Patients::query();

        if ($request->query('query')) {
            $searchTerm = $request->query('query');
            $patients->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%');
            });
        }

        return response()->json($patients->get()->toArray(), 200);
    }

    public function getProducts(Centers $centers, Request $request)
    {
        $products = DB::table('product_management')
            ->join('products', 'product_management.product_id', '=', 'products.id')
            ->where('product_management.center_id', $centers->id)
            ->select(
                'products.name as name',
                'product_management.price as price',
                'products.id as id',
                'products.description as description',
                'product_management.cost_price as product_cost_price',
                'product_management.quantity',
                'products.default_price'
            );

        if ($request->query('query')) {
            $products->where('products.name', 'like', '%' . $request->query('query') . '%' );
        }

        return response()->json($products->get()->toArray(), 200);
    }

    public function addPatients(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'address' => 'required | unique:patients,address',
            'phone_number' => 'required | unique:patients,phone_number',
            'email' => 'required | unique:patients,email',
            'tex_id' => 'required',
            'patient_insurance_id' => 'required',
            'patient_insurance_name' => 'required',
            'insurance_group' => 'required',
            'patient_insurance_type' => 'required',
            'patient_blood_group' => 'required',
            'patient_dob' => 'required',
        ]);

        $patient = Patients::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'tex_id' => $request->tex_id,
            'insurance_id' => $request->patient_insurance_id,
            'insurance_name' => $request->patient_insurance_name,
            'insurance_group' => $request->insurance_group,
            'insurance_type' => $request->patient_insurance_type,
            'blood_group' => $request->patient_blood_group,
            'dob' => $request->patient_dob,
        ]);

        $return = [
            'message' => 'Patient added successfully',
            'data' => $patient
        ];

        return response()->json($return, 201);
    }

    public function postOrder(PostOrderRequest $request)
    {
        $preparationData = [
            'center_id' => $request->center_id_field,
            'patient_id' => $request->patient_id,
            'total_amount' => $request->cart_total,
            'discount' => $request->discount,
            'payment_method' => 'cash',
            'payment_status' => 'paid',
            'order_status' => 'completed',
            'order_date' => $request->order_date,
            'order_time' => $request->order_time,
            'user_id' => auth()->user()->id,
        ];

        // Check product stock before proceeding
        foreach ($request->product_id as $key => $product) {
            $productDetails = ProductManagement::where('product_id', $product)
                ->where('center_id', $request->center_id_field)
                ->first();

            if (!$productDetails || $productDetails->quantity < $request->product_qty[$key]) {
                // Redirect back with an error if stock is insufficient
                return redirect()->back()->withErrors([
                    'error' => "The product '{$productDetails->product->name}' is out of stock or has insufficient quantity."
                ]);
            }
        }

        // Proceed with order creation if all stock checks pass
        $orderDetails = SalesOrder::create($preparationData);
        $itemsList = [];
        foreach ($request->product_id as $key => $product) {
            // Update product quantity
            ProductManagement::where('product_id', $product)
                ->where('center_id', $request->center_id_field)
                ->update([
                    'quantity' => DB::raw('quantity - ' . $request->product_qty[$key]),
                ]);

            $productDetails = ProductManagement::where('product_id', $product)->first();

            $productItem = [
                'sales_order_id' => $orderDetails->id,
                'product_id' => $product,
                'center_id' => $request->center_id_field,
                'quantity' => $request->product_qty[$key],
                'price' => $productDetails->price,
                'payment_method' => 'cash',
                'payment_reference' => 'pos',
                'payment_date' => 'pos',
                'total_amount' => $request->product_total[$key],
            ];
            SalesOrderItem::create($productItem);
            $productItem['product_name'] = $productDetails->product->name;
            $itemsList[] = $productItem;
        }

        $preparationData['items'] = $itemsList;

        SalesOrder::where('id', $orderDetails->id)
            ->update(['order_note' => $preparationData]);

        return redirect(url('invoice', [
            'center_id' => $request->center_id_field,
            'salesorder' => $orderDetails->id
        ]));
    }


    public function posPortal()
    {
        $posAccessService = new PosAccessService();
        $posAccess = $posAccessService->posAccess(auth()->user()->id);
        return view('pos.pos-portal',$posAccess);
    }

    public function productBarcodePrint(Products $product, $qty)
    {

        return view('products.product',[
            'product' => $product,
            'qty' => $qty
        ]);
    }

    public function productBarcode(Request $request)
    {
        return redirect(url('product-barcode-print',[
            'product' => $request->product_id,
            'qty' => $request->barcode_quantity
        ]));
    }
}
