<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome to h&c</title>
  <style>
    html,body{
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
    }
    .wallpp{
      position: absolute;
      width: 100%;
      height: 100%;
      background: url('img/wallpp.jpg') no-repeat;
      background-size: cover;
      filter: blur(3px);
    }
    .glass{
      position: relative;
      background: rgba(0, 0, 0, 0.5);
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
    }
    .glass p{
      font-size: 600%;
      font-family: "Comic Sans MS";
      font-weight: bold;
    }
    .glass a{
      text-decoration: none;
      display: block;
      border: 2px solid white;
      text-transform: uppercase;
      outline: none;
      color: white;
      padding: 10px 15px;
    }
  </style>
</head>
<body>
  <div class="wallpp"></div>
  <div class="glass">
    <p>Wellcome to H&C milk tea</p>
    <a href="/login">Login</a>
  </div>
</body>
</html>