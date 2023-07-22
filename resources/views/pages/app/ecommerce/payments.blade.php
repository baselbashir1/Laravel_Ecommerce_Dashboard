<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
            @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
            @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
            <!--  END CUSTOM STYLE FILE  -->

            <style>
                #ecommerce-list img {
                    border-radius: 18px;
                }
            </style>
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            {{-- <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-6">
                    <a href="/product/add" class="btn btn-primary w-100 btn-lg mb-4">
                        <span class="btn-text-inner"><i class="fab fa-servicestack"></i>
                            Add New Product</span>
                    </a>
                </div>
            </div> --}}

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="fab fa-servicestack"></i> #</th>
                                    <th><i class="fas fa-book-open"></i> amount</th>
                                    <th><i class="fas fa-book-open"></i> status</th>
                                    <th><i class="fas fa-book-open"></i> type</th>
                                    <th><i class="fas fa-book-open"></i> created by</th>
                                    {{-- <th class="no-content text-center"><i class="fas fa-recycle"></i>
                                        {{ __('trans.action') }}</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @unless (count((array) $payments) == 0)
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->order_id }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>
                                                @if ($payment->status == 'paid')
                                                    <div class="btn btn-success"
                                                        style="pointer-events: none; border-radius: 100px">
                                                        {{ $payment->status }}
                                                    </div>
                                                @else
                                                    <div class="btn btn-warning"
                                                        style="pointer-events: none; border-radius: 100px">
                                                        {{ $payment->status }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $payment->type }}</td>
                                            <td>
                                                {{ $payment->user ? $payment->user->name : 'User not found for this payment.' }}
                                            </td>
                                            {{-- <td class="text-center">
                                                <div style="display: flex">
                                                    <a href="#" style="width: 50px; height: 40px"
                                                        class="btn btn-primary mt-2 mb-1"><i class="fas fa-info"></i></a>
                                                    <a href="#" style="width: 50px; height: 40px"
                                                        class="btn btn-success m-2"><i class="far fa-edit"></i></a>
                                                    <form method="POST" class="mt-2" action="">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            style="width: 50px; height: 40px">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td> --}}
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
                <script type="module" src="{{asset('plugins/global/vendors.min.js')}}"></script>
                @vite(['resources/assets/js/custom.js'])
                <script type="module" src="{{asset('plugins/table/datatable/datatables.js')}}"></script>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
