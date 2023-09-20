<!DOCTYPE html>
<html lang="en">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
    </style>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"
      defer
    ></script>


<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">

   

    <div class="container-fluid">
        @yield('content')
    </div>

    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>

    @include('partials.javascripts')

</body>
</html>