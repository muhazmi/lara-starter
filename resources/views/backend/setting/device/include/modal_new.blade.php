<!-- Create Data Modal -->
<div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="createItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="create-menu-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createItemModalLabel">{{ __('Add') . ' ' . $page_title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-sort">{{ __('Order Number') }}</label>
                        <input type="number" class="form-control" name="sort" id="create-sort">
                        <div class="invalid-feedback" id="create-sort-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="create-name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" name="name" id="create-name">
                        <div class="invalid-feedback" id="create-name-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="create-url">{{ __('URL') }}</label>
                        <input type="text" class="form-control" name="url" id="create-url">
                        <div class="invalid-feedback" id="create-url-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="create-icon">{{ __('Icon') }}</label>
                        <a href="https://fontawesome.com/search" target="_blank">
                            <span class="badge badge-secondary">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> {{ __('Icon List') }}
                            </span>
                        </a>
                        <input type="text" class="form-control" name="icon" id="create-icon">
                        <div class="invalid-feedback" id="create-icon-error"></div>
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
