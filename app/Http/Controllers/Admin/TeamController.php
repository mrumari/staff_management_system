<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Team;
use App\Models\TeamUserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$data=User::where('user_type',2)->where('parent_id',auth()->user()->id)->with('department')->get();
            $data=Team::where('parent_department_id',auth()->user()->department_id)->with('department')->get();
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


//                    $x = '<div class="btn-group mr-1 mb-1">';
//                    $x =$x.'<button type="button" class="btn btn-outline-primary">'.$currentStatus.'</button>';
//                    $x =$x.'<button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
//                    $x =$x.'<span class="sr-only">Toggle Dropdown</span>';
//                    $x =$x.'</button>';
//                    $x =$x.'<div class="dropdown-menu">';
//                    $x =$x.'<a class="dropdown-item" onclick="change_status_by_id('.$id.','.$newStatus.')">'.$newStatusValue.'</a>';
//                    $x =$x.'<a class="dropdown-item" href="#">Another action</a>';
//                    $x =$x.'<a class="dropdown-item" href="#">Something else here</a>';
//                    $x =$x.'</div>';
//                    $x =$x.'</div>';
                    return $x;

                })
                ->addColumn('department_name', function ($row) {
                    return $row->department->name;
                })
//                ->addColumn('action', function($row){
//                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
//                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    return $btn;
//                })
                ->addColumn('action', function ($row) {
                    $x= '<table><tr><td><a href="'.route('admin.teams.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                    // return $btn;
                    $x = $x.'<td>
                    <form action="'.route('admin.teams.destroy',$row->id).'" method="POST">
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
        return view('admin.teams.index');
    }

    public function create()
    {
        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
        return view('admin.teams.create',compact('departments'));
    }

    public function store(Request $request)
    {

        // dd($request->all());


        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            /// 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

//        echo '<pre>';
//        print_r($request->users);
//        die;

        $team = new Team();
        $team->name = $request->name;
        $team->description = $request->description;
        $team->department_id = $request->department_id;
        $team->parent_department_id = auth()->user()->department_id;
        $team->created_by = auth()->user()->id;
        $team->save();

        foreach ($request->users as $userRaw){
            $user =User::where('email',$userRaw['email'])->first();
            if (!$user) {
                $user = new User();
                $user->department_id = $request->department_id;
                $user->name = $userRaw['full_name'];
                $user->email = $userRaw['email'];
                $user->password = Hash::make($userRaw['password']);
                $user->user_type = 2;
                $user->parent_id = auth()->user()->id;
                $user->parent_department_id = auth()->user()->department_id;
                $user->created_by = auth()->user()->id;
                $user->save();

                $teamUserRole = new TeamUserRole();
                $teamUserRole->team_id = $team->id;
                $teamUserRole->user_id = $user->id;
                $teamUserRole->role = $userRaw['role'];
                $teamUserRole->save();

            }
        }

        return redirect()->route('admin.teams.index')
            ->with('success','Team has been created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
        $user = User::findOrFail($id);
        return view('admin.teams.edit',compact('user','departments'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            'email' => ['required','min:5','max:191','email','unique:users,email,'.$user->id],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user->department_id = $request->department_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        return redirect()->route('admin.teams.index')
            ->with('success','Team has been updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.teams.index')
            ->with('success','Team has been deleted successfully');
    }

    public function deleteAll(Request $request){
        $ids = $request->deleteids_arr;
        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
        if(User::whereIn('id',$ids)->delete()) {
            return response()->json(['success' => "Users deleted successfully."]);
        }else{
            return response()->json(['success' => "Users have not been deleted successfully."]);
        }
    }


    public function changeStatus(Request $request)
    {
        $team = Team::findOrFail($request->id);
        $team->status = $request->status;
        if($team->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "Team status have been changed successfully"
                ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "User status have not been changed due to internel error"
                ]);
        }
    }

    public function autocompleteSearch(Request $request)
    {
        $query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;

//        if (!isset($query)) {
//            die('Invalid query.');
//        }
        //print_r($query);
       // print_r($request->get('q'));
       // die;

        $status = true;
        $query = $request->get('q');
        $filterResult = User::where('email', 'LIKE', '%'.$query.'%')->get();


        $data=[];
        foreach ($filterResult as  $item){
            $data[]=[
                'id'=>$item->id,
                 'email'=>$item->email
            ];
        }



//        return response()->json($filterResult);


        header('Content-Type: application/json');

        header('Content-Type: application/json');

        echo json_encode(array(
            "status" => $status,
            "error"  => null,
            "data"   => array(
                "email"      => $data
            )
        ));
    }
}

