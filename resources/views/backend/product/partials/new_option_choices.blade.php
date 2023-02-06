<select class="form-control select2" name="option_{{ $attribute_id }}_choices[]" data-live-search="true" multiple onchange="update_sku()">
    @foreach($attribute_values as $key => $attribute_value)
        <option value="{{ $attribute_value->id }}">{{ $attribute_value->name }}</option>
    @endforeach
</select>
