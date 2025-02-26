<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="{{asset('css/sidebar.css')}}" rel="stylesheet">
    {{-- image  Icon --}}
    <link rel="icon" href="{{asset('images/imges-camping/logo.png')}}" type="image/png">
</head>
<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">ADMIN CAMPING</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="/products">Home</a>
      <a class="p-2 text-dark" href="/admin/dashboard">Dashboard</a>
      <a class="p-2 text-dark" href="/home">Profile</a>
      <a class="p-2 text-dark" href="#">Help</a>
    </nav>
  </div>
  <div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Overview</div>
      <div class="list-group list-group-flush">
        <a href="/admin/dashboard" class="list-group-item list-group-item-action bg-light">Show Product</a>
        <a href="/admin/createProduct" class="list-group-item list-group-item-action bg-light">Product</a>
        <a href="/admin/createCategory" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="/admin/orders" class="list-group-item list-group-item-action bg-light">Orders</a>
        <a href="/admin/payments" class="list-group-item list-group-item-action bg-light">Payments</a>
        <a href="/admin/users" class="list-group-item list-group-item-action bg-light">User</a>
      </div>
    </div>
    <div id="page-content-wrapper">
      <div class="container-fluid">
        @if(Session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{Session()->get('success')}}
        </div>
        @endif
        @if(Session()->has('warning'))
        <div class="alert alert-warning" role="alert">
            {{Session()->get('warning')}}
        </div>
        @endif

        @if(Session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session()->get('error')}}
        </div>
        @endif
        @yield('body')
    </div>
  </div>
</body>
</html>
