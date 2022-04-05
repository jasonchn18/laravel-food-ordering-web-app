@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center">
    <table class="p-10 border-collapse border">
        <thead>
            <tr>
                <th class="border">ID</th>
                <th class="border">Name</th>
                <th class="border">Description</th>
                <th class="border">Price</th>
                <th class="border">Type</th>
                <th class="border">Picture</th>
            </tr>
        </thead>
        @foreach($foods as $food)
        <tbody>
            <tr>
                <td class="border">{{$food['id']}}</td>
                <td class="border">{{$food['name']}}</td>
                <td class="border">{{$food['description']}}</td>
                <td class="border">{{$food['price']}}</td>
                <td class="border">{{$food['type']}}</td>
                <td class="border">{{$food['picture']}}</td>
                <td class="border"><a href="du/{{$food['id']}}">Edit</a></td>
                <td class="border"><a href="du/{{$food['id']}}">Delete</a></td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <span class="p-5">
        {{$foods -> links()}}
    </span>
</div>
@endsection