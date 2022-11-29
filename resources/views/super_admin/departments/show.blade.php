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
                    <h3 class="content-header-title">Main Department Detail</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('super-admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('super-admin.departments.index')}}">Department Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('super-admin.departments.show',$department->id)}}">Department Detail</a>
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
                                    <h4 class="card-title">Main Department <small class="text-muted">Detail</small></h4>
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
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Name</dt>
                                                        <dd class="col-sm-9">{{ $department->name }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Description</dt>
                                                        <dd class="col-sm-9">{{ $department->description }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Status</dt>
                                                        <dd class="col-sm-9">{{  $department->status ? 'Enabled':'Disabled' }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Company Name</dt>
                                                        <dd class="col-sm-9">{{ $department->company->name }}</dd>
                                                    </dl>


                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created By</dt>
                                                        <dd class="col-sm-9">{{ $department->user->name }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created At</dt>
                                                        <dd class="col-sm-9">{{$department->created_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Updated At</dt>
                                                        <dd class="col-sm-9">{{$department->updated_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @if(count($department->getChildDepartmentsByMainDepartmentId($department->id))>0)
                @foreach($department->getChildDepartmentsByMainDepartmentId($department->id) as $childDepartment)
                <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Child Department ( {{$childDepartment->name}} ) <small class="text-muted">Detail</small></h4>
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
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Name</dt>
                                                        <dd class="col-sm-9">{{ $childDepartment->name }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Description</dt>
                                                        <dd class="col-sm-9">{{ $childDepartment->description }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Status</dt>
                                                        <dd class="col-sm-9">{{  $childDepartment->status ? 'Enabled':'Disabled' }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Company Name</dt>
                                                        <dd class="col-sm-9">{{ $childDepartment->company->name }}</dd>
                                                    </dl>


                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created By</dt>
                                                        <dd class="col-sm-9">{{ $childDepartment->user->name }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created At</dt>
                                                        <dd class="col-sm-9">{{$childDepartment->created_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Updated At</dt>
                                                        <dd class="col-sm-9">{{$childDepartment->updated_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(count($department->getTeamsByChildDepartmentId($childDepartment->id))>0)
                                     @foreach($department->getTeamsByChildDepartmentId($childDepartment->id) as $team)
                                <div class="card-header">
                                    <h4 class="card-title">Team ( {{$team->name}} ) <small class="text-muted">Detail</small></h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="card-text">
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Name</dt>
                                                        <dd class="col-sm-9">{{ $team->name }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Description</dt>
                                                        <dd class="col-sm-9">{{ $team->description }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Status</dt>
                                                        <dd class="col-sm-9">{{  $team->status ? 'Enabled':'Disabled' }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created By</dt>
                                                        <dd class="col-sm-9">{{ $team->user->name }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created At</dt>
                                                        <dd class="col-sm-9">{{$team->created_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Updated At</dt>
                                                        <dd class="col-sm-9">{{$team->updated_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </div>
                        </div>
                        </div>
                </section>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('javascript')
@endsection
