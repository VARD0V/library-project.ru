<?php
// app/Models/Discussion.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Discussion extends Model
{
    protected $fillable = [
        'text', 'title', 'description', 'preview', 'discussion_category_id', 'author_id',
    ];
    // Связь с категорией обсуждения
    public function discussionCategory()
    {
        return $this->belongsTo(DiscussionCategory::class, 'discussion_category_id');
    }
    // Связь с автором (пользователем)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    // Связь с комментариями
    public function comments()
    {
        return $this->hasMany(Comment::class, 'discussion_id');
    }
}
