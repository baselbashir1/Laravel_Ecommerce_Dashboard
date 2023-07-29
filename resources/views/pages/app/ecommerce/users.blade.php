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

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-6">
                    <a href="/user/add" class="btn btn-primary w-100 btn-lg mb-4">
                        <span class="btn-text-inner">{{ __('trans.add_new_user') }}</span>
                    </a>
                </div>
            </div>

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="ecommerce-list" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-id-card"></i> {{ __('trans.name') }}</th>
                                    <th><i class="fas fa-envelope"></i> {{ __('trans.email') }}</th>
                                    <th><i class="fas fa-lock"></i> {{ __('trans.password') }}</th>
                                    <th><i class="fas fa-gem"></i> {{ __('trans.role') }}</th>
                                    <th class="no-content text-center"><i class="fas fa-recycle"></i>
                                        {{ __('trans.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless (count((array) $users) == 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ substr($user->password, 0, 10) }}</td>
                                            <td>
                                                @if ($user->is_admin == 1)
                                                    Admin
                                                @else
                                                    Normal user
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div style="display: flex">
                                                    <a href="/user/{{ $user->id }}/edit"
                                                        style="width: 50px; height: 40px" class="btn btn-success m-2"><i
                                                            class="far fa-edit"></i></a>
                                                    <form method="POST" class="mt-2"
                                                        action="/delete-user/{{ $user->id }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            style="width: 50px; height: 40px">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
                <script type="module" src="{{asset('plugins/global/vendors.min.js')}}"></script>
                @vite(['resources/assets/js/custom.js'])
                <script type="module" src="{{asset('plugins/table/datatable/datatables.js')}}"></script>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
