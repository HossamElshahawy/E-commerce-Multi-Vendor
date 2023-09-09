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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Category</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Category Management</li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body">
                        <form method="post" action="{{route("category.update",$category->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title') ?? $category->title}}">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Status<span>*</span></label>
                                    <select name="status" class="form-control show-tick">
                                        <label for="">Condition <span class="text-danger">*</span></label>
                                        <option  >-- Status --</option>
                                        <option value="active" {{old('status' , $category->status) == 'active' ? 'selected' : ''}}>active</option>
                                        <option value="inactive" {{old('status' , $category->status) == 'inactive' ? 'selected' : ''}}>inactive</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Is Parent<span class="text-danger">*</span></label>
                                        <input id="is_parent" type="checkbox" name="is_parent" value="1" {{ old('is_parent', $category->is_parent) == 1 ? 'checked' : '' }}>Yes

                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 {{$category->is_parent == true ? 'd-none' : ''}}" id="parent_cat_div">
                                    <select name="parent_id" class="form-control show-tick">
                                        <label for="">parent Category <span class="text-danger">*</span></label>
                                        <option  >-- parent Category --</option>
                                        @foreach($parent_categories as $parent_category)
                                            <option value="{{$parent_category->id}}" {{$parent_category->id == $category->parent_id ? 'selected' : ''}}>{{$parent_category->title}}</option>

                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group mt-3">

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo') ?? $category->photo}}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group mt-3">
                                        <textarea  id="summary" rows="4" name="summary" class="form-control no-resize" placeholder="summary">{!! old('summary') ?? $category->summary!!}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
            $('#summary').summernote();
        });
    </script>

    <script>
        $('#is_parent').change(function () {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');

            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                // Clear the value of the parent_id select element
                $('select[name="parent_id"]').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>



@endsection
