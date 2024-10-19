<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }

        .text-end {
            text-align: right;
            padding-left: 1vw;
            padding-right: 1vw;
        }

        .text-start {
            text-align: left;
            padding-left: 1vw;
            padding-right: 1vw;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>EasyShop</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               EasyShop Head Office
               Email:support@easylearningbd.com <br>
               Mob: 1245454545 <br>
               Dhaka 1207,Dhanmondi:#4 <br>
              
            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Customer Name: {{ $sale->customer->name }}</strong> <br>
                    <strong>Customer Email: {{ $sale->customer->email }}</strong> <br>
                    <strong>Customer Phone: {{ $sale->customer->phone }}</strong> <br>

                    <strong>Address: {{ $sale->customer->address }}</strong>
                    <strong>Shop Name: {{ $sale->customer->shopname }}</strong>

                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">Invoice:</span> # </h3>
                Order Date: {{ $sale->date }}<br>
                Order Status: {{ $sale->status }}<br>
                Payment Status: {{ $sale->payment_status }}<br>
                Total Pay : Rp.{{ number_format($sale->total, 2, '.', ',') }}<br>
                Total Due : Rp.{{ number_format($sale->due, 2, '.', ',') }}</span>

                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>


    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Image </th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total(+Vat)</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($salesDetails as $item)
                <tr class="font">
                    <td align="center">
                        <img src="{{ asset($item->product->image) ?? 'images/no_image.jpg' }}" height="50px;"
                            width="50px;" alt="">
                    </td>
                    <td class="text-start"> {{ $item->product->name }} </td>

                    <td align="center"> {{ $item->product->code }} </td>
                    <td class="text-end"> {{ rtrim(rtrim(number_format($item->qty, 2, '.', ','), '0'), '.') }}
                    </td>

                    <td class="text-end">Rp.{{ number_format($item->price, 2, '.', ',') }} </td>
                    <td class="text-end">Rp.{{ number_format($item->total_price, 2, '.', ',') }} </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5" class="text-end" style="color: green;">
                    <h2>Subtotal</h2>
                </td>
                <td>
                    <h2>: Rp.{{ number_format($sale->total_products, 2, '.', ',') }}</h2>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-end" style="color: green;">
                    <h2>VAT</h2>
                </td>
                <td>
                    <h2>: Rp. {{ number_format($sale->vat, 2, '.', ',') }}</h2>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-end" style="color: green;">
                    <h2>Total</h2>
                </td>
                <td>
                    <h2>: Rp.{{ number_format($sale->total, 2, '.', ',') }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="thanks">
        <p>Thanks For Buying Products..!!</p>
    </div>
    <div class="authority float-right">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>
