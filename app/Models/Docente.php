<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = ['user_id', 'apellidos', 'nombres'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atenciones()
    {
        return $this->hasMany(Atencion::class);
    }
}
