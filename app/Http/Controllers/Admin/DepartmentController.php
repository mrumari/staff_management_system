<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Department::where('parent_id',auth()->user()->department_id)->get();
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
//                ->addColumn('action', function($row){
//                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
//                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    return $btn;
//                })
                ->addColumn('action', function ($row) {
                    $x= '<table><tr><td><a href="'.route('admin.departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                   // return $btn;
                    $x = $x.'<td>
                    <form action="'.route('admin.departments.destroy',$row->id).'" method="POST">
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
        return view('admin.departments.index');
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $company = new Department();
        $company->name = $request->name;
        $company->description = $request->description;
        $company->parent_id = auth()->user()->department_id;
        $company->created_by = auth()->user()->id;
        $company->save();
        return redirect()->route('admin.departments.index')
            ->with('success','Department has been created successfully.');
    }

    public function show(Department $company)
    {
        return view('admin.departments.show',compact('company'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit',compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->description = $request->description;
        $department->status = $request->status;
        $department->save();
        return redirect()->route('admin.departments.index')
            ->with('success','Department has been updated successfully');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('admin.departments.index')
            ->with('success','Department has been deleted successfully');
    }

    public function deleteAll(Request $request){
        $ids = $request->deleteids_arr;
        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
        if(Department::whereIn('id',$ids)->delete()) {
            return response()->json(['success' => "Departments Deleted successfully."]);
        }else{
            return response()->json(['success' => "Departments have not been Deleted successfully."]);
        }
    }

    public function changeStatus(Request $request)
    {
        $department = Department::findOrFail($request->id);
        $department->status = $request->status;
        if($department->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "User status have been changed successfully"
            ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "User status have not been changed due to internel error"
            ]);
        }
    }
}
