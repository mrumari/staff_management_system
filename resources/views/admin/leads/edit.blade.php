@extends('layouts.app_admin')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('admin-theme/app-assets/vendors/jquery-typeahead/dist/jquery.typeahead.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/plugins/file-uploaders/dropzone.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Lead Add</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Lead Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Lead Add</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Lead Add</h4>
                                    <a class="heading-elements-toggle">
                                        <i class="la la-ellipsis-v font-medium-3"></i>
                                    </a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse">
                                                    <i class="ft-minus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-action="reload">
                                                    <i class="ft-rotate-cw"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-action="expand">
                                                    <i class="ft-maximize"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-action="close">
                                                    <i class="ft-x"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        {{--                                    action="./"--}}
                                        {{--                                    --}}
                                        {{--                                    id="dpz-single-file"--}}

{{--                                        action="{{ route('admin.leads.update',$lead->id) }}"--}}
                                        <form class="form"  id="dropzone-form" method="post" action="{{ route('admin.leads.update',$lead->id) }}" enctype="multipart/form-data">
                                            @csrf
{{--                                            @method('PATCH')--}}
                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="ft-flag"></i> Lead Info</h4>
                                                <div class="form-group">
                                                    <label for="departmentStatus">Department Name</label>
                                                    <select name="department_id" id="department_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}" @if($lead->department_id == $department->id) selected @endif>{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="client_name">Client Name</label>
                                                    <input type="text" id="client_name" class="form-control" placeholder="Enter Client Name" name="client_name" value="{{$lead->client_name}}" required>
                                                    @error('name')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="client_contact_number">Client Contact Number</label>
                                                    <input type="text" id="client_contact_number" class="form-control" placeholder="Enter Client Contact Number" name="client_contact_number" value="{{$lead->client_contact_number}}" required>
                                                    @error('client_contact_number')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="client_email">Client Email</label>
                                                    <input type="text" id="client_email" class="form-control" placeholder="Enter Client Email" name="client_email" value="{{$lead->client_email}}" required>
                                                    @error('client_email')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="client_skype">Client Skype URL</label>
                                                    <input type="text" id="client_skype_url" class="form-control" placeholder="Enter Client Skype URL" name="client_skype_url" value="{{$lead->client_skype_url}}" required>
                                                    @error('client_skype_url')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="client_email">Client Linkedin URL</label>
                                                    <input type="text" id="client_linkedin_url" class="form-control" placeholder="Enter Client Linkedin" name="client_linkedin_url" value="{{$lead->client_linkedin_url}}" required>
                                                    @error('client_linkedin_url')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="lead_type_id">Lead Payment Type</label>
                                                    <select name="lead_payment_type_id" id="lead_payment_type_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($leadPaymentTypes as $leadPaymentType)
                                                            <option value="{{$leadPaymentType->id}}" @if($lead->lead_payment_type_id == $leadPaymentType->id) selected @endif>{{$leadPaymentType->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lead_payment_type_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" id="amount" class="form-control" placeholder="Enter Amount" name="amount" value="{{$lead->amount}}" required>
                                                    @error('amount')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="estimated_time_line">Estimated Time Line</label>
                                                    <input type="text" id="estimated_time_line" class="form-control" placeholder="Enter Estimated Time Line" name="estimated_time_line"  value="{{$lead->estimated_time_line}}" required>
                                                    @error('estimated_time_line')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="lead_type_id">Lead Type</label>
                                                    <select name="lead_type_id" id="lead_type_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($leadTypes as $leadType)
                                                            <option value="{{$leadType->id}}" @if($lead->lead_type_id == $leadType->id) selected @endif>{{$leadType->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lead_type_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="lead_type_category_id">Lead Type Category</label>
                                                    <select name="lead_type_category_id" id="lead_type_category_id" class="form-control" required>
                                                        <option value="">----- SELECT LEAD TYPE CATEGORY -----</option>
                                                        @foreach($leadTypeCategories as $leadTypeCategory)
                                                            <option value="{{$leadTypeCategory->id}}" @if($lead->lead_type_category_id == $leadTypeCategory->id) selected @endif>{{$leadTypeCategory->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('lead_type_category_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="lead_url">Lead URL</label>
                                                    <input type="text" id="lead_url" class="form-control" placeholder="Enter Lead URL" name="lead_url" value="{{$lead->lead_url}}" required>
                                                    @error('lead_url')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="lead_proposal">Lead Proposal</label>
                                                    <textarea id="lead_proposal" rows="5" class="form-control" name="lead_proposal" placeholder="Lead Proposal">{{$lead->lead_proposal}}</textarea>
                                                    @error('lead_proposal')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="departmentStatus">Lead Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option>----- Select -----</option>
                                                        <option value="1" @if($lead->status) selected @endif>Enabled</option>
                                                        <option value="0" @if(!$lead->status) selected @endif>Disabled</option>
                                                    </select>
                                                    @error('status')
                                                    <div class="danger">{{ $message }}</div>
                                                    @enderror
                                                </div>






{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="courseName" class="col-sm-2 col-form-label">Product Image</label>--}}
{{--                                                    <div class="col-md-8">--}}
{{--                                                        <div class="file-loading">--}}
{{--                                                            <input id="input-b1" name="product_image" type="file" accept="image/*" >--}}
{{--                                                        </div>--}}
{{--                                                        @if ($errors->has('product_image'))--}}
{{--                                                            <span class="text-danger">{{ $errors->first('product_image') }}</span>--}}
{{--                                                        @else--}}
{{--                                                            <span style="font-size: 12px; font-style: italic"><strong>Note : </strong> Leave empty if you do not want to change product image</span>--}}
{{--                                                        @endif--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}


                                                <div class="form-group">
                                                    <label for="lead_url">Lead Attachments(s)</label>
                                                    <div class="file-loading">
                                                        <input id="input-b2" name="lead_attachments[]" type="file" accept="image/*" multiple>
                                                    </div>

                                                    @if ($errors->has('lead_attachments'))
                                                        <span class="text-danger">{{ $errors->first('lead_attachments') }}</span>
                                                    @else
                                                        <span style="font-size: 12px; font-style: italic"><strong>Note : </strong> Leave empty if you do not want to change additional Image(s)</span>
                                                    @endif


                                                </div>


{{--                                                <div class="form-group row">--}}
{{--                                                    <label for="courseName" class="col-sm-2 col-form-label">Additional Image(s)</label>--}}
{{--                                                    <div class="col-md-8">--}}
{{--                                                        <div class="file-loading">--}}
{{--                                                            <input id="input-b2" name="additional_images[]" type="file" accept="image/*" multiple>--}}
{{--                                                        </div>--}}
{{--                                                        @if ($errors->has('additional_images'))--}}
{{--                                                            <span class="text-danger">{{ $errors->first('additional_images') }}</span>--}}
{{--                                                        @else--}}
{{--                                                            <span style="font-size: 12px; font-style: italic"><strong>Note : </strong> Leave empty if you do not want to change additional Image(s)</span>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}






{{--                                                <div class="form-group">--}}
{{--                                                    <label for="lead_proposal">Lead Attachment(s)</label>--}}
{{--                                                    <div class="card">--}}
{{--                                                        <div class="card-content collapse show">--}}
{{--                                                            <div class="card-body">--}}
{{--                                                                <div id="dropzone" class="dropzone"></div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>

                                            <div class="form-actions right">
                                                <button type="button" class="btn btn-danger mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                               <input id="submit-dropzone" class="uk-button uk-button-primary" type="submit" name="submitDropzone" value="Submit" />
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>


<!--    --><?php
//   echo json_encode($leadAttachments);
//    ?>


    <!-- END: Content-->
@endsection
@section('javascript')

    <script src="{{ asset('admin-theme/app-assets/vendors/js/extensions/dropzone.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/ui/prism.min.js') }}" type="text/javascript"></script>


    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
            wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/plugins/sortable.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/fileinput.min.js"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js
!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/themes/fas/theme.js"></script>
    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/locales/(lang).js"></script>--}}


    <script>
        $(document).ready(function() {
            {{--$("#input-b1").fileinput({--}}
            {{--    theme: "fas",--}}
            {{--    uploadUrl: "{{url('products/upload-image')}}",--}}
            {{--    autoReplace: true,--}}
            {{--    overwriteInitial: true,--}}
            {{--    showUploadedThumbs: true,--}}
            {{--    maxFileCount: 1,--}}
            {{--    initialPreview: [--}}
            {{--        '<img src="{{url($product->product_image)}}" class="kv-preview-data file-preview-image">',--}}
            {{--    ],--}}
            {{--    initialCaption: '{{url($product->product_image)}}',--}}
            {{--    initialPreviewShowDelete: false,--}}
            {{--    showRemove: false,--}}
            {{--    showCancel: false,--}}
            {{--    showClose: false,--}}
            {{--    layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion--}}
            {{--    allowedFileExtensions: ["jpg", "png", "gif"],--}}
            {{--    initialPreviewConfig: [--}}
            {{--        {type: "image", caption: "{{url($product->product_image)}}", size: 847000, url: "{{url('/products/remove-product-image')}}",key: '{{$product->id}}', extra: {id: 100, _token: $("input[name='_token']").val()}},--}}
            {{--    ],--}}
            {{--    uploadExtraData: function() {--}}
            {{--        return {--}}
            {{--            _token: $("input[name='_token']").val(),--}}
            {{--            product_id:'{{$product->id}}'--}}
            {{--        };--}}
            {{--    },--}}
            {{--    ajaxDeleteSettings: {--}}
            {{--        type: 'DELETE' // This should override the ajax as $.ajax({ type: 'DELETE' })--}}
            {{--    }--}}
            {{--});--}}




            {{--$("#input-b1").fileinput({--}}
            {{--theme: "fas",--}}
            {{--autoReplace: true,--}}
            {{--maxFileCount: 1,--}}
            {{--showUpload: true,--}}
            {{--dropZoneEnabled: false,--}}
            {{--allowedFileExtensions: ["jpg", "png", "gif"],--}}
            {{--overwriteInitial: false,--}}
            {{--initialPreview: [--}}
            {{--'<img src="{{url($product->product_image)}}" class="kv-preview-data file-preview-image">',--}}
            {{--],--}}
            {{--initialPreviewAsData: false, // allows you to set a raw markup--}}
            {{--initialPreviewFileType: 'image', // image is the default and can be overridden in config below--}}
            {{--initialPreviewDownloadUrl: '{{url($product->product_image)}}', // includes the dynamic key tag to be replaced for each config--}}
            {{--initialPreviewConfig: [--}}
            {{--{type: "image", caption: "{{url($product->product_title)}}", size: 847000, url: "{{url('/products/remove-product-image')}}", product_id: '{{$product->id}}'}--}}
            {{--],--}}
            {{--uploadExtraData: function() {--}}
            {{--return {--}}
            {{--_token: $("input[name='_token']").val(),--}}
            {{--product_id:1--}}
            {{--};--}}
            {{--},--}}

            {{--}).on('filesorted', function(e, params) {--}}
            {{--console.log('File sorted params', params);--}}
            {{--}).on('fileuploaded', function(e, params) {--}}
            {{--console.log('File uploaded params', params);--}}
            {{--});--}}





            $("#input-b2").fileinput({
                theme: "fas",
                //uploadUrl: "{{route('admin.leads.upload-lead-attachments')}}",
                showUpload: false,
                dropZoneEnabled: false,
                maxFileCount: 10,
                showCancel: false,
                showRemove: false,
                allowedFileExtensions: ["jpg","png","pdf"],
                overwriteInitial: false,
                initialPreview: [
                    // IMAGE RAW MARKUP
                    <?php foreach ($leadAttachments as $leadAttachment){?>
                        '<img src="{{url($leadAttachment->url)}}" class="kv-preview-data file-preview-image">',
                    <?php } ?>
                ],
                initialPreviewAsData: false, // allows you to set a raw markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below

                <?php foreach ($leadAttachments as $leadAttachment){?>
                initialPreviewDownloadUrl:'{{url($leadAttachment->url)}}',
                <?php } ?>
                // includes the dynamic key tag to be replaced for each config
                initialPreviewConfig: [
                        <?php foreach ($leadAttachments as $leadAttachment){?>
                    {type: "image", caption: "{{url($leadAttachment->url)}}", size: 847000, url: "{{route('admin.leads.remove-lead-attachment')}}",key: '{{$leadAttachment->id}}', extra: {id: 100, _token: $("input[name='_token']").val()}},
                    <?php } ?>
                ],
                //deleteUrl: "/site/file-delete",
                uploadExtraData: function() {
                    return {
                        _token: $("input[name='_token']").val(),
                        lead_id:'{{$lead->id}}'
                    };
                },
                ajaxDeleteSettings: {
                    type: 'DELETE' // This should override the ajax as $.ajax({ type: 'DELETE' })
                }
            }).on('filesorted', function(e, params) {
                console.log('File sorted params', params);
            }).on('fileuploaded', function(e, params) {
                console.log('File uploaded params', params);
            });

        });




        // disable autodiscover
       {{-- Dropzone.autoDiscover = false;--}}
       {{-- var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");--}}
       {{-- var myDropzone = new Dropzone("#dropzone", {--}}
       {{--     url: "{{ route('admin.leads.update',$lead->id) }}",--}}
       {{--     method: "POST",--}}
       {{--     paramName: "file",--}}
       {{--     autoProcessQueue : false,--}}
       {{--     acceptedFiles: "image/*",--}}
       {{--     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
       {{--     maxFiles: 5,--}}
       {{--     maxFilesize: 5.3, // MB--}}
       {{--     uploadMultiple: true,--}}
       {{--     parallelUploads: 100, // use it with uploadMultiple--}}
       {{--     createImageThumbnails: true,--}}
       {{--     thumbnailWidth: 120,--}}
       {{--     thumbnailHeight: 120,--}}
       {{--     addRemoveLinks: true,--}}
       {{--     timeout: 180000,--}}
       {{--     dictRemoveFileConfirmation: "Are you Sure?", // ask before removing file--}}
       {{--     // Language Strings--}}
       {{--     dictFileTooBig: "File is to big (10000mb). Max allowed file size is 765mb",--}}
       {{--     dictInvalidFileType: "Invalid File Type",--}}
       {{--     dictCancelUpload: "Cancel",--}}
       {{--     dictRemoveFile: "Remove",--}}
       {{--     dictMaxFilesExceeded: "Only 5 files are allowed",--}}
       {{--     dictDefaultMessage: "Drop files here to upload",--}}
       {{-- });--}}

       {{-- myDropzone.on("addedfile", function(file) {--}}
       {{--     //console.log(file);--}}
       {{-- });--}}

       {{-- myDropzone.on("removedfile", function(file) {--}}
       {{--     // console.log(file);--}}
       {{-- });--}}


       {{-- // Add mmore data to send along with the file as POST data. (optional)--}}
       {{-- myDropzone.on("sending", function(file, xhr, formData) {--}}
       {{--     formData.append("department_id", $('#department_id').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("client_name", $('#client_name').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("client_contact_number", $('#client_contact_number').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("client_email", $('#client_email').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("client_skype_url", $('#client_skype_url').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("client_linkedin_url", $('#client_linkedin_url').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("lead_url", $('#lead_url').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("lead_payment_type_id", $('#lead_payment_type_id').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("lead_type_id", $('#lead_type_id').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("lead_type_category_id", $('#lead_type_category_id').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("amount", $('#amount').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("estimated_time_line", $('#estimated_time_line').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("lead_proposal", $('#lead_proposal').val()); // $_POST["dropzone"]--}}
       {{--     formData.append("_token", CSRF_TOKEN);--}}
       {{-- });--}}

       {{-- myDropzone.on("error", function(file, response) {--}}
       {{--     console.log(response);--}}
       {{-- });--}}

       {{-- // on success--}}
       {{-- myDropzone.on("successmultiple", function(file, response) {--}}
       {{--     // get response from successful ajax request--}}
       {{--     console.log(response);--}}
       {{--     // submit the form after images upload--}}
       {{--     // (if u want yo submit rest of the inputs in the form)--}}
       {{--     window.location = '{{ route('admin.leads.index') }}'--}}
       {{--     //document.getElementById("dropzone-form").submit();--}}
       {{-- });--}}


       {{-- /**--}}
       {{--  *  Add existing images to the dropzone--}}
       {{--  *  @var images--}}
       {{--  *--}}
       {{--  */--}}

       {{-- var images = [--}}
       {{--         <?php foreach ($leadAttachments as $leadAttachment){?>--}}
       {{--     {name: "{{ $leadAttachment->name }}", url: "{{ asset($leadAttachment->url) }}", size: "{{ $leadAttachment->size }}" },--}}
       {{--     <?php } ?>--}}
       {{--     // {name:"image_1.jpg", url: "example/image1.jpg", size: "12345"},--}}
       {{--     // {name:"image_2.jpg", url: "example/image2.jpg", size: "12345"},--}}
       {{--     // {name:"image_2.jpg", url: "example/image2.jpg", size: "12345"},--}}
       {{-- ]--}}

       {{-- for(let i = 0; i < images.length; i++) {--}}

       {{--     let img = images[i];--}}
       {{--     //console.log(img.url);--}}

       {{--     // Create the mock file:--}}
       {{--     var mockFile = {name: img.name, size: img.size, url: img.url};--}}
       {{--     // Call the default addedfile event handler--}}
       {{--     myDropzone.emit("addedfile", mockFile);--}}
       {{--     // And optionally show the thumbnail of the file:--}}
       {{--     myDropzone.emit("thumbnail", mockFile, img.url);--}}
       {{--     // Make sure that there is no progress bar, etc...--}}
       {{--     myDropzone.emit("complete", mockFile);--}}
       {{--     // If you use the maxFiles option, make sure you adjust it to the--}}
       {{--     // correct amount:--}}
       {{--     var existingFileCount = 1; // The number of files already uploaded--}}
       {{--     myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;--}}

       {{-- }--}}

       {{--// button trigger for processingQueue--}}
       {{-- var submitDropzone = document.getElementById("submit-dropzone");--}}
       {{-- submitDropzone.addEventListener("click", function(e) {--}}
       {{--     // Make sure that the form isn't actually being sent.--}}
       {{--     e.preventDefault();--}}
       {{--     e.stopPropagation();--}}

       {{--     if (myDropzone.files != "") {--}}
       {{--         // console.log(myDropzone.files);--}}
       {{--         myDropzone.processQueue();--}}
       {{--     } else {--}}
       {{--         // if no file submit the form--}}
       {{--         document.getElementById("dropzone-form").submit();--}}
       {{--     }--}}

       {{-- });--}}




        function overlay_ajax(){
            $('.overlay').block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
                // timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        }



        $(function() {
            $('select[name="lead_type_id"]').on('change', function () {
                var lead_type_id = $(this).val();
                if (lead_type_id) {
                    $.ajax({
                        url: '{{route('admin.leads.getLeadTypeCategoriesByLeadTypeId')}}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {lead_type_id: lead_type_id},
                        beforeSend: function () {
                            //overlay_ajax();
                        },
                        success: function (response) {
                            $('select[name="lead_type_category_id"]').empty();
                            $('select[name="lead_type_category_id"]').append('<option value="">----- SELECT LEAD TYPE CATEGORY -----</option>');
                            $.each(response,function(key, value) {
                                $('select[name="lead_type_category_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            $('#modal-default').modal('show');
                        },
                        complete: function () {
                            // $('.card').unblock();
                        }
                    });
                } else {
                    $('select[name="lead_type_category_id"]').empty();
                    $('select[name="lead_type_category_id"]').append('<option value="">----- SELECT LEAD TYPE CATEGORY -----</option>');
                }
            });
        });
    </script>

@endsection
