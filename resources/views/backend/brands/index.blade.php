@extends('backend.layout.master')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2>

                        <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Brands
                        <a href="{{route('brand.create')}}" class="btn btn-sm btn-outline-secondary"> <i class="icon-plus"></i> Create</a>

                    </h2>

                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Brand Management</li>
                    </ul>
                    <p class="float-right">Total Brands : {{\App\Models\Brand::count()}}</p>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Brands</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$brand->title}}</td>
                                    <td>{{$brand->slug}}</td>
                                    <td>
                                        <img src="{{$brand->photo}}" width="120" height="90">
                                    </td>

                                    <td>
                                        <input type="checkbox" name="toogle" value="{{$brand->id}}" data-toggle="switchbutton" {{$brand->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="small" data-onstyle="success" data-offstyle="danger">
                                    </td>


                                    <td>
                                        <a  href="{{route('brand.edit',$brand->id)}}" data-toggle="tooltip" class="float-left btn btn-sm btn-outline-warning" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form class="float-left ml-2" method="post" action="{{route('brand.destroy',$brand->id)}}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="" data-toggle="tooltip" class="float-left deleteButton btn btn-sm btn-outline-danger" data-id="{{$brand->id}}" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>


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

{{--    delete script--}}
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
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });




        });

    </script>

    <script>
        $('input[name=toogle]').change(function () {
            var mode = $(this).prop('checked');

            var id = $(this).val();
            $.ajax({
                url: "{{ route('brand.status') }}", // Use the route name
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


@endsection
