<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $fillable = ['nombre'];

    public function atenciones()
    {
        return $this->hasMany(Atencion::class);
    }
}
