<?php

namespace App\Models;

use App\Models\Album;
use App\Models\User;
use App\Models\Comment;
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

    public function album()
    {
        return $this->belongsTo(Album::class, 'albumId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'photoId', 'id');
    }

    public function isFavoritedByUser(User $user)
    {
        return $this->favorites->where('userId', $user->id)->count() > 0;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'photoId');
    }
}
