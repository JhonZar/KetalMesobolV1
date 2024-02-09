<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $id_rol
 * @property $ci
 * @property $nombre
 * @property $fecha_nac
 * @property $telefono
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @property Role $role
 * @property Usuario[] $usuarios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    static $rules = [
		'id_rol' => 'required',
		'ci' => 'required',
		'nombre' => 'required',
		'telefono' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_rol','ci','nombre','fecha_nac','telefono','email'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'id_rol');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario', 'id_empleado', 'id');
    }
    

}
