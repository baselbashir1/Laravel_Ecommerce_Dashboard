<x-rtl.base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins-rtl/table/datatable/datatables.css') }}">
            @vite(['resources/rtl/scss/light/plugins/table/datatable/dt-global_style.scss'])
            @vite(['resources/rtl/scss/dark/plugins/table/datatable/dt-global_style.scss'])
            <!--  END CUSTOM STYLE FILE  -->

            <style>
                #ecommerce-list img {
                    border-radius: 18px;
                }
            </style>
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-6">
                    <a href="/orders" class="btn btn-primary w-100 btn-lg mb-4">
                        <span class="btn-text-inner">{{ __('trans.view_all_orders') }}</span>
                    </a>
                </div>
            </div>

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-pen"></i> {{ __('trans.product_title') }}</th>
                                    <th><i class="fas fa-image"></i> {{ __('trans.product_image') }}</th>
                                    <th><i class="far fa-money-bill-alt"></i> {{ __('trans.product_price') }}</th>
                                    <th><i class="fas fa-balance-scale"></i> {{ __('trans.amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless (count((array) $orderItems) == 0)
                                    @foreach ($orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->product->title }}</td>
                                            <td>
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar me-3">
                                                        <img src="{{ $orderItem->product->image? app('firebase.storage')->getBucket()->object('Images/' . $orderItem->product->image)->signedUrl(new DateTime('9999-01-01')): asset('no-image.png') }}"
                                                            alt="Avatar" width="64" height="64">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $orderItem->unit_price }} $</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                        </tr>
                                    @endforeach
                                @endunless
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script type="module" src="{{asset('plugins-rtl/global/vendors.min.js')}}"></script>
                @vite(['resources/rtl/assets/js/custom.js'])
                <script type="module" src="{{asset('plugins-rtl/table/datatable/datatables.js')}}"></script>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
