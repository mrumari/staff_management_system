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
                    <h3 class="content-header-title">Edit Department</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('super-admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('super-admin.departments.index')}}">Department Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('super-admin.departments.edit',$department->id)}}">Edit Department</a>
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Department</h4>
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
                                        <form class="form" method="post" action="{{ route('super-admin.departments.update',$department->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-body">
                                                <h4 class="form-section">
                                                    <i class="ft-flag"></i> Department Info</h4>
                                                <div class="form-group">
                                                    <label for="CompanyStatus">Company Name</label>
                                                    <select name="company_id" class="form-control" required>
                                                        <option value="">----- SELECT -----</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}" @if($company->id == $department->company_id) selected @endif>{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('company_id')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>



                                                <div class="form-group">
                                                    <label for="departmentName">Department Name</label>
                                                    <input type="text" id="departmentName" class="form-control" placeholder="Department Name" name="name" value="{{ $department->name }}">
                                                    @error('name')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="departmentStatus">Department Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">----- SELECT -----</option>
                                                        <option value="1" @if($department->status) selected @endif>Enabled</option>
                                                        <option value="0" @if(!$department->status) selected @endif>Disabled</option>
                                                    </select>
                                                    @error('status')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="departmentDescription">Department Description</label>
                                                    <textarea id="departmentDescription" rows="5" class="form-control" name="description" placeholder="Department Description">{{ $department->description }}</textarea>
                                                    @error('description')
                                                    <label class="danger">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-actions right">
                                                <a href="{{route('super-admin.departments.index')}}" class="btn btn-danger mr-1">
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
@endsection
