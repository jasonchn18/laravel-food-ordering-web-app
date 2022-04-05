@extends('layouts.app')
@section('content')
<div class="px-3 py-2 flex flex-col justify-center items-center">
    <div class="flex flex-row leading-normal border shadow-md rounded-lg w-8/12 items-center bg-white">
        <div class="h-full">
            <img src="{{ $food['picture'] }}" class='object-fill xl:rounded-l-lg h-full'>
        </div>
        <div class="flex flex-col p-4 self-start ">
            <h1 class="font-bold font-sans text-2xl leading-8">{{ $food['name'] }}</h1>
            <h1 class="font-semibold font-sans text-lg text-red-500 leading-8">RM {{ $food['price'] }}</h1>
            <h1 class="font-serif text-sm text-gray-600 leading-7">{{ $food['description'] }}</h1>
            <div class="pt-3 flex flex-col ">
                <div>
                <h1 class="font-sans text-sm text-gray-900 leading-8">Quantity</h1>
                    <div class="inline-flex rounded-md border-2">
                        <button class="py-2 px-3 font-bold border-r-2">-</button>
                        <p class="py-2 px-3 text-sm m-0">1</p>
                        <button class="py-2 px-3 font-bold border-l-2">+</button>
                    </div>
                </div>
                <button class="p-2 mt-4 bg-blue-600 hover:text-blue-600 text-neutral-50 rounded-md hover:bg-white border-2 border-blue-600 ">Add to Order</button>
            </div>

        </div>
    </div>
</div>

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
                <button type="button" class="closeRemoveModal w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"> Confirm </button>
                <button type="button" class="closeRemoveModal w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-inherit text-base font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
            </div>
        </div>
    </div>
</div>

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

        // $('.closePaymentModal').on('click', function(e){
        //     $('#payment-modal').addClass('invisible');
        // });
    });
</script>
@endsection