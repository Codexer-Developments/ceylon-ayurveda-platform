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
                        <strong>Company Name</strong><br>
                        Address Line 1<br>
                        Address Line 2<br>
                        City, State, ZIP<br>
                        Phone: (123) 456-7890<br>
                        Email: info@company.com
                    </p>
                </div>
                <div class="col-sm-6 text-end">
                    <h5>To:</h5>
                    <p>
                        <strong>Client Name</strong><br>
                        Address Line 1<br>
                        Address Line 2<br>
                        City, State, ZIP<br>
                        Phone: (987) 654-3210<br>
                        Email: client@example.com
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6>Invoice Number:</h6>
                    <p>#INV-001</p>
                </div>
                <div class="col-sm-6 text-end">
                    <h6>Date:</h6>
                    <p>January 1, 2025</p>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Item 1</td>
                    <td>2</td>
                    <td>$50.00</td>
                    <td>$100.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Item 2</td>
                    <td>1</td>
                    <td>$75.00</td>
                    <td>$75.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Item 3</td>
                    <td>3</td>
                    <td>$20.00</td>
                    <td>$60.00</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                    <td>$235.00</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Tax (10%)</strong></td>
                    <td>$23.50</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td>$258.50</td>
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
