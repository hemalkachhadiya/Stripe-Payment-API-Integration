@extends('layouts.app')
@section('title')
    Update Charge | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Update Charge
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col justify-center">

            <div class="flex flex-col mt-6">
                <label for="charge" class="text-lg font-bold mb-2">
                    Charge
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-white bg-red-600 mx-1">
                        REQUIRED
                    </span>
                    <span id="charge-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <select id="charge" name="charge"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                    <option></option>
                </select>
            </div>

            <div class="flex flex-col mt-6">
                <label for="fraud_details" class="text-lg font-bold mb-2">
                    Fraud Details
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                    <span id="fraud_details-error" class="text-sm hidden py-1 px-2 rounded text-red-600 mx-1">
                    </span>
                </label>
                <select id="fraud_details" name="fraud_details"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                <option value="safe">Safe</option>
                <option value="fraudulent">Fraudulent</option>
            </select>
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
                url: "{{ url('/charge/all') }}",
                type: "POST",
                data: limitdata,
                success: function(data) {
                    $.each(data.data, function(key, value) {
                        var option = "<option value='" + value.id + "'>" + value.id +
                            "</option>";
                        $("#charge").append(option);
                    });
                }
            });
        });

        $("#target").on('click', function(event) {
            console.log($("#charge").val());
            if($("#charge").val() == ""){
                $("#charge-error").removeClass("hidden");
                $("#charge-error").html("The charge field is required.");
                $("#charge-error").addClass("inline-block");
            }else{
                var formdata = {
                '_token'    : "{{ csrf_token() }}",
                'fraud_details'  : $("#fraud_details").val(),
            }
            var charge = $("#charge").val();

            $.ajax({
                url: "{{ url('/charge') }}/"+charge,
                type: "PUT",
                data: formdata,
                success: function(data) {
                    $("#json").css("display", "block");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                },
                error: function(data) {
                    if(data.responseJSON.errors.hasOwnProperty('fraud_details')){
                        $("#fraud_details-error").removeClass("hidden");
                        $("#fraud_details-error").html(data.responseJSON.errors.fraud_details[0]);
                        $("#fraud_details-error").addClass("inline-block");
                    }
                },
            });
            }
           
        });

    </script>

@endsection
