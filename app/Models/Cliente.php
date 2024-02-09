<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $ci
 * @property $direccion
 * @property $telefono
 * @property $email
 * @property $pass
 * @property $created_at
 * @property $updated_at
 *
 * @property Destinatario[] $destinatarios
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'apellido' => 'required',
		'ci' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
		'email' => 'required',
		'pass' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','apellido','ci','direccion','telefono','email','pass'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany('App\Models\Destinatario', 'id_cliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'id_cliente', 'id');
    }
    

}
