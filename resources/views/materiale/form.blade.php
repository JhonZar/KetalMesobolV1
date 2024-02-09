<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $materiale->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado', 'Estado') }}
            <div class="form-check">
                {{ Form::radio('estado', '1', $materiale->estado === 1, ['class' => 'form-check-input' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
                {{ Form::label('estado_disponible', 'Disponible', ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
                {{ Form::radio('estado', '0', $materiale->estado === 0, ['class' => 'form-check-input' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
                {{ Form::label('estado_no_disponible', 'No Disponible', ['class' => 'form-check-label']) }}
            </div>
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>