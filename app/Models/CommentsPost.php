<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentsPost extends Model
{
    use HasFactory;


    protected $table = 'commentsposts';
    
    protected $fillable = [
        'id',
        'text',
        'id_user',
        'id_post'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function post()
    {
        return $this->belongsTo(posts::class, 'id_post');
    }
}
