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
                <form method="POST" action="/edit-product/{{ $product->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <label for="image"><i class="fas fa-image"></i>
                                            {{ __('trans.product_image') }}</label>
                                        <div class="text-center">
                                            <img src="{{ $product->image? app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')): asset('no-image.png') }}"
                                                class="card-img-top" alt="..."
                                                style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-2 mb-2">
                                    <input type="file" name="image" class="form-control"
                                        value="{{ $product->image }}" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="title"><i class="fas fa-pen"></i>
                                        {{ __('trans.product_title') }}</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="{{ __('trans.product_title') }}" value="{{ $product->title }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="price"><i class="far fa-money-bill-alt"></i>
                                        {{ __('trans.product_price') }}</label>
                                    <input type="number" name="price" class="form-control"
                                        placeholder="{{ __('trans.product_price') }}" value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="description"><i class="fas fa-book-open"></i>
                                        {{ __('trans.product_description') }}</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control"
                                        placeholder="{{ __('trans.product_description') }}">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="published"><i class="fas fa-rocket"></i>
                                        {{ __('trans.publish') }}</label>
                                    <input type="checkbox" name="published" />
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="far fa-edit"></i> {{ __('trans.update_product_details') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if (count($productImages) > 0)
                <div class="row mb-4 layout-spacing layout-top-spacing">
                    <h3>{{ __('trans.product_images') }}</h3>
                    @foreach ($productImages as $productImage)
                        <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                            <div class="widget-content widget-content-area ecommerce-create-section">
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="text-center">
                                                <img src="{{ app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->signedUrl(new DateTime('9999-01-01')) }}"
                                                    class="card-img-top" alt="..."
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST"
                                    action="/edit-product/{{ $product->id }}/edit-product-image/{{ $productImage->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="container mt-2 mb-2">
                                        <input type="file" name="product_image" class="form-control"
                                            value="{{ $productImage->image }}" required>
                                    </div>
                                    <div class="container">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="far fa-edit"></i> {{ __('trans.update_image') }}
                                        </button>
                                    </div>
                                </form>
                                <form method="POST"
                                    action="/edit-product/{{ $product->id }}/delete-product-image/{{ $productImage->id }}">
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
                </div>
                <div class="row mb-4 layout-spacing layout-top-spacing">
                    <h3><i class="fas fa-image"></i> {{ __('trans.add_new_image') }}</h3>
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <form method="POST" action="/edit-product/{{ $product->id }}/add-product-image"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container mt-2 mb-2">
                                    <input type="file" name="product_image" class="form-control" required>
                                </div>
                                <div class="container">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('trans.add_image') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-4 layout-spacing layout-top-spacing">
                    <h3><i class="fas fa-images"></i> {{ __('trans.no_images') }}</h3>
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-4">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <form method="POST" action="/edit-product/{{ $product->id }}/add-product-image"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="container mt-2 mb-2">
                                    <input type="file" name="product_image" class="form-control" required>
                                </div>
                                <div class="container">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('trans.add_image') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

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
