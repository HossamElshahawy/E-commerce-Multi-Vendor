<!doctype html>
<html lang="en">

@include('frontend.layout.head')


<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner-grow" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<!-- Header Area -->
@include('frontend.layout.header')
<!-- Header Area End -->

@yield('content')

<!-- Footer Area -->
@include('frontend.layout.footer')
<!-- Footer Area -->


@include('frontend.layout.script')


</body>

</html>
