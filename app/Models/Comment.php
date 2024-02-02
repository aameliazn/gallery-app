<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'content',
        'photoId',
        'userId',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photoId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
