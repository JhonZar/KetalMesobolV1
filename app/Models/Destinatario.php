<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Destinatario
 *
 * @property $id
 * @property $id_pedido
 * @property $id_cliente
 * @property $id_producto
 * @property $cantidad
 * @property $fecha_Entrega
 * @property $talla
 * @property $obs
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Pedido $pedido
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Destinatario extends Model
{
    
    static $rules = [
		'id_pedido' => 'required',
		'id_cliente' => 'required',
		'id_producto' => 'required',
		'cantidad' => 'required',
		'fecha_Entrega' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_pedido','id_cliente','id_producto','cantidad','fecha_Entrega','talla','obs'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_cliente');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'id_pedido');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'id_producto');
    }
    

}
