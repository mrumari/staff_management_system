@extends('layouts.app_super_admin')
@section('stylesheet')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Edit User</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('super-admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('super-admin.users.index')}}">User Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('super-admin.users.edit', $user->id)}}">Edit User</a>
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
                            <div class="card overlay">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Edit User</h4>
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
                                        <form class="form" method="post" action="{{ route('super-admin.users.update',$user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="ft-flag"></i> User Info</h4>

                                                <div class="form-group">
                                                    <label for="companyStatus">Company Name</label>
                                                    <select name="company_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}" @if($company->id == $user->company_id) selected @endif>{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('company_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>




                                                <div class="form-group">
                                                    <label for="departmentStatus">Department Name</label>
                                                    <select name="department_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}" @if($user->department_id == $department->id) selected @endif>{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="fullName">Full Name</label>
                                                    <input type="text" id="fullName" class="form-control" placeholder="Enter Full Name" name="name" value="{{$user->name}}" required>
                                                    @error('name')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="userEmail">Email (Username)</label>
                                                    <input type="email" id="userEmail" class="form-control" placeholder="Enter Email (Username)" name="email" value="{{$user->email}}" required>
                                                    @error('email')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="departmentStatus">User Status</label>
                                                    <select name="status" class="form-control">
                                                        <option>----- Select -----</option>
                                                        <option value="1" @if($user->status) selected @endif>Enabled</option>
                                                        <option value="0" @if(!$user->status) selected @endif>Disabled</option>
                                                    </select>
                                                    @error('status')
                                                    <div class="danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-actions right">
                                                <a href="{{route('super-admin.users.index')}}" class="btn btn-danger mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
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
                <!-- // Basic form layout section end -->
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
            $('select[name="company_id"]').on('change', function () {
                var company_id = $(this).val();

                if (company_id) {
                    $.ajax({
                        url: '{{route('super-admin.users.getDepartmentByCompanyId')}}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {company_id: company_id},
                        beforeSend: function () {
                            overlay_ajax();
                        },
                        success: function (response) {
                            $('select[name="department_id"]').empty();
                            $('select[name="department_id"]').append('<option value="">----- Select Department -----</option>');
                            $.each(response,function(key, value) {
                                $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            $('#modal-default').modal('show');
                        },
                        complete: function () {
                            $('.card').unblock();
                        }
                    });
                } else {
                    $('select[name="department_id"]').empty();
                    $('select[name="department_id"]').append('<option value="">----- Select Department -----</option>');
                }
            });
        });
    </script>
@endsection
