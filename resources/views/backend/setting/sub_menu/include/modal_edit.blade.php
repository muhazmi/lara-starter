<!-- Edit Data Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-submenu-form">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">{{ __('Edit') . ' ' . $page_title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-menu_id">{{ __('Menu Name') }}</label>
                        <select name="menu_id" id="edit-menu_id" class="form-control">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="edit-menu_id-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit-sort">{{ __('Order Number') }}</label>
                        <input type="text" class="form-control" name="sort" id="edit-sort">
                        <div class="invalid-feedback" id="edit-sort-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">{{ __('Sub Menu Name') }}</label>
                        <input type="text" class="form-control" name="name" id="edit-name">
                        <div class="invalid-feedback" id="edit-name-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit-url">{{ __('URL') }}</label>
                        <input type="text" class="form-control" name="url" id="edit-url">
                        <div class="invalid-feedback" id="edit-url-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="edit-icon">{{ __('Icon') }}</label>
                        <input type="text" class="form-control" name="icon" id="edit-icon">
                        <div class="invalid-feedback" id="edit-icon-error"></div>
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
