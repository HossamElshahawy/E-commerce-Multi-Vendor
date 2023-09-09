@extends('backend.layout.master')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2>

                        <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Users
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create</a>

                    </h2>

                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ul>
                    <p class="float-right">Total Users : {{\App\Models\User::count()}}</p>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Users</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>

                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->username}}</td>
                                        <td><img src="{{$user->photo}}" style="border-radius: 50%" width="120" height="90"></td>

                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->role}}</td>



{{--                                        <td>--}}
{{--                                        @if($user->condition == 'banner')--}}
{{--                                            <span class="badge badge-success">{{$user->condition}}</span>--}}
{{--                                        @else--}}
{{--                                            <span class="badge badge-primary">{{$user->condition}}</span>--}}

{{--                                        @endif--}}
{{--                                        </td>--}}

                                    <td>
                                        <input type="checkbox" name="toogle" value="{{$user->id}}" data-toggle="switchbutton" {{$user->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="small" data-onstyle="success" data-offstyle="danger">

                                    </td>


                                    <td>

                                        <a  href="{{route('user.edit',$user->id)}}" data-toggle="tooltip" class="float-left btn btn-sm btn-outline-warning" title="edit" data-placement="bottom"><i class="fas fa-edit"> </i></a>

                                        <a  href="javascript:void(0)" data-toggle="modal" data-target="#userID{{$user->id}}" class="float-left btn btn-sm btn-outline-secondary" title="view" data-placement="bottom"> <i class="fas fa-eye"></i></a>

                                        <form class="float-left ml-2" method="post" action="{{route('user.destroy',$user->id)}}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="" data-toggle="tooltip" class="float-left deleteButton btn btn-sm btn-outline-danger" data-id="{{$user->id}}" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>


                                        </form>


                                    </td>



                                        <!-- Modal -->
                                        <div class="modal fade" id="userID{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                @php
                                                    $user = \App\Models\User::where('id',$user->id)->first();
                                                @endphp
                                                <div class="modal-content">
                                                   <div class="text-center">
                                                       <img src="{{$user->photo}}" style="border-radius: 50%; margin: 2% 0;">
                                                   </div>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{$user->full_name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">


                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Email:</strong>
                                                                <p>{{$user->email}}</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Phone:</strong>
                                                                <p>{{$user->phone}}</p>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Address:</strong>
                                                                <p>{{$user->address}}</p>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <strong>Role:</strong>
                                                                <p>{{$user->role}}</p>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Status</strong>
                                                                @if($user->status == 'active')
                                                                    <p class="badge badge-success">{{$user->status}}</p>
                                                                @else
                                                                    <p class="badge badge-danger">{{$user->status}}</p>
                                                                @endif

                                                            </div>
                                                        </div>








                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



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

{{--    // delete script--}}
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

{{--    status script--}}
    <script>
        $('input[name=toogle]').change(function () {
            var mode = $(this).prop('checked');
            var id = $(this).val();

            $.ajax({
                url: "{{ route('user.status') }}", // Use the route name
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
