<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css ') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        {{-- Header --}}
        @include('layouts.header')
        {{-- Sidebar --}}
        @include('layouts.sidebar')
        <!-- Content -->
        <div class="content-wrapper">
            {{ $slot }}
        </div>
        {{-- Footer --}}
        @include('layouts.footer')
    </div>

    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Toastr JS --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            window.addEventListener('show-form', event => {
                $('#form').modal('show');
            });

            window.addEventListener('show-detail', event => {
                $('#detail-modal').modal('show');
            });

            window.addEventListener('show-delete-modal', event => {
                $('#delete-modal').modal('show');
            });

            window.addEventListener('show-confirm-modal', event => {
                $('#confirm-modal').modal('show');
            });

            window.addEventListener('hide-form', event => {
                $('#form').modal('hide');
                $('#author_name').val('');
                $('#author_birthday').val('');
                toastr.success(event.detail.message, 'Thành công!');
            });

            window.addEventListener('hide-delete-modal', event => {
                $('#delete-modal').modal('hide');
                if (event.detail.type == 'success') {
                    toastr.success(event.detail.message, 'Thành công!');
                } else {
                    toastr.error(event.detail.message, 'Thất bại!');
                }
            });

            window.addEventListener('hide-confirm-modal', event => {
                $('#confirm-modal').modal('hide');
                toastr.success(event.detail.message, 'Thành công!');
            });

            window.addEventListener('toastr-danger', event => {
                toastr.error(event.detail.message);
            });
            
            window.addEventListener('toastr-success', event => {
                toastr.success(event.detail.message);
            });
        });
    </script>

    @livewireScripts
    @yield('scripts')
</body>

</html>
