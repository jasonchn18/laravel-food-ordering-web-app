@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center">
  <form action="/food/{{$food['id']}}" method="POST" class="w-50">
  @csrf
    <div class="shadow sm:rounded-md sm:overflow-hidden">
      <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
        <div class="grid grid-cols-3 gap-6">
          <div class="col-span-3 sm:col-span-2">
            <label for="food name" class="block text-lg font-medium text-gray-700"> Food Name </label>
            <div class="mt-1 flex rounded-md shadow-sm">
              <input value="{{$food['name']}}" type="text" name="name" id="name" class="p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300" placeholder="Cheeseburger">
            </div>
          </div>
        </div>

        <div>
          <label for="food description" class="block text-lg font-medium text-gray-700"> Food Description </label>
          <div class="mt-1">
            <textarea id="description" name="description" rows="3" class="resize-none p-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-lg border border-gray-300 rounded-md" placeholder="Cheeseburger not tasty">{{$food['description']}}</textarea>
          </div>
        </div>

        <div>
          <label for="food price" class="block text-lg font-medium text-gray-700"> Food Price </label>
          <div class="mt-1 flex rounded-md shadow-sm">
              <input value="{{$food['price']}}" type="number" name="price" id="price" class="p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300" placeholder="20.00">
            </div>
        </div>

        <div>
          <label for="food type" class="block text-lg font-medium text-gray-700">Food type</label>
          <div>
          <select name="type" id="type" class="flex justify-center mt-1 flex rounded-md shadow-sm p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300">>
            <option value="Western" {{($food['type'] == "Western") ? "selected" : ""}}>Western</option>
            <option value="Chinese" {{($food['type'] == "Chinese") ? "selected" : ""}}>Chinese</option>
            <option value="Japanese" {{($food['type'] == "Japanese") ? "selected" : ""}}>Japanese</option>
            
          </select>
        </div>

        <div class="mt-3">
          <label for="food price" class="block text-lg font-medium text-gray-700"> Food Photo Link </label>
          <div class="mt-1 flex rounded-md shadow-sm">
              <input value="{{$food['picture']}}" type="text" name="picture" id="picture" class="p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300" placeholder="https://www.google.com/">
            </div>
        </div>  
      </div>
      <div class="px-4 py-3 text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
      </div>
    </div>
  </form>
</div>
@endsection