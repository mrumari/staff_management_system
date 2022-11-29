<?php


namespace App\Http\Traits;


use App\Models\Department;
use App\Models\Lead;
use App\Models\LeadAttachment;
use App\Models\LeadPaymentType;
use App\Models\LeadType;
use App\Models\LeadTypeCategory;
use App\Models\Meeting;
use App\Models\SetMeeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

trait LeadTrait
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$data=User::where('user_type',2)->where('parent_id',auth()->user()->id)->with('department')->get();
            if (auth()->user()->user_type==1) {
                $data = Lead::where('parent_department_id', auth()->user()->department_id)->get();
            }else{
                $data = Lead::where('department_id', auth()->user()->department_id)->get();
            }

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
                    $x= '<table><tr><td><a href="'.route('admin.leads.edit',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-edit"></i></a></td>';
                    $x= $x.'<td><a href="'.route('admin.leads.meeting',$row->id).'"  data-toggle="tooltip" data-placement="top" data-original-title="Set A Meeting" title="" class="btn btn-sm ml-3 btn-danger"><i class="la la-calendar-plus-o"></i></a></td>';
                    //$x = $x.'<a  href="'.route('departments.destroy',$row->id).'" onclick="return confirm(\'Are you sure?\')"  data-toggle="tooltip"  data-original-title="Delete" class="btn btn-sm ml-3 btn-danger"><i class="la la-trash"></i></a>';
                    // return $btn;
                    $x = $x.'<td>
                    <form action="'.route('admin.leads.destroy',$row->id).'" method="POST">
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
        if (auth()->user()->user_type==2) {
            return view('leads.index');
        }else{
            return view('admin.leads.index');
        }
    }

    public function create()
    {
        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
        $leadTypes= LeadType::all();
        $leadPaymentTypes = LeadPaymentType::all();
        if (auth()->user()->user_type==2) {
            return view('leads.create', compact('departments', 'leadTypes','leadPaymentTypes'));
        }else{
            return view('admin.leads.create', compact('departments', 'leadTypes','leadPaymentTypes'));
        }
    }

    public function store(Request $request)
    {






        $request->validate([
            //'department_id' => 'required',
            'client_name' => ['required', 'string', 'max:255'],
            'client_contact_number' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'string', 'email', 'max:255'],
            //'estimated_time_line' => ['required', 'dou', 'max:255'],
            'lead_url' => ['required', 'string', 'max:255'],
            'lead_proposal' => ['required', 'string'],
            'estimated_time_line' => 'required',
            'amount' => 'required',
            'lead_type_id' => 'required',
            'lead_payment_type_id' => 'required',
            'lead_type_category_id' => 'required',
            'lead_attachments.*' => 'required|image|mimes:jpeg,png,jpg,pdf',
        ]);

        $lead = new Lead();
        $lead->client_name = $request->client_name;
        $lead->client_contact_number = $request->client_contact_number;
        $lead->client_email = $request->client_email;
        $lead->client_skype_url = $request->client_skype_url;
        $lead->client_linkedin_url = $request->client_linkedin_url;
        $lead->lead_url = $request->lead_url;
        $lead->estimated_time_line = $request->estimated_time_line;
        $lead->amount = $request->amount;
        $lead->lead_proposal = $request->lead_proposal;
        $lead->lead_type_id = $request->lead_type_id;
        $lead->lead_type_category_id= $request->lead_type_category_id;
        $lead->lead_payment_type_id= $request->lead_payment_type_id;

        if (auth()->user()->user_type==2) {
            $lead->department_id = auth()->user()->department_id;
            $lead->parent_department_id = auth()->user()->parent_department_id;
        }else{
            $lead->department_id = $request->department_id;
            $lead->parent_department_id = auth()->user()->department_id;
        }

       // $lead->parent_department_id = auth()->user()->department_id;
        $lead->created_by = auth()->user()->id;
        $lead->save();



       // $leadAttachments = $request->file('lead_attachments');

        $leadAttachments = $request->file('lead_attachments');
//       echo '<pre>';
//       print_r($files);
//        die;


        if(isset($leadAttachments)) {
            foreach ( $leadAttachments as $leadAttachmentFile) {

                $fileName = time() .uniqid() .'.' .$leadAttachmentFile->getClientOriginalName();
                $fileType = $leadAttachmentFile->getClientMimeType();
                $fileSize = $leadAttachmentFile->getSize();
                $leadAttachmentFile->move(public_path('uploads'), $fileName);
                $leadAttachment = new LeadAttachment();
                $leadAttachment->lead_id = $lead->id;
                $leadAttachment->name = $fileName;
                $leadAttachment->url = 'uploads/'.$fileName;
                $leadAttachment->size = $fileSize;
                $leadAttachment->mime_type = $fileType;
                $leadAttachment->save();





//                $randomString = \Illuminate\Support\Str::random(32);
//                $filename = str_replace( ' ', '', 'public/images/products/' . time() . '-'.$randomString.'product-additional-image.' . $additional_image->getClientOriginalName() );
//                $location = app()->basePath( 'public/images/products/' );
//                $additional_image->move( $location, $filename );
//                $productImage = new ProductImage();
//                $productImage->product_id = $product->id;
//                $productImage->image = $filename;
//                $productImage->save();
            }
        }






        // define absolute folder path
       // $dest_folder = 'ABSOLUTE_FOLDER_PATH/';

