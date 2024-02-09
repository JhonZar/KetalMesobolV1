<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallePedido
 *
 * @property $id
 * @property $id_pedido
 * @property $id_producto
 * @property $cantidad
 * @property $precion_unitario
 * @property $created_at
 * @property $updated_at
 *
 * @property Destinatario[] $destinatarios
 * @property Pedido $pedido
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetallePedido extends Model
{
    
    static $rules = [
		'id_pedido' => 'required',
		'id_producto' => 'required',
		'cantidad' => 'required',
		'precion_unitario' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_pedido','id_producto','cantidad','precion_unitario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany('App\Models\Destinatario', 'id_detalle_pedido', 'id');
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
