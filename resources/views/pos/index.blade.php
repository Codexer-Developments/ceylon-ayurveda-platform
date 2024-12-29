<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .cart-item {
            align-items: center;
        }

        .cart-item .item-qty {
            width: 50px;
        }

        .total-section {
            font-weight: bold;
            font-size: 1.3rem;
        }
    </style>
</head>
<body>
<div class="row">
    <div style="background: #0d6efd;color: white;font-size: 14px;padding-top: 20px;padding-bottom: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Ceylon Aryurvedic Point of Sale System</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center">

                        <a href="" class="btn btn-light">{{$center->center_name}}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

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
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" style="height: 40px;margin-left: 10px;">+</button>
            </div>

            <div class="row">
                <div class="col-md-12" style="background: #eaeaeadb;padding-bottom: 20px;border-radius: 10px;border-style: dashed;border-width: 1px;border-color: #dddddd;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-sm" style="margin-top: 20px">
                                <label for="searchInput">Patient Name</label>
                                <input type="text" id="patient_name" class="form-control" placeholder="Patient Name" readonly>
                                <input type="hidden" id="patient_id" class="form-control" name="patient_id" placeholder="Patient Name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-top: 20px">
                                <label for="searchInput">Patient Address</label>
                                <input type="text" id="patient_address" class="form-control" placeholder="Search Patient" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-sm" style="margin-top: 20px">
                                <label for="searchInput">Patient Email</label>
                                <input type="text" id="patient_email" class="form-control" placeholder="Patient Name" readonly>
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
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <label for="discount">Discount (%):</label>
                <input
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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Search Patient</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Create Patient</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-top: 20px">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search Patient">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <ol id="patientList" class="list-group list-group">
                                    <div style="text-align:center;color: gray; padding-top: 60px;padding-bottom: 60px;">
                                        <h3>Search Patients</h3>
                                    </div>
                                    <!-- Patient results will appear here -->
                                </ol>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="patientForm">
                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="patient_first_name" name="first_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" id="patient_middle_name" name="middle_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="patient_last_name" name="last_name">
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="patient_email" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" id="patient_phone_number" name="phone_number">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" id="patient_address" name="address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>Tax ID</label>
                                        <input type="text" class="form-control" id="patient_tax_id" name="tex_id">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Blood Group</label>
                                        <select type="text" class="form-select" id="patient_blood_group" name="patient_blood_group">
                                            <option value="A Positive">A Positive</option>
                                            <option value="B Positive">B Positive</option>
                                            <option value="AB Positive">AB Positive</option>
                                            <option value="AB Negative">AB Negative</option>
                                            <option value="A Negative">A Negative</option>
                                            <option value="B Negative">B Negative</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Date of birth</label>
                                        <input type="date" class="form-control" id="patient_dob" name="patient_dob">
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-3">
                                        <label>Insurance ID</label>
                                        <input type="text" class="form-control" id="patient_insurance_id" name="patient_insurance_id">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Name</label>
                                        <input type="text" class="form-select" id="patient_insurance_name" name="patient_insurance_name">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Type</label>
                                        <select type="text" class="form-select" id="patient_insurance_type" name="patient_insurance_type">
                                            <option value="Health Insurance">Health Insurance</option>
                                            <option value="Life Insurance">Life Insurance</option>
                                            <option value="Home Insurance">Home Insurance</option>
                                            <option value="Travel Insurance">Travel Insurance</option>
                                            <option value="Business Insurance">Business Insurance</option>
                                            <option value="Critical Illness Insurance">Critical Illness Insurance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Group</label>
                                        <select type="text" class="form-select" id="patient_insurance_group" name="insurance_group">
                                            <option value="Aviva Group">Aviva Group</option>
                                            <option value="AXA Group">AXA Group</option>
                                            <option value="Admiral Group">Admiral Group</option>
                                            <option value="Direct Line Group">Direct Line Group</option>
                                            <option value="Legal & General Group">Legal & General Group</option>
                                            <option value="Bupa Group">Bupa Group</option>
                                            <option value="Zurich Group">Zurich Group</option>
                                            <option value="Liverpool Victoria (LV=) Group">Liverpool Victoria (LV=) Group</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="responseMessage" class="mt-3"></div>


                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#patientForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: '{{url('api/patients')}}', // Replace with your server endpoint
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success
                    $('#responseMessage').html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );

                    patientSelect(response.data.id, response.data.first_name + ' ' + response.data.middle_name + ' ' + response.data.last_name,
                        response.data.address, response.data.email, response.data.phone_number);
                    $('#exampleModal').modal('toggle');
                },
                error: function (xhr) {
                    // Handle error
                    let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#responseMessage').html(
                        `<div class="alert alert-danger">${errorMessage}</div>`
                    );
                }
            });
        });
    });
</script>

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
                    <div  class="card product-card" style="margin-bottom: 10px;height: 123px;" onclick="addToCart('${product.name}', ${product.price})">
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
    function addToCart(productName, productPrice) {
        const audio = new Audio('{{url('sound/beep.mp3')}}'); // Replace with the actual path to your MP3 file
        audio.play();

        const existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            existingProduct.qty++;
        } else {
            cart.push({  name: productName, price: productPrice, qty: 1 });
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

            const cartItem = document.createElement('tr');
            cartItem.className = '';
            cartItem.innerHTML = `
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
