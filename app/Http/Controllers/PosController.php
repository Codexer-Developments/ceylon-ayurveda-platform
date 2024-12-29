<?php

namespace App\Http\Controllers;

use App\Models\Centers;
use App\Models\Patients;
use App\Models\ProductManagement;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PosController extends Controller
{
    public function pos(Centers $centers, Request $request)
    {
        return view('pos.index',[
            'center' => $centers,
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
}
