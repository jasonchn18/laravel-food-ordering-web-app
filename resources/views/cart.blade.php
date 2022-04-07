
@extends('layouts.app')

<?php
    if(session('cart') != null) {
        // dd(session('cart'));
    }
?>

@section('content')
    <h1 class="px-4 pt-1 pb-3 text-3xl font-bold">
        <div class="flex flex-row">
            <span class="mr-5 self-center"> My Cart </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 self-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </h1>

    {{-- Cart --}}
    @foreach (session('cart') as $food)
    <div class="px-3 py-2">
        <div class="flex flex-row p-4 leading-normal border shadow-md hover:bg-gray-100">
            <div class="w-full">
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-full hover:bg-gray-100">
                        <div class="flex rounded-lg">
                            <img class="flex h-28 w-44 object-fill rounded-lg" src="{{$food['picture']}}">
                        </div>
                        <div class="flex flex-col place-content-center px-4 py-3 leading-normal w-4/6">
                            <h5 class="flex mb-2 text-2xl font-bold tracking-tight text-gray-900"> {{$food['name']}} </h5>
                            <p class="flex font-normal text-gray-700"> Quantity: <b>&nbsp;{{$food['quantity']}}</b> </p>
                            <p class="flex font-normal text-gray-700"> Price: <b>&nbsp;RM{{$food['price']*$food['quantity']}}.00 &ensp;</b> <span class="opacity-60"> [RM{{$food['price']}}.00 per unit] <span> </p>
                        </div>
                        <div class="flex justify-center leading-normal w-1/6">
                            <button onclick="remove_form_action({{$food['id']}})" type="button" class="openRemoveModal text-red-700 font-semibold bg-inherit border-red-500 rounded hover:text-white hover:bg-red-500 hover:border-transparent py-1 px-3 border-2">
                                <span> Remove </span>
                            </button>
                        </div>
                    </div>
                    <div class="p-1"></div>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('.openRemoveModal').on('click', function(e){
                $('#remove-modal').removeClass('invisible');
            });
            $('.closeRemoveModal').on('click', function(e){
                $('#remove-modal').addClass('invisible');
            });
            $('.openOrderModal').on('click', function(e){
                $('#order-modal').removeClass('invisible');
            });
            $('.closeOrderModal').on('click', function(e){
                $('#order-modal').addClass('invisible');
            });
        });
        function remove_form_action(food_id) {
            $('#remove_form').attr('action', '/cart/remove/' + food_id);
        }
    </script>
@endsection