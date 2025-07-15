<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'text',
        'id_user',
        'imagem'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

   public function comments()
  {
    return $this->hasMany(CommentsPost::class, 'id_post');
  }  

}
