@extends('layout')
@section('title','Extra Manager')
@section('content')

<div>
  <ul class="nav">
    <li class="nav-item ">
      <a class="nav-link mx-2 btn func-btn" href="{{ url('extra/extraform') }}">
        Insert
      </a>
    </li>
  </ul>
</div>


@endsection