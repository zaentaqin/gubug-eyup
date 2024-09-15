<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        /* Ensure background color is explicitly set */
        #invoice {
            background-color: #ffffff;
            /* Set the desired background color */
        }
    </style>
</head>

<body>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-lg my-6" id="invoice">

        <div class="grid grid-cols-2 items-center">
            <div>
                <img class="h-24 w-auto" src="/logo.png" alt="company-logo">
            </div>

            <div class="text-right">
                <p class="font-semibold text-lg">Gubug Eyup Dekorasi</p>
                <p class="text-gray-500 text-sm">gubugeyup@gmail.com</p>
                <p class="text-gray-500 text-sm mt-1">+6289509464569</p>
                <p class="text-gray-500 text-sm mt-1">Jagalan, Salam, Magelang</p>
            </div>
        </div>

        <!-- Client info -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">Bill to:</p>
                <p class="text-gray-500">
                    {{ $order->name }} <br />
                    {{ $order->telephone }} <br />
                    {{ $order->address }}
                </p>
            </div>

            <div class="text-right">
                <p class="text-gray-500">Invoice number: <span class="font-medium">{{ $order->id }}</span></p>
                <p class="text-gray-500">Invoice date: <span
                        class="font-medium">{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</span>
                <p class="text-gray-500">Due date: <span
                        class="font-medium">{{ \Carbon\Carbon::parse($order->date)->addDays(30)->format('d/m/Y') }}</span>
                </p>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Items
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Quantity</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                            Price</th>
                        <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900">
                            Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="py-5 pl-4 pr-3 text-sm">
                                <div class="font-medium text-gray-900">{{ $item->catalog->name }}</div>
                            </td>
                            <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                {{ $item->quantity }}</td>
                            <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                Rp. {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500">
                                Rp. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 text-right text-sm text-gray-500 sm:table-cell">Subtotal</th>
                        <th scope="row" class="pl-6 pr-3 text-left text-sm text-gray-500 sm:hidden">Subtotal</th>
                        <td class="pl-3 pr-6 text-right text-sm text-gray-500">
                            Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 text-right text-sm text-gray-500 sm:table-cell">Discount</th>
                        <th scope="row" class="pl-6 pr-3 text-left text-sm text-gray-500 sm:hidden">Discount</th>
                        <td class="pl-3 pr-6 text-right text-sm text-gray-500">
                            Rp. {{ number_format($order->discount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="3"
                            class="hidden pl-4 pr-3 text-right text-sm text-gray-900 sm:table-cell">Total</th>
                        <th scope="row" class="pl-6 pr-3 text-left text-sm text-gray-900 sm:hidden">Total</th>
                        <td class="pl-3 pr-6 text-right text-sm text-gray-900">
                            Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            Please pay the invoice before the due date. You can pay the invoice by logging in to your account from our
            client portal.
        </div>
        <div class="text-right mt-6">
            <button id="printButton" class="bg-blue-500 text-white py-2 px-4 rounded">
                Print Invoice as PDF
            </button>
        </div>
    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            html2canvas(document.getElementById('invoice'), {
                backgroundColor: '#ffffff' // Explicitly set the background color
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 295;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, -heightLeft, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('invoice.pdf');
            });
        });
    </script>
</body>

</html>
