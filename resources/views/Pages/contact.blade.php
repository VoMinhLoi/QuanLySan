<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('Library.grid_system')
        @include('Library.responsive')
        @include('Library.variable')
    </head>
    <body>
        <div class="grid">
            @include('Components.header')
            <div class="container">
                <div class="grid wide">
                    @include('Components.breadcrumb')
                    <script>
                        breadCrumbHeading.innerText = 'Liên hệ'
                    </script>
                    <div class="row no-gutters">
                        <div class="col l-12 m-12 c-12">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8938657781437!2d108.17775297460003!3d16.070996439391656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218fcdd80b585%3A0xfed1485cf372e066!2sDUPES!5e0!3m2!1sen!2s!4v1712807756688!5m2!1sen!2s" style="margin-top: 40px;" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                </div>
            </div>
            @include('Components.footer')
        </div>
    </body>
</html>