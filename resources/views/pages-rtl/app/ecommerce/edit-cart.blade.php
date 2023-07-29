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
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="product_id"><i class="fas fa-headphones-alt"></i>
                                        {{ __('trans.product_title') }}</label>
                                    <select name="product_id" class="form-control">
                                        <option value="{{ $cartItem->product_id }}" selected disabled>
                                            {{ $cartItem->product->title }}
                                        </option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="quantity"><i class="fas fa-balance-scale"></i>
                                        {{ __('trans.amount') }}</label>
                                    <input type="number" name="quantity" class="form-control"
                                        value="{{ $cartItem->quantity }}">
                                </div>
                            </div>
                            <div class="container">
                                <button type="submit" class="btn btn-success w-100">
                                    {{ __('trans.update_cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
            ecommerce.addFiles("{{Vite::asset('resources/rtl/images/product-1.jpg')}}", "{{Vite::asset('resources/rtl/images/product-3.jpg')}}", "{{Vite::asset('resources/rtl/images/product-5.jpg')}}");
        </script>
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
