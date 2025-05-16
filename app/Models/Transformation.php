<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transformation extends Model
{
    protected $fillable = [
        'name', 'code'
    ];
    // Связь с искусственным интеллектом через промежуточную таблицу ai_transformations
    public function artificialIntelligences()
    {
        return $this->belongsToMany(ArtificialIntelligence::class, 'ai_transformations', 'transformation_id', 'ai_id');
    }
}
