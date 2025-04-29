<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ArtificialIntelligence extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'paid', 'trial', 'conversion_from', 'conversion_to',
    ];
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'ai_tasks', 'ai_id', 'task_id');
    }
}
