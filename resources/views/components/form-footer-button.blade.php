<div class="btn-group">
    <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fa fa-save"></i>
        {{ __('Save') }}
    </button>
    <button type="reset" name="reset" class="btn btn-primary"><i class="fa fa-sync"></i>
        {{ __('Reset') }}
    </button>
    <a href="{{ url()->previous() }}" name="backward" class="btn btn-dark"><i class="fa fa-arrow-left"></i>
        {{ __('Back') }}
    </a>    
</div>