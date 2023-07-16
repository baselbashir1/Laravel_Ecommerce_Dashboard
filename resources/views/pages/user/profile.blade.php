<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            @vite(['resources/scss/light/assets/components/list-group.scss'])
            @vite(['resources/scss/light/assets/users/user-profile.scss'])
            @vite(['resources/scss/dark/assets/components/list-group.scss'])
            @vite(['resources/scss/dark/assets/users/user-profile.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('trans.users') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('trans.profile') }}</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->

            <div class="text-ciner">

                <!-- Content -->
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    <div class="user-profile">
                        <div class="widget-content widget-content-area">
                            <div class="d-flex justify-content-between">
                                <h3 class="">{{ __('trans.profile') }}</h3>
                            </div>
                            <div class="text-center user-info">
                                <img src="{{ Vite::asset('resources/images/profile-3.jpeg') }}" alt="avatar">
                                <p>
                                    @auth
                                        {{ Auth::user()->name }}
                                    @endauth
                                </p>
                            </div>
                            <div class="user-info-list">

                                <div>
                                    <ul class="contacts-block list-unstyled">
                                        <li class="contacts-block__item">
                                            <p style="font-size: 15px"><i class="fas fa-coffee"></i> Web Developer</p>
                                        </li>
                                        <li class="contacts-block__item">
                                            <p style="font-size: 15px"><i class="fas fa-location-arrow"></i> New York,
                                                USA</p>
                                        </li>
                                        <li class="contacts-block__item">
                                            <p style="font-size: 15px">
                                                <i class="fas fa-envelope"></i>
                                                @auth
                                                    {{ Auth::user()->email }}
                                                @endauth
                                            </p>
                                        </li>
                                        <li class="contacts-block__item">
                                            <p style="font-size: 15px"> <i class="fas fa-phone"></i> +1 (530) 555-12121
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>

                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
