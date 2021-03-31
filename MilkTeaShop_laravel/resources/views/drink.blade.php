@extends('layout')
@section('title','Drink Manager')
@section('content')

<div>
  <ul class="nav">
    <li class="nav-item ">
      <a class="nav-link mx-2 btn func-btn" href="{{ url('drink/drinkform') }}">
        Insert
      </a>
    </li>
  </ul>
</div>


@endsection