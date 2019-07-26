<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="/">
    <title>Demo</title>

    <!-- Scripts -->
{{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script> --}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">

    <!-- Styles -->
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{url(env('APP_URL').'/semantic/dist/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container-fluid flex-wrap">
            <a class="navbar-brand" href="{{ route('admin.home') }}"><img src="{{ asset('images/Logo.png')}}" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-expand">
                <div class="m-0 d-flex justify-content-between">
                    <div id="navbarMenus-1" class="d-flex align-items-center">
                        <div class="d-flex justify-content-start text-center">
                            <div class="px-0">
                                <a href="{{ route('admin.caregivers') }}"> Caregivers </a>
                            </div>
                            <div class="px-0">
                                <a href={{ route('admin.employers')}}> Employers </a>
                            </div>
                            <div class="px-0">
                                <a href="{{ route('admin.jobs')}}"> Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div id="navbarMenus-2" class="d-flex justify-content-center align-items-center">
                        
                        <div class="d-flex nav-item dropdown justify-content-start">
                            <a id="navbarDropdown" class="dropdown-toggle d-flex justify-content-center align-items-center mr-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="avatar" src="{{ env('APP_URL') . '/storage/profile_image/'  . Auth::user()->profile_image  }}" avatar="HT">
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Links -->
                    <ul class="navbar-nav mr-auto ml-3">
                        <li class="nav-item active mt-1 mb-1 text-center">
                            <a href="/admin/users"> Users</a>
                        </li>
                        <li class="nav-item mt-1 mb-1 text-center">
                            <a href="/admin/usersHired"> Person Hired</a>
                        </li>
                        <li class="nav-item mt-1 mb-1 text-center">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                    <!-- Links -->
                </div>
            </div>
        </div>

    </nav>

    <main class='py-4 {{ Request::route()->getName() == "admin.caregivers.detail" ? "caregiver-bg" : "" }}' style="min-height: 100vh;">
        @yield('content')
    </main>
</div>
@yield('script')
<script src="https://unpkg.com/virgil-crypto/dist/virgil-crypto-pythia.browser.umd.min.js"></script>
<script src="https://unpkg.com/virgil-sdk/dist/virgil-sdk.browser.umd.min.js"></script>
<script src="https://unpkg.com/virgil-pythia/dist/virgil-pythia.browser.umd.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.address.js') }}"></script>
<script src="{{url(env('APP_URL').'/semantic/dist/semantic.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="{{ asset('lightbox/js/lightbox.min.js') }}"></script>


{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{url(env('APP_URL').'/semantic/dist/semantic.min.js')}}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>--}}
{{--<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>--}}

<script type="text/javascript">
   
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'HH:mm'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'HH:mm'
        });
    });

    $("#skills").select2();
    $("#languages").select2();
    $("#weekdays").select2();
</script>
</body>
</html>
