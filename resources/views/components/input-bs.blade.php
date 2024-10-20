<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
    id="{{ $name }}" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder ?? '' }}">
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror
