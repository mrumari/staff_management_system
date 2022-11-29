<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Lead;
use App\Models\LeadType;
use App\Models\LeadTypeCategory;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\TeamUserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Traits\LeadTrait;

class LeadController extends Controller
{
    use LeadTrait;
}

