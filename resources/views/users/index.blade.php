@extends('layouts.default')
@section('title', '所有用户')

@section('content')
  <div class="offset-md-2 col-md-8">
    <h2 class="mb-4 text-center">List All User</h2>
    <div class="list-group list-group-flush">
      @foreach ($users as $user)
        @include('users._user',['user'=> $user])
      @endforeach
    </div>
    <div class="mt-3">
  </div>
@stop
