@extends('layouts.app')
@section('title')
    Update a PaymentMethod | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Update a PaymentMethod
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col justify-center">

            <div class="flex flex-col mt-6">
                <label for="id" class="text-lg font-bold mb-2">
                    PaymentMethod_ID
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="id-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none"
                    type="text" name="id" id="id" value="pm_1J5WPZSGK3FuNZrbXE1iawZ1" disabled />
            </div>

            <div class="flex flex-col mt-6">
                <label for="exp_month" class="text-lg font-bold mb-2">
                    Expiration Month
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
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
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                    <span id="exp_year-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="exp_year" id="exp_year" placeholder="YYYY"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <a href="https://stripe.com/docs/api/customers/create?lang=php" class="text-indigo-900 mt-5">Many Parameters Not
                Cover In This Example So Please Visite Website</a>


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
            var limitdata = {
                '_token': "{{ csrf_token() }}",
                'limit': 4,
            }
            $.ajax({
                url: "{{ url('/customer/all') }}",
                type: "POST",
                data: limitdata,
                success: function(data) {
                    $.each(data.data, function(key, value) {
                        var option = "<option value='" + value.id + "'>" + value.id +
                            "</option>";
                        $("#customer").append(option);
                    });
                }
            });
        });

        $("#target").on('click', function(event) {
                var id = $("#id").val();
                var formdata = {
                    '_token': "{{ csrf_token() }}",
                    'exp_month': $("#exp_month").val(),
                    'exp_year': $("#exp_year").val(),
                }
                $.ajax({
                    url: "{{ url('/paymentmethod') }}/" + id,
                    type: "PUT",
                    data: formdata,
                    success: function(data) {
                        $("#json").css("display", "block");
                        $("#responce").html(JSON.stringify(data, null, '\t'));
                    },
                    error: function(data) {
                        if (data.responseJSON.errors.hasOwnProperty('exp_year')) {
                            $("#exp_year-error").removeClass("hidden");
                            $("#exp_year-error").html(data.responseJSON.errors.exp_year[0]);
                            $("#exp_year-error").addClass("inline-block");
                        }

                        if (data.responseJSON.errors.hasOwnProperty('exp_month')) {
                            $("#exp_month-error").removeClass("hidden");
                            $("#exp_month-error").html(data.responseJSON.errors.exp_month[0]);
                            $("#exp_month-error").addClass("inline-block");
                        }
                    },
                });

        });
    </script>

@endsection
