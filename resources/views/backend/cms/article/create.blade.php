@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <x-input-bs type="text" name="title" />
                        </div>

                        <div class="form-group">
                            <label for="keywords">{{ __('Keywords') }} (SEO)</label>
                            <x-input-bs type="text" name="keywords" />
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description (SEO)</label>
                            <x-textarea-bs name="meta_description" placeholder="{{ __('Max: 160 character') }}"
                                maxlength="160" />
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <x-textarea-bs name="description" />
                        </div>

                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group select2-primary">
                                    <label for="tag_id">Tags</label>
                                    <x-select-multiple-bs name="tag_id" placeholder="{{ __('Please Select') }}"
                                        :options="$tags->pluck('name', 'id')->toArray()" :selected="old('tag_id')" multiple />
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="is_published">{{ __('Publish?') }}</label>
                                    <br>
                                    <input type="radio" name="is_published" id="is_publish_draft"
                                        value="{{ \App\Enums\PublishStatus::DRAFT }}" checked>
                                    <label
                                        for="is_publish_draft">{{ \App\Enums\PublishStatus::getDescription(\App\Enums\PublishStatus::DRAFT) }}</label>
                                    <input type="radio" name="is_published" id="is_publish_published"
                                        value="{{ \App\Enums\PublishStatus::PUBLISHED }}">
                                    <label
                                        for="is_publish_published">{{ \App\Enums\PublishStatus::getDescription(\App\Enums\PublishStatus::PUBLISHED) }}</label>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-lg-6">
                                <div class="mb-3 form-group">
                                    <label for="photo">{{ __('Featured Image') }}</label>
                                    <br>
                                    <input type="file" name="photo" id="photo" accept="image/*">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-6">
                                <div class="mb-3 form-group">
                                    <label for="photo">Preview</label>
                                    <br>
                                    <img id="imagePreview" src="" alt="Preview Gambar" style="display: none;"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <x-form-footer-button></x-form-footer-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script_addon_footer')
    @include('backend.cms.article.include.script')
    @include('backend.cms.article.include.ckeditor')

    <script>
        // Set default value to current date and time
        var defaultDateTime = moment().format('YYYY-MM-DD HH:mm');

        // Initialize date range picker with default value
        $('#published_at').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            autoApply: true,
            startDate: defaultDateTime,
            locale: {
                format: 'YYYY-MM-DD hh:mm',
                monthNames: moment.months()
            }
        });

        $('#tag_id').select2({
            placeholder: '-- Pilih Tag --'
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
    </script>
@endsection
