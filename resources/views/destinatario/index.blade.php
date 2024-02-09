@extends('layouts.app')

@section('template_title')
    Destinatario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Destinatario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('destinatarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Id Cliente</th>
										<th>Id Producto</th>
										<th>Cantidad</th>
										<th>Fecha Entrega</th>
										<th>Talla</th>
										<th>Obs</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($destinatarios as $destinatario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $destinatario->id_pedido }}</td>
											<td>{{ $destinatario->cliente->nombre }}</td>
											<td>{{ $destinatario->producto->nombre }}</td>
											<td>{{ $destinatario->cantidad }}</td>
											<td>{{ $destinatario->fecha_Entrega }}</td>
											<td>{{ $destinatario->talla }}</td>
											<td>{{ $destinatario->obs }}</td>

                                            <td>
                                                <form action="{{ route('destinatarios.destroy',$destinatario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('destinatarios.show',$destinatario->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('destinatarios.edit',$destinatario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $destinatarios->links() !!}
            </div>
        </div>
    </div>
@endsection
