<!DOCTYPE html>
<html>

<head>
    <title>Print Barcode & QR Code</title>
    <style>
        .barcode {
            text-align: center;
            max-width: 7cm;
            /* Atur lebar maksimum sesuai dengan ukuran kertas */
            overflow: hidden;
            /* Sembunyikan elemen yang meluap */
            margin-top: -15px;
            margin-bottom: -50px;
            height: 80px;
        }

        .code-label {
            text-align: center;
            font-size: 15px;
        }

        body {
            font-size: 8px;
            margin: 0px;
            padding: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="barcode">
        {!! $barcode !!} <br />
        <div class="code-label">{{ $product->code }}</div>
    </div>
</body>

</html>
