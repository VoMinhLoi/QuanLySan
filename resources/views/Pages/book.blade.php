<!DOCTYPE html>
<html lang="en">
<head>
    @include('Components.grid_system')
    @include('Components.variable')
</head>
<body>
    <div class="grid">
        @include('Components.header')
        @include('Book.container')
        @include('Components.footer')
    </div>
</body>
</html>