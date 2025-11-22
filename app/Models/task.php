<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //
    use HasFactory;

    protected $table = 'task';
    protected $fillable = ['lists_id', 'deskripsi', 'is_completed', 'due_date', 'assigned_user_id'];

    // relasi ke list
    public function list()
    {
        return $this->belongsTo(lists::class, 'lists_id');
    }
}
