@extends('backend.layout.master')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2>

                        <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Categories
                        <a href="{{route('category.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create</a>

                    </h2>

                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Category Management</li>
                    </ul>
                    <p class="float-right">Total Banners : {{\App\Models\Category::count()}}</p>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Categories</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Image</th>
{{--                                    <th>Condition</th>--}}
                                    <th>Parent_id</th>
                                    <th>is_Parent</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{!! $category->summary !!}</td>
                                    <td><img src="{{$category->photo}}" width="120" height="90"></td>
{{--                                        <td>--}}
{{--                                        @if($category->status == 'active')--}}
{{--                                            <span class="badge badge-success">{{$category->status}}</span>--}}
{{--                                        @else--}}
{{--                                            <span class="badge badge-primary">{{$category->status}}</span>--}}

{{--                                        @endif--}}
{{--                                        </td>--}}
                                        <td>{{\App\Models\Category::where('id',$category->parent_id)->value('title')}}</td>

                                        <td>
                                            {{ $category->is_parent === 1 ? 'Yes' : 'No'}}
                                        </td>
                    <td>

                        <input type="checkbox" name="toggle" value="{{$category->id}}" data-toggle="switchbutton" {{$category->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="small" data-onstyle="success" data-offstyle="danger">

                    </td>
                                    <td>
                                        <a  href="{{route('category.edit',$category->id)}}" data-toggle="tooltip" class="float-left btn btn-sm btn-outline-warning" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>

                                        <form class="float-left ml-2" method="post" action="{{route('category.destroy',$category->id)}}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="" data-toggle="tooltip" class="float-left deleteButton btn btn-sm btn-outline-danger" data-id="{{$category->id}}" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>


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
    {{--  delete script--}}
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

{{--    status--}}
    <script>
        $('input[name=toggle]').change(function () {
            var mode = $(this).prop('checked');
            var id = $(this).val();


            $.ajax({
                url: "{{ route('category.status') }}", // Use the route name
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

{{--    is_parent--}}
{{--    <script>--}}
{{--        $('input[name=parent]').change(function () {--}}
{{--            var mode = $(this).prop('checked');--}}
{{--            var id = $(this).val();--}}

{{--            $.ajax({--}}
{{--                url: "{{ route('category_isparent') }}", // Use the route name--}}
{{--                type: "POST",--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}",--}}
{{--                    mode: mode,--}}
{{--                    id: id,--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    console.log(response.status);--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}


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
