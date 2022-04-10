<?php
// Initialize cart array in session
if (session('cart') == null) {
    session()->put('cart', array());
}
?>

@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

            </div>
        </div>
    </div>
    ***
    <div class="w-64 ml-16">
    <label for="food type" class="block text-lg font-medium text-gray-700">Sort by :</label>
    <div>
        <select name="type" id="type" class="flex justify-center mt-1 flex rounded-md shadow-sm p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300">>
            <option value="Western">All</option>
            <option value="Western">Western</option>
            <option value="Chinese">Chinese</option>
            <option value="Japanese">Japanese</option>
        </select>
    </div>
    ***
</div>
</div>-->

<div>
    
</div>

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
<div class="p-8">

    <div class=" grid grid-cols-4 gap-4 place-items-center">
        @foreach($foods as $data)


        <div class="p-8 m-8 border-solid border-2 border-indigo-600 rounded-md text-center">
            <a class="nav-link" href="../food/{{$data['id']}}">
                <p class="text-black text-xl font-bold">{{$data['name']}}</p>
                <section class="hero container max-w-screen-lg mx-auto pb-10 flex justify-center">
                    <img src=" {{$data['picture']}}" alt="screenshot" heigt="300" width="300">
                </section>
                <p class="text_black">RM {{$data['price']}}</p>
            </a>
        </div>


        @endforeach
    </div>
    <span class="p-5">
        {{$foods -> links()}}
    </span>
</div>
@endsection