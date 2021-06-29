@extends('layouts.app')
@section('title')
List all charges | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        List all charges
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col">
            <div class="flex flex-col mt-6">
                <label for="name" class="text-lg font-bold mb-2">
                    Limit
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                    <span id="limit-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <input type="number" name="limit" id="limit" placeholder="Limit"
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
            <pre class="text-white p-8 w-100 text-sm" id="responce"></pre>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var limitdata = {
                '_token': "{{ csrf_token() }}",
                'limit': 10,
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
            var customer = $("#customer").val();

            var formdata = {
                '_token': "{{ csrf_token() }}",
                'limit': $("#limit").val(),
                'customer': customer
            }

            $.ajax({
                url: "{{ url('/charge/all') }}",
                type: "POST",
                data: formdata,
                success: function(data) {
                    $("#json").css("display", "block");
                    $("#limit-error").removeClass("inline-block");
                    $("#limit-error").addClass("hidden");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                },
                error: function(data) {
                    $("#json").css("display", "none");
                    $("#limit-error").removeClass("hidden");
                    $("#limit-error").html(data.responseJSON.errors.limit[0]);
                    $("#limit-error").addClass("inline-block");
                },
            });
        });

    </script>

@endsection
