<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">
        <style>
            .picture-container {
                position: relative;
                cursor: pointer;
                text-align: center;
            }

            .picture {
                width: 106px;
                height: 106px;
                background-color: #999999;
                border: 4px solid #cccccc;
                color: #ffffff;
                border-radius: 50%;
                margin: 5px auto;
                overflow: hidden;
                transition: all 0.2s;
                -webkit-transition: all 0.2s;
            }

            .picture-src {
                width: 100%;
                height: 100%;
            }

            .picture:hover {
                border-color: #4caf50;
            }

            .picture input[type="file"] {
                cursor: pointer;
                display: block;
                height: 100%;
                left: 0;
                opacity: 0 !important;
                position: absolute;
                top: 0;
                width: 100%;
            }

            .choice {
                text-align: center;
                cursor: pointer;
            }

            .choice input[type="radio"],
            .choice input[type="checkbox"] {
                position: absolute;
                left: -10000px;
                z-index: -1;
            }

            .choice .icon {
                text-align: center;
                vertical-align: middle;
                height: 106px;
                width: 106px;
                border-radius: 50%;
                color: #999999;
                margin: 5px auto;
                border: 4px solid #cccccc;
                transition: all 0.2s;
                -webkit-transition: all 0.2s;
                overflow: hidden;
            }

            .choice .icon:hover {
                border-color: #4caf50;
            }

            .choice.active .icon {
                border-color: #2ca8ff;
            }
        </style>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.money').simpleMoneyFormat();
        });
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'));
        ClassicEditor.create(document.querySelector('#editor1'));
        ClassicEditor.create(document.querySelector('#editor2'));
        ClassicEditor.create(document.querySelector('#editor3'));
        ClassicEditor.create(document.querySelector('#editor4'));
        ClassicEditor.create(document.querySelector('#editor5'));
    </script>
    <script>
        $("#wizard-picture").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
