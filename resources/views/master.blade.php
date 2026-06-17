<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Authentication.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Model.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Campaign.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Order.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Setting.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Service.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/SubAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Notification.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Varasa Health</title>
</head>

<body>
    @yield('content')
</body>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://kit.fontawesome.com/696233e01c.js" crossorigin="anonymous"></script>

</html>
