@extends('backend.layout.master')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add Product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Product Management</li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">


                        <div class="body">
                            <form method="post" action="{{route("product.store")}}">
                                @csrf
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <label for="Title">Title</label>
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <label for="Summary">Summary</label>
                                    @error('summary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group mt-3">
                                        <textarea  id="summary" rows="4" name="summary" class="form-control no-resize" placeholder="Summary">{{old('summary')}}</textarea>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <label for="Description">Description</label>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group mt-3">
                                        <textarea  id="description" rows="4" name="description" class="form-control no-resize" placeholder="Description">{{old('description')}}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <label for="Stock">Stock</label>
                                    @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="number" STEP="any" class="form-control" placeholder="Stock" name="stock" value="{{old('stock')}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <label for="Price">Price</label>
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="number" STEP="any" class="form-control" placeholder="Price" name="price" value="{{old('price')}}">
                                    </div>
                                </div>

{{--                                <div class="col-lg-12 col-md-12">--}}
{{--                                    <label for="Offer_Price">Offer Price</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="number" STEP="any" class="form-control" placeholder="Offer Price" name="offer_price" value="{{old('offer_price')}}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-lg-12 col-md-12">
                                    <label for="Discount">Discount</label>
                                    @error('discount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="number" min="0" max="100" STEP="any" class="form-control" placeholder="Discount" name="discount" value="{{old('discount')}}">
                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Brands</label>
                                    @error('brand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="brand_id" class="form-control show-tick">
                                        <label for="">Brands <span class="text-danger">*</span></label>
                                        <option  >-- Brands --</option>
                                        @foreach(\App\Models\Brand::get() as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 d-">
                                    <label for="">Category</label>
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select id="category_id" name="category_id" class="form-control show-tick">
                                        <option  >-- Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent',1)->get() as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="child_category_div">
                                    <label for="Child Category">Child Category</label>
                                    @error('child_category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select id="child_category_id" name="child_category_id" class="form-control show-tick">
                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Size">Size</label>
                                    @error('size')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="size" class="form-control show-tick">
                                        <label for="">Size <span class="text-danger">*</span></label>
                                        <option  >-- Size --</option>
                                            <option value="S" {{old('size')=='S' ? 'selected' : ''}}>Small</option>
                                            <option value="M" {{old('size')=='M' ? 'selected' : ''}}>Medium</option>
                                            <option value="L" {{old('size')=='L' ? 'selected' : ''}}>Large</option>
                                            <option value="XL" {{old('size')=='S' ? 'selected' : ''}}>Extra Large</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Condition</label>
                                    @error('condition')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="condition" class="form-control show-tick">
                                        <label for="">Condition <span class="text-danger">*</span></label>
                                        <option  >-- Condition --</option>
                                        <option value="new" {{old('condition')=='new' ? 'selected' : ''}}>New</option>
                                        <option value="popular" {{old('condition')=='popular' ? 'selected' : ''}}>popular</option>
                                        <option value="winter" {{old('condition')=='winter' ? 'selected' : ''}}>winter</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Vendor<span>*</span></label>
                                    @error('vendor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="vendor_id" class="form-control show-tick">
                                        <label for="">Vendor <span class="text-danger">*</span></label>
                                        <option  >-- Vendor --</option>
                                        @foreach(\App\Models\User::where('role','vendor')->get() as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->full_name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group mt-3">
                                        <label for="Image">Image</label>
                                        @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    </div>
                                </div>






                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Status<span>*</span></label>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="status" class="form-control show-tick">
                                        <label for="">Condition <span class="text-danger">*</span></label>
                                        <option  >-- Status --</option>
                                        <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>active</option>
                                        <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>inactive</option>
                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                </div>

                            </div>

                            </form>

                        </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('scripts')
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

    <script>
        $('#lfm').filemanager('image');
    </script>

    <script src="https://cdn.jsdelivr.xyz/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

{{--    //category and child_category--}}
    <script>
        $('#category_id').change(function () {
            var category_id = $(this).val();

            $.ajax({
                url: "/admin/category/" + category_id + "/child",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    category_id: category_id,
                },
                success: function (response) {
                    var html_option = "<option value=''>---Child Category---</option>";
                    if (response.status ) {
                        $('#child_category_div').removeClass('d-none');
                        $.each(response.data, function (id, title) {
                            html_option += "<option value='" + id + "'>" + title + "</option>"
                        });
                    } else
                    {
                        $('#child_category_div').addClass('d-none');
                    }

                    $('#child_category_id').html(html_option);
                }
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
