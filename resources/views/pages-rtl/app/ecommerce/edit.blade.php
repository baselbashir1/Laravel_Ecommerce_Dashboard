<x-rtl.base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins-rtl/filepond/filepond.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins-rtl/filepond/FilePondPluginImagePreview.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins-rtl/tagify/tagify.css') }}">

            @vite(['resources/rtl/scss/light/assets/forms/switches.scss'])
            @vite(['resources/rtl/scss/light/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/rtl/scss/light/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/rtl/scss/light/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/rtl/scss/dark/assets/forms/switches.scss'])
            @vite(['resources/rtl/scss/dark/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/rtl/scss/dark/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/rtl/scss/dark/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/rtl/scss/light/assets/apps/ecommerce-create.scss'])
            @vite(['resources/rtl/scss/dark/assets/apps/ecommerce-create.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <form method="POST" action="/modern-dark-menu/edit-service/{{ $service->id }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label for="picture"><i class="fas fa-image"></i>
                                            {{ __('trans.service_picture') }}</label>
                                        <div class="text-center">
                                            <img src="{{ $service->picture ? asset('storage/' . $service->picture) : asset('no-image.png') }}"
                                                class="card-img-top" alt="..."
                                                style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-2 mb-2">
                                    <input type="file" name="picture" class="form-control"
                                        placeholder="Service Picture" value="{{ $service->picture }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="title"><i class="fab fa-servicestack"></i>
                                        {{ __('trans.service_title') }}</label>
                                    <input type="text" name="title" class="form-control" id="inputEmail3"
                                        placeholder="{{ __('trans.service_title') }}" value="{{ $service->title }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="content"><i class="fas fa-book-open"></i>
                                        {{ __('trans.service_content') }}</label>
                                    <textarea name="content" cols="30" rows="10" class="form-control"
                                        placeholder="{{ __('trans.service_content') }}">{{ $service->content }}</textarea>
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="far fa-edit"></i> {{ __('trans.update_service_details') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mb-4 layout-spacing layout-top-spacing">
                @unless (count($serviceImages) == 0)
                    <h3><i class="fas fa-images"></i> {{ __('trans.service_images') }}</h3>
                    @foreach ($serviceImages as $serviceImage)
                        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                            <div class="widget-content widget-content-area ecommerce-create-section">
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="text-center">
                                                <img src="{{ $serviceImage->image ? asset('storage/' . $serviceImage->image) : asset('no-image.png') }}"
                                                    class="card-img-top" alt="..."
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST"
                                    action="/modern-dark-menu/edit/{{ $service->id }}/edit-service-image/{{ $serviceImage->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container mt-2 mb-2">
                                        <input type="file" name="img" class="form-control"
                                            placeholder="Service Picture" value="{{ $serviceImage->image }}">
                                    </div>
                                    <div class="container">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="far fa-edit"></i> {{ __('trans.update_image') }}
                                        </button>
                                    </div>
                                </form>
                                <form method="POST"
                                    action="/modern-dark-menu/delete/{{ $service->id }}/delete-service-image/{{ $serviceImage->id }}">
                                    @csrf
                                    <div class="container mt-2">
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="far fa-trash-alt"></i> {{ __('trans.delete_image') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center">{{ __('trans.no_images_found') }}</h3>
                @endunless
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins-rtl/editors/quill/quill.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/filepond.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginImagePreview.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginImageCrop.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginImageResize.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/FilePondPluginImageTransform.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/tagify/tagify.min.js') }}"></script>
                @vite(['resources/rtl/assets/js/apps/ecommerce-create.js'])
                <script type="module">
            ecommerce.addFiles("{{Vite::asset('resources/images/product-1.jpg')}}", "{{Vite::asset('resources/images/product-3.jpg')}}", "{{Vite::asset('resources/images/product-5.jpg')}}");
        </script>
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
