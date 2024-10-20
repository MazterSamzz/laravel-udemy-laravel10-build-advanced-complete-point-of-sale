<!DOCTYPE html>
<html>

<head>
    <title>Print Barcode & QR Code</title>
    <style>
        html {
            margin: 0;
            padding: 0;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 2;
        }

        .barcode {
            /* Sembunyikan elemen yang meluap */
            margin-top: 15;
            margin-left: 15;
        }
    </style>
</head>

<body>
    <div class="barcode">{!! $barcode !!}</div>
    <div>{{ $product->code }}</div>
</body>

</html>
