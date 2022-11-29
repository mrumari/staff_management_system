@extends('layouts.app_team_member')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/pickers/pickadate/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/pickers/pickadate/default.date.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/pickers/pickadate/default.time.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/plugins/pickers/daterange/daterange.css') }}">
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Add Meeting</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Lead Listing</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Add Meeting</a>
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
                                <h4 class="card-title" id="basic-layout-form">Add Meeting</h4>
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
                                    <form class="form" action="{{ route('leads.store-meeting', $lead->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section">
                                                <i class="ft-flag"></i> Meeting Info</h4>

                                            <div class="form-group">
                                                <label for="start_date">Meeting Date</label>
                                                <div class="row">
                                                    <div class="col-lg-12 mb-1">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <span class="ft-calendar"></span>
                                                                </span>
                                                            </div>
                                                            <input id="picker_from" name="date" class="form-control datepicker" type="date" placeholder="Select Meeting Date">
                                                        </div>
                                                        @error('date')
                                                        <label class="danger">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-1">
                                            <div class="form-group">
                                                <label>Meeting Time</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="ft-clock"></span>
                                                        </span>
                                                    </div>
                                                    <input type='text' id="time" name="time" class="form-control pickatime" placeholder="Select Meeting Time" />
                                                </div>

                                                @error('time')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror


                                            </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="description">Meeting Description</label>
                                                <textarea id="description" rows="5" class="form-control" name="description" placeholder="Meeting description"></textarea>
                                                @error('description')
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

    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-theme/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript"></script>

    {{--    <script src="{{ asset('admin-theme/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}" type="text/javascript"></script>--}}

    <script>
        function isNumberKey(txt, evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 46) {
                //Check if the text already contains the . character
                if (txt.value.indexOf('.') === -1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (charCode > 31 &&
                    (charCode < 48 || charCode > 57))
                    return false;
            }
            return true;
        }


        $(document).ready(function () {
            $('#picker_from').pickadate({
                    format: 'yyyy-mm-dd',
                    formatSubmit: 'yyyy-mm-dd',
                })

            $('.pickatime').pickatime({
                interval: 1,
                format: 'h:i A',
                formatSubmit: 'HH:i',
            });
        });
    </script>



@endsection

