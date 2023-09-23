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
                            <form method="post" action="{{route("coupon.store")}}">
                                @csrf
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <label for="">Code</label>
                                    @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Code" name="code" value="{{old('code')}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <label for="">Value</label>
                                    @error('value')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="eg. 10%" name="value" value="{{old('value')}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Type</label>
                                    @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="type" class="form-control show-tick">
                                        <label for="">Type <span class="text-danger">*</span></label>
                                        <option  >-- Type --</option>
                                        <option value="fixed" {{old('type') == 'fixed' ? 'selected' : ''}}>fixed</option>
                                        <option value="percent" {{old('type') == 'percent' ? 'selected' : ''}}>percent</option>
                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Status</label>
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
