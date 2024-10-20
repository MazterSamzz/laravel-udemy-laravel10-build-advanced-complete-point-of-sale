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

        .qrcode {
            margin-top: 10;
            margin-left: 13;
        }
    </style>
</head>

<body>
    <div class="qrcode">{!! $qrcode !!}</div>
    <div class="code-label">{{ $product->code }}</div>
</body>

</html>
