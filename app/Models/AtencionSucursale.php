<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtencionSucursale
 *
 * @property $id
 * @property $id_usuario
 * @property $id_sucursal
 * @property $fechaInicio
 * @property $fechaFin
 * @property $created_at
 * @property $updated_at
 *
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AtencionSucursale extends Model
{
    
    static $rules = [
		'id_usuario' => 'required',
		'id_sucursal' => 'required',
		'fechaInicio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_usuario','id_sucursal','fechaInicio','fechaFin'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sucursale()
    {
        return $this->hasOne('App\Models\Sucursale', 'id', 'id_sucursal');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'id_usuario');
    }
    

}
