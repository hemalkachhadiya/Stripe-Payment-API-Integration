<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
    <script type="application/javascript" src="{{ asset('public/js/app.js') }}" defer></script>
</head>

<body>
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 m-5 mb-10">


        <div class="overflow-hidden bg-indigo-100 border-gray-200 p-3 m-2 rounded-xl">
            <div class="m-2 text-justify text-sm">
                <h2 class="font-bold text-4xl mb-8 text-indigo-900">Customer</h2>
                <div class="text-center">
                    <div><a href="{{ url('/customer/create') }}" class="text-lg font-semibold" >Create a customer</a></div>
                    <div><a href="{{ route('customer.show', ['id']) }}" class="text-lg font-semibold">Retrieve a customer</a></div>
                    <div><a href="{{ route('customer.edit', ['id']) }}" class="text-lg font-semibold">Update a customer</a></div>
                    <div><a href="{{ route('customer.delete') }}" class="text-lg font-semibold">Delete a customer</a></div>
                    <div><a href="{{ route('customer.index') }}" class="text-lg font-semibold">List all customers</a></div>
                </div>
               
            </div>
        </div>

        <div class="overflow-hidden bg-indigo-100 border-gray-200 p-3 m-2 rounded-xl">
            <div class="m-2 text-justify text-sm">
                <h2 class="font-bold text-4xl mb-8 text-indigo-900">Card</h2>
                <div class="text-center">
                    <div><a href="{{ url('/card/create') }}" class="text-lg font-semibold" >Create a Card</a></div>
                    <div><a href="{{ route('card.show', ['id']) }}" class="text-lg font-semibold">Retrieve a Card</a></div>
                    <div><a href="{{ route('card.edit', ['id']) }}" class="text-lg font-semibold">Update a Card</a></div>
                    <div><a href="{{ route('card.delete') }}" class="text-lg font-semibold">Delete a Card</a></div>
                    <div><a href="{{ route('card.index') }}" class="text-lg font-semibold">List all Cards</a></div>
                </div>
               
            </div>
        </div>

        <div class="overflow-hidden bg-indigo-100 border-gray-200 p-3 m-2 rounded-xl">
            <div class="m-2 text-justify text-sm">
                <h2 class="font-bold text-4xl mb-8 text-indigo-900">Charges</h2>
                <div class="text-center">
                    <div><a href="{{ url('/charge/create') }}" class="text-lg font-semibold" >Create a Charge</a></div>
                    <div><a href="{{ route('charge.show', ['id']) }}" class="text-lg font-semibold">Retrieve a Charge</a></div>
                    <div><a href="{{ route('charge.edit', ['id']) }}" class="text-lg font-semibold">Update a Charge</a></div>
                    <div><a href="{{ route('charge.delete') }}" class="text-lg font-semibold">Capture a Charge</a></div>
                    <div><a href="{{ route('charge.index') }}" class="text-lg font-semibold">List all Charges</a></div>
                </div>
               
            </div>
        </div>

        <div class="overflow-hidden bg-indigo-100 border-gray-200 p-3 m-2 rounded-xl">
            <div class="m-2 text-justify text-sm">
                <h2 class="font-bold text-4xl mb-8 text-indigo-900">PaymentMethod</h2>
                <div class="text-center">
                    <div><a href="{{ url('/paymentmethod/create') }}" class="text-lg font-semibold" >Create a PaymentMethod</a></div>
                    <div><a href="{{ route('paymentmethod.show', ['id']) }}" class="text-lg font-semibold">Retrieve a PaymentMethod</a></div>
                    <div><a href="{{ route('paymentmethod.edit', ['id']) }}" class="text-lg font-semibold">Update a PaymentMethod</a></div>
                    <div><a href="{{ route('paymentmethod.delete') }}" class="text-lg font-semibold">Detach a PaymentMethod from a Customer</a></div>
                    <div><a href="{{ route('paymentmethod.index') }}" class="text-lg font-semibold">List a Customer's PaymentMethods</a></div>
                    <div><a href="{{ route('paymentmethod.getcustomer') }}" class="text-lg font-semibold">Attach a PaymentMethod to a Customer</a></div>

                </div>
               
            </div>
        </div>
    

    </div>

</body>

</html>
