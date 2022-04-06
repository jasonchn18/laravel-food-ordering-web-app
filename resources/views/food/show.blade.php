@extends('layouts.app')
@section('content')
<div class="px-3 py-2 flex flex-col justify-center items-center h-[70vh]">
    <div class="flex flex-row leading-normal border shadow-md rounded-lg w-8/12 bg-white">
        <div class="flex flex-col justify-center">
            <img src="{{ $food['picture'] }}" class='object-fill xl:rounded-l-lg'>
        </div>
        <div class="flex flex-col p-4 self-start h-full">
            <div class="flex-grow flex flex-col justify-around">
                <h1 class="font-bold font-sans text-2xl leading-8">{{ $food['name'] }}</h1>
                <h1 class="font-semibold font-sans text-lg text-red-500 leading-8">RM {{ $food['price'] }}</h1>
                <h1 class="font-serif text-sm text-gray-600 leading-7">{{ $food['description'] }}</h1>
            </div>
            <div class="pt-3 flex flex-col flex-grow justify-around">
                <div>
                    <h1 class="font-sans text-sm text-gray-900 leading-8">Quantity</h1>
                    <div class="inline-flex rounded-md border-2">
                        <button class="py-2 px-3 font-bold border-r-2" id="minusBtn">-</button>
                        <p class="py-2 px-3 text-sm m-0" id="qty" data-object="{{ json_encode($food) }}">1</p>
                        <button class="py-2 px-3 font-bold border-l-2" id="plusBtn">+</button>
                    </div>
                </div>
                <button id='addCartBtn' class="p-2 mt-4 bg-blue-600 hover:text-blue-600 text-neutral-50 rounded-md hover:bg-white border-2 border-blue-600 disabled:text-slate-500 disabled:bg-slate-200">Add to Order</button>
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
    function docReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            fn;
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(() => {
        const plusBtn = document.getElementById('plusBtn');
        const minusBtn = document.getElementById('minusBtn');
        const qty = document.getElementById('qty');
        const addCartBtn = document.getElementById('addCartBtn');
        const csrf = document.querySelector("meta[name='csrf-token']")
        plusBtn.addEventListener('click', function() {
            qty.innerHTML = Number(qty.innerHTML) + 1
        });

        minusBtn.addEventListener('click', function() {
            if (Number(qty.innerHTML) == 0) return;
            qty.innerHTML = Number(qty.innerHTML) - 1
        });
        addCartBtn.addEventListener('click', function(e) {
            e.target.disabled = true;
            addToCart();
        })

        async function addToCart() {
            data = {
                ...JSON.parse(qty.dataset.object),
                quantity: qty.innerHTML,
                _token: csrf.getAttribute('content'),
            }
            await $.ajax({
                url: '../addToCart',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: (route) => {
                    window.location.href = '..' + route;
                }
            });
        }
    })

    // function() {






    //     plusBtn.onclick = () => {
    //         console.log('ss');
    //     }
    // }

    {
        /* $(document).ready(function() {
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
            }); */
    }
</script>
@endsection