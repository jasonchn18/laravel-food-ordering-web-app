@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center">
  <form action="/user/edit" method="POST" class="w-50">
  @csrf
    <div class="shadow sm:rounded-md sm:overflow-hidden">
      <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
        <div>
          <div class="col-span-3 sm:col-span-2">
            <label for="food name" class="block text-lg font-medium text-gray-700"> Name </label>
            <div class="mt-1 flex flex-col rounded-md">
              <input required type="text" value="{{$user['name']}}" name="name" id="name" class="shadow-sm @error('name') is-invalid @enderror p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300" placeholder="Cheeseburger">
              @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            
          </div>
        </div>

        <div>
          <label for="food description" class="block text-lg font-medium text-gray-700"> Email </label>
          <div class="mt-1">
            <input required id="description" value="{{$user['email']}}" name="email" type="email" class="@error('email') is-invalid @enderror resize-none p-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-lg border border-gray-300 rounded-md" placeholder="example@email.com">
            @error('email') 
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div>
          <label for="food price" class="block text-lg font-medium text-gray-700"> Address</label>
          <div class="mt-1 flex flex-col rounded-md">
              <textarea required name="address" id="price" rows="3"  class="shadow-sm @error('address') resize-none is-invalid @enderror p-1 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-lg border-gray-300" placeholder="Sesame Street">{{$user['address']}}</textarea>
              @error('address')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
        </div> 
      </div>
      <div class="px-4 py-3 text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
      </div>
    </div>
  </form>
</div>
@endsection