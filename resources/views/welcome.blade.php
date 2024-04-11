<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('Components.grid_system')
        @include('Components.variable')
    </head>
    <body>
        <div class="grid">
            @include('Components.header')
            @include('Components.slider')
            @include('welcome_container')
            @include('Components.footer')
        </div>
    </body>
</html>
