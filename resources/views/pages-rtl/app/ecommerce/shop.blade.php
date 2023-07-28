<x-rtl.base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="container text-center" style="margin-top: 50px; margin-bottom: 50px">
                <h3>{{ __('trans.dashboard') }}</h3>
            </div>

            <div class="row">
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/products">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('products.jpeg') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.products') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/customers">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('customers.jpeg') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.customers') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/orders">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('orders.jpg') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.orders') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/users">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('users.png') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.users') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/payments">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('payments.png') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.payments') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a class="card style-6" href="/carts">
                        {{-- <span class="badge badge-primary"><i class="fas fa-star"></i> {{ __('trans.new') }}</span> --}}
                        <img src="{{ asset('carts.jpg') }}" class="card-img-top" alt="..."
                            style="width: 182px; height: 182px;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="container">
                                    <i style="font-size: 20px" class="fab fa-servicestack"></i>
                                    <b>{{ __('trans.carts') }}</b>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
