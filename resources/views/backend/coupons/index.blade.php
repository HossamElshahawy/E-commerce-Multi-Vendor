@extends('backend.layout.master')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2>

                        <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Coupons
                        <a href="{{route('coupon.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create</a>

                    </h2>

                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Coupon Management</li>
                    </ul>
                    <p class="float-right">Total Coupons : {{\App\Models\Coupon::count()}}</p>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Coupons</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupon)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$coupon->code}}</td>

                                        <td>
                                        @if($coupon->type == 'fixed')
                                            <span class="badge badge-success">{{$coupon->type}}</span>
                                        @else
                                            <span class="badge badge-primary">{{$coupon->type}}</span>
                                        @endif
                                        </td>

                                        <td>{{$coupon->value}}</td>


                                        <td>
                                        <input type="checkbox" name="toogle" value="{{$coupon->id}}" data-toggle="switchbutton" {{$coupon->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="small" data-onstyle="success" data-offstyle="danger">

                                    </td>


                                    <td>
                                        <a  href="{{route('coupon.edit',$coupon->id)}}" data-toggle="tooltip" class="float-left btn btn-sm btn-outline-warning" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form class="float-left ml-2" method="post" action="{{route('coupon.destroy',$coupon->id)}}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="" data-toggle="tooltip" class="float-left deleteButton btn btn-sm btn-outline-danger" data-id="{{$coupon->id}}" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>


                                        </form>


                                    </td>

                                </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('scripts')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--    delete button--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.deleteButton').click(function (e) {

            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Coupon!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your Coupon has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

        });
    </script>

{{--    status script--}}
    <script>
        $('input[name=toogle]').change(function () {
            var mode = $(this).prop('checked');
            var id = $(this).val();

            $.ajax({
                url: "{{ route('coupon.status') }}", // Use the route name
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    mode: mode,
                    id: id,
                },
                success: function (response) {
                    console.log(response.status);
                },
            });
        });
    </script>


{{--    toastr script--}}
    @if(Session::has('success'))
        <script>
            // Initialize Toastr
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            // Example usage:
            toastr.success("{{Session::get('success')}}");
        </script>
    @endif

@endsection
