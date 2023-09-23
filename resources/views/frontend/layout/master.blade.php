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
<header class="header_area" id="header_ajax">

@include('frontend.layout.header')

</header>

<!-- Header Area End -->

@yield('content')

<!-- Footer Area -->
@include('frontend.layout.footer')
<!-- Footer Area -->


@include('frontend.layout.script')


</body>
@yield('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    $(document).on('click','.cart_delete',function(e){
        e.preventDefault();
        var cart_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        var path = "{{route('cart.delete')}}"

        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                cart_id:cart_id,
                _token:token,
            },

            success: function (data) {
                console.log('Success Response:', data);
                $('body #header_ajax').html(data['header']);
                if (data['status'])
                {
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "Ok!",
                    });
                }


            },
            error: function (error) {
                // Log the error response to the console
                console.log('Error Response:', error);
                // Handle the error response here
                // Update your UI to show an error message or handle the error
            },
        });
    });

</script>

</html>
