@extends('layout')
@section('title','Extra Manager')
@section('content')

@if(!$edit_form)
<form id="extra_form" enctype="multipart/form-data" class="w-75" action="{{url('/extra/insert')}}" method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="extra_image">Example file input</label>
    <div class="col-sm-9">
      <input type="file" class="form-control-file" id="extra_image" name="extra_image"
      accept="image/png, image/jpg, image/jpeg, image/gif">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-3">Image preview</div>
    <div class="col-sm-9">
      <img id="image-preview" src="." width="350px" height="auto" alt="" srcset="">
    </div>
  </div>
  <div class="form-group row">
    <label for="extra_name" class="col-sm-3 col-form-label">Extra name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="extra_name" name="extra_name" placeholder="Extra Name">
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
    <label for="extra_type_id" class="col-sm-3 col-form-label">Extra type</label>
    <div class="col-sm-9">
      <select id="extra_type_id" name="extra_type_id" class="custom-select">
        @foreach ($extra_type as $index => $type)
        <option value="{{$type['extra_type_id']}}">{{$type['extra_type_name']}}</option>
        @endforeach
      </select>
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
    <button id="submit-btn" class="btn btn-primary">{{$button}}</button>
  </div>
</form>
@else

@endif

<script>
  document.getElementById("submit-btn").addEventListener("click", function(event){
    event.preventDefault()
    const extra_name = document.getElementById("extra_name")
    const extra_describe = document.getElementById("extra_describe")
    const extra_type_id = document.getElementById("extra_type_id")
    const extra_price = document.getElementById("extra_price")

    if (escape(extra_name.value.trim()).length == 0){
      alert('extra_name is a blank')
    }
    else if (escape(extra_describe.value.trim()).length == 0){
      alert('extra_describe is a blank')
    }
    else if (isNaN(extra_type_id.value.trim())){
      alert('wrong extra type format')
    }
    else if (isNaN(extra_price.value.trim())){
      alert('wrong extra price format')
    }
    else{
      document.getElementById('extra_form').submit()
    }
  })

  document.querySelector('input#extra_image').addEventListener('change', function(){
    const extra_image = this.files[0]
    const reader = new FileReader()
    reader.onloadend = function(){
      document.getElementById('image-preview').src = this.result
    }
    reader.readAsDataURL(extra_image)
  })
</script>

@if (session('status'))
<script>
  alert("{{session('status')}}");
</script>
@endif


@endsection