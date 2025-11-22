<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class lists extends Model
{
    use HasFactory;
    // kolom yang boleh diisi / dilindungi oleh laravel
    protected $table = 'lists';
    protected $fillable = ['user_id', 'title'];

    // Relasi
    public function user() 
    {
        return $this -> belongsTo(User::class);
    }

    public function task() 
    {
        return $this -> hasMany(task::class);
    }
}
