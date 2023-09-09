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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Product</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Product Management</li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">


                    <div class="body">
                        <form method="post" action="{{route("product.update",$product->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <label for="Title">Title</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title') ?? $product->title}}">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <label for="Summary">Summary</label>
                                    <div class="form-group mt-3">
                                        <textarea  id="summary" rows="4" name="summary" class="form-control no-resize" placeholder="Summary">{{old('summary') ?? $product->summary}}</textarea>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <label for="Description">Description</label>
                                    <div class="form-group mt-3">
                                        <textarea  id="description" rows="4" name="description" class="form-control no-resize" placeholder="Description">{{old('description') ?? $product->description}}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <label for="Stock">Stock</label>
                                    <div class="form-group">
                                        <input type="number" STEP="any" class="form-control" placeholder="Stock" name="stock" value="{{old('stock') ?? $product->stock}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <label for="Price">Price</label>
                                    <div class="form-group">
                                        <input type="number" STEP="any" class="form-control" placeholder="Price" name="price" value="{{old('price') ?? $product->price}}">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <label for="Discount">Discount</label>
                                    <div class="form-group">
                                        <input type="number" min="0" max="100" STEP="any" class="form-control" placeholder="Discount" name="discount" value="{{old('discount') ?? $product->discount}}">
                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Brands</label>
                                    <select name="brand_id" class="form-control show-tick">
                                        <label for="">Brands <span class="text-danger">*</span></label>
                                        <option  >-- Brands --</option>
                                        @foreach(\App\Models\Brand::get() as $brand)
                                            <option value="{{$brand->id}}" {{$brand->id==$product->brand_id ? 'selected' : ''}}>{{old('title') ?? $brand->title}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 d-">
                                    <label for="">Category</label>
                                    <select id="category_id" name="category_id" class="form-control show-tick">
                                        <option  >-- Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent',1)->get() as $category)
                                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{old('title') ?? $category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="child_category_div">
                                    <label for="Child Category">Child Category</label>
                                    <select id="child_category_id" name="child_category_id" class="form-control show-tick">
                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Size">Size</label>
                                    <select name="size" class="form-control show-tick">
                                        <label for="">Size <span class="text-danger">*</span></label>
                                        <option  >-- Size --</option>
                                        <option value="S" {{$product->size =='S' ? 'selected' : ''}}>Small</option>
                                        <option value="M" {{$product->size =='M' ? 'selected' : ''}}>Medium</option>
                                        <option value="L" {{$product->size =='L' ? 'selected' : ''}}>Large</option>
                                        <option value="XL" {{$product->size =='S' ? 'selected' : ''}}>Extra Large</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Condition</label>
                                    <select name="condition" class="form-control show-tick">
                                        <option  >-- Condition --</option>
                                        <option value="new" {{$product->condition=='new' ? 'selected' : ''}}>New</option>
                                        <option value="popular" {{$product->condition=='popular' ? 'selected' : ''}}>popular</option>
                                        <option value="winter" {{$product->condition=='winter' ? 'selected' : ''}}>winter</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="vendor">Vendor<span>*</span></label>
                                    <select name="vendor_id" class="form-control show-tick">
                                        <label for="">Vendor <span class="text-danger">*</span></label>
                                        <option  >-- Vendor --</option>
                                        @foreach(\App\Models\User::where('role','vendor')->get() as $vendor)
                                            <option value="{{$vendor->id}}" {{$vendor->id==$product->vendor_id ? 'selected' : ''}}>{{old('full_name') ?? $vendor->full_name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group mt-3">
                                        <label for="Image">Image</label>

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo') ?? $product->photo}}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    </div>
                                </div>






                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Status<span>*</span></label>
                                    <select name="status" class="form-control show-tick">
                                        <label for="">Condition <span class="text-danger">*</span></label>
                                        <option  >-- Status --</option>
                                        <option value="active" {{$product->status == 'active' ? 'selected' : ''}}>active</option>
                                        <option value="inactive" {{$product->status == 'inactive' ? 'selected' : ''}}>inactive</option>
                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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



        var child_category_id = {{$product->child_category_id}};
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
                            html_option += "<option value='" + id + "' "+(child_category_id==id ? 'selected' : '')+">" + title + "</option>"
                        });
                    } else
                    {
                        $('#child_category_div').addClass('d-none');
                    }

                    $('#child_category_id').html(html_option);
                }
            });
        });

        if(child_category_id != null)
        {
            $('#category_id').change();
        }

    </script>



@endsection
