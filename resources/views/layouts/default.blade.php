<!DOCTYPE html>

<?php
\App\Log::logInc(\App\Log::VIEWS);
?>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title)?$title.' - ':''}}PetStore - Thế giới thú nuôi</title>

@include('layouts.js_include')

<!-- Styles -->


    <link href="/css/semantic.min.css" rel="stylesheet">
    <link href="/css/app.css?t={{rand()}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="/bower_components/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/bower_components/slick-carousel/slick/slick-theme.css"/>

    <style>
        .slick-prev:before,
        .slick-next:before {
            color: darkgray;
        }
    </style>
</head>
<body>
@include('layouts.top_menu')
@include('layouts.logo_and_nav')
@yield('content')



@include('layouts.footer')
<!--Start of Tawk.to Script-->
{{--<script type="text/javascript">--}}
{{--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();--}}
{{--(function(){--}}
{{--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];--}}
{{--s1.async=true;--}}
{{--s1.src='https://embed.tawk.to/5ac8e69f4b401e45400e6f43/default';--}}
{{--s1.charset='UTF-8';--}}
{{--s1.setAttribute('crossorigin','*');--}}
{{--s0.parentNode.insertBefore(s1,s0);--}}
{{--})();--}}
{{--</script>--}}
</body>
</html>

