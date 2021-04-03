@extends('layout')
@section('title','Drink Manager')
@section('content')

{{-- if this form is insert form --}}
@if(!$edit_form)
<form id="drink_form" enctype="multipart/form-data" class="w-75" action="{{url('/drink/insert')}}" method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="drink_image">Drink image input</label>
    <div class="col-sm-9">
      <input type="file" class="form-control-file" id="drink_image" name="drink_image"
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
    <label for="drink_name" class="col-sm-3 col-form-label">Drink name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="drink_name" name="drink_name">
    </div>
  </div>
  <div class="form-group row">
    <label for="drink_describe" class="col-sm-3 col-form-label">Drink describe</label>
    <div class="col-sm-9">
      <textarea id="drink_describe" name="drink_describe" 
      class="form-control" rows="4" form="drink_form"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="drink_type_id" class="col-sm-3 col-form-label">Drink type</label>
    <div class="col-sm-9">
      <select id="drink_type_id" name="drink_type_id" class="custom-select">
        {{-- <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option> --}}
        @foreach ($drink_type as $index => $type)
        <option value="{{$type['drink_type_id']}}">{{$type['drink_type_name']}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_s" class="col-sm-3 col-form-label">Price size S</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_s" name="price_size_s">
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_m" class="col-sm-3 col-form-label">Price size M</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_m" name="price_size_m">
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_l" class="col-sm-3 col-form-label">Price size L</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_l" name="price_size_l">
    </div>
  </div>
  <div class="form-check pt-2 pb-4">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
    <label class="form-check-label" for="is_active">Sell now</label>
  </div>
  <div class="text-center">
    <button id="submit-btn" class="btn btn-primary">{{$button}}</button>
  </div>
</form>
{{-- if this form is update form --}}
@else
<form id="drink_form" enctype="multipart/form-data" class="w-75" action="{{url('/drink/update/'.$drink['drink_id'])}}" 
method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="drink_image">Drink image input</label>
    <div class="col-sm-9">
      <input type="file" class="form-control-file" id="drink_image" name="drink_image"
      accept="image/png, image/jpg, image/jpeg, image/gif">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-3">Image preview</div>
    <div class="col-sm-9">
      <img id="image-preview" 
      src="{{$drink['drink_image_path'] !== null ? url('storage/img',$drink['drink_image_path']):'' }}" 
      width="100%" height="auto" alt="" srcset="">
    </div>
  </div>
  <div class="form-group row">
    <label for="drink_name" class="col-sm-3 col-form-label">Drink name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="drink_name" name="drink_name"
      value="{{$drink['drink_name']}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="drink_describe" class="col-sm-3 col-form-label">Drink describe</label>
    <div class="col-sm-9">
      <textarea id="drink_describe" name="drink_describe" 
      class="form-control" rows="4" form="drink_form">{{$drink['drink_describe']}}</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="drink_type_id" class="col-sm-3 col-form-label">Drink type</label>
    <div class="col-sm-9">
      <select id="drink_type_id" name="drink_type_id" class="custom-select">
        {{-- <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option> --}}
        @foreach ($drink_type as $index => $type)
        @if ($drink['drink_type_id'] == $type['drink_type_id'])
        <option value="{{$type['drink_type_id']}}" selected>{{$type['drink_type_name']}}</option>
        @else
        <option value="{{$type['drink_type_id']}}">{{$type['drink_type_name']}}</option>
        @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_s" class="col-sm-3 col-form-label">Price size S</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_s" name="price_size_s" 
      value="{{$drink_price[0]['drink_price']}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_m" class="col-sm-3 col-form-label">Price size M</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_m" name="price_size_m"
      value="{{$drink_price[1]['drink_price']}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="price_size_l" class="col-sm-3 col-form-label">Price size L</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="price_size_l" name="price_size_l"
      value="{{$drink_price[2]['drink_price']}}">
    </div>
  </div>
  <div class="form-check pt-2 pb-4">
    @if ($drink['is_active'] == 1)
    <input type="checkbox" checked class="form-check-input" id="is_active" name="is_active">
    @else
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active">  
    @endif
    <label class="form-check-label" for="is_active">Sell now</label>
  </div>
  <div class="text-center">
    <button id="submit-btn" class="btn btn-primary">{{$button}}</button>
  </div>
</form>
@endif

<script>
  document.getElementById("submit-btn").addEventListener("click", function(event){
    event.preventDefault()
    const drink_name = document.getElementById('drink_name')
    const drink_describe = document.getElementById('drink_describe')
    const drink_type_id = document.getElementById('drink_type_id')
    const price_size_s = document.getElementById('price_size_s')
    const price_size_m = document.getElementById('price_size_m')
    const price_size_l = document.getElementById('price_size_l')

    if (drink_name.value.trim().length == 0){
      alert('drink_name is a blank')
    }
    else if (escape(drink_describe.value.trim()).length == 0){
      alert('drink_describe is a blank')
    }
    else if (isNaN(drink_type_id.value.trim())){
      alert('wrong drink type format')
    }
    else if (isNaN(price_size_s.value.trim())){
      alert('wrong price_size_s format')
    }
    else if (isNaN(price_size_m.value.trim())){
      alert('wrong price_size_m format')
    }
    else if (isNaN(price_size_l.value.trim())){
      alert('wrong price_size_l format')
    }
    else{
      document.getElementById('drink_form').submit()
    }
  })

  document.querySelector('input#drink_image').addEventListener('change', function(){
    const drink_image = this.files[0]
    const reader = new FileReader()
    reader.onloadend = function(){
      document.getElementById('image-preview').src = this.result
    }
    reader.readAsDataURL(drink_image)
  })


</script>

@if (session('status'))
<script>
  alert("{{session('status')}}");
</script>
@endif

@endsection