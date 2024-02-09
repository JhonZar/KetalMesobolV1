@extends('layouts.app')

@section('template_title')
    Detalle Pedido
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Pedido') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalle-pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Id Pedido</th>
										<th>Id Producto</th>
										<th>Cantidad</th>
										<th>Precion Unitario</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallePedidos as $detallePedido)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallePedido->id_pedido }}</td>
											<td>{{ $detallePedido->producto->nombre }}</td>
											<td>{{ $detallePedido->cantidad }}</td>
											<td>{{ $detallePedido->precion_unitario }}</td>
                                            <td>
                                                <form action="{{ route('detalle-pedidos.destroy',$detallePedido->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-pedidos.show',$detallePedido->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-pedidos.edit',$detallePedido->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallePedidos->links() !!}
            </div>
        </div>
    </div>
@endsection