//        if (!empty($_FILES)) {
//            // if dest folder doesen't exists, create it
//            //if(!file_exists($dest_folder) && !is_dir($dest_folder)) mkdir($dest_folder);
//
//            $files = $request->file('file');
//
//
//
//
//            foreach($files as $file) {
//
//                $fileName = time() .uniqid() .'.' .$file->getClientOriginalName();
//                $fileType = $file->getClientMimeType();
//                $fileSize = $file->getSize();
//                $file->move(public_path('uploads'), $fileName);
//                $leadAttachment = new LeadAttachment();
//                $leadAttachment->lead_id = $lead->id;
//                $leadAttachment->name = $fileName;
//                $leadAttachment->url = 'uploads/'.$fileName;
//                $leadAttachment->size = $fileSize;
//                $leadAttachment->mime_type = $fileType;
//                $leadAttachment->save();
//            }
//
//        }



        if (auth()->user()->user_type==2) {
            return redirect()->route('leads.index')->with('success', 'Lead has been created successfully.');
        }else{
            return redirect()->route('admin.leads.index')->with('success', 'Lead has been created successfully.');

        }
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);//->with('teamUserRole');
        $departments= Department::where('parent_id',auth()->user()->department_id)->get();
        $leadAttachments= LeadAttachment::where('lead_id',$id)->get();
//        $product_images=Product::join('product_images','products.id','=','product_images.product_id')
//            ->select('product_images.image','product_images.id')
//            ->where('products.id',$id)
//            ->get();


        $leadTypes= LeadType::all();
        $leadPaymentTypes = LeadPaymentType::all();
        $leadTypeCategories= LeadTypeCategory::where('lead_type_id',$lead->lead_type_id)->get();
        if (auth()->user()->user_type==2) {
            return view('leads.edit', compact('lead', 'departments', 'leadTypes', 'leadTypeCategories','leadPaymentTypes','leadAttachments'));
        }else{
            return view('admin.leads.edit', compact('lead', 'departments', 'leadTypes', 'leadTypeCategories','leadPaymentTypes','leadAttachments'));
        }
    }

    public function update(Request $request, $id)
    {

        $lead = Lead::findOrFail($id);
        $request->validate([
           // 'department_id' => 'required',
            'client_name' => ['required', 'string', 'max:255'],
            'client_contact_number' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'string', 'email', 'max:255'],
            'lead_url' => ['required', 'string', 'max:255'],
            'lead_proposal' => ['required', 'string'],
            'lead_type_id' => 'required',
            'lead_type_category_id' => 'required',
            'status' => 'required',
        ]);

        $lead->client_name = $request->client_name;
        $lead->client_contact_number = $request->client_contact_number;
        $lead->client_email = $request->client_email;
        $lead->client_skype_url = $request->client_skype_url;
        $lead->client_linkedin_url = $request->client_linkedin_url;
        $lead->lead_url = $request->lead_url;
        $lead->estimated_time_line = $request->estimated_time_line;
        $lead->amount = $request->amount;
        $lead->lead_proposal = $request->lead_proposal;
        $lead->lead_type_id = $request->lead_type_id;
        $lead->lead_type_category_id= $request->lead_type_category_id;
        $lead->lead_payment_type_id= $request->lead_payment_type_id;

        if (auth()->user()->user_type==2) {
            $lead->department_id = auth()->user()->department_id;
            $lead->parent_department_id = auth()->user()->parent_department_id;
        }else{
            $lead->department_id = $request->department_id;
            $lead->parent_department_id = auth()->user()->department_id;
        }

       // $lead->department_id = $request->department_id;
       // $lead->parent_department_id = auth()->user()->department_id;
        $lead->created_by = auth()->user()->id;
        $lead->status = $request->status;
        $lead->save();



        $leadAttachments = $request->file('lead_attachments');
