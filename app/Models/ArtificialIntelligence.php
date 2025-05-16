<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ArtificialIntelligence extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'paid', 'trial', 'link', 'description'
    ];
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'ai_tasks', 'ai_id', 'task_id');
    }
    public function transformations()
    {
        return $this->belongsToMany(Transformation::class, 'ai_transformations', 'ai_id', 'transformation_id');
    }
}
