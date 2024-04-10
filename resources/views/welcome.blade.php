<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('Components.grid_system')
    </head>
    <body>
        <div class="grid">
            @include('Components.header')
            @include('slider')
            @include('container')
            @include('Components.footer')
        </div>
    </body>
</html>
