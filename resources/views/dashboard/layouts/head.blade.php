<!-- Title -->
<title>Dashboard DataBook </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/dashboard/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/dashboard/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/dashboard/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
{{--<link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">--}}
@if (App::getLocale() == 'en')
    <link href="{{URL::asset('assets/dashboard/css/skin-modes.css')}}" rel="stylesheet">
@else
    <link rel="stylesheet" href="{{URL::asset('assets/dashboard/css-rtl/sidemenu.css')}}">
@endif
@yield('css')

@if (App::getLocale() == 'en')
    <link rel="stylesheet" href="{{URL::asset('assets/dashboard/css/sidemenu.css')}}">
    <link href="{{URL::asset('assets/dashboard/css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('assets/dashboard/css/style-dark.css')}}" rel="stylesheet">
@else
<!--- Style css -->
<link href="{{URL::asset('assets/dashboard/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('assets/dashboard/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/dashboard/css-rtl/skin-modes.css')}}" rel="stylesheet">
<style>
    .app-sidebar .slide.active .side-menu__item {
        background: #53649021;
    }
    .slide.is-expanded .side-menu__item
    {
    background: #53649021;
    }
</style>
@endif


