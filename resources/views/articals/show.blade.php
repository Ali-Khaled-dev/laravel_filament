<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />


        <title>Articals Blog</title>


    </head>

<body class="flex flex-col h-screen">
    <nav class="bg-gray-500 w-full h-16">

        <div class="flex justify-around">

            <div class="md:flex flex items-center pt-3 pb-3 text-center space-x-6">

                <a href="#" class="  text-white hover:text-black">{{ __('Categories') }}</a>
                <a href="#" class="  text-white hover:text-black "> {{ __('About Us') }}</a>
                <a href="#" class="  text-white hover:text-black "> {{ __('Contact Us') }}</a>

            <button id="mobile" class="md:hidden"><i class="ri-menu-line text-2xl"></i></button>

        </div>
    </nav>


        @include('layout.content')

        <footer class="flex flex-wrap items-center justify-between px-4 py-4 text-sm border-t border-gray-100  bg-slate-600">

            <ul class="flex space-x-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class=" text-white hover:text-yellow-500 " >
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

        <div class="flex space-x-4">
            <a class="text-white hover:text-yellow-500 " href="">{{ __('Categories') }} </a>
            <a class="text-white hover:text-yellow-500" href="">{{ __('Profile') }} </a>
            <a class="text-white hover:text-yellow-500" href="">{{ __('Blog') }} </a>
        </div>
        </footer>

    </body>
</html>
