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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add Coupon</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Coupon Management</li>
                        <li class="breadcrumb-item active">Add Coupon</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body">
                        <form method="post" action="{{route("coupon.update",$coupon->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Code</label>
                                        <input type="text" class="form-control" placeholder="Title" name="code" value="{{old('code') ?? $coupon->code}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Value</label>
                                        <input type="number" class="form-control" placeholder="Url" name="value" value="{{old('value') ?? $coupon->value}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Tyoe</label>
                                    <select name="type" class="form-control show-tick">
                                        <option  >-- type --</option>
                                        <option value="fixed" {{old('type') ?? $coupon->type == 'fixed' ? 'selected' : ''}}>fixed</option>
                                        <option value="percent" {{old('type') ?? $coupon->type == 'percent' ? 'selected' : ''}}>percent</option>
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

    @include('notificantion')


@endsection
