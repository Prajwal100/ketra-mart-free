<div class="row mt-2">
    <div class="col-3  attr-names">
        <select class="form-control select2" name="product_attributes[]" onchange="get_attributes_values(this)" data-live-search="true"  title="Select an option">
            <option value="">Select an option</option>
            @foreach($attributes as $key => $attribute)
                <option value="{{ $attribute->id }}">{{$attribute->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-8 attr-values">
        <div class="form-control">
            <span>Select an attribute</span>
        </div>
    </div>
    <div class="col-auto">
        <button type="button" data-toggle="remove-parent" class="btn btn-danger" data-parent=".row">
            <i class="fe fe-trash-2"></i>
        </button>
    </div>
</div>