//       echo '<pre>';
//       print_r($files);
//        die;


        if(isset($leadAttachments)) {
            foreach ( $leadAttachments as $leadAttachmentFile) {
                $fileName = time() .uniqid() .'.' .$leadAttachmentFile->getClientOriginalName();
                $fileType = $leadAttachmentFile->getClientMimeType();
                $fileSize = $leadAttachmentFile->getSize();
                $leadAttachmentFile->move(public_path('uploads'), $fileName);
                $leadAttachment = new LeadAttachment();
                $leadAttachment->lead_id = $lead->id;
                $leadAttachment->name = $fileName;
                $leadAttachment->url = 'uploads/'.$fileName;
                $leadAttachment->size = $fileSize;
                $leadAttachment->mime_type = $fileType;
                $leadAttachment->save();
            }
        }





        if (auth()->user()->user_type==2) {
            return redirect()->route('leads.index')->with('success', 'Lead has been updated successfully');
        }else{
            return redirect()->route('admin.leads.index')->with('success', 'Lead has been updated successfully');
        }
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        if (auth()->user()->user_type==2) {
            return redirect()->route('leads.index')->with('success', 'Lead has been deleted successfully');
        }else{
            return redirect()->route('admin.leads.index')->with('success', 'Lead has been deleted successfully');
        }
    }

    public function deleteAll(Request $request){
        $ids = $request->deleteids_arr;
        //DB::table("departments")->whereIn('id',explode(",",$ids))->delete();
        if(Lead::whereIn('id',$ids)->delete()) {
            return response()->json(['success' => "Leads deleted successfully."]);
        }else{
            return response()->json(['success' => "Leads have not been deleted successfully."]);
        }
    }


    public function changeStatus(Request $request)
    {
        $lead = Lead::findOrFail($request->id);
        $lead->status = $request->status;
        if($lead->save()) {
            return response()->json([
                'flag'=>true,
                'msg' => "Lead status have been changed successfully"
            ]);
        }else{
            return response()->json([
                'flag'=>false,
                'msg' => "Lead status have not been changed due to internel error"
            ]);
        }
    }

    public function getLeadTypeCategoriesByLeadTypeId(Request $request)
    {
        $lead_type_id = $request->lead_type_id;
        return LeadTypeCategory::where('lead_type_id', $lead_type_id)->pluck('name', 'id');
    }

    public function meeting($id)
    {
        $lead = Lead::findOrFail($id);//->with('teamUserRole');
        if (auth()->user()->user_type==2) {
            return view('leads.meeting', compact('lead'));
        }else{
            return view('admin.leads.meeting', compact('lead'));
        }
    }

    public function storeMeeting(Request $request, $id)
    {

        $request->validate([
            //'department_id' => 'required',
            'date' => ['required'],
            'time' => ['required'],
            'description' => ['required', 'string'],
        ]);

        $timestamp = strtotime($request->date);
        $date = date("Y-m-d", $timestamp);
        $time  = date("H:i", strtotime($request->time));

        $meeting = new Meeting();
        $meeting->lead_id= $id;
        $meeting->date = $date;
        $meeting->time = $time;
        $meeting->description = $request->description ;

        // $lead->parent_department_id = auth()->user()->department_id;
        $meeting->created_by = auth()->user()->id;
        $meeting->save();

        if (auth()->user()->user_type==2) {
            return redirect()->route('admin.leads.index')->with('success', 'Meetting has been created successfully.');
        }else{
            return redirect()->route('leads.index')->with('success', 'Meetting has been created successfully.');
        }
    }




    public function uploadLeadAttachments(Request $request){

        $leadAttachments = $request->file('lead_attachments');
//       echo '<pre>';
//       print_r($files);
//        die;


        if(isset($leadAttachments)) {
            foreach ( $leadAttachments as $leadAttachmentFile) {

                $fileName = time() .uniqid() .'.' .$leadAttachmentFile->getClientOriginalName();
                $fileType = $leadAttachmentFile->getClientMimeType();
                $fileSize = $leadAttachmentFile->getSize();
                $leadAttachmentFile->move(public_path('uploads'), $fileName);
                $leadAttachment = new LeadAttachment();
                $leadAttachment->lead_id =$request->lead_id;
                $leadAttachment->name = $fileName;
                $leadAttachment->url = 'public/uploads/'.$fileName;
                $leadAttachment->size = $fileSize;
                $leadAttachment->mime_type = $fileType;
                $leadAttachment->save();
            }
        }



//        $additional_images = $request->file('additional_images');
//        if(isset($additional_images)) {
//            foreach ( $additional_images as $additional_image ) {
//                $randomString = \Illuminate\Support\Str::random(32);
//                $filename = str_replace( ' ', '', 'public/images/products/'.time().'-'.$randomString.'product-additional-image.' . $additional_image->getClientOriginalName() );
//                $location = app()->basePath( 'public/images/products/' );
//                $additional_image->move( $location, $filename );
//                $productImage = new ProductImage();
//                $productImage->product_id = $request->product_id;
//                $productImage->image = $filename;
//                $productImage->save();
//            }
//        }


        // $imgName = request()->file->getClientOriginalName();
        //request()->file->move(public_path('images'), $imgName);
        return response()->json(['uploaded' => '/images/'.'jjj']);
    }
//    public function remove_product_image(Request $request){
//        $product=Product::findOrFail($request->key);
//        if ( ! empty( $product->product_image) ) {
//            File::delete( public_path( $product->product_image) );
//        }
//        $product->product_image='';
//        $product->save();
//        return response()->json(['uploaded' => '/images/'.'jjj']);
//    }




    public function removeLeadAttachment(Request $request){



        $leadAttachment=LeadAttachment::findOrFail($request->key);
        if ( ! empty( $leadAttachment->name) ) {
            File::delete( public_path($leadAttachment->name) );
        }
        $leadAttachment->delete();
        return response()->json(['uploaded' => '/images/'.'jjj']);
    }



}
