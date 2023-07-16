<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/glightbox/glightbox.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/splide/splide.min.css') }}">

            @vite(['resources/scss/light/assets/components/tabs.scss'])
            @vite(['resources/scss/light/assets/components/accordions.scss'])
            @vite(['resources/scss/light/assets/apps/ecommerce-details.scss'])
            @vite(['resources/scss/dark/assets/components/tabs.scss'])
            @vite(['resources/scss/dark/assets/components/accordions.scss'])
            @vite(['resources/scss/dark/assets/apps/ecommerce-details.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row layout-top-spacing">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                    <div class="widget-content widget-content-area br-8">
                        <div class="row justify-content-center">
                            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 pe-3">
                                <!-- Swiper -->
                                <div id="main-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($serviceImages as $serviceImage)
                                                <li class="splide__slide">
                                                    <a href="{{ $serviceImage->image ? asset('storage/' . $serviceImage->image) : asset('no-image.png') }}"
                                                        class="glightbox">
                                                        <img alt="ecommerce"
                                                            src="{{ $serviceImage->image ? asset('storage/' . $serviceImage->image) : asset('no-image.png') }}">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div id="thumbnail-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($serviceImages as $serviceImage)
                                                <li class="splide__slide"><img alt="ecommerce"
                                                        src="{{ $serviceImage->image ? asset('storage/' . $serviceImage->image) : asset('no-image.png') }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-xxl-4 col-xl-5 col-lg-12 col-md-12 col-12 mt-xl-0 mt-5 align-self-center text-center">
                                <div class="product-details-content">
                                    <h3 class="product-title mb-0"><i class="fab fa-servicestack"></i>
                                        {{ $service->title }}</h3>
                                    <hr class="mb-4">
                                    <div class="container">
                                        <p style="font-size: 20px"><i class="fas fa-book-open"></i>
                                            {{ $service->content }}</p>
                                    </div>
                                    <hr class="mb-5 mt-4">
                                    <h4><i class="fas fa-image"></i> {{ __('trans.add_image') }}</h4>
                                    <form action="/modern-dark-menu/detail/{{ $service->id }}/add-service-image"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xxl-12 col-xl-12 col-sm-12 mb-sm-0 mb-3 mt-3">
                                            <div class="row mb-4">
                                                <div class="col-sm-12">
                                                    <input type="file" name="img" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 btn-lg">
                                                <span class="btn-text-inner">{{ __('trans.submit') }}</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
                <script src="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
                <script src="{{ asset('plugins/glightbox/glightbox.min.js') }}"></script>
                <script src="{{ asset('plugins/splide/splide.min.js') }}"></script>
                @vite(['resources/assets/js/apps/ecommerce-details.js'])
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
