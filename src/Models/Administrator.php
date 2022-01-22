<?php

namespace AngryMoustache\Rambo\Models;

use AngryMoustache\Media\Models\Attachment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar_id',
        'online',
    ];

    protected $guard = 'admin';

    public function avatar()
    {
        return $this->belongsTo(Attachment::class, 'avatar_id');
    }

    public function link()
    {
        return route('rambo.crud.show', [
            'id' => $this->id,
            'resource' => 'administrators',
        ]);
    }

    public function scopeOnline($query)
    {
        return $query->where('online', 1);
    }
}
