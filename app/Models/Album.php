<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    protected $fillable = [
        'name',
        'desc',
        'userId',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'albumId');
    }
}
