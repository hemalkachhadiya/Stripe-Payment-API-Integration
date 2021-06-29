@extends('layouts.app')
@section('title')
Detach a PaymentMethod from a Customer | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Detach a PaymentMethod from a Customer
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
                    type="text" name="id" id="id" />
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
        });

        $("#target").on('click', function(event) {
            var id = $("#id").val();
            if($("#id").val() == ''){
                $("#id-error").removeClass("hidden");
                $("#id-error").html("The id field is required.");
                $("#id-error").addClass("inline-block");
            }else{
                console.log($("#id").val());
            var formdata = {
                '_token': "{{ csrf_token() }}",
                'id': id
            }

            $.ajax({
                url: "{{ url('/paymentmethod') }}/"+id,
                type: "DELETE",
                data: formdata,
                success: function(data) {
                    $("#json").css("display", "block");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                }
            });
            }
        });
    </script>

@endsection
