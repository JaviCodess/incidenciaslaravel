<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use User;
use Illuminate\Database\Eloquent\Model;
class Incidencia extends Model
{

    use Notifiable;
    //
    protected $table='incidencia';
    protected $fillable=['fecha','aula','hora','codigo_equipo','codigo_incidencia','informacion'];
    public function profesor(){
        return $this->belongsTo(User::class);
    }
}
