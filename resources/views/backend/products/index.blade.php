@extends('backend.layout.master')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-8 col-sm-12">
                    <h2>

                        <a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Products
                        <a href="{{route('product.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i>Create</a>

                    </h2>

                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Product Management</li>
                    </ul>
                    <p class="float-right">Total Products : {{\App\Models\Product::count()}}</p>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Products</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Size</th>
                                    <th>Condition</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>
                                        <img src="{{$product->photo}}" width="120" height="90">
                                    </td>

                                    <td>{{number_format($product->price,2)}}$</td>
                                    <td>{{number_format($product->discount,2)}}$</td>
                                        <td>{{$product->size}}</td>

                                    <td>
                                    @if($product->condition == 'new')
                                        <span class="badge badge-success">{{$product->condition}}</span>
                                    @elseif($product->condition == 'popular')
                                            <span class="badge badge-warning">{{$product->condition}}</span>
                                    @else
                                            <span class="badge badge-primary">{{$product->condition}}</span>
                                    @endif
                                    </td>

                                    <td>
                                        <input type="checkbox" name="toogle" value="{{$product->id}}" data-toggle="switchbutton" {{$product->status=='active' ? 'checked' : ''}} data-onlabel="active" data-offlabel="inactive" data-size="small" data-onstyle="success" data-offstyle="danger">

                                    </td>


                                    <td>
                                        <a  href="{{route('product.edit',$product->id)}}" data-toggle="tooltip" class="float-left btn btn-sm btn-outline-warning" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>

                                        <a  href="javascript:void(0)" data-toggle="modal" data-target="#productID{{$product->id}}" class="float-left btn btn-sm btn-outline-warning" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>

                                        <form class="float-left ml-2" method="post" action="{{route('product.destroy',$product->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="" data-toggle="tooltip" class="float-left deleteButton btn btn-sm btn-outline-danger" data-id="{{$product->id}}" title="Delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                        </form>
                                    </td>





                                        <!-- Modal -->
                                        <div class="modal fade" id="productID{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                @php
                                                    $product = \App\Models\Product::where('id',$product->id)->first();
                                                @endphp
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{$product->title}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <strong>Summary:</strong>
                                                        <p>{!! html_entity_decode($product->summary) !!}</p>

                                                        <strong>Description:</strong>
                                                        <p>{!! html_entity_decode($product->description) !!}</p>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Price:</strong>
                                                                <p>{{number_format($product->price,2)}} $</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Offer Price:</strong>
                                                                <p>{{number_format($product->offer_price,2)}} $</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Discount:</strong>
                                                                <p>{{$product->discount}} %</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Stock:</strong>
                                                                <p>{{$product->stock}} </p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Category:</strong>
                                                                <p>{{\App\Models\Category::where('id',$product->category_id)->value('title')}}</p>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <strong>Child Category:</strong>
                                                                <p>{{\App\Models\Category::where('id',$product->child_category_id)->value('title')}}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Brand:</strong>
                                                                <p>{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Size</strong>
                                                                <p class="badge badge-success">{{$product->size}}</p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <strong>Vendor</strong>
                                                                <p>{{\App\Models\User::where('id',$product->vendor_id)->value('full_name')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Condition:</strong>
                                                                @if($product->condition == 'new')
                                                                <p class="badge badge-success">{{$product->condition}}</p>
                                                                @elseif($product->condition == 'popular')
                                                                    <p class="badge badge-warning">{{$product->condition}}</p>
                                                                @else
                                                                    <p class="badge badge-primary">{{$product->condition}}</p>
                                                                @endif
                                                            </div>


                                                            <div class="col-md-6">
                                                                <strong>Status</strong>
                                                                @if($product->status == 'active')
                                                                <p class="badge badge-success">{{$product->status}}</p>
                                                                @else
                                                                    <p class="badge badge-danger">{{$product->status}}</p>
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
                url: "{{ route('product.status') }}", // Use the route name
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
