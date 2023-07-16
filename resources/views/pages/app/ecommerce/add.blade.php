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
                <form method="POST" action="/modern-dark-menu/add-service" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="title"><i class="fab fa-servicestack"></i>
                                        {{ __('trans.service_title') }}</label>
                                    <input type="text" name="title" class="form-control" id="inputEmail3"
                                        placeholder="{{ __('trans.service_title') }}">
                                </div>
                                @error('title')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="picture"><i class="fas fa-image"></i>
                                        {{ __('trans.service_picture') }}</label>
                                    <input type="file" name="picture" class="form-control" id="inputEmail3"
                                        placeholder="Service Picture">
                                </div>
                                @error('picture')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="content"><i class="fas fa-book-open"></i>
                                        {{ __('trans.service_content') }}</label>
                                    <textarea name="content" cols="30" rows="10" class="form-control"
                                        placeholder="{{ __('trans.service_content') }}"></textarea>
                                </div>
                                @error('content')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="service_image"><i class="fas fa-images"></i>
                                        {{ __('trans.upload_service_image') }}</label>
                                    <input type="file" name="service_image" class="form-control" id="inputEmail3"
                                        placeholder="Service Picture">
                                </div>
                                @error('service_image')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                                <div class="widget-content widget-content-area ecommerce-create-section">
                                    <div class="col-sm-12">
                                        <button type="submit"
                                            class="btn btn-success w-100">{{ __('trans.add_service') }}</button>
                                    </div>
                                </div>
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
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
