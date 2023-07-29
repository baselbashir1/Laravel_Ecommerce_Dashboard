<x-rtl.base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet"
                href="{{ asset('plugins-rtl/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins-rtl/glightbox/glightbox.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins-rtl/splide/splide.min.css') }}">

            @vite(['resources/rtl/scss/light/assets/components/tabs.scss'])
            @vite(['resources/rtl/scss/light/assets/components/accordions.scss'])
            @vite(['resources/rtl/scss/light/assets/apps/ecommerce-details.scss'])
            @vite(['resources/rtl/scss/dark/assets/components/tabs.scss'])
            @vite(['resources/rtl/scss/dark/assets/components/accordions.scss'])
            @vite(['resources/rtl/scss/dark/assets/apps/ecommerce-details.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row layout-top-spacing">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                    <div class="widget-content widget-content-area br-8">
                        <div class="row justify-content-center">
                            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 pe-3">
                                <!-- Swiper -->
                                <div class="product-details-content text-center">
                                    <h3 class="product-title mb-4"><i class="fas fa-images"></i>
                                        {{ __('trans.product_images') }}</h3>
                                </div>
                                <div id="main-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <li class="splide__slide">
                                                <a href="{{ app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')) }}"
                                                    class="glightbox">
                                                    <img alt="ecommerce" style="width: 500px"
                                                        src="{{ app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')) }}">
                                                </a>
                                            </li>
                                            @foreach ($productImages as $productImage)
                                                <li class="splide__slide">
                                                    <a href="{{ app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->signedUrl(new DateTime('9999-01-01')) }}"
                                                        class="glightbox">
                                                        <img alt="ecommerce" style="width: 500px"
                                                            src="{{ app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->signedUrl(new DateTime('9999-01-01')) }}">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div id="thumbnail-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <li class="splide__slide"><img alt="ecommerce"
                                                    src="{{ app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')) }}">
                                            </li>
                                            @foreach ($productImages as $productImage)
                                                <li class="splide__slide"><img alt="ecommerce"
                                                        src="{{ app('firebase.storage')->getBucket()->object('Product Images/' . $productImage->image)->signedUrl(new DateTime('9999-01-01')) }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-xxl-4 col-xl-5 col-lg-12 col-md-12 col-12 mt-xl-0 mt-5 align-self-center text-center">
                                <div class="product-details-content">
                                    <hr class="mb-6">
                                    <h3 class="product-title mb-4"><i class="fas fa-pen"></i>
                                        {{ __('trans.product_title') }}</h3>
                                    <h5>{{ $product->title }}</h5>
                                    <hr class="mb-6">
                                    <h3 class="product-title mb-4"><i class="fas fa-book-open"></i>
                                        {{ __('trans.product_description') }}</h3>
                                    <h5>{{ $product->description }}</h5>
                                    <hr class="mb-6">
                                    <h3 class="product-title mb-4"><i class="far fa-money-bill-alt"></i>
                                        {{ __('trans.product_price') }}</h3>
                                    <h5>{{ $product->price }} $</h5>
                                    <hr class="mb-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins-rtl/global/vendors.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/glightbox/glightbox.min.js') }}"></script>
                <script src="{{ asset('plugins-rtl/splide/splide.min.js') }}"></script>
                @vite(['resources/rtl/assets/js/apps/ecommerce-details.js'])
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
