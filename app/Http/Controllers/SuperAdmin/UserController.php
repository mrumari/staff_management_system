<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
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
//        if ($request->ajax()) {
//            $data=User::where('user_type',1)->with('department')->get();
//
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('checkbox', function ($row) {
//                    return "<input type='checkbox' class='delete_check' id='delcheck_".$row->id."' onclick='checkcheckbox();' value='".$row->id."'>";
//                })
//                ->addColumn('status', function ($row) {
//                    $currentStatus = $row->status ? 'Enabled':'Disabled';
//                    $id= $row->id;
//                    $checked='';
//                    if($currentStatus=='Enabled'){
//                       $newStatus = 0;
//                        $checked ='checked';
//                    }else{
//                        $newStatus = 1;
//                    }
//
//                    $x = '<input  class="switchery js-check-click" data-id="'.$id.'" data-status="'.$newStatus.'" type="checkbox"  '.$checked.'  />';
//
//
////                    $x = '<div class="btn-group mr-1 mb-1">';
////                    $x =$x.'<button type="button" class="btn btn-outline-primary">'.$currentStatus.'</button>';
////                    $x =$x.'<button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
////                    $x =$x.'<span class="sr-only">Toggle Dropdown</span>';
////                    $x =$x.'</button>';
////                    $x =$x.'<div class="dropdown-menu">';
////                    $x =$x.'<a class="dropdown-item" onclick="change_status_by_id('.$id.','.$newStatus.')">'.$newStatusValue.'</a>';
////                    $x =$x.'<a class="dropdown-item" href="#">Another action</a>';
////                    $x =$x.'<a class="dropdown-item" href="#">Something else here</a>';
////                    $x =$x.'</div>';
////                    $x =$x.'</div>';
//                    return $x;
//
//                })
//                ->addColumn('department_name', function ($row) {
//                    return $row->department->name;
//                })
////                ->addColumn('action', function($row){
////                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
////                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
////                    return $btn;
////                })
//                ->addColumn('action', function ($row) {
//                    $x= '<table><tr><td><a href="'.route('super-admin.users.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
//                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    // return $btn;
//                    $x = $x.'<td>
//                    <form action="'.route('super-admin.users.destroy',$row->id).'" method="POST">
//                    '.csrf_field().'
//                    '.method_field("DELETE").'
//                    <button type="submit" class="btn btn-sm ml-3 btn-danger"
//                        onclick="return confirm(\'Are You Sure Want to Delete?\')"><i class="la la-trash"></i></button>
//                    </form>
//                </td></tr></table>';
//                    return $x;
//                })
//                // ->rawColumns(['action'])
//
//                ->rawColumns(['checkbox','status','action'])
//                ->make(true);
//        }

        if ($request->ajax()) {
            $data=User::where('user_type',1)->with('department')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' class='delete_check' id='delcheck_".$row->id."' onclick='checkcheckbox();' value='".$row->id."'>";
                })
                ->addColumn('status', function ($row) {
                    $currentStatus = $row->status ? 'Enabled':'Disabled';
                    return $currentStatus;
//                    $id= $row->id;
//                    $checked='';
//                    if($currentStatus=='Enabled'){
//                        $newStatus = 0;
//                        $checked ='checked';
//                    }else{
//                        $newStatus = 1;
//                    }
//
//                    $x = '<input  class="switchery js-check-click" data-id="'.$id.'" data-status="'.$newStatus.'" type="checkbox"  '.$checked.'  />';
//                    return $x;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');// $row->created_at->format('jS F Y h:i:s A');
                })



//                ->addColumn('action', function($row){
//                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
//                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    return $btn;
//                })
                ->addColumn('action', function ($row) {
                    $currentStatus = $row->status ? 'Enabled':'Disabled';
                    $id= $row->id;
                    $checked='';
                    if($currentStatus=='Enabled'){
                        $newStatus = 0;
                        $checked ='checked';
                    }else{
                        $newStatus = 1;
                    }

                    $x = '<table style="border: none;"><tr><td style="border: none; padding: 0px; padding-top: 7px;
padding-right: 10px;">
                            <span style="margin-top: 10px" data-toggle="tooltip" data-placement="top" data-original-title="Change Status"><input type="checkbox" data-toggle="toggle" data-style="ios" data-onstyle="info" data-offstyle="warning" class="switchery js-check-click" data-id="'.$id.'" data-status="'.$newStatus.'" type="checkbox"  '.$checked.'>
                            </span>
                            </td>';

                    $x= $x.'<td style="border: none; padding: 0px">

                            <a href="'.route('super-admin.users.show',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="View Detail">
                            <div class="col-md-1 fonticon-container">
                                   <div class="fonticon-wrap icon-shadow icon-shadow-primary"><i class="la la-eye"></i></div>
                            </div>
                            </a>
                            </td>';
                    $x= $x.'<td style="border: none; padding: 0px">
                            <a href="'.route('super-admin.users.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Edit Record">
                             <div class="col-md-1 fonticon-container">
                                   <div class="fonticon-wrap icon-shadow icon-shadow-primary"><i class="la la-edit"></i></div>
                            </div>
                             </a>
                             </td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                    // return $btn;



                    $x = $x.'<td style="border: none;  padding: 0px">
                    <form action="'.route('super-admin.users.destroy',$row->id).'" method="POST" data-toggle="tooltip" data-placement="top" data-original-title="Delete Record">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="button"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')">
                         <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                   <div class="fonticon-wrap icon-shadow icon-shadow-primary"><i class="la la-trash"></i></div>
                            </div>
                       </button>
                    </form>
                </td></tr></table>';
                    return $x;
                })
                // ->rawColumns(['action'])

                ->rawColumns(['checkbox','status','action'])
                ->make(true);
        }




        return view('super_admin.users.index');
    }

    public function create()
    {
        $companies= Company::all();
        $departments= [];
        return view('super_admin.users.create',compact('companies','departments'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'company_id' => 'required',
            'department_id' => 'required',
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = new User();
        $user->company_id = $request->company_id;
        $user->department_id = $request->department_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->created_by = auth()->user()->id;
        $user->save();
        return redirect()->route('super-admin.users.index')
            ->with('success','User has been created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('super_admin.users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies= Company::all();
        $departments= Department::where('company_id',$user->company_id)->get();
        return view('super_admin.users.edit',compact('user','companies','departments'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'company_id' => 'required',
            'department_id' => 'required',
            'name' => 'required',
            'email' => ['required','min:5','max:191','email','unique:users,email,'.$user->id],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $user->company_id = $request->company_id;
        $user->department_id = $request->department_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        return redirect()->route('super-admin.users.index')
            ->with('success','User has been updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('super-admin.users.index')
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


    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;

        $status = 'Disabled';
        if ($request->status){
            $status = 'Enabled';
        }

        if($user->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "User status have been changed to ".$status
                ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "User status have not been changed due to internel error"
                ]);
        }
    }

    public function getDepartmentByCompanyId(Request $request)
    {
        $company_id = $request->company_id;
        return Department::where('company_id', $company_id)->pluck('name', 'id');
    }
}

