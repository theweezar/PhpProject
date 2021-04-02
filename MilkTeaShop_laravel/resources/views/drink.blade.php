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
        <td>{{$drink['drink_type']}}</td>
        @if ($drink['is_active'])
        <td class="text-sucess">Stop selling</td>
        @else
        <td class="text-danger">Stop selling</td>
        @endif
        <td>
          <img src="{{$drink['drink_image']}}" alt="" srcset="" width="25px" height="auto">
        </td>
        <td class="text-center">
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