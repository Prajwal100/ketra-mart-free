@if (count($combinations[0]) > 0)
    <table class="table table-bordered table-responsive-xl">
        <thead>
        <tr>
            <td class="text-center">
                <label for="" class="control-label">Variant</label>
            </td>
            <td class="text-center">
                <label for="" class="control-label">Variant Price</label>
            </td>
            <td class="text-center">
                <label for="" class="control-label">Stock</label>
            </td>
            <td class="text-center">
                <label for="" class="control-label">SKU</label>
            </td>

        </tr>
        </thead>

        <tbody>
        @foreach ($combinations as $key => $combination)
            @php
                $name = '';
                $code = '';
                $lstKey = array_key_last($combination);

                foreach ($combination as $option_id => $choice_id) {
                    $option_name = \App\Models\Attribute::find($option_id)->name;
                    $choice_name = \App\Models\AttributeValue::find($choice_id)->name;

                    $name .= $option_name . ': ' . $choice_name;
                    $code .= $option_id . ':' . $choice_id . '/';

                    if ($lstKey != $option_id) {
                        $name .= ' / ';
                    }
                }
            @endphp
            <tr class="variant">
                <td>
                    <label for="" class="control-label">{{ $name }}</label>
                    <input type="hidden" value="{{ $code }}" name="variations[{{ $key }}][code]">
                </td>
                <td>
                    <input type="number" step="0.01" name="variations[{{ $key }}][price]" value="0" min="0"
                           class="form-control" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="variations[{{ $key }}][stock]" value="0" min="0"
                           class="form-control" required>
                </td>
                <td>
                    <input type="text" name="variations[{{ $key }}][sku]" class="form-control">
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endif
