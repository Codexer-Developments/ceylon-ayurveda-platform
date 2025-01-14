<form method="post" action="{{url('post-order')}}">
    {{csrf_field()}}
    <div class="container mt-5">

        <div class="row">
            <!-- Product List -->
            <div class="col-md-4">
                <div class="card">
                    <div class="" style="padding: 20px;background: lightblue;margin-bottom: 30px;">
                        <div class="form-group row">
                            <input type="text" id="search-product-input" class="form-control" placeholder="Search products..." onkeyup="searchProducts()"/>
                        </div>
                    </div>
                    <div class="" style="padding: 20px;">
                        <div class="row" id="product-container">
                            <div style="text-align: center">
                                <div style="background: url('{{url('img/product.png')}}');height: 150px;background-position: center;background-size: contain;background-repeat: no-repeat;"></div>
                                <h3 style="color: grey;">Search Products...</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-md-8">
                <div style="font-size: 12px;color: #646464;background: #d2d2d2;color: #3d3d3d;padding: 10px;border-radius: 2px 28px 2px 1px;">
                    <h4 style="font-size: 18px;padding-top: 10px">Patient Details </h4>
                    <div style="display: flex">
                        <input type="text" id="search-customer-input" class="form-control mb-3" placeholder="Search Address, Name, Etc" onkeyup="searchCustomer()"/>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" style="height: 40px;margin-left: 10px;">+</a>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="background: #eaeaeadb;padding-bottom: 20px;border-style: dashed;border-width: 1px;border-color: #dddddd;">
                            <div class="row">
                                <div class="col-md-6" style="display: none">
                                    <div class="form-group" style="margin-top: 20px">
                                        <label for="searchInput">Patient Address</label>
                                        <input type="text" id="patient_address" class="form-control" placeholder="Search Patient" readonly required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group-sm" style="margin-top: 20px">
                                        <label for="searchInput">Patient Name</label>
                                        <input type="text" id="patient_name" class="form-control" placeholder="Patient Name" readonly>
                                        <input type="hidden" id="patient_id" class="form-control" name="patient_id" placeholder="Patient Name" readonly>
                                        <input type="hidden" id="center_id_field" class="form-control" name="center_id_field" value="{{$center->id}}" placeholder="Patient Name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-sm" style="margin-top: 20px">
                                        <label for="searchInput">Patient Email</label>
                                        <input type="text" id="patient_email" class="form-control" placeholder="Patient Email" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-top: 20px">
                                        <label for="searchInput">Phone Number</label>
                                        <input type="text" id="patient_phone_number" class="form-control" placeholder="Search Patient" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>






                <div id="customer-details" class="mb-3">

                </div>

                <h4>Products Item</h4>
                <ul class="list-group mb-3">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="cart-list">

                        </tbody>
                    </table>



                    <!-- Dynamic Cart Items -->
                </ul>
                <div class="d-flex justify-content-between align-items-center total-section">
                    <span>Total:</span>
                    <span id="cart-total">$0.00</span>
                    <input type="hidden" name="cart_total" id="cart-total-field">
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <label for="discount">Discount (%):</label>
                    <input name="discount"
                           type="number"
                           id="discount-input"
                           class="form-control w-50"
                           min="0"
                           max="100"
                           value="0"
                           onchange="applyDiscount()"
                    />
                </div>
                <button class="btn btn-primary w-100 mt-3" onclick="checkout()">Checkout</button>
            </div>
        </div>
    </div>

</form>
