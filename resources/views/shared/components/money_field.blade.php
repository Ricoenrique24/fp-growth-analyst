@php
$class_attributes = $attributes['class'] ?? '';
unset($attributes['class']);
$container_class = $attributes['container_class'] ?? '';
unset($attributes['container_class']);
@endphp

<div class="form-group {{ $container_class }}">
    {!! Form::label($name, $label . (isset($attributes['required']) ? ' *' : '')) !!}
    {!! Form::text($name, $value, array_merge([   
            'class' => 'form-control form-control-sm money ' . $class_attributes . ($errors->has($name) ? ' is-invalid' : ''),
            'autocomplete' => 'off',
            'id' => $name,
        ], $attributes));
    !!}
    <input type='hidden' id="{{$name}}_raw_value" class="money_value" value="{{ $value }}" />
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>