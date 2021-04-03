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

<div class="mt-4">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Drink ID</th>
        <th scope="col">Drink Name</th>
        <th scope="col">Drink Describe</th>
        <th scope="col">Drink Type</th>
        <th scope="col">Is Active</th>
        <th scope="col">Drink Image</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($drinks as $drink)
      <tr>
        <th scope="row">{{$drink['drink_id']}}</th>
        <td>{{$drink['drink_name']}}</td>
        <td>{{$drink['drink_describe']}}</td>
        <td>{{$drink['drink_type_id']}}</td>
        @if ($drink['is_active'])
        <td class="text-primary">Selling</td>
        @else
        <td class="text-danger">Stop selling</td>
        @endif
        <td class="text-center">
          {{-- http://127.0.0.1:8000/storage/img/KO6XtSXJTdOYOqYh3gSLjagowYWb8TkAC8AQ6ZS7.png --}}
          {{-- <img src="{{asset($drink['drink_image'])}}" alt="" srcset="" width="25px" height="auto"> --}}
          <img src="{{ url('storage/img',$drink['drink_image']) }}" 
          alt="" srcset="" width="250px" height="auto">
        </td>
        <td>
          <a href="{{url('drink/drinkform/'.$drink['drink_id'])}}">Edit</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@if (session('status'))
<script>
  alert("{{session('status')}}");
</script>
@endif

@endsection