<?php /** @var \App\Model\User\Attribute $_filter */ ?>
@foreach($filters as $_attribute)
    @if($_attribute->frontend_edit_type == 'textarea')
        @include('search.fields.textarea')
    @elseif($_attribute->frontend_edit_type == 'select')
        @include('search.fields.select')
    @else
        @include('search.fields.input')
    @endif
@endforeach
<div class="form-group">
    <button type="submit" class="btn btn-success btn-lg">Наити знакомства
        <img height="25px" src="/images/search.png" alt="search">
    </button>
</div>

