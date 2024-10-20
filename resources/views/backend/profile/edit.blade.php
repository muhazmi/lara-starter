@extends('backend.layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('backend.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <ul class="ml-auto nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#biodata" data-toggle="tab"><i class="far fa-id-card"></i>
                                Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#login" data-toggle="tab"><i class="fas fa-key"></i> Login</a>
                        </li>
                    </ul>
                </h3>
                <div class="card-tools">
                </div>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="p-0 tab-content">
                    <!-- Morris chart - Bookings -->
                    <div class="chart tab-pane active" id="biodata">
                        <div class="row">
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap (*)</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="identity_card_number">NIK</label>
                                    <input type="text" class="form-control" name="identity_card_number"
                                        id="identity_card_number" maxlength="16" value="{{ $user->identity_card_number }}">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="mobile_phone">No. HP</label>
                                    <input type="number" class="form-control" name="mobile_phone" id="mobile_phone"
                                        value="{{ $user->mobile_phone }}">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <br>
                                    <input type="radio" name="gender" id="gender" value="man"
                                        @if ($user->gender == 'man') checked @endif> Pria
                                    <input type="radio" name="gender" id="gender" value="woman"
                                        @if ($user->gender == 'woman') checked @endif> Wanita
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea type="address" class="form-control" name="address" id="address" rows="2">{{ $user->address }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <div class="form-group">
                                    <label for="province_id">Provinsi</label>
                                    <select class="form-control" name="province_id" id="province_id">
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}"
                                                @if ($province->code == $user->province_id) selected @endif>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="form-group">
                                    <label for="city_id">Kabupaten / Kota</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->code }}"
                                                @if ($city->code == $user->city_id) selected @endif>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="form-group">
                                    <label for="district_id">Kecamatan</label>
                                    <select name="district_id" id="district_id" class="form-control">
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->code }}"
                                                @if ($district->code == $user->district_id) selected @endif>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="form-group">
                                    <label for="subdistrict_id">Kelurahan / Desa</label>
                                    <select name="village_id" id="village_id" class="form-control">
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->code }}"
                                                @if ($village->code == $user->village_id) selected @endif>
                                                {{ $village->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-4 col-lg-4">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <input type="number" class="form-control" name="rt" id="rt"
                                        value="{{ $user->rt }}">
                                </div>
                            </div>
                            <div class="col col-4 col-lg-4">
                                <div class="form-group">
                                    <label for="rw">RW</label>
                                    <input type="number" class="form-control" name="rw" id="rw"
                                        value="{{ $user->rw }}">
                                </div>
                            </div>
                            <div class="col col-4 col-lg-4">
                                <div class="form-group">
                                    <label for="postcode">Kode Pos</label>
                                    <input type="number" class="form-control" name="postcode" id="postcode"
                                        value="{{ $user->postcode }}" placeholder="isikan angka saja">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="current_photo">Foto Saat Ini</label>
                                    @if ($user->photo)
                                        <p>
                                            <img src="{{ Storage::url('images/users/' . $user->photo) }}"
                                                alt="Profile Image" class="img-fluid">
                                        </p>
                                    @else
                                        <p>Belum ada foto</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="photo">Foto Baru</label>
                                    <br>
                                    <input type="file" name="photo" id="photo" accept="image/*">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="photo">Preview Foto Baru</label>
                                    <br>
                                    <img id="imagePreview" src="" alt="Preview Gambar" style="display: none;"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart tab-pane" id="login">
                        <div class="row">
                            <div class="col col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="" placeholder="diisi jika ingin mengganti password"
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                    Simpan</button>
                <button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-sync"></i>
                    Reset</button>
            </div>
            <!-- /.card-body -->
        </div>
    </form>
@endsection

@section('script_addon_footer')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        // Menonaktifkan tombol submit setelah diklik
        $('form').submit(function() {
            $('#submit').attr('disabled', 'disabled');
            return true; // proses form
        });

        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault(); // Mencegah form submit secara default

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function() {
                                if (response.logout) {
                                    window.location.href =
                                    '/login'; // Redirect ke halaman login jika logout
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Mengambil pesan error dari response
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            // Loop melalui error dan gabungkan menjadi satu pesan
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] +
                                '<br>'; // Tambahkan error ke dalam pesan
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMessage, // Menggunakan html untuk multiple lines
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update profile. Please try again later.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    complete: function() {
                        $('#submit').attr('disabled', false); // Enable tombol setelah selesai
                    }
                });

                // Disable tombol submit untuk mencegah double submit
                $('#submit').attr('disabled', true);
            });
        });

        $('#province_id').select2({
            theme: 'bootstrap4',
            placeholder: "-- Pilih Provinsi --",
        });
        $('#city_id').select2({
            theme: 'bootstrap4',
            placeholder: "-- Pilih Kota --",
        });
        $('#district_id').select2({
            theme: 'bootstrap4',
            placeholder: "-- Pilih Kecamatan --",
        });
        $('#village_id').select2({
            theme: 'bootstrap4',
            placeholder: "-- Pilih Kelurahan / Desa --",
        });

        const photo = document.getElementById("photo");
        const imagePreview = document.getElementById("imagePreview");

        photo.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "";
                imagePreview.style.display = "none";
            }
        });

        // Show region data
        $(document).ready(function() {
            // show province
            $('#province_id').change(function() {
                var provinceId = $(this).val();
                $.get('/region/getCity', {
                    province_id: provinceId
                }, function(data) {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Silahkan Pilih Kota</option>');
                    $.each(data, function(key, value) {
                        $('#city_id').append('<option value="' + value.code + '">' + value
                            .name + '</option>');
                    });
                });
            });

            // show city based on province id
            $('#city_id').change(function() {
                var cityId = $(this).val();
                $.get('/region/getDistrict', {
                    city_id: cityId
                }, function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Silahkan Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="' + value.code + '">' +
                            value.name + '</option>');
                    });
                });
            });

            // show district based on city code
            $('#district_id').change(function() {
                var districtId = $(this).val();
                $.get('/region/getVillage', {
                    district_id: districtId
                }, function(data) {
                    $('#village_id').empty();
                    $('#village_id').append('<option value="">Silahkan Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#village_id').append('<option value="' + value.code + '">' +
                            value.name + '</option>');
                    });
                });
            });
        });
    </script>
@endsection
