<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_empleado') }}
            {{ Form::select('id_empleado', $empleado,$usuario->id_empleado, ['class' => 'form-control' . ($errors->has('id_empleado') ? ' is-invalid' : ''), 'placeholder' => 'Id Empleado']) }}
            {!! $errors->first('id_empleado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('UserName') }}
            {{ Form::text('nombre', $usuario->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de Usuario']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('contra') }}
            {{ Form::password('contra', ['class' => 'form-control' . ($errors->has('contra') ? ' is-invalid' : ''), 'placeholder' => 'Contra']) }}
            {!! $errors->first('contra', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado', 'Estado') }}
            <div class="form-check">
                {{ Form::radio('estado', 1, $usuario->estado == 1, ['class' => 'form-check-input' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
                {{ Form::label('estado_activo', 'Activo', ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
                {{ Form::radio('estado', 0, $usuario->estado == 0, ['class' => 'form-check-input' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
                {{ Form::label('estado_inactivo', 'Inactivo', ['class' => 'form-check-label']) }}
            </div>
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>