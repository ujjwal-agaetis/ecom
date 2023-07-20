<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#create_product_form').validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },

                        slug: {
                            required: true,
                            
                        },

                        description: {
                            required: true,
                            
                        },

                        rules: {
                        status:{
                            required: true,
                            
                        }
                    },


                        quantity: {
                            required: true,
                            
                        },
                        // Add more rules for other form fields as needed
                    },
                    messages: {
                        name: {
                            required: "Please enter your name",
                            minlength: "Name must be at least 3 characters"
                        },
                        slug: {
                            required: "Please enter your Slug Number",
                            
                        },

                        description: {
                            required: "Please enter your Description Details",
                            description: "Please enter a Description Details"
                        },

                        status: {
                            required: "Please enter your Status ",
                            
                        },

                        quantity: {
                            required: "Please enter your product quantity",
                            
                        },
                        // Add more custom error messages for other form fields
                    },
                    submitHandler: function(form) {
                        // This function will be called when the form is valid
                        //form.submit(); // Submit the form
                        form_data = $('#create_product_form').serialize();

                        $.ajax({
                            url: '/products/store',
                            type: 'post',
                            data: $('#create_product_form').serialize(),
                            success: function(response) {
                                // Handle the response
                                //console.log(response);
                                alert('Product created successfully!');
                                location.reload('/products');
                            }
                        });
                    }
                });
                
            // Delete action
            $('.delete_btn').on('click', function(){
                var id = $(this).data('id');
                //alert(id);

                $.ajax({
                    url: '/products/destroy',
                    type: 'post',
                    data: {"_token": "{{ csrf_token() }}", "id":id},
                    success: function(response) {
                        // Handle the response
                        //console.log(response);
                        alert(response);
                        location.reload();
                    }
                });
            })

            // Create action
           
            $('.2create_product').on('click', function(e){
                //e.preventDefault();
                //$(this).html('Sending..');

                
                
            })
        })
    </script>
</body>
</html>