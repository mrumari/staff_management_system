<?php

namespace App\Http\Controllers\Admin;

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



//    public function index(Request $request)
//    {
//        if ($request->ajax()) {
//            //$data=User::where('user_type',2)->where('parent_id',auth()->user()->id)->with('department')->get();
//            $data=Lead::where('parent_department_id',auth()->user()->department_id)->get();
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
//                    return $x;
//
//                })
////                ->addColumn('action', function($row){
////                    $btn = '<a href="'.route('departments.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a>';
////                    $btn = $btn.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
////                    return $btn;
////                })
//                ->addColumn('action', function ($row) {
//                    $x= '<table><tr><td><a href="'.route('admin.leads.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
//                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
//                    // return $btn;
//                    $x = $x.'<td>
//                    <form action="'.route('admin.leads.destroy',$row->id).'" method="POST">
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
//        return view('admin.leads.index');
//    }

//    public function create()
//    {
//        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
//        $leadTypes= LeadType::all();
//        return view('admin.leads.create',compact('departments','leadTypes'));
//    }
//
//    public function store(Request $request)
//    {
//
//        // dd($request->all());
//
//
//        $request->validate([
//            'department_id' => 'required',
//            'client_name' => ['required', 'string', 'max:255'],
//            'client_contact_number' => ['required', 'string', 'max:255'],
//            'client_email' => ['required', 'string', 'email', 'max:255'],
//            'lead_url' => ['required', 'string', 'max:255'],
//            'lead_proposal' => ['required', 'string'],
//            'lead_type_id' => 'required',
//            'lead_type_category_id' => 'required',
//        ]);
//
////        echo '<pre>';
////        print_r($request->users);
////        die;
//
//        $lead = new Lead();
//        $lead->client_name = $request->client_name;
//        $lead->client_contact_number = $request->client_contact_number;
//        $lead->client_email = $request->client_email;
//        $lead->lead_url = $request->lead_url;
//        $lead->lead_proposal = $request->lead_proposal;
//        $lead->lead_type_id = $request->lead_type_id;
//        $lead->lead_type_category_id= $request->lead_type_category_id;
//        $lead->department_id = $request->department_id;
//        $lead->parent_department_id = auth()->user()->department_id;
//        $lead->created_by = auth()->user()->id;
//        $lead->save();
//
//        return redirect()->route('admin.leads.index')
//            ->with('success','Lead has been created successfully.');
//    }
//
//    public function show(User $user)
//    {
//        return view('users.show',compact('user'));
//    }
//
//    public function edit($id)
//    {
//        $lead = Lead::findOrFail($id);//->with('teamUserRole');
//        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
//        $leadTypes= LeadType::all();
//        $leadTypeCategories= LeadTypeCategory::where('lead_type_id',$lead->lead_type_id)->get();
//
//
//       // print_r($team->teamUsers);
//       // die();
//
//        return view('admin.leads.edit',compact('lead','departments','leadTypes','leadTypeCategories'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $lead = Lead::findOrFail($id);
//        $request->validate([
//            'department_id' => 'required',
//            'client_name' => ['required', 'string', 'max:255'],
//            'client_contact_number' => ['required', 'string', 'max:255'],
//            'client_email' => ['required', 'string', 'email', 'max:255'],
//            'lead_url' => ['required', 'string', 'max:255'],
//            'lead_proposal' => ['required', 'string'],
//            'lead_type_id' => 'required',
//            'lead_type_category_id' => 'required',
//            'status' => 'required',
//        ]);
//
//        $lead->client_name = $request->client_name;
//        $lead->client_contact_number = $request->client_contact_number;
//        $lead->client_email = $request->client_email;
//        $lead->lead_url = $request->lead_url;
//        $lead->lead_proposal = $request->lead_proposal;
//        $lead->lead_type_id = $request->lead_type_id;
//        $lead->lead_type_category_id= $request->lead_type_category_id;
//        $lead->department_id = $request->department_id;
//        $lead->parent_department_id = auth()->user()->department_id;
//        $lead->created_by = auth()->user()->id;
//        $lead->status = $request->status;
//        $lead->save();
//
//        return redirect()->route('admin.leads.index')
//            ->with('success','Lead has been updated successfully');
//    }
//
//    public function destroy($id)
//    {
//        $lead = Lead::findOrFail($id);
//        $lead->delete();
//        return redirect()->route('admin.leads.index')
//            ->with('success','Lead has been deleted successfully');
//    }
//
//    public function deleteAll(Request $request){
//        $ids = $request->deleteids_arr;
//        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
//        if(Lead::whereIn('id',$ids)->delete()) {
//            return response()->json(['success' => "Leads deleted successfully."]);
//        }else{
//            return response()->json(['success' => "Leads have not been deleted successfully."]);
//        }
//    }
//
//
//    public function changeStatus(Request $request)
//    {
//        $lead = Lead::findOrFail($request->id);
//        $lead->status = $request->status;
//        if($lead->save()) {
//            return response()->json([
//                'flag'=>true,
//                'msg' => "Lead status have been changed successfully"
//                ]);
//        }else{
//            return response()->json([
//                'flag'=>false,
//                'msg' => "Lead status have not been changed due to internel error"
//                ]);
//        }
//    }
//
////    public function autocompleteSearch(Request $request)
////    {
////        $query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;
////
////        $status = true;
////        $query = $request->get('q');
////        $filterResult = Lead::where('email', 'LIKE', '%'.$query.'%')->get();
////
////
////        $data=[];
////        foreach ($filterResult as  $item){
////            $data[]=[
////                'id'=>$item->id,
////                 'email'=>$item->email
////            ];
////        }
////
////        header('Content-Type: application/json');
////
////        echo json_encode(array(
////            "status" => $status,
////            "error"  => null,
////            "data"   => array(
////                "email"      => $data
////            )
////        ));
////    }
//
//    public function getLeadTypeCategoriesByLeadTypeId(Request $request)
//    {
//        $lead_type_id = $request->lead_type_id;
//        return LeadTypeCategory::where('lead_type_id', $lead_type_id)->pluck('name', 'id');
//    }
}

