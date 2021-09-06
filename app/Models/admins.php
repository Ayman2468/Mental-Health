<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\problems;

class admins extends Model
{
    use HasFactory;
    protected $table = "admins";
    protected $fillable = ['name_ar', 'name_en', 'email', 'password', 'college', 'division', 'mobile', 'position'];
    public $timestamps = false;
    public function problems()
    {
        return $this->hasMany(problems::class, 'admin_id', 'id');
    }
}
