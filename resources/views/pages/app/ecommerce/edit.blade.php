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
                <form method="POST" action="/edit-product/{{ $product->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label for="image"><i class="fas fa-image"></i>
                                            {{ __('trans.service_picture') }}</label>
                                        <div class="text-center">
                                            <img src="{{ $product->image? app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')): asset('no-image.png') }}"
                                                class="card-img-top" alt="..."
                                                style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-2 mb-2">
                                    <input type="file" name="image" class="form-control"
                                        placeholder="Service Picture" value="{{ $product->image }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="title"><i class="fab fa-servicestack"></i>
                                        {{ __('trans.service_title') }}</label>
                                    <input type="text" name="title" class="form-control" id="inputEmail3"
                                        placeholder="{{ __('trans.service_title') }}" value="{{ $product->title }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="price"><i class="fab fa-servicestack"></i>
                                        Price</label>
                                    <input type="number" name="price" class="form-control" id="inputEmail3"
                                        placeholder="price" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="description"><i class="fas fa-book-open"></i>
                                        description</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control" placeholder="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="published"><i class="fas fa-book-open"></i>
                                        publish</label>
                                    <input type="checkbox" name="published" class="form-control" />
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
                {{-- @unless (count((array) $serviceImages) == 0) --}}
                <h3><i class="fas fa-images"></i> {{ __('trans.service_images') }}</h3>
                {{-- @foreach ($serviceImages as $serviceImage) --}}
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                    <div class="widget-content widget-content-area ecommerce-create-section">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="text-center">
                                        <img src="{{ $product->image ? asset($product->image) : asset('no-image.png') }}"
                                            class="card-img-top" alt="..." style="width: 250px; height: 250px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" {{-- action="/modern-dark-menu/edit/{{ $service->id }}/edit-service-image/{{ $serviceImage->id }}" --}} enctype="multipart/form-data">
                            @csrf
                            <div class="container mt-2 mb-2">
                                <input type="file" name="img" class="form-control" placeholder="Service Picture"
                                    value="{{ $product->image }}">
                            </div>
                            <div class="container">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="far fa-edit"></i> {{ __('trans.update_image') }}
                                </button>
                            </div>
                        </form>
                        <form method="POST" {{-- action="/modern-dark-menu/delete/{{ $service->id }}/delete-service-image/{{ $serviceImage->id }}" --}}>
                            @csrf
                            <div class="container mt-2">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="far fa-trash-alt"></i> {{ __('trans.delete_image') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- @endforeach --}}
                {{-- @else --}}
                {{-- <h3 class="text-center">{{ __('trans.no_images_found') }}</h3> --}}
                {{-- @endunless --}}
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
