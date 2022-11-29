<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=Company::all();
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

                            <a href="'.route('super-admin.companies.show',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="View Detail">
                            <div class="col-md-1 fonticon-container">
                                   <div class="fonticon-wrap icon-shadow icon-shadow-primary"><i class="la la-eye"></i></div>
                            </div>
                            </a>
                            </td>';
                    $x= $x.'<td style="border: none; padding: 0px">
                            <a href="'.route('super-admin.companies.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Edit Record">
                             <div class="col-md-1 fonticon-container">
                                   <div class="fonticon-wrap icon-shadow icon-shadow-primary"><i class="la la-edit"></i></div>
                            </div>
                             </a>
                             </td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                   // return $btn;



                    $x = $x.'<td style="border: none;  padding: 0px">
                    <form action="'.route('super-admin.companies.destroy',$row->id).'" method="POST" data-toggle="tooltip" data-placement="top" data-original-title="Delete Record">
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
        return view('super_admin.companies.index');
    }

    public function create()
    {
        return view('super_admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $company = new Company();
        $company->name = $request->name;
        $company->description = $request->description;
        $company->created_by = auth()->user()->id;
        $company->save();
        return redirect()->route('super-admin.companies.index')
            ->with('success','Company has been created successfully.');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('super_admin.companies.show',compact('company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('super_admin.companies.edit',compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->description = $request->description;
        $company->status = $request->status;
        $company->save();
        return redirect()->route('super-admin.companies.index')
            ->with('success','Department has been updated successfully');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('super-admin.companies.index')
            ->with('success','Company has been deleted successfully');
    }

    public function deleteAll(Request $request){
        $ids = $request->deleteids_arr;
        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
        if(Company::whereIn('id',$ids)->delete()) {
            return response()->json(['success' => "Companies Deleted successfully."]);
        }else{
            return response()->json(['success' => "Companies have not been Deleted successfully."]);
        }
    }

    public function changeStatus(Request $request)
    {
        $company = Company::findOrFail($request->id);

        $company->status = $request->status;
        $status = 'Disabled';
        if ($request->status){
            $status = 'Enabled';
        }
        if($company->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "Company status has been changed to ".$status
            ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "Company status have not been changed due to internel error"
            ]);
        }
    }
}
