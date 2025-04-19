<?php
// app/Models/Discussion.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DiscussionCategory extends Model
{
    protected $fillable = [
        'name', 'code',
    ];
    // Связь с обсуждениями
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'discussion_category_id');
    }
}
