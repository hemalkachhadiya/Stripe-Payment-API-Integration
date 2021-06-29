@extends('layouts.app')
@section('title')
    Create Customer | Stripe Demo
@endsection

@section('content')
    <h1 class="text-center mt-10 text-indigo-900 text-2xl font-extrabold">
        Create Customer
    </h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-6 flex flex-col justify-center">
            {{-- <div class="flex flex-col">
            <label class="text-lg font-bold mb-2">
                Address
                <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                    Optional
                </span>
            </label>

            <div class="border border-gray-500 rounded-lg p-3 grid grid-cols-3 gap-2">
                <input type="text" name="city" id="city" placeholder="City"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white border border-gray-400 text-gray-800 font-semibold focus:border-blue-500 focus:outline-none" />
                <input type="text" name="country" id="country" placeholder="Country"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
                <input type="text" name="line1" id="line1" placeholder="Line1"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
                <input type="text" name="line2" id="line2" placeholder="Line2"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
                <input type="number" name="postal_code" id="postal_code" placeholder="Postal_code"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
                <input type="text" name="state" id="state" placeholder="State"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

        </div> --}}

            <div class="flex flex-col mt-6">
                <label for="description" class="text-lg font-bold mb-2">
                    Description
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                </label>
                <textarea name="description" id="description" placeholder="Description"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none"></textarea>
            </div>

            <div class="flex flex-col mt-6">
                <label for="email" class="text-lg font-bold mb-2">
                    Email
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                </label>
                <input type="email" name="email" id="email" placeholder="Email"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="name" class="text-lg font-bold mb-2">
                    Name
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                </label>
                <input type="text" name="name" id="name" placeholder="Full Name"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="name" class="text-lg font-bold mb-2">
                    Payment Method
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                </label>
                <input type="text" name="payment_method" id="payment_method" placeholder="ex. id_cus233sfd2s86"
                    class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="name" class="text-lg font-bold mb-2">
                    Phone
                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-gray-900 bg-gray-200 mx-1">
                        Optional
                    </span>
                </label>
                <input type="number" name="phone" id="phone" placeholder="Number"
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
        $("#target").on('click', function(event) {

            var formdata = {
                '_token': "{{ csrf_token() }}",
                'description': $("#description").val(),
                'email': $("#email").val(),
                'name': $("#name").val(),
                'phone': $("#phone").val(),
                'payment_method': $("#payment_method").val(),
            }

            $.ajax({
                url: "{{ route('customer.store') }}",
                type: "POST",
                data: formdata,
                success: function(data) {
                    $("#json").css("display", "block");
                    $("#responce").html(JSON.stringify(data, null, '\t'));
                }
            });
        });

    </script>

@endsection
