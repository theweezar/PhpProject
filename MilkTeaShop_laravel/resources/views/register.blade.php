<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register Form</title>
</head>
<body>
  <form action="{{url('register')}}" method="post">
    @csrf
    <div>
      <input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{old('first_name')}}">
      @error('first_name')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{old('last_name')}}">
      @error('last_name')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <input type="text" name="email" id="email" placeholder="Email" value="{{old('email')}}">
      @error('email')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <input type="password" name="password" id="password" placeholder="Password">
      @error('password')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <input type="password" name="re_password" id="re_password" placeholder="Re Password">
      @error('re_password')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}">
      @error('phone_number')
        <span style="color:red">{{$message}}</span>
      @enderror
    </div>
    <div>
      <button type="submit">Submit</button>
    </div>
  </form>
</body>

@if (session('re_password_failed'))
<script>
  alert("{{session('re_password_failed')}}");
</script>
@endif


</html>