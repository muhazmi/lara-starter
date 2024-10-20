<!-- Create Data Modal -->
<div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="createItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="create-category-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createItemModalLabel">{{ __('Add') . ' ' . $page_title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" id="create-name">
                        <div class="invalid-feedback" id="create-name-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Category') }}</label>
                        <select name="category_type_id" id="category_type_id" class="form-control">
                            <option value="">{{ __('Choose') }}</option>
                            @foreach ($category_types as $categoryType)
                                <option value="{{ $categoryType->id }}">{{ $categoryType->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="create-category_id-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><i class="fa fa-ban"></i>
                        {{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-dark"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
