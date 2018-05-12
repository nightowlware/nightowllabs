<div class="container">
    <div class="flexy form-group row">
        {{ Form::label("$field-label", $labelText, ['class' => "col-form-label"]) }}
        {{ Form::text($field, NULL, ['class' => 'form-control auto-width', 'readonly' => (isset($ro) ? true : false)]) }}
    </div>
</div>
