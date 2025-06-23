<?php
// app/Models/Discussion.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Article extends Model
{
    public $timestamps = false; // Отключаем временные метки
    protected $fillable = [
        'text', 'title', 'description', 'preview', 'article_category_id', 'author_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($article) {
            // Удаляем все комментарии перед удалением статьи
            $article->comments()->delete();
        });
    }
    // Связь с категорией статьи
    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }
    // Связь с автором (пользователем)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    // Связь с комментариями
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
}
