<!DOCTYPE html>
<html>

<head>
    <title>Print Barcode & QR Code</title>
    <style>
        .qrcode {
            text-align: center;
            max-width: 7cm;
            /* Atur lebar maksimum sesuai dengan ukuran kertas */
            overflow: hidden;
            /* Sembunyikan elemen yang meluap */
            margin-top: -35px;
            margin-bottom: -60px;
            height: 100px;
        }

        .code-label {
            text-align: center;
            font-size: 8px;
            margin-top: 5px;
        }

        body {
            font-size: 8px;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .qr {
            margin-left: 50px;
        }
    </style>
</head>

<body>
    <div class="qrcode">
        <div class="qr">{!! $qrcode !!}</div>
        <div class="code-label">{{ $product->code }}</div>
    </div>
</body>

</html>
