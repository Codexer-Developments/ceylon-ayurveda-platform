@extends('pos.layout.pos-app')


@section('content')


    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top: 10px">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-product-sell-pos-tab" data-bs-toggle="pill" data-bs-target="#pills-product-sell-pos" type="button" role="tab" aria-controls="pills-product-sell-pos" aria-selected="true">Product Selling</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-treatment-checkout-tab" data-bs-toggle="pill" data-bs-target="#pills-treatment-checkout" type="button" role="tab" aria-controls="pills-treatment-checkout" aria-selected="false">Doctors Appointment Checkout</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-doctor-appointment-tab" data-bs-toggle="pill" data-bs-target="#pills-doctor-appointment" type="button" role="tab" aria-controls="pills-doctor-appointment" aria-selected="false">Doctor Appointment</button>
            </li>
        </ul>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Ceylon Ayurvedic Platform:</strong> Revolutionize your Ayurvedic practice with our comprehensive Point of Sale system. Manage doctor appointments, streamline receipt management, and ensure smooth checkouts, all in one intuitive platform tailored for Ayurvedic centers. Ideal for enhancing operational efficiency and patient care seamlessly.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-product-sell-pos" role="tabpanel" aria-labelledby="pills-product-sell-pos-tab">

            <div class="container">



            @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">

                    @foreach ($errors->all() as $error)

                            <div>{{$error}}</div>

                    @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif
            </div>


            @include('pos.pos_pages.product_sell_pos')
        </div>
        <div class="tab-pane fade" id="pills-treatment-checkout" role="tabpanel" aria-labelledby="pills-treatment-checkout-tab">
            @include('pos.pos_pages.doctor_appoiment_checkout')
        </div>
        <div class="tab-pane fade" id="pills-doctor-appointment" role="tabpanel" aria-labelledby="pills-doctor-appointment-tab">
            @include('pos.pos_pages.doctor_appoiment')
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@include('pos.dialog.add_customer',[
    'dialogId' => 'addcustomerdialogpos',
    'dialogTitle' => 'Add Customer',
    'updateParameter' => [
        'inputId' => 'patient_id',
        'inputName' => 'patient_name',
        'inputEmail' => 'patient_email',
        'inputPhone' => 'patient_phone_number',
        'inputAddress' => 'patient_address',
        'inputIdField' => 'patient_id',
        'inputCenterIdField' => 'center_id_field',
    ]
])

    @include('pos.dialog.add_customer',[
    'dialogId' => 'addcustomerdialogposdoc_appoitment',
    'dialogTitle' => 'Add Customer Doctor Appoitment',
    'updateParameter' => [
        'inputId' => 'patient_id_doc_appointment',
        'inputName' => 'patient_name_doc_appointment',
        'inputEmail' => 'patient_email_doc_appoitment',
        'inputPhone' => 'patient_phone_number_doc_appoitment',
        'inputAddress' => 'patient_address_appoitment',
        'inputIdField' => 'patient_id_appoitment',
        'inputCenterIdField' => 'center_id_field_appoitment',
    ]
])


    <script>

        // Remove an item from the cart
        function removeFromCart(index) {
            // Remove the item at the given index
            cart.splice(index, 1);

            // Update the cart display and recalculate totals
            updateCart();
        }


        document.addEventListener("DOMContentLoaded", function () {
            // Define the specific tab IDs you want this functionality to apply to
            const allowedTabIds = ["pills-product-sell-pos-tab", "pills-treatment-checkout-tab","pills-doctor-appointment-tab"]; // Replace with your specific tab IDs

            // Retrieve stored tab ID from localStorage
            const activeTabId = localStorage.getItem("activeTab");

            if (activeTabId && allowedTabIds.includes(activeTabId)) {
                // Activate the stored tab
                const activeTab = document.querySelector(`#${activeTabId}`);
                const tabContent = document.querySelector(activeTab.dataset.bsTarget);

                // Remove active classes from all tabs and tab panes
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));

                // Add active classes to the stored tab and its content
                activeTab.classList.add('active');
                tabContent.classList.add('show', 'active');
            }

            // Store the active tab ID when a tab is clicked
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function () {
                    if (allowedTabIds.includes(this.id)) {
                        localStorage.setItem("activeTab", this.id);
                    }
                });
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
            var imgData =  '{{url('img/product.png')}}';
            productCard.className = 'col-md-12';
            productCard.innerHTML = `
                    <div  class="card product-card" style="margin-bottom: 10px;height: 123px;" onclick="addToCart('${product.id}','${product.name}', ${product.price})">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="${imgData}" alt="" style="width: 50px;height: 50px;">
                                </div>

                                <div class="col-md-10">
                                    <h5>${product.name}</h5>
                                    <div style="font-size: 12px;">${product.description}</div>
                                    <div style="background: #cd8603;padding: 3px;font-size: 15px;padding-left: 10px;padding-right: 10px;border-radius: 5px;width: 110px;margin-top: 10px;color: white;" >EUR ${product.price.toFixed(2)}</div>
                                </div>
                            </div>
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
                            <td><input type="number" class="form-control" onchange="updateQty(${index}, this.value)" value="${item.qty}" onchange="updateQty(${index}, this.value)"></td>
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

    function updateQty(index, newQty) {
        // Parse the new quantity as an integer
        const quantity = parseInt(newQty);

        // Check if the quantity is valid
        if (quantity > 0) {
            // Update the quantity of the item at the given index
            cart[index].qty = quantity;
        } else {
            // If the quantity is invalid (e.g., 0 or negative), reset it to 1
            cart[index].qty = 1;
        }

        // Refresh the cart display and totals
        updateCart();
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

