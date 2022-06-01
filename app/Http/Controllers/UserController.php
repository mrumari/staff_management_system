<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=User::where('user_type',1)->with('department')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' class='delete_check' id='delcheck_".$row->id."' onclick='checkcheckbox();' value='".$row->id."'>";
                })
                ->addColumn('status', function ($row) {
                    return $row->status ? 'Enabled':'Disabled';
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
                    $x= '<table><tr><td><a href="'.route('users.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                    // return $btn;
                    $x = $x.'<td>
                    <form action="'.route('users.destroy',$row->id).'" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="btn btn-sm ml-3 btn-danger"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')"><i class="la la-trash"></i></button>
                    </form>
                </td></tr></table>';
                    return $x;
                })
                // ->rawColumns(['action'])

                ->rawColumns(['checkbox','action'])
                ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        $departments= Department::all();
        return view('users.create',compact('departments'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User();
        $user->department_id = $request->department_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->created_by = auth()->user()->id;
        $user->save();
        return redirect()->route('users.index')
            ->with('success','User has been created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $departments= Department::all();
        $user = User::findOrFail($id);
        return view('users.edit',compact('user','departments'));
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
        return redirect()->route('users.index')
            ->with('success','User has been updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('success','User has been deleted successfully');
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
}

