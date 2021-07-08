<html lang="en">
<head>
    <title>Peer Chat</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('js/peerjs.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/site.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</head>
<body>
@include("component.navMenu")
@include("component.fullscreenloader")
@yield("section")
@yield("script")
<script>

    CheckSession();
    $('title').html(getName())
    $('#userName').html(getName())

</script>
</body>
</html>

