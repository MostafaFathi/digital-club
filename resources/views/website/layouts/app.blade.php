<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Saudi Digital Dentistry Club') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/portal/assets/css/style.css')}}">
</head>
<body>
<div id="app">
    <div id="loading_overlay">

        <div class="loading_container">
            <img style="width: 150px;"
                 src="{{ asset('web/images/logo-dark.png') }}">
            <p>الرجاء الانتظار ...</p>
            <i class="fas fa-spin fa-spinner"></i>

        </div>
    </div>
<header class="header-digital-club">
    <nav class="navbar">
        <div class="container">
            <router-link to="/" class="navbar-brand py-0">
                <img src="{{asset('/portal/assets/images/logo-dig.png')}}">
            </router-link>
            <div class="ml-auto d-flex">
                <div class="btns-header d-flex align-items-center me-3">
                    <a href="#" id="btn-search" class="me-3"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <a href="#" class="me-3 link-user"><i class="fa-regular fa-user"></i></a>
                    <router-link to="/join" class="btn btn-primary">Join us</router-link>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu">
                            <li><router-link class="dropdown-item" to="/events/live-webinars">Live webinars</router-link></li>
                            <li><router-link class="dropdown-item" to="/events/cad">CAD recording techniques</router-link></li>
                            <li><router-link class="dropdown-item" to="/events/workshop">On site workshop</router-link></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle about-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><router-link class="dropdown-item" to="/who-we-are">Who we are</router-link></li>
                            <li><router-link class="dropdown-item" to="/partners">Our partners</router-link></li>
                            <li><router-link class="dropdown-item" to="/">Blog</router-link></li>
                            <li><router-link class="dropdown-item" to="/">Information & media</router-link></li>
                            <li><router-link class="dropdown-item" to="/members">Leadership</router-link></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="search-box">
    <div class="input-group">
        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" class="form-control" placeholder="Type to search" >
    </div>
</div>
    <loader :is-visible="isLoading"></loader>
    @yield('content')
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('web/js/app-website.js?version='.now()) }}" defer></script>
<script>

    $('#btn-search').click(function(){
        $('.search-box').toggleClass('show');
        return false;
    });

    $('#next-step2').click(function(){
        $('.box-step1').addClass('d-none');
        $('.box-step2').removeClass('d-none');
        $('.steps-2').addClass('active');
        // $('html, body').animate({scrollTop: 0}, 300);
        return false;
    });

</script>
<!-- /page content -->
@yield('js_assets')
@yield('js_code')

