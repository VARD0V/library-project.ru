<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    protected $fillable = [
        'login', 'password', 'mail', 'birthday', 'avatar_url', 'role_id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    // Связь с ролью
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // Связь с обсуждениями (как автор)
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'author_id');
    }
    // Связь со статьями (как автор)
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }
    // Связь с комментариями (как автор)
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
