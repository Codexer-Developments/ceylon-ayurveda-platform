@extends('pos.layout.pos-app')


@section('content')


<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Invoice</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h5>From:</h5>
                    <p>
                        <strong>{{$center->center_name}}</strong><br>
                        {!! $center->address !!} <br>
                        Phone: {{$center->phone}}<br>
                        Email: {{$center->email}}
                    </p>
                </div>
                <div class="col-sm-6 text-end">
                    <h5>To:</h5>
                    <p>
                        <strong>{{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}</strong><br>
                        {!! $patient->address !!}<br>
                        Phone: {{$patient->phone_number}}<br>
                        Email: {{$patient->email}}
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6>Invoice Number:</h6>
                    <p>#INV-{{$salesOrder->id}}</p>
                </div>
                <div class="col-sm-6 text-end">
                    <h6>Date:</h6>
                    <p>{{$salesOrder->created_at}}</p>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salesOrder->order_note['items'] as $productItems )
                    <tr>
                        <td>{{$productItems['product_id']}}</td>
                        <td>{{$productItems['product_name']}}</td>
                        <td>{{$productItems['quantity']}}</td>
                        <td>GBP {{$productItems['price']}}</td>
                        <td>GBP {{$productItems['total_amount']}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                    <td>GBP {{$salesOrder->order_note['total_amount']}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Discount</strong></td>
                    <td>GBP {{$salesOrder->order_note['discount']}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td>GBP {{$salesOrder->order_note['total_amount']}}</td>
                </tr>
                </tfoot>
            </table>

            <div class="text-end">
                <button class="btn btn-primary">Download PDF</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
