<?php
// Initialize cart array in session
if (session('cart') == null) {
    session()->put('cart', array());
}
?>

@extends('layouts.app')

@section('content')

<div class="mx-8">
    <div class="flex flex-row space-x-4">
        <span class="font-weight-bold sort-font"> Sort By :</span>
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
            <div class="px-6 py-4">
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
@endsection