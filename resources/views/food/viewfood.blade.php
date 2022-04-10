@extends('layouts.app')
@section('content')

<div class="flex flex-col items-center">
    <div class="flex flex-col items-center w-4/5">
        <div class="self-end pb-2">
            <button onclick="location.href='/food/addfood'" style="font-size:20px" class="flex py-2 px-4 border border-transparent shadow-sm text-lg 
            font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add <i class="material-icons self-center">add</i></button>
        </div>
        <table class="p-10 border-collapse border bg-white">
            <thead>
                <tr>
                    <th class="border px-2 py-2">ID</th>
                    <th class="border px-2 py-2">Name</th>
                    <th class="border px-2 py-2">Description</th>
                    <th class="border px-2 py-2">Price</th>
                    <th class="border px-2 py-2">Type</th>
                    <th class="border px-2 py-2">Picture</th>
                </tr>
            </thead>
            @foreach($foods as $food)
            <tbody>
                <tr>
                    <td class="border px-2 py-2">{{$food['id']}}</td>
                    <td class="border px-2 py-2">{{$food['name']}}</td>
                    <td class="border px-2 py-2">{{$food['description']}}</td>
                    <td class="border px-2 py-2">{{$food['price']}}</td>
                    <td class="border px-2 py-2">{{$food['type']}}</td>
                    <td class="border px-2 py-2">{{$food['picture']}}</td>
                    <td class="border px-2 py-2">
                        @can('update', $food)
                        <form action="/updatefood/{{$food['id']}}" method="GET">
                            @csrf
                            <button type="submit" class="text-sky-600">Edit</button>
                        </form>
                        @endcan
                    </td>
                    <td class="border px-2 py-2">
                        @can('delete', $food)
                        <form action="/food/{{$food['id']}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <span class="p-5">
            {{$foods -> links()}}
        </span>
    </div>
</div>
@endsection