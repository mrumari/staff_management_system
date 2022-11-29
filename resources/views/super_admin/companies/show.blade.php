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
                    <h3 class="content-header-title">Company Detail</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('super-admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('super-admin.companies.index')}}">Company Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('super-admin.companies.show',$company->id)}}">Company Detail</a>
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
                                    <h4 class="card-title">Company <small class="text-muted">Detail</small></h4>
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
                                                        <dd class="col-sm-9">{{ $company->name }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Description</dt>
                                                        <dd class="col-sm-9">{{ $company->description }}</dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-3">Status</dt>
                                                        <dd class="col-sm-9">{{  $company->status ? 'Enabled':'Disabled' }}</dd>
                                                    </dl>


                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created By</dt>
                                                        <dd class="col-sm-9">{{ $company->user->name }}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Created At</dt>
                                                        <dd class="col-sm-9">{{$company->created_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>

                                                    <dl class="row">
                                                        <dt class="col-sm-3">Updated At</dt>
                                                        <dd class="col-sm-9">{{$company->updated_at->format('Y-m-d H:i:s')}}</dd>
                                                    </dl>


                                                </div>
                                            </div>
                                        </div>


{{--                                        <form class="form" method="post" action="{{ route('super-admin.companies.update',$company->id) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('PATCH')--}}
{{--                                            <div class="form-body">--}}
{{--                                                <h4 class="form-section">--}}
{{--                                                    <i class="ft-flag"></i> Company Info</h4>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="companyName">Company Name</label>--}}
{{--                                                    <input type="text" id="companyName" class="form-control" placeholder="Company Name" name="name" value="{{ $company->name }}">--}}
{{--                                                    @error('name')--}}
{{--                                                    <label class="danger">{{ $message }}</label>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="departmentStatus">Company Status</label>--}}
{{--                                                    <select name="status" class="form-control">--}}
{{--                                                        <option value="">----- SELECT -----</option>--}}
{{--                                                        <option value="1" @if($company->status) selected @endif>Enabled</option>--}}
{{--                                                        <option value="0" @if(!$company->status) selected @endif>Disabled</option>--}}
{{--                                                    </select>--}}
{{--                                                    @error('status')--}}
{{--                                                    <label class="danger">{{ $message }}</label>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="companyDescription">Company Description</label>--}}
{{--                                                    <textarea id="companyDescription" rows="5" class="form-control" name="description" placeholder="Department Description">{{ $company->description }}</textarea>--}}
{{--                                                    @error('description')--}}
{{--                                                    <label class="danger">{{ $message }}</label>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-actions right">--}}
{{--                                                <button type="button" class="btn btn-danger mr-1">--}}
{{--                                                    <i class="ft-x"></i> Cancel--}}
{{--                                                </button>--}}
{{--                                                <button type="submit" class="btn btn-primary">--}}
{{--                                                    <i class="la la-check-square-o"></i> Save--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
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
