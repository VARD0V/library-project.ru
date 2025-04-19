<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;
    public $timestamps = false; // Отключаем временные метки

    protected $fillable = [
        'login', 'password', 'email', 'birthday', 'avatar_url', 'role_id',
    ];
    protected $hidden = [
        'password', 'api_token',
    ];
    // Списки полей для скрытия
    protected function casts(): array{
        return [
            'password' => 'hashed'
        ];
    }
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
