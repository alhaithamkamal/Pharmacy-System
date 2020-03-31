<!DOCTYPE html>

<html lang="en">
  <head>
    @include('includes.head')
  </head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @include('includes.navbar')
  </nav>
  <!-- /.navbar -->

  @include('includes.sidebar')

  @yield('content')


</div>

<!-- ./wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">  
      @include('includes.footer')
  </footer>

<!-- REQUIRED SCRIPTS -->
  @include('includes.script')

</body>
</html>
