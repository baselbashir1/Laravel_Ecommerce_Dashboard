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

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="far fa-money-bill-alt"></i> {{ __('trans.total_price') }}</th>
                                    <th><i class="fas fa-info-circle"></i> {{ __('trans.status') }}</th>
                                    <th><i class="fas fa-user-alt"></i> {{ __('trans.user') }}</th>
                                    <th class="no-content text-center"><i class="fas fa-recycle"></i>
                                        {{ __('trans.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless (count((array) $orders) == 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->total_price }}</td>
                                            <td>
                                                @if ($order->status == 'paid')
                                                    <div class="btn btn-success"
                                                        style="pointer-events: none; border-radius: 100px">
                                                        {{ $order->status }}
                                                    </div>
                                                @else
                                                    <div class="btn btn-warning"
                                                        style="pointer-events: none; border-radius: 100px">
                                                        {{ $order->status }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->user ? $order->user->name : 'User not found for this order.' }}
                                            </td>
                                            <td class="text-center">
                                                <div style="display: flex">
                                                    <a href="/order/{{ $order->id }}/details"
                                                        class="btn btn-primary mt-2 mb-1">{{ __('trans.order_details') }}</a>
                                                </div>
                                            </td>
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
                </x-rt.base-layout>
