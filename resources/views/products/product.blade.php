<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcodes</title>
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .print-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .barcode-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns per row */
            gap: 10px;
        }

        .barcode-item {
            text-align: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .barcode {
            font-family: 'Libre Barcode 39', sans-serif;
            font-size: 68px;
            margin-top: 10px;
            height: 60px;
        }

        .barcode-label {
            font-size: 12px;
            color: #333;
        }

        @media print {
            .no-print {
                display: none;
            }
            .print-container {
                padding: 0;
                margin: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="print-container">


    <div class="print-container">
        <h1 style="text-align: center;margin-bottom: 20px">Barcode Print Layout</h1>
        <div class="barcode-grid">
            <!-- Loop to generate 30 barcodes -->
            @for ($i = 1; $i <= $qty; $i++)
                <div class="barcode-item">
                    <div class="barcode-label" style="font-size: 10px">{{  $product->name }}</div>
                    <div class="barcode">{{ $product->id}} *</div>
                </div>
            @endfor
        </div>
    </div>
    <button class="no-print btn btn-primary" onclick="window.print()">Print</button>
    <a class="no-print btn btn-primary" href="{{url('admin/product-managements')}}">Back to Product Page</a>

</div>

<script>
    window.print();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
