@extends('pos.layout.pos-app')


@section('content')


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

                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-md-8">
                <h4>Patient Details </h4>
                <div style="display: flex">
                    <input type="text" id="search-customer-input" class="form-control mb-3" placeholder="Search Address, Name, Etc" onkeyup="searchCustomer()"/>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" style="height: 40px;margin-left: 10px;">+</a>
                </div>

                <div class="row">
                    <div class="col-md-12" style="background: #eaeaeadb;padding-bottom: 20px;border-radius: 10px;border-style: dashed;border-width: 1px;border-color: #dddddd;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-sm" style="margin-top: 20px">
                                    <label for="searchInput">Patient Name</label>
                                    <input type="text" id="patient_name" class="form-control" placeholder="Patient Name" readonly>
                                    <input type="hidden" id="patient_id" class="form-control" name="patient_id" placeholder="Patient Name" readonly>
                                    <input type="hidden" id="center_id_field" class="form-control" name="center_id_field" value="{{$center->id}}" placeholder="Patient Name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="searchInput">Patient Address</label>
                                    <input type="text" id="patient_address" class="form-control" placeholder="Search Patient" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-sm" style="margin-top: 20px">
                                    <label for="searchInput">Patient Email</label>
                                    <input type="text" id="patient_email" class="form-control" placeholder="Patient Email" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="searchInput">Phone Number</label>
                                    <input type="text" id="patient_phone_number" class="form-control" placeholder="Search Patient" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div id="customer-details" class="mb-3">

                </div>

                <h4>Cart</h4>
                <ul class="list-group mb-3">

                    <table class="table">
                        <caption>List of users</caption>
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


@include('pos.dialog.add_customer')

<script>
    function patientSelect(patientId, patientName, patientAddress, patientEmail, patientPhoneNumber) {
        const audio = new Audio('{{url('sound/blip.mp3')}}'); // Replace with the actual path to your MP3 file
        audio.play();

        $('#patient_id').val(patientId);
        $('#patient_name').val(patientName);
        $('#patient_address').val(patientAddress);
        $('#patient_email').val(patientEmail);
        $('#patient_phone_number').val(patientPhoneNumber);
    }

    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            const query = $(this).val();

            // Perform AJAX request if query has at least 3 characters
            if (query.length >= 3) {
                $.ajax({
                    url: '{{ url("api/patients") }}',
                    type: 'GET',
                    data: { query },
                    success: function (data) {
                        let patientList = '';

                        if (data.length > 0) {
                            data.forEach(function (patient) {
                                patientList += `<a href="#" onclick="patientSelect('${patient.id}','${patient.first_name} ${patient.middle_name} ${patient.last_name}','${patient.address}', '${patient.email}','${patient.phone_number}')"  data-bs-dismiss="modal" class="list-group-item d-flex justify-content-between align-items-start list-group-item-action">
                                                    <div class="ms-2 me-auto">
                                                      <div class="fw-bold">${patient.first_name} ${patient.middle_name} ${patient.last_name}</div>
                                                        ${patient.address}
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">${patient.email}</span>
                                                  </a>`;
                            });
                        } else {
                            patientList = '<li class="list-group-item">No results found</li>';
                        }

                        $('#patientList').html(patientList);
                    },
                    error: function () {
                        console.error('Error fetching patients.');
                    }
                });
            } else {
                $('#patientList').html('');
            }
        });
    });
</script>



<script>
    let products = [];
    let cart = [];
    let total = 0;
    let discount = 0;

    // Fetch products via AJAX
    async function loadProducts() {
        try {
            const response = await fetch('/api/products/{{$center->id}}'); // Replace with your API endpoint
            products = await response.json();
            renderProducts(products);
        } catch (error) {
            console.error('Failed to load products:', error);
            alert('Failed to load products. Please try again.');
        }
    }

    // Search products via AJAX
    async function searchProducts() {
        const query = document.getElementById('search-product-input').value.toLowerCase();
        try {
            const response = await fetch(`/api/products/{{$center->id}}?query=${query}`);
            const filteredProducts = await response.json();
            renderProducts(filteredProducts);
        } catch (error) {
            console.error('Product search failed:', error);
        }
    }

    // Render the product list dynamically
    function renderProducts(productList) {
        const productContainer = document.getElementById('product-container');
        productContainer.innerHTML = '';

        productList.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'col-md-12';
            productCard.innerHTML = `
                    <div  class="card product-card" style="margin-bottom: 10px;height: 123px;" onclick="addToCart('${product.id}','${product.name}', ${product.price})">
                        <div class="card-body">
                            <h5>${product.name}</h5>
                            <p style="font-size: 12px;">${product.description}</p>
                            <p >EUR ${product.price.toFixed(2)}</p>
                        </div>
                    </div>
                `;

            productContainer.appendChild(productCard);
        });
    }

    // Add product to cart
    function addToCart(productId,productName, productPrice) {
        const audio = new Audio('{{url('sound/beep.mp3')}}'); // Replace with the actual path to your MP3 file
        audio.play();

        const existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            existingProduct.qty++;
        } else {
            cart.push({  id:productId, name: productName, price: productPrice, qty: 1 });
        }

        updateCart();
    }

    // Update cart
    function updateCart() {
        const cartList = document.getElementById('cart-list');
        const cartTotal = document.getElementById('cart-total');
        cartList.innerHTML = '';
        total = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.qty;
            total += itemTotal;

            console.log(item);
            const cartItem = document.createElement('tr');
            cartItem.className = '';
            cartItem.innerHTML = `<input type="hidden" name="product_id[]" value="${item.id}">
                                    <input type="hidden" name="product_qty[]" value="${item.qty}">
                                    <input type="hidden" name="product_total[]" value="${itemTotal.toFixed(2)}">
                            <td>${item.name}</td>
                            <td>($${item.price.toFixed(2)})</td>
                            <td><input type="number" class="form-control" value="${item.qty}" onchange="updateQty(${index}, this.value)"></td>
                            <td>$${itemTotal.toFixed(2)}</td>
                            <td><button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">Remove</button></td>
                `;

            cartList.appendChild(cartItem);
        });

        applyDiscount();
    }

    // Apply discount
    function applyDiscount() {
        discount = parseInt(document.getElementById('discount-input').value) || 0;
        const discountedTotal = total - (total * (discount / 100));
        document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
        document.getElementById('cart-total-field').value = `${discountedTotal.toFixed(2)}`;

    }

    // Search customer via AJAX
    async function searchCustomer() {
        const query = document.getElementById('search-customer-input').value.toLowerCase();
        try {
            const response = await fetch(`/api/customers?query=${query}`);
            const customers = await response.json();

            const customerDetails = document.getElementById('customer-details');
            customerDetails.innerHTML = customers.map(customer =>
                `<p><strong>${customer.name}</strong> (${customer.email})</p>`
            ).join('');
        } catch (error) {
            console.error('Customer search failed:', error);
        }
    }

    // Load products when the page loads
    loadProducts();
</script>




@endsection

<!-- Modal -->

