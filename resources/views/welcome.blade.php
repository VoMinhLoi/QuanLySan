<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('Library.grid_system')
        @include('Library.variable')
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
