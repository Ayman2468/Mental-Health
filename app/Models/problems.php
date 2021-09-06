<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class problems extends Model
{
    use HasFactory;
    protected $table = "problems";
    protected $fillable = ['title', 'content', 'answer', 'user', 'admin', 'user_id', 'admin_id', 'updated_at', 'created_at'];
    protected $hidden = ['created_at', 'updated_at'];
}
