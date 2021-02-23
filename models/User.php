<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "estado",
        "avatar",
        "rol"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password", "remember_token",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function avatar()
    {
        if ($this->avatar != null) {
            return "<img src=".asset("img")."/users/".$this->avatar.">";
        }else {
            $Rand = "#".str_pad(dechex(Rand(0x000000, 0x989898)), 6, 0, STR_PAD_LEFT);
            return  "<span style=background-color:".$Rand.">".substr($this->name, 0, 1)."</span>";
        }
    }
}