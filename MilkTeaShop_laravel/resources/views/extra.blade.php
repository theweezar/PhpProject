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

<div class="mt-4">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Extra ID</th>
        <th scope="col">Extra Name</th>
        <th scope="col">Extra Describe</th>
        <th scope="col">Extra Type</th>
        <th scope="col">Is Active</th>
        <th scope="col">Extra Image</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($extras as $extra)
      <tr>
        <th scope="row">{{$extra['extra_id']}}</th>
        <td>{{$extra['extra_name']}}</td>
        <td>{{$extra['extra_describe']}}</td>
        <td>{{$extra['extra_type_id']}}</td>
        @if ($extra['is_active'])
        <td class="text-primary">Selling</td>
        @else
        <td class="text-danger">Stop selling</td>
        @endif
        <td class="text-center">
          {{-- http://127.0.0.1:8000/storage/img/KO6XtSXJTdOYOqYh3gSLjagowYWb8TkAC8AQ6ZS7.png --}}
          {{-- <img src="{{asset($extra['extra_image'])}}" alt="" srcset="" width="25px" height="auto"> --}}
          <img src="{{$extra['extra_image_path'] !== null ? url('storage/img',$extra['extra_image_path']):'' }}" 
          alt="" srcset="" width="250px" height="auto">
        </td>
        <td>
          <a href="{{url('extra/extraform/'.$extra['extra_id'])}}">Edit</a>
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