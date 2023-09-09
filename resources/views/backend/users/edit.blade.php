@extends('backend.layout.master')


@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit User</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Users Management</li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body">
                        <form method="post" action="{{route("user.update",$user->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        @error('full_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="{{old('full_name') ?? $user->full_name}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Username">Username</label>
                                        @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username') ?? $user->username}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email') ?? $user->email}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Phone">Phone</label>
                                        @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone') ?? $user->phone}}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{old('address') ?? $user->address}}">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Role</label>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="role" class="form-control show-tick">
                                        <label for="">Role <span class="text-danger">*</span></label>
                                        <option  >-- Role --</option>
                                        <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                        <option value="vendor" {{$user->role == 'vendor' ? 'selected' : ''}}>Vendor</option>
                                        <option value="customer" {{$user->role == 'customer' ? 'selected' : ''}}>Customer</option>

                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="Condition">Status<span>*</span></label>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="status" class="form-control show-tick">
                                        <label for="">Condition <span class="text-danger">*</span></label>
                                        <option  >-- Status --</option>
                                        <option value="active" {{old('status') ?? $user->status == 'active' ? 'selected' : ''}}>active</option>
                                        <option value="inactive" {{old('status') ?? $user->status == 'inactive' ? 'selected' : ''}}>inactive</option>
                                    </select>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mt-3">

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                             </a>
                                           </span>
                                            @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo') ?? $user->photo}}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    </div>
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


@endsection
