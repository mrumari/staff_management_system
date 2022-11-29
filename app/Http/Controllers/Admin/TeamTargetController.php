<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Team;
use App\Models\TeamTarget;
use App\Models\TeamUser;
use App\Models\TeamUserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;

class TeamTargetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$data=User::where('user_type',2)->where('parent_id',auth()->user()->id)->with('department')->get();
            $data=TeamTarget::where('parent_department_id',auth()->user()->department_id)->with('department')->with('team')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' class='delete_check' id='delcheck_".$row->id."' onclick='checkcheckbox();' value='".$row->id."'>";
                })
                ->addColumn('status', function ($row) {
                    $currentStatus = $row->status ? 'Enabled':'Disabled';
                    $id= $row->id;
                    $checked='';
                    if($currentStatus=='Enabled'){
                       $newStatus = 0;
                        $checked ='checked';
                    }else{
                        $newStatus = 1;
                    }

                    $x = '<input  class="switchery js-check-click" data-id="'.$id.'" data-status="'.$newStatus.'" type="checkbox"  '.$checked.'  />';
                    return $x;

                })
                ->addColumn('department_name', function ($row) {
                    return $row->department->name;
                })
                ->addColumn('team_name', function ($row) {
                    return $row->team->name;
                })
//                ->addColumn('action', function($row){
//                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
//                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    return $btn;
//                })
                ->addColumn('action', function ($row) {
                    $x= '<table><tr><td><a href="'.route('admin.team-targets.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                    // return $btn;
                    $x = $x.'<td>
                    <form action="'.route('admin.team-targets.destroy',$row->id).'" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="btn btn-sm ml-3 btn-danger"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')"><i class="la la-trash"></i></button>
                    </form>
                </td></tr></table>';
                    return $x;
                })
                // ->rawColumns(['action'])

                ->rawColumns(['checkbox','status','action'])
                ->make(true);
        }
        return view('admin.team_targets.index');
    }

    public function create()
    {
        $teams= Team::where('parent_department_id',auth()->user()->department_id)->get();
        return view('admin.team_targets.create',compact('teams'));
    }

    public function store(Request $request)
    {

        // dd($request->all());


        $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
            /// 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

//        echo '<pre>';
//        print_r($request->users);
//        die;


        $timestamp = strtotime($request->start_date);
        $start_date = date("Y-m-d", $timestamp);

        $timestamp = strtotime($request->end_date);
        $end_date = date("Y-m-d", $timestamp);

        $teamTarget = new TeamTarget();
        $teamTarget->name = $request->name;
        $teamTarget->description = $request->description;

        $teamTarget->start_date = $start_date;
        $teamTarget->end_date = $end_date;
        $teamTarget->amount = $request->amount;

        $teamTarget->team_id = $request->team_id;

         $team = Team::findOrFail($request->team_id);
        $teamTarget->department_id = $team->department_id;
        $teamTarget->parent_department_id = auth()->user()->department_id;
        $teamTarget->created_by = auth()->user()->id;
        $teamTarget->save();

        return redirect()->route('admin.team-targets.index')
            ->with('success','Team target has been created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $teams= Team::where('parent_department_id',auth()->user()->department_id)->get();
        $teamTarget = TeamTarget::findOrFail($id);//->with('teamUserRole');

       // print_r($team->teamUsers);
       // die();

        return view('admin.team_targets.edit',compact('teamTarget','teams'));
    }

    public function update(Request $request, $id)
    {
        $teamTarget = TeamTarget::findOrFail($id);
        $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
           // 'email' => ['required','min:5','max:191','email','unique:users,email,'.$user->id],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        //$team = new Team();
        $teamTarget->name = $request->name;
        $teamTarget->description = $request->description;
        $teamTarget->start_date = $request->start_date;
        $teamTarget->end_date = $request->end_date;
        $teamTarget->amount = $request->amount;
        $teamTarget->status = $request->status;
        $teamTarget->team_id = $request->team_id;
        $teamTarget->save();
        return redirect()->route('admin.team-targets.index')
            ->with('success','Team target has been updated successfully');
    }

    public function destroy($id)
    {
        $teamTarget = TeamTarget::findOrFail($id);
        $teamTarget->delete();
        return redirect()->route('admin.team-targets.index')
            ->with('success','Team target has been deleted successfully');
    }

    public function deleteAll(Request $request){
        $ids = $request->deleteids_arr;
        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
        if(TeamTarget::whereIn('id',$ids)->delete()) {
            return response()->json(['success' => "Team target(s) deleted successfully."]);
        }else{
            return response()->json(['success' => "Team target(s) have not been deleted successfully."]);
        }
    }


    public function changeStatus(Request $request)
    {
        $teamTarget = TeamTarget::findOrFail($request->id);
        $teamTarget->status = $request->status;
        if($teamTarget->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "Team target status have been changed successfully"
                ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "Team target status have not been changed due to internel error"
                ]);
        }
    }

}

