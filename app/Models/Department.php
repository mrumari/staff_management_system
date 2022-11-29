<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function getChildDepartmentsByMainDepartmentId($mainDepartmentId){
        $childDepartments   = Department::where('parent_id',$mainDepartmentId)->where('status',1)->get();
        return $childDepartments;
    }

    public function getTeamsByChildDepartmentId($childDepartmentId){
        $childTeams   = Team::where('department_id',$childDepartmentId)->where('status',1)->get();
        return $childTeams;
    }

}
