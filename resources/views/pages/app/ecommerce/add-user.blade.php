<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins/filepond/filepond.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/tagify/tagify.css') }}">

            @vite(['resources/scss/light/assets/forms/switches.scss'])
            @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/scss/dark/assets/forms/switches.scss'])
            @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
            @vite(['resources/scss/dark/plugins/tagify/custom-tagify.scss'])
            @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

            @vite(['resources/scss/light/assets/apps/ecommerce-create.scss'])
            @vite(['resources/scss/dark/assets/apps/ecommerce-create.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row mb-4 layout-spacing layout-top-spacing">
                <form method="POST" action="/add-user" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="widget-content widget-content-area ecommerce-create-section">
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="name"><i class="fab fa-servicestack"></i>
                                        Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="name">
                                </div>
                                @error('name')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="email"><i class="fab fa-servicestack"></i>
                                        Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email">
                                </div>
                                @error('email')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="password"><i class="fab fa-servicestack"></i>
                                        Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="password">
                                </div>
                                @error('password')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label for="is_admin"><i class="fas fa-book-open"></i>
                                        Role</label>
                                    <select name="is_admin" class="form-control">
                                        <option selected disabled></option>
                                        <option value="0">normal user</option>
                                        <option value="1">admin</option>
                                    </select>
                                </div>
                                @error('is_admin')
                                    <p class="mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mt-4">
                                <div class="widget-content widget-content-area ecommerce-create-section">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success w-100">Add User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins/editors/quill/quill.js') }}"></script>
                <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
                <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
                <script src="{{ asset('plugins/tagify/tagify.min.js') }}"></script>
                @vite(['resources/assets/js/apps/ecommerce-create.js'])
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
