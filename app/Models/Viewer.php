<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Viewer extends Authenticatable
{
    protected $fillable = [
        'email','name','email_hash','name_hash'
    ];

    protected $hidden = [
        'email_hash','name_hash'
    ];

    public function setNameAttribute($value)
    {
        $value = ucfirst(strtolower($value));
        $this->attributes['name'] = Crypt::encryptString($value);
        $this->attributes['name_hash'] = hash('sha256', $value);
    }

    public function getNameAttribute($value)
    {
        return ucwords(Crypt::decryptString($value));
    }


    public function setEmailAttribute($value)
    {
        $email = strtolower($value);
        $this->attributes['email'] = Crypt::encryptString($email);
        $this->attributes['email_hash'] = hash('sha256', $email);
    }

    public function getEmailAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function folders()
    {
        return $this->hasMany('App\Models\ViewerFolder', 'viewer_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

}
