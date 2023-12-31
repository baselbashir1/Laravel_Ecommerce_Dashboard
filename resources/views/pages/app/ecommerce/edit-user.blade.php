<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins/filepond/filepond.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/tagify/tagify.css') }}">

            @vite(['resources/scss/light/assets/forms/switches.scss'])
            @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/scss/dark/assets/forms/switches.scss'])
            @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/scss/dark/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/scss/light/assets/apps/ecommerce-create.scss'])
            @vite(['resources/scss/dark/assets/apps/ecommerce-create.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <form method="POST" action="/edit-user/{{ $user->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="name"><i class="fas fa-id-card"></i>
                                        {{ __('trans.name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="email"><i class="fas fa-envelope"></i>
                                        {{ __('trans.email') }}</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="password"><i class="fas fa-lock"></i>
                                        {{ __('trans.password') }}</label>
                                    <input type="password" name="password" class="form-control" placeholder="password"
                                        value="">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="is_admin"><i class="fas fa-gem"></i>
                                        {{ __('trans.role') }}</label>
                                    <select name="is_admin" class="form-control">
                                        @if ($user->is_admin == 1)
                                            <option value="0">{{ __('trans.normal_user') }}</option>
                                            <option value="1" selected>{{ __('trans.admin') }}</option>
                                        @else
                                            <option value="0" selected>{{ __('trans.normal_user') }}</option>
                                            <option value="1">{{ __('trans.admin') }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="far fa-edit"></i> {{ __('trans.update_user') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins/editors/quill/quill.js') }}"></script>
                <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
                <script src="{{ asset('plugins/tagify/tagify.min.js') }}"></script>
                @vite(['resources/assets/js/apps/ecommerce-create.js'])
                <script type="module">
            ecommerce.addFiles("{{Vite::asset('resources/images/product-1.jpg')}}", "{{Vite::asset('resources/images/product-3.jpg')}}", "{{Vite::asset('resources/images/product-5.jpg')}}");
        </script>
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
