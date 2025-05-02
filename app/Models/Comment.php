<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    public $timestamps = false; // Отключаем временные метки

    protected $fillable = [
        'text', 'user_id', 'discussion_id', 'article_id',
    ];
    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Связь с обсуждением
    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id')->nullable();
    }
    // Связь со статьей
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id')->nullable();
    }
}
