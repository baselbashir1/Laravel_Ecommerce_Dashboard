<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row layout-top-spacing">
                <div class="col-lg-6 col-md-3 col-sm-3 mb-4">
                    <input id="t-text" type="text" name="txt" placeholder="{{ __('trans.search') }}"
                        class="form-control" required="">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-3 col-sm-3 mb-4 ms-auto">
                    <a href="/add" class="btn btn-primary w-100 btn-lg mb-4">
                        <span class="btn-text-inner"><i class="fab fa-servicestack"></i>
                            {{ __('trans.add_new_service') }}</span>
                    </a>
                </div>
            </div>

            <div class="row">
                @unless (count((array) $products) == 0)
                    @foreach ($products as $product)
                        <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                            <a class="card style-6" href="/product/{{ $product->id }}/details">
                                <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span>
                                <img src="{{ $product->image? app('firebase.storage')->getBucket()->object('Images/' . $product->image)->signedUrl(new DateTime('9999-01-01')): asset('no-image.png') }}"
                                    class="card-img-top" alt="..." style="width: 182px; height: 182px;">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="container">
                                            <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                            <b>{{ $product->title }}</b>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="container mt-1">
                                <div class="btn btn-success mb-1" style="width: 75px; height: 35px;">
                                    <a href="/product/edit/{{ $product->id }}" class="text-white">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                                <div class="btn btn-danger mb-1" style="width: 75px; height: 35px;">
                                    <form method="POST" action="/delete/{{ $product->id }}">
                                        @csrf
                                        <button type="submit"
                                            style="background-color: transparent; border: transparent; color: white;">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $products->links() }}
                @else
                    <div class="container text-center">
                        <p>{{ __('trans.no_services_found') }}</p>
                    </div>
                @endunless
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
