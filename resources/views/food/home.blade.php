<?php
// Initialize cart array in session
if (session('cart') == null) {
    session()->put('cart', array());
}
?>

@extends('layouts.app')

@section('content')

<div class="hidden flex w-full justify-center items-center" id="message-modal" data-object="{{ Session::get('unauthorized')}}">
    <div class="px-4 py-2 mb-4 mx-2 bg-red-100 w-8/12 flex">
        <p id="message-content" class="text-red-800 flex-grow m-auto font-semibold"></p>
        <button type="button" class="close text-lg" id="close">x</button>
    </div>
</div>

<div class="mx-8">
    <div class="flex flex-row space-x-4">
        <span class="font-weight-bold sort-font my-auto"> Sort By :</span>
        <div class="columns-1 w-20 border-solid border-2 border-black rounded-md text-center bg-slate-200">
            <a href="/home" class="sort-font">All</a>
        </div>
        <div class="columns-1 w-20 border-solid border-2 border-black rounded-md text-center bg-slate-200">
            <a href="../home/Western" class="sort-font">Western</a>
        </div>
        <div class="columns-1 w-20 border-solid border-2 border-black rounded-md text-center bg-slate-200">
            <a href="../home/Chinese" class="sort-font">Chinese</a>
        </div>
        <div class="columns-1 w-20 border-solid border-2 border-black rounded-md text-center bg-slate-200">
            <a href="../home/Japanese" class="sort-font">Japanese</a>
        </div>
    </div>
</div>

<div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-5">
    @foreach($foods as $data)
    <div class="rounded-md overflow-hidden shadow-md border-1 border-gray-100">
        <a class="nav-link" href="../food/{{$data['id']}}">
            <img class="pt-2 h-48 w-full object-cover" src="{{$data['picture']}}" alt="Mountain">
            <div class="py-4">
                <div class="font-bold text-xl mb-2">{{$data['name']}}</div>
                <p class="text-gray-700 text-base">
                    RM {{$data['price']}}
                </p>
            </div>
        </a>
    </div>
    @endforeach
</div>
<span class="p-5">
    {{$foods -> links()}}
</span>
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
        const modal = document.getElementById('message-modal');
        const content = document.getElementById('message-content');
        const closeBtn = document.getElementById('close');

        if (modal.dataset.object != '') {
            modal.classList.remove('hidden');
            content.innerHTML = modal.dataset.object
        }

        closeBtn.addEventListener('click', function(e) {
            modal.classList.add('hidden');
        })


    })
</script>
@endsection