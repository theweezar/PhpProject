<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Form</title>
</head>
<body>
  <form action="{{url('login')}}" method="post">
    @csrf
    <div>
      <input type="text" name="email" id="email" placeholder="Email">
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
    <button type="submit">Submit</button>
  </form>
</body>

@if (session('status'))
<script>
  alert("{{session('status')}}");
</script>
@endif

</html>