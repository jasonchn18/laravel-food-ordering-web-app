@extends('layouts.app')

<?php
if (session('cart') == null) {
    session()->put('cart', array());
}

$total = 0.0;
if (!empty(session('cart'))) {
    foreach (session('cart') as $key => $value) {
        $total += ($value['price'] * $value['quantity']);
    }
}
?>

@section('content')
<h1 class="px-4 pt-1 pb-3 text-3xl font-bold">
    <div class="flex flex-row">
        <div class="flex flex-row flex-1">
            <span class="mr-5 self-center"> My Cart </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div class="flex-1 text-right text-2xl self-center">
            @if (!empty(session('cart')))
            <span class="mr-8 "> Total: RM{{number_format((float)($total), 2, '.', '')}} </span>
            @endif
        </div>
    </div>
</h1>

{{-- Check if cart is not empty --}}
@if (count(session('cart')) != 0)
{{-- Cart --}}
@foreach (session('cart') as $food)
<div class="px-3 py-2">
    <div class="flex flex-row px-4 py-3 leading-normal border shadow-md hover:bg-gray-100">
        <div class="w-full">
            <div class="flex flex-col justify-between">
                <div class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-full hover:bg-gray-100">
                    <div class="flex rounded-lg">
                        <img class="flex h-28 w-44 object-fill rounded-lg" src="{{$food['picture']}}">
                    </div>
                    <div class="flex flex-col place-content-center px-4 py-3 leading-normal w-4/6">
                        <h5 class="flex mb-2 text-2xl font-bold tracking-tight text-gray-900"> {{$food['name']}} </h5>
                        <p class="flex font-normal text-gray-700"> Quantity: <b>&nbsp;{{$food['quantity']}}</b> </p>
                        <p class="flex font-normal text-gray-700"> Price: <b>&nbsp;RM{{number_format((float)($food['price']*$food['quantity']), 2, '.', '')}} &ensp;</b> <span class="opacity-60"> [RM{{number_format((float)($food['price']), 2, '.', '')}} per unit] <span> </p>
                    </div>
                    <div class="flex justify-center leading-normal w-1/6">
                        <button onclick="remove_form_action({{$food['id']}})" type="button" class="openRemoveModal text-red-700 font-semibold bg-inherit border-red-500 rounded hover:text-white hover:bg-red-500 hover:border-transparent py-1 px-3 border-2">
                            <span> Remove </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="flex justify-center">
    <button type="button" class="openOrderModal shadow leading-tight bg-green-600 text-white text-xl font-semibold rounded-lg m-4 px-12 py-3 text-sm focus:outline-none focus:border-white">
        Place Order
    </button>
</div>
@else
<p class="px-4 pt-4 text-lg">
    Your cart is empty.
</p>
@endif

