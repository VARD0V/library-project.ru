<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'code',
    ];
    // Связь с искусственным интеллектом через промежуточную таблицу ai_tasks
    public function artificialIntelligences()
    {
        return $this->belongsToMany(ArtificialIntelligence::class, 'ai_tasks', 'task_id', 'ai_id');
    }
}
