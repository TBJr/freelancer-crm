<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice #{{ $invoice->id }}</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                color: #333;
            }

            .invoice-box {
                max-width: 800px;
                margin: 20px auto;
                padding: 30px;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                font-size: 16px;
                line-height: 24px;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
                border-collapse: collapse;
            }

            .invoice-box table td {
                padding: 8px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 30px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #f4f4f4;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #f4f4f4;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                font-weight: bold;
                border-top: 2px solid #ddd;
            }

            .invoice-box .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 12px;
                color: #999;
            }
        </style>
    </head>

    <body>
        <div class="invoice-box">
            <table>
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <strong>Invoice #{{ $invoice->id }}</strong>
                                </td>
                                <td>
                                    Date: {{ $invoice->created_at->format('Y-m-d') }}<br>
                                    Due: {{ $invoice->created_at->addDays(15)->format('Y-m-d') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <strong>From:</strong><br>
                                    {{ env('app_name') ?? 'Evolvtech LTD'}}<br>
                                    {{ env('app_email') ?? 'info@evolvtech-gambia.com' }}
                                </td>
                                <td>
                                    <strong>To:</strong><br>
                                    {{ $invoice->customer->name }}<br>
                                    {{ $invoice->customer->email }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Payment Method</td>
                    <td>Check #</td>
                </tr>

                <tr class="details">
                    <td>Bank Transfer</td>
                    <td>1001</td>
                </tr>

                <tr class="heading">
                    <td>Item</td>
                    <td>Price</td>
                </tr>

                @foreach ($invoice->items as $item)
                    <tr class="item">
                        <td>{{ $item->item->name }} (Qty: {{ $item->quantity }})</td>
                        <td>${{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach

                <tr class="total">
                    <td></td>
                    <td>Subtotal: ${{ number_format($invoice->items->sum('total'), 2) }}</td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>Tax: ${{ number_format($invoice->tax, 2) }}</td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>Total: ${{ number_format($invoice->total, 2) }}</td>
                </tr>
            </table>

            <div class="footer">
                Thank you for your business!
            </div>
        </div>
    </body>
</html>
