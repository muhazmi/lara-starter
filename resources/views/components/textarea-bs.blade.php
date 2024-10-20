<textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
    placeholder="{{ $placeholder ?? '' }}" rows="{{ $rows ?? '2' }}" maxlength="{{ $maxlength ?? '' }}">{{ old($name, $value ?? '') }}</textarea>

@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror
