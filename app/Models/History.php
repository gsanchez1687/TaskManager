<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'tasks_users_id',
        'statu_id',
        'observation',
    ];

    //relaciones

    public function taskuser()
    {
        return $this->belongsTo(TaskUser::class);
    }

    public function statu()
    {
        return $this->belongsTo(Status::class);
    }
}
