@extends('layouts.app')

@section('content')
<h1 class="px-4 pt-1 pb-3 text-3xl font-bold">
    <div class="flex flex-row flex-1">
        <span class="mr-5 self-center"> My Order History </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
    </div>
</h1>

{{-- Orders --}}
{{-- Check if user is logged in --}}
@if (auth()->check())
    {{-- Check if user has any orders --}}
    @if (count($orders) != 0)
        @foreach ($orders as $order)
            <div class="px-3 py-2">
                <div class="flex flex-row p-4 leading-normal border shadow-md hover:bg-gray-100">
                    <div class="p-2 w-1/5">
                        <p class="mb-1"> Order ID: <span class="font-semibold"> {{$order->id}} </span> </p>
                        <p class="mb-1"> Date: <span class="font-semibold"> {{date_format(date_create($order->date), 'jS F Y')}} </span> </p>
                        <p class="mb-1"> Type: <span class="font-semibold capitalize"> {{$order->type}} </span> </p>
                        <p class="mb-1"> Total: <span class="font-semibold capitalize"> RM{{number_format((float)$order->total, 2, '.', '')}} </span> </p>
                        {{-- flex justify-center leading-normal w-1/6 --}}
                        <div class="mt-2">
                            <button onclick="remove_form_action({{$order->id}})" type="button" class="openRemoveModal text-red-700 font-semibold bg-inherit border-red-500 rounded hover:text-white hover:bg-red-500 hover:border-transparent py-1 px-3 border-2">
                                <span> Delete Order </span>
                            </button>
                        </div>
                    </div>
                    <div class="w-4/5">
                        <div class="flex flex-col justify-between">
                            @foreach ($order->food as $food)
                            <input type="hidden" id="order_id" value={{$order->id}} />
                            <input type="hidden" id="food_id" value={{$food->id}} />
                            <div class="flex flex-col items-center -white rounded-lg border shadow-md md:flex-row md:max-w-full hover:bg-gray-100">
                                <div class="flex rounded-lg">
                                    <img class="flex h-28 w-44 object-fill rounded-lg" src="{{$food->picture}}" alt="">
                                </div>
                                <div class="flex flex-col place-content-center px-4 py-3 leading-normal w-4/6">
                                    <h5 class="flex mb-2 text-2xl font-bold tracking-tight text-gray-900"> {{$food->name}} </h5>
                                    <p class="flex font-normal text-gray-700"> Quantity: <b>&nbsp;{{$food->pivot->quantity}}</b> </p>
                                    <p class="flex font-normal text-gray-700"> Price: <b>&nbsp;RM{{number_format((float)($food->price*$food->pivot->quantity), 2, '.', '')}} &ensp;</b> <span class="opacity-60"> [RM{{number_format((float)($food->price), 2, '.', '')}} per unit] <span> </p>
                                </div>
                            </div>
                            <div class="p-1"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Remove item modal -->
        <div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="remove-modal">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Are you sure you want to delete this order from your order history?</h3>
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

        <!-- Payment Processing Modal -->
        <div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="payment-modal">
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
        <div class="invisible flex h-screen overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="payment-success-modal">
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
    @else
        <p class="px-4 pt-4 text-lg">
            Your order history is empty.
        </p>
    @endif
@else
    <p class="px-4 pt-4 text-lg">
        You must be logged in to view your order history.
    </p>
@endif

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
        $('.openPaymentModal').on('click', function(e) {
            $('#payment-modal').removeClass('invisible');
            setTimeout(function() {
                $('#payment-modal').addClass('invisible');
                showPaymentSuccess();
            }, 3000);
        });

        function showPaymentSuccess() {
            $('#payment-success-modal').removeClass('invisible');
            setTimeout(function() {
                $('#payment-success-modal').addClass('invisible');
            }, 3000);
        }
    });

    function remove_form_action(order_id) {
        $('#remove_form').attr('action', '/order/' + order_id);
    }
</script>
@endsection