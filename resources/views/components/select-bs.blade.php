<select name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
    <option value="">{{ __($placeholder) }}</option>
    @foreach ($options as $value => $option)
        <option value="{{ $value }}" {{ in_array($value, (array) $selected) ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror
