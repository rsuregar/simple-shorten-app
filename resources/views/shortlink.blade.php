<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ asset('admin') }}/">
    <meta charset="utf-8" />
    <title>App Create Short Link</title>
    <meta name="description" content="Shorten Your Links | Al Akhyar Islamic School" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://alakhyar.sch.id" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/css/pages/login/classic/login-1.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />

    <style>
        .clipboard-message {
            color: green;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Entry-->
            <!--begin::Hero-->
            <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center"
                style="background-image: url('assets/media/bg/bg-3.jpg')">
                <div class="container">
                    <!--begin::Topbar-->
                    <div class="d-flex justify-content-between align-items-center border-bottom border-white py-4">
                        <h3 class="h4 text-dark mb-0">
                            <img src="{{ asset('logo.png') }}" height="70" alt="">
                        </h3>
                        <div class="d-flex">
                            <a href="https://ppdb.alakhyar.sch.id" class="font-size-h6 font-weight-bold">PPDB ALKHYAR</a>
                            <a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="text-danger font-weight-bold ml-8">LOGOUT</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!--end::Topbar-->
                    <div class="d-flex align-items-stretch text-center flex-column py-40">
                        <!--begin::Heading-->
                        {{-- <h1 class="text-dark font-weight-bolder mb-8">Paste link here</h1> --}}
                        <!--end::Heading-->
                        <!--begin::Form-->
                        <form class="d-flex position-relative w-75 m-auto" action="{{ route('form.store') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 py-5 px-8">
                                        <i class="la la-link icon-lg"></i>
                                    </span>
                                </div>
                                <input type="url" class="form-control h-auto border-0 py-5 px-1 font-size-h6" placeholder="Paste your long url here" name="origin_link" value="{{ old('origin_link') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success font-size-h6 py-5">Shorten!</button>
                                </div>
                            </div>

                        </form>
                        @error('origin_link')
                        <p><small class="text-danger">{{ $message }}</small></p>
                        @enderror
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Hero-->
            <!--begin::Section-->
            <div class="container mb-8" style="margin-top: -120px">
                <div class="card card-custom p-6">
                    <div class="card-body">
                        <!--begin::Content-->
                        {{-- <h4 class="font-weight-bold text-dark mb-4">Basic License</h4>
                        <div class="text-dark-50 line-height-lg mb-8">
                            {{ $links }}
                        </div> --}}
                        <!--end::Content-->
                        <!--begin::Content-->
                        @error('short_link')
                        <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">{{ $message }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                        @enderror
                        <h4 class="font-weight-bold text-dark mb-4">Daftar URL</h4>
                        <div class="text-dark-50 line-height-lg">
                            <div class="table-responsive">
                                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Short Url</th>
                                            <th>Original Url</th>
                                            <th>total clicks</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($links as $item)
                                            <tr>
                                                <td class="align-middle text-right">{{ $loop->index+1 }}</td>
                                                <td class="align-middle">
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <a href="{{ url($item->short_link) }}" target="_blank" type="button" class="btn text-dark">{{ url($item->short_link) }}</a>
                                                    <button type="button" class="btn clipboard-button"
                                                        data-clipboard-text="{{ url($item->short_link) }}"><i class="la la-copy"></i>
                                                        <span class="clipboard-message d-none">Copied</span>
                                                    </button>
                                                </div>
                                                </td>
                                                <td class="align-middle">{{ $item->origin_link }}</td>
                                                <td class="align-middle text-center">{{ $item->num_of_clicks }}</td>
                                                <td class="align-middle">
                                                    <div class="btn-toolbar float-right" role="toolbar" aria-label="...">
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                            {{-- <button type="button" class="btn btn-success btn-icon clipboard-button" data-clipboard-text="{{ url($item->short_link) }}"><i class="la la-copy"></i>
                                                                <span class="clipboard-message d-none">Copied</span>
                                                            </button> --}}
                                                            <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#exampleModal{{ $item->id }}"><i class="la la-edit"></i></button>
                                                            <a href="javascript:;" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" class="btn btn-danger btn-icon"><i class="la la-trash"></i></a>
                                                     <form id="delete-form" action="{{ route('form.delete') }}" method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                    </form>
                                                        </div>
                                                    </div>

                                                    <!-- Modal-->
                                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Link</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('form.update', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-solid">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text pr-0 text-muted">
                                                                                        {{ url('/') }}/
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" name="short_link" value="{{ $item->short_link }}" class="form-control p-0 text-danger font-size-h4" style="font-weight: 700">
                                                                                <div class="input-group-append">
                                                                                    <button type="submit" class="btn btn-primary font-size-h6 py-3">change</button>
                                                                                </div>
                                                                            </div>
                                                                            <span class="form-text text-muted">Ganti shortlink</span>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                </div>
            </div>
            <!--end::Section-->
            <!--end::Entry-->
        </div>
    </div>
    <!--end::Main-->
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <script>
        (function(){
        var clipboard = new ClipboardJS('.clipboard-button');

        clipboard.on('success', function (e) {
            var message = e.trigger.querySelector('.clipboard-message');
            message.classList.remove('d-none');
            setTimeout(() => {
                message.classList.add('d-none');
            }, 1000);
        });
        })();
    </script>
</body>
<!--end::Body-->

</html>
