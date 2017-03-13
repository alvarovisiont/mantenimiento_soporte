<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table='usuario';

    protected $primaryKey='id_user';

    public $timestamp=false;

    protected $fillable = [
    'usuario',
    'password',
    'nivel'];

    protected $guarded = [];
}

