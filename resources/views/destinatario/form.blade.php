<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('id_pedido') }}
                    {{ Form::text('id_pedido', session('pasoNroPed'), ['class' => 'form-control', 'placeholder' => 'Id Pedido', 'readonly' => 'readonly']) }}
                    {!! $errors->first('id_pedido', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('id_producto') }}
                    {{ Form::text('id_producto', session('carrito.0.id', $destinatario->id_producto), ['class' => 'form-control', 'placeholder' => 'Id Producto', 'readonly' => 'readonly']) }}
                    {!! $errors->first('id_producto', '<div class="invalid-feedback">:message</div>') !!}
                </div>


            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('fecha_Entrega', 'Fecha de Entrega') }}
                    {{ Form::date('fecha_Entrega', $destinatario->fecha_Entrega, ['class' => 'form-control' . ($errors->has('fecha_Entrega') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Entrega']) }}
                    {!! $errors->first('fecha_Entrega', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('observaciones', 'Observaciones') }}
                    {{ Form::textarea('observaciones', $destinatario->observaciones, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'placeholder' => 'Observaciones', 'rows' => 4]) }}
                    {!! $errors->first('observaciones', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <h3><strong>Total a Pagar: {{ session('precioTotalCarrito') }} Bs.</strong></h3>
            <div class="form-group">
                {{ Form::label('acc', 'A cuenta') }}
                {{ Form::number('acc', null, ['class' => 'form-control' . ($errors->has('acc') ? ' is-invalid' : ''), 'placeholder' => 'Pago', 'required' => 'required', 'min' => 0]) }}
                {!! $errors->first('acc', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>



<h1>Sesiones</h1>
<pre>
        {{ print_r($sesiones) }}
    </pre>{{    $cantidad = session('carrito.0.cantidad')}}