<!-- Remove item modal -->
<div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="remove-modal">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="p-1 sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: outline/exclamation -->
                        {{-- <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="red" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="-3.5 -3 31 31" stroke="red" strokeWidth={2}>
                            <path strokeLinecap="round" strokeLinejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div class="pl-1 sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Are you sure you want to remove this item from your order?</h3>
                        {{-- <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                            </div> --}}
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form name="remove_form" id="remove_form" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="closeRemoveModal w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"> Confirm </button>
                </form>
                <button type="button" class="closeRemoveModal w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-inherit text-base font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
            </div>
        </div>
    </div>
</div>

{{-- Place Order Modal --}}
<div x-show="show" tabindex="0" class="invisible z-40 overflow-auto left-0 top-8 bottom-0 right-0 w-full h-full fixed" id="order-modal">
    <div class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
        <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
            <button class="closeOrderModal fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
            <div class="px-6 py-3 text-xl border-b font-bold">Place Order</div>
            <form method="POST" action="/cart/placeorder" class="px-4 pt-2 pb-4" name="place-order-form" id="place-order-form">
                @csrf
                <div class="p-6 flex-grow">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                            Order Type:
                        </label>
                        <div class="columns-2 gap-2 w-fit">
                            <div><label> <input type="radio" name="type" id="pickupType" value="pickup" onclick="showAddressField()" checked> Pickup </label></div>
                            <div><label> <input type="radio" name="type" id="deliveryType" value="delivery" onclick="showAddressField()"> Delivery </label></div>
                        </div>
                    </div>
                    <div class="hidden" id="address_div">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                            Address:
                        </label>
                        @if(Auth::user())
                        <textarea rows="3" class="resize-none shadow-sm appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address">{{Auth::user() -> address}}</textarea>
                        @endif
                        <span class="">
                            <p id="addresserr" class="text-red-600"></p>
                        </span>
                    </div>
                </div>
                <div class="px-6 pt-3 border-t">
                    <div class="flex justify-end">
                        <button type="button" class="closeOrderModal bg-gray-700 text-gray-100 rounded px-4 py-2 mr-1">Close</Button>
                        <button type="button" class="openPaymentModal bg-green-600 text-white rounded px-4 py-2">Proceed to Payment</Button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
</div>

<!-- Payment Processing Modal -->
<div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-0 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="payment-modal">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                    {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>   --}}
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-3 text-center">
                {{-- <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                <div class="flex justify-center pb-5">
                    <svg role="status" class="mr-2 w-16 h-16 text-gray-200 animate-spin fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-normal text-gray-500">Payment is being processed.</h3>
                {{-- <button data-modal-toggle="popup-modal" type="button" class="closePaymentModal text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="popup-modal" type="button" class="closePaymentModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancel</button> --}}
            </div>
        </div>
    </div>
</div>

<!-- Payment Success Modal -->
<div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-0 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="payment-success-modal">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                    {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>   --}}
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-3 text-center">
                {{-- <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                <div class="flex justify-center pb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 stroke-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mb-4 text-2xl font-semibold text-gray-600">Payment successful!</h3>
                {{-- <button data-modal-toggle="popup-modal" type="button" class="closePaymentModal text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-toggle="popup-modal" type="button" class="closePaymentModal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancel</button> --}}
            </div>
        </div>
    </div>
</div>

{{-- Just for some spacing before the end of page (footer) --}}
<div class="py-10"></div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.openRemoveModal').on('click', function(e) {
            $('#remove-modal').removeClass('invisible');
        });
        $('.closeRemoveModal').on('click', function(e) {
            $('#remove-modal').addClass('invisible');
        });

        $('.openOrderModal').on('click', function(e) {
            $('#order-modal').removeClass('invisible');
        });
        $('.closeOrderModal').on('click', function(e) {
            $('#order-modal').addClass('invisible');
        });

        $('.openPaymentModal').on('click', function(e) {
            if (document.getElementById('deliveryType').checked) {
                if (validateForm()) {
                    $('#payment-modal').removeClass('invisible');
                    setTimeout(function() {
                        $('#payment-modal').addClass('invisible');
                        showPaymentSuccess();
                    }, 3000);
                }
            } else {
                $('#payment-modal').removeClass('invisible');
                setTimeout(function() {
                    $('#payment-modal').addClass('invisible');
                    showPaymentSuccess();
                }, 3000);
            }
        });

        function showPaymentSuccess() {
            $('#payment-success-modal').removeClass('invisible');
            setTimeout(function() {
                $('#payment-success-modal').addClass('invisible');
                submitOrderForm();
            }, 2000);
        }

        function submitOrderForm() {
            $('#place-order-form').submit();
        }


    });

    function validateForm() {
        let x = document.forms["place-order-form"]["address"].value;
        const address = document.querySelector('#addresserr');
        if (x == "") {
            console.log(address);
            address.innerHTML = "Delivery address cannot be empty"
            return false;
        }
        return true;
    }

    function remove_form_action(food_id) {
        $('#remove_form').attr('action', '/cart/remove/' + food_id);
    }

    function showAddressField() {
        if (document.getElementById('deliveryType').checked) {
            $('#address_div').removeClass('hidden');
            $('#address_field').prop('required', true);
        } else {
            $('#address_div').addClass('hidden');
            $('#address_field').prop('required', false);
        }
    }

    function setAddress() {

        document.getElementById('address').defaultValue = 'abc';
    }
</script>
@endsection