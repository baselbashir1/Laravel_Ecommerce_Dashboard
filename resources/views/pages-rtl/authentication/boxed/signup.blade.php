<x-rtl.base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            @vite(['resources/rtl/scss/light/assets/authentication/auth-boxed.scss'])
            @vite(['resources/rtl/scss/dark/assets/authentication/auth-boxed.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="container mt-4">
                <ul class="nav-item dropdown language-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle mt-2" id="language-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <p class="fas fa-globe" style="font-size: 25px"></p>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="container">
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                    {{-- {{ $localeCode == LaravelLocalization::getCurrentLocale() ? 'active' : '' }} --}}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </ul>
            </div>

            <div class="auth-container d-flex">
                <div class="container mx-auto align-self-center">
                    <div class="row">
                        <div
                            class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                            <div class="card mt-3 mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <h2>{{ __('trans.sign_up') }}</h2>
                                            <p>{{ __('trans.enter_em_pass_reg') }}</p>
                                        </div>
                                        <form method="POST" action="/modern-dark-menu/register">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('trans.name') }}</label>
                                                    <input type="text" name="name"
                                                        class="form-control add-billing-address-input">
                                                    @error('name')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('trans.email') }}</label>
                                                    <input type="email" class="form-control" name="email">
                                                    @error('email')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">{{ __('trans.password') }}</label>
                                                    <input type="password" class="form-control" name="password">
                                                    @error('password')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">{{ __('trans.confirm_password') }}</label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <div class="form-check form-check-primary form-check-inline">
                                                        <input class="form-check-input me-3" type="checkbox"
                                                            id="form-check-default">
                                                        <label class="form-check-label" for="form-check-default">
                                                            {{ __('trans.agree') }} <a href="javascript:void(0);"
                                                                class="text-primary">{{ __('trans.terms_conditions') }}</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <button type="submit" class="btn btn-secondary w-100"
                                                        style="text-transform:uppercase">
                                                        {{ __('trans.sign_up') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <p class="mb-0">{{ __('trans.have_account') }} <a
                                                        href="/modern-dark-menu/sign-in" class="text-warning">
                                                        {{ __('trans.sign_in') }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>

                {{-- </x-slot> --}}
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-rtl.base-layout>
