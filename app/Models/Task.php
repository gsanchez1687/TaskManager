<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'credit_for_task',
        'credit_paid',
        'expiration_date',
        'hours_passed',
        'statu_id',
    ];

    //relaciones
    public function statu()
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
