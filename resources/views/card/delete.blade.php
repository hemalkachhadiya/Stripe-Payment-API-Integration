@extends('layouts.app')
@section('title')
    Delete Card | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Delete Card
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col justify-center">

            <div class="flex flex-col mt-6">
                <label for="description" class="text-lg font-bold mb-2">
                    Customer
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="customer-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                
                <select id="customer" name="customer"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                </select>
            </div>

            <div class="flex flex-col mt-6">
                <label for="card" class="text-lg font-bold mb-2">
                    Card
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="card-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <select id="card" name="card"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                </select>
            </div>


            <a href="https://stripe.com/docs/api/customers/create?lang=php" class="text-indigo-900 mt-5">Many Parameters Not
                Cover In This Example So Please Visite Website</a>


            <button id="target"
                class="bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">
                Delete
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
            var customer = $("#customer").val();
            var card = $("#card").val();
            if($("#card").val() == null){
                $("#card-error").removeClass("hidden");
                $("#card-error").html("The card field is required.");
                $("#card-error").addClass("inline-block");
            }else{
            var formdata = {
                '_token': "{{ csrf_token() }}",
                'customer': customer
            }

            $.ajax({
                url: "{{ url('/card') }}/"+card,
                type: "DELETE",
                data: formdata,
                success: function(data) {
                    $("#json").css("display", "block");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                }
            });
            }
        });

         $("#customer").on('change', function(event){
            var customer = $("#customer").val();

            var formdata = {
                '_token': "{{ csrf_token() }}",
                'limit': 100,
                'customer': customer
            }
            $.ajax({
                url: "{{ url('/card/all') }}",
                type: "POST",
                data: formdata,
                success: function(data) {
                    $( "#card" ).empty();
                   if(Array.isArray(data.data) && data.data.length){
                    $("#card").removeClass("hidden");
                    $.each(data.data, function(key, value) {
                        var option = "<option value='" + value.id + "'>" + value.id +
                            "</option>";
                        $("#card").append(option);
                    });
                   }else{
                    $("#card").addClass("hidden");
                   }
                    
                },
                error: function(data) {
                    
                },
            });

        });

    </script>

@endsection
