@extends('backend.layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-lg-12">
            <form id="companyUpdateForm" action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <ul class="ml-auto nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#company" data-toggle="tab">
                                        <i class="far fa-building"></i> {{ __('Company') }}
                                    </a>
                                </li>
                            </ul>
                        </h3>
                        <div class="card-tools"></div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="p-0 tab-content">
                            <!-- Morris chart - Bookings -->
                            <div class="chart tab-pane active" id="company">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('Company Name') }}</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name', $company->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="director_name">{{ __('Director Name') }}</label>
                                            <input type="text" class="form-control" name="director_name"
                                                id="director_name"
                                                value="{{ old('director_name', $company->director_name) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_description">{{ __('Company Short Description') }}</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="2">{{ old('short_description', $company->short_description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Company Description') }}</label>
                                    <textarea class="form-control" name="description" id="description" rows="2">{{ old('description', $company->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">{{ __('Company Address') }}</label>
                                    <textarea class="form-control" name="address" id="address" rows="2">{{ old('address', $company->address) }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="gmap_location">{{ __('Company Google Map Location') }}</label>
                                            <input type="text" class="form-control" name="gmap_location"
                                                id="gmap_location"
                                                value="{{ old('gmap_location', $company->gmap_location) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label
                                                for="gmap_location">{{ __('Company Google Map Location Preview') }}</label>
                                            <p>{!! $company->gmap_location !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                value="{{ old('email', $company->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="phone">{{ __('Mobile Phone') }}</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="{{ old('phone', $company->phone) }}" required>
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="telephone">{{ __('Telephone') }}</label>
                                            <input type="text" class="form-control" name="telephone" id="telephone"
                                                value="{{ old('telephone', $company->telephone) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="current_logo">{{ __('Current Company Logo') }}</label>
                                            @if (Storage::exists('assets/images/company/' . $company->logo))
                                                <p>
                                                    <img src="{{ asset('assets/images/company/' . $company->logo) }}"
                                                        alt="{{ __('Company Logo') }}" class="img-fluid">
                                                </p>
                                            @else
                                                <p>{{ __('No Company Logo found') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo">{{ __('New Company Logo') }}</label>
                                            <br>
                                            <input type="file" name="logo" id="logo" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo_preview">{{ __('New Company Logo Preview') }}</label>
                                            <br>
                                            <img id="logoPreview" src="" alt="Preview Gambar"
                                                style="display: none;" class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="current_favicon">{{ __('Current Favicon') }}</label>
                                            @if (Storage::exists('assets/images/favicon/' . $company->favicon))
                                                <p>
                                                    <img src="{{ asset('assets/images/favicon/' . $company->favicon) }}"
                                                        alt="{{ __('Favicon Logo') }}" class="img-fluid">
                                                </p>
                                            @else
                                                <p>{{ __('No Favicon found') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="favicon">{{ __('New Favicon') }}</label>
                                            <br>
                                            <input type="file" name="favicon" id="favicon" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col col-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="favicon_preview">{{ __('New Favicon Preview') }}</label>
                                            <br>
                                            <img id="faviconPreview" src="" alt="Preview Gambar"
                                                style="display: none;" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" id="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> {{ __('Update') }}
                        </button>
                        <button type="reset" name="reset" class="btn btn-danger">
                            <i class="fa fa-sync"></i> Reset
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script_addon_footer')
    <script type="text/javascript">
        const logoPreview = document.getElementById("logo");
        const faviconPreview = document.getElementById("faviconPreview");

        logo.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    companyLogoPreview.src = e.target.result;
                    companyLogoPreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                companyLogoPreview.src = "";
                companyLogoPreview.style.display = "none";
            }
        });

        favicon.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    faviconPreview.src = e.target.result;
                    faviconPreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                faviconPreview.src = "";
                faviconPreview.style.display = "none";
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('companyUpdateForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses menggunakan SweetAlert dengan localization Laravel
                            Swal.fire({
                                title: '{{ __('Success!') }}',
                                text: '{{ __('Data Updated Successfully') }}',
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                timer: 1500,
                                timerProgressBar: true
                            });
                        } else {
                            // Tampilkan pesan error jika ada masalah
                            Swal.fire('Error',
                                '{{ __('Failed to update data. Please try again.') }}', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', '{{ __('Failed to update data. Please try again') }}',
                            'error');
                    });
            });
        });
    </script>

    @include('backend.setting.company.ckeditor')
@endsection
