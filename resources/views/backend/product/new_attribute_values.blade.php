<select class="form-control select2" name="attribute_{{ $attribute_id }}_values[]" multiple data-live-search="true">
    @foreach($attribute_values as $key => $attribute_value)
        <option value="{{ $attribute_value->id }}">{{ $attribute_value->name }}</option>
    @endforeach
</select>
