<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Manager</title>
  <!-- File css hay js sẽ được để trong folder public, vì những folder khác sẽ không được truy cập -->
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">

    <div class="wrapper d-flex">
      <div class="sidebar pl-3">
        <div class="brand">
          MilkTeaShop3DM
        </div>
        <div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ url ('drink') }}">Drink Section</a>
            </li>
            <li class="nav-item">
              Extra Section
            </li>
          </ul>
        </div>
      </div>
      <div class="content-wrapper">
        <div class="p-4">
          Manager Section
        </div>
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>