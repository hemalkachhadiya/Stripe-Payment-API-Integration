@extends('layouts.app')
@section('title')
Create a PaymentMethod | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Create a PaymentMethod
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col justify-center">

            <div class="flex flex-col mt-6">
                <label for="number" class="text-lg font-bold mb-2">
                    Card Number
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="number-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="number" id="number" placeholder="12-Digit Number"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="exp_month" class="text-lg font-bold mb-2">
                    Expiration Month
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="exp_month-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="exp_month" id="exp_month" placeholder="MM"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="exp_year" class="text-lg font-bold mb-2">
                    Expiration Year
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="exp_year-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="exp_year" id="exp_year" placeholder="YYYY"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>


            <div class="flex flex-col mt-6">
                <label for="cvc" class="text-lg font-bold mb-2">
                    CVC
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                    <span id="cvc-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="cvc" id="cvc" placeholder="CVC"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>







            <a href="https://stripe.com/docs/api/customers/create?lang=php" class="text-indigo-900 mt-5">Many Parameters Not
                Cover In This Example So Please Visite Website</a>

            <a href="https://www.positronx.io/integrate-stripe-payment-gateway-in-laravel-application/" class="text-indigo-900 mt-5">For Test Data Visit This Website </a>


            <button id="target"
                class="bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">
                Submit
            </button>
        </div>
        <div class="bg-gray-900 m-10 rounded-2xl" id="json" style="display: none;">
            <pre class="text-white p-8 w-100 text-sm" id="responce">

                            </pre>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
         $(document).ready(function() {
        });
        $("#target").on('click', function(event) {
            var formdata = {
                '_token': "{{ csrf_token() }}",
                'cvc': $("#cvc").val(),
                'exp_year': $("#exp_year").val(),
                'exp_month': $("#exp_month").val(),
                'number': $("#number").val(),
            }

            $.ajax({
                url: "{{ route('paymentmethod.store') }}",
                type: "POST",
                data: formdata,
                success: function(data) {
                    $("#cvc-error").addClass("hidden");
                    $("#exp_year-error").addClass("hidden");
                    $("#exp_month-error").addClass("hidden");
                    $("#number-error").addClass("hidden");
                    $("#json").css("display", "block");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                },
                error:function(data) {

                    $("#json").css("display", "none");
                    $("#cvc-error").addClass("hidden");
                    $("#exp_year-error").addClass("hidden");
                    $("#exp_month-error").addClass("hidden");
                    $("#number-error").addClass("hidden");

                    if(data.responseJSON.errors.hasOwnProperty('cvc')){
                        $("#cvc-error").removeClass("hidden");
                        $("#cvc-error").html(data.responseJSON.errors.cvc[0]);
                        $("#cvc-error").addClass("inline-block");
                    }

                    if(data.responseJSON.errors.hasOwnProperty('exp_year')){
                        $("#exp_year-error").removeClass("hidden");
                        $("#exp_year-error").html(data.responseJSON.errors.exp_year[0]);
                        $("#exp_year-error").addClass("inline-block");
                    }

                    if(data.responseJSON.errors.hasOwnProperty('exp_month')){
                        $("#exp_month-error").removeClass("hidden");
                        $("#exp_month-error").html(data.responseJSON.errors.exp_month[0]);
                        $("#exp_month-error").addClass("inline-block");
                    }

                    if(data.responseJSON.errors.hasOwnProperty('number')){
                        $("#number-error").removeClass("hidden");
                        $("#number-error").html(data.responseJSON.errors.number[0]);
                        $("#number-error").addClass("inline-block");
                    }

                },
            });
        });

    </script>

@endsection
