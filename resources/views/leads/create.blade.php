@extends('layouts.app_team_member')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('admin-theme/app-assets/vendors/jquery-typeahead/dist/jquery.typeahead.min.css') }}">
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
                                    <form class="form" action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section">
                                                <i class="ft-flag"></i> Lead Info</h4>
{{--                                            <div class="form-group">--}}
{{--                                                <label for="departmentStatus">Department Name</label>--}}
{{--                                                <select name="department_id" class="form-control" required>--}}
{{--                                                    <option value="">----- SELECT -----</option>--}}
{{--                                                    @foreach($departments as $department)--}}
{{--                                                        <option value="{{$department->id}}">{{$department->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                @error('department_id')--}}
{{--                                                <label class="danger">{{ $message }}</label>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}


                                            <div class="form-group">
                                                <label for="client_name">Client Name</label>
                                                <input type="text" id="client_name" class="form-control" placeholder="Enter Client Name" name="client_name" required>
                                                @error('name')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="client_contact_number">Client Contact Number</label>
                                                <input type="text" id="client_contact_number" class="form-control" placeholder="Enter Client Contact Number" name="client_contact_number" required>
                                                @error('client_contact_number')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="client_email">Client Email</label>
                                                <input type="text" id="client_email" class="form-control" placeholder="Enter Client Email" name="client_email" required>
                                                @error('client_email')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="lead_type_id">Lead Type</label>
                                                <select name="lead_type_id" class="form-control" required>
                                                    <option value="">----- SELECT -----</option>
                                                    @foreach($leadTypes as $leadType)
                                                        <option value="{{$leadType->id}}">{{$leadType->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('lead_type_id')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="lead_type_category_id">Lead Type Category</label>
                                                <select name="lead_type_category_id" class="form-control" required>
                                                    <option value="">----- SELECT -----</option>
                                                </select>
                                                @error('lead_type_category_id')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="lead_url">Lead URL</label>
                                                <input type="text" id="lead_url" class="form-control" placeholder="Enter Lead URL" name="lead_url" required>
                                                @error('lead_url')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="lead_proposal">Lead Proposal</label>
                                                <textarea id="lead_proposal" rows="5" class="form-control" name="lead_proposal" placeholder="Lead Proposal"></textarea>
                                                @error('lead_proposal')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>






                                          </div>

                                        <div class="form-actions right">
                                            <button type="button" class="btn btn-danger mr-1">
                                                <i class="ft-x"></i> Cancel
                                            </button>
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





<!-- END: Content-->
@endsection
@section('javascript')

    <script>
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
                        url: '{{route('leads.getLeadTypeCategoriesByLeadTypeId')}}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {lead_type_id: lead_type_id},
                        beforeSend: function () {
                            //overlay_ajax();
                        },
                        success: function (response) {
                            $('select[name="lead_type_category_id"]').empty();
                            $('select[name="lead_type_category_id"]').append('<option value="">----- Select Lead Type Category -----</option>');
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
                    $('select[name="lead_type_category_id"]').append('<option value="">----- Select Lead Type Category -----</option>');
                }
            });
        });
    </script>



@endsection

