@extends('layout')
@section('title','Extra Manager')
@section('content')

<form enctype="multipart/form-data" class="w-75" action="{{url('/extra/insert')}}" method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="extra_image">Example file input</label>
    <div class="col-sm-9">
      <input type="file" class="form-control-file" id="extra_image" name="extra_image">
    </div>
  </div>
  <div class="form-group row">
    <label for="extra_name" class="col-sm-3 col-form-label">Extra name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="extra_name" name="drink_name" placeholder="Extra Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="extra_describe" class="col-sm-3 col-form-label">Extra describe</label>
    <div class="col-sm-9">
      <textarea id="extra_describe" name="extra_describe" 
      class="form-control" rows="4"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="extra_price" class="col-sm-3 col-form-label">Extra Price</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="extra_price" name="extra_price">
    </div>
  </div>
  <div class="form-check pt-2 pb-4">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
    <label class="form-check-label" for="exampleCheck1">Sell now</label>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary">{{$button}}</button>
  </div>
</form>

@endsection