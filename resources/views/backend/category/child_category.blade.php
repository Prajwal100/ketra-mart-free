@php
    $value = null;
    for ($i=0; $i < $child_category->level; $i++){
        $value .= '--';
    }
@endphp
<option value="{{ $child_category->id }}" @isset($category) {{$category->parent_id==$child_category->id ? 'selected' : ''}} @endisset>{{ $value." ".$child_category->title }}</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('backend.category.child_category', ['child_category' => $childCategory])
    @endforeach
@endif
