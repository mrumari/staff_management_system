<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class);
    }
}
