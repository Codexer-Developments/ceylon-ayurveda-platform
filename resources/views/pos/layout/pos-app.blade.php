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


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <!-- Main Content Section -->
    @yield('content')




<script>
    document.getElementById('center-select').addEventListener('change', function () {
        const selectedValue = this.value;

        // Check if a valid option is selected
        if (selectedValue) {
            // Redirect to the corresponding URL
            const baseUrl = "{{ url('/') }}/pos"; // Base URL of your Laravel app
            window.location.href = `${baseUrl}/${selectedValue}`;
        }
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
