<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ asset('admin') }}/">
    <meta charset="utf-8" />
    <title>Shorten Your Links | Al Akhyar Islamic School</title>
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
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10"
                style="background-image: url(assets/media/bg/bg-3.jpg);">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin: Aside header-->
                    <a href="/" class="flex-column-auto mt-5 pb-lg-0 pb-10">
                        <img src="{{ asset('logo.png') }}" class="max-h-70px" alt="" />
                    </a>
                    <!--end: Aside header-->
                    <!--begin: Aside content-->
                    <div class="flex-column-fluid d-flex flex-column justify-content-center">
                        <h3 class="font-size-h1 mb-5 text-dark">Welcome to S.ALAKHYAR.SCH.ID!</h3>
                        <p class="font-weight-lighter text-dark opacity-80">Layanan memendekkan URL Anda.</p>
                    </div>
                    <!--end: Aside content-->
                    <!--begin: Aside footer for desktop-->
                    <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                        <div class="opacity-70 font-weight-bold text-dark">?? {{ date('Y').' '.config('app.name') }}
                        </div>
                        <div class="d-flex">
                            <a href="https://ppdb.alakhyar.sch.id" target="_blank" class="text-dark">PPDB ALAKHYAR</a>
                            {{-- <a href="#" class="text-white ml-10">Legal</a>
                            <a href="#" class="text-white ml-10">Contact</a> --}}
                        </div>
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden bgi-size-cover bgi-no-repeat"
                style="background-image: url(assets/media/bg/bg-3.jpg);">

                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <div class="text-center mb-5 mb-lg-10">
                            <h4 class="font-size-h1">Selamat datang</h4>
                            <p class="text-muted font-weight-bold">Untuk menggunakan layanan
                                <code>S.ALAKHYAR.SCH.ID</code></p>
                                @if (session('msg'))
                                <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">{{ session('msg') }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                        </div>
                        <!--begin::Form-->
                        <!--begin::Form-->
                        <form class="form" action="{{ route('register') }}" method="POST" id="kt_login_signup_form">
                            @csrf
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="Fullname" name="name" value="{{ old('name') }}"
                                    autocomplete="off" />

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="email" placeholder="Email" name="email" value="{{ old('email') }}"
                                    autocomplete="off" />
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Password" value="{{ old('password') }}"
                                    name="password" autocomplete="off" />

                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Confirm password" value="{{ old('cpassword') }}"
                                    name="cpassword" autocomplete="off" />

                                    @error('cpassword')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label class="checkbox mb-0">
                                    <input type="checkbox" name="agree" />
                                    <span></span> I Agree the
                                    <a href="#">terms and conditions</a></label>
                            </div> --}}
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button type="submit" id="kt_login_signup_submit"
                                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Buat Akun</button>
                                <a href="{{ url('/') }}"
                                    class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</a>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--end::Form-->
                        <!--begin::Content header-->

                        <!--end::Content header-->
                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Content body-->
                <!--begin::Content footer for mobile-->
                <div
                    class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">?? {{ date('Y').'
                        '.config('app.name') }}</div>
                    <div class="d-flex order-1 order-sm-2 my-2">
                        <a href="https://ppdb.alakhyar.sch.id" class="text-dark-75 text-hover-primary">PPDB ALAKHYAR</a>
                        {{-- <a href="#" class="text-dark-75 text-hover-primary ml-4">Legal</a>
                        <a href="#" class="text-dark-75 text-hover-primary ml-4">Contact</a> --}}
                    </div>
                </div>
                <!--end::Content footer for mobile-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
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
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/custom/login/login-general.js"></script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
