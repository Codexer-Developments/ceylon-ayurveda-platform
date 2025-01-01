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
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-product-sell-pos" role="tabpanel" aria-labelledby="pills-product-sell-pos-tab">
            @include('pos.pos_pages.product_sell_pos')
        </div>
        <div class="tab-pane fade" id="pills-treatment-checkout" role="tabpanel" aria-labelledby="pills-treatment-checkout-tab">
            
        </div>
        <div class="tab-pane fade" id="pills-doctor-appointment" role="tabpanel" aria-labelledby="pills-doctor-appointment-tab">

        </div>
    </div>






@include('pos.dialog.add_customer')




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

