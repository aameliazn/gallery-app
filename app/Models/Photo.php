<?php

namespace App\Models;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $fillable = [
        'name',
        'desc',
        'path',
        'albumId',
        'userId',
    ];

    public function albums()
    {
        return $this->belongsTo(Album::class, 'albumId');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
