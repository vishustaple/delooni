<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="base-url" content="{{url('/')}}"/>
  <title>Delooni | Dashboard</title>
  <!-- sweetalert pop up -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Google map: location google api -->
  <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd69fy-3SQFQiKECos32_6RICz0sa3ETQ&libraries=places">
 </script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
  <!-- Theme css -->
  <link rel="stylesheet" href="{{asset('css/theme.css')}}">

  <!-- Custom css -->
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <!-- Select2 -->
  
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  
  
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  @stack('checkbox_styles')
  @stack('search_bar_css')
  {{-- Swal --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>