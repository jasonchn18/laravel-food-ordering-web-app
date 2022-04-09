<?php
    // Initialize cart array in session
    if(session('cart') == null) {
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
</div>-->
<div class="mx-5 col-md-12 mb-3">
    <span class="font-weight-bold sort-font"> Sort By :</span>
    <a href="" class="sort-font">All</a>
    <a href="" class="sort-font">Western</a>
    <a href="" class="sort-font">Chinese</a>
    <a href="" class="sort-font">Japanese</a>

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