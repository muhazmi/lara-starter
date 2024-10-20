@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('articles.update', $articles->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <x-input-bs name="title" value="{{ old('title', $articles->title) }}" />
                        </div>
                        <div class="form-group">
                            <label for="keywords">{{ __('Keywords') }} (SEO)</label>
                            <x-input-bs name="keywords" value="{{ old('keywords', $articles->keywords) }}" />
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description (SEO)</label>
                            <x-textarea-bs name="meta_description"
                                value="{{ old('meta_description', $articles->meta_description) }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <x-textarea-bs name="description" value="{{ old('description', $articles->description) }}" />
                        </div>

                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <div class="form-group select2-primary">
                                        <label for="tag_id">Tags</label>
                                        <x-select-multiple-bs name="tag_id" placeholder="{{ __('Please Select') }}"
                                            :options="$tags->pluck('name', 'id')->toArray()" :selected="$articles->tags->pluck('id')->toArray()" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="is_published">{{ __('Publish?') }}</label>
                                        <br>
                                        <input type="radio" name="is_published" id="is_publish_published"
                                            value="{{ \App\Enums\PublishStatus::PUBLISHED }}"
                                            @if ($articles->is_published == \App\Enums\PublishStatus::PUBLISHED) checked @endif>
                                        <label
                                            for="is_publish_published">{{ \App\Enums\PublishStatus::getDescription(\App\Enums\PublishStatus::PUBLISHED) }}</label>

                                        <input type="radio" name="is_published" id="is_publish_draft"
                                            value="{{ \App\Enums\PublishStatus::DRAFT }}"
                                            @if ($articles->is_published == \App\Enums\PublishStatus::DRAFT) checked @endif>
                                        <label
                                            for="is_publish_draft">{{ \App\Enums\PublishStatus::getDescription(\App\Enums\PublishStatus::DRAFT) }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="current_photo">{{ __('Existing Image') }}</label>
                                    @if ($articles->photo)
                                        <p>
                                            <img src="{{ Storage::disk('images')->url('article/' . $articles->photo) }}"
                                                alt="Featured Image" class="img-fluid">
                                        </p>
                                    @else
                                        <p>Belum ada foto</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <div class="mb-3 form-group">
                                    <label for="photo">{{ __('Featured Image') }}</label>
                                    <br>
                                    <input type="file" name="photo" id="photo" accept="image/*">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
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
                    <!-- /.card-body -->
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
            timePicker: true,
            timePicker24Hour: true,
            autoApply: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm',
                monthNames: moment.months()
            },
            startDate: defaultDateTime,
            endDate: defaultDateTime
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
