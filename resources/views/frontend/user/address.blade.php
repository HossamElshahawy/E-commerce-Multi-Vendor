@extends('frontend.layout.master')


@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home.frontend')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                       @include('frontend.user.sidebar')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{$user->address}} <br>
                                    {{$user->state}}, {{$user->city}} <br>
                                    {{$user->country}} <br>
                                    {{$user->postcode}}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAddress">Edit Address</a>
                                <!-- Modal -->
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,.5) ">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('billing.address',$user->id)}}" method="post">

                                            <div class="modal-body">
                                                @csrf
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <textarea class="form-control"  name="address" id="" placeholder="eg Hai Qibaa">{{$user->address}}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <input class="form-control"  name="country" id="" placeholder="eg Egypt" value="{{$user->country}}"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">PostCode</label>
                                                        <input class="form-control"  name="postcode" id="" placeholder="eg 35511" value="{{$user->postcode}}"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">State</label>
                                                        <input class="form-control"  name="state" id="" placeholder="eg state1" value="{{$user->state}}"></input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">City</label>
                                                        <input class="form-control"  name="city" id="" placeholder="eg .. Egypt" value="{{$user->city}}"></input>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    {{$user->saddress}} <br>
                                    {{$user->sstate}}, {{$user->scity}} <br>
                                    {{$user->scountry}} <br>
                                    {{$user->spostcode}}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSAddress">Edit Address</a>
                                <div class="modal fade" id="editSAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,.5) ">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('shipping.address',$user->id)}}" method="post">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="">Shipping Address</label>
                                                    <textarea class="form-control"  name="saddress" id="" placeholder="eg Hai Qibaa">{{$user->saddress}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping  Country</label>
                                                    <input class="form-control"  name="scountry" id="" placeholder="eg Egypt" value="{{$user->scountry}}"></input>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping PostCode</label>
                                                    <input class="form-control"  name="spostcode" id="" placeholder="eg 35511" value="{{$user->spostcode}}"></input>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping State</label>
                                                    <input class="form-control"  name="sstate" id="" placeholder="eg state1" value="{{$user->sstate}}"></input>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping City</label>
                                                    <input class="form-control"  name="scity" id="" placeholder="eg .. Egypt" value="{{$user->scity}}"></input>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

@endsection
