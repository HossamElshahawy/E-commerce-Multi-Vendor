<!-- Javascript -->
<script src="{{asset('backend/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('backend/assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('backend/assets/bundles/morrisscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/knob.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/ui/sortable-nestable.js')}}"></script>
<script src="{{asset('backend/assets/js/index.js')}}"></script>


{{--toastr js--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{--switch-button js--}}
<script src="https://cdn.jsdelivr.xyz/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>


@yield('scripts')
