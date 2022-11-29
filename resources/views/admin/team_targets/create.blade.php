@extends('layouts.app_admin')
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
                <h3 class="content-header-title">Basic Forms</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Form Layouts</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Basic Forms</a>
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
                                <h4 class="card-title" id="basic-layout-form">Simple Form</h4>
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
                                    <div class="card-text">
                                        <p>This is the most basic and default form having form section.</p>
                                    </div>
                                    <form class="form" action="{{ route('admin.team-targets.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section">
                                                <i class="ft-flag"></i> Team Info</h4>
                                            <div class="form-group">
                                                <label for="departmentStatus">Team Name</label>
                                                <select name="team_id" class="form-control" required>
                                                    <option value="">----- SELECT -----</option>
                                                    @foreach($teams as $team)
                                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="fullName">Team Target Name</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter Team Target Name" name="name" required>
                                                @error('name')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teamDescription">Team Target Description</label>
                                                <textarea id="teamDescription" rows="5" class="form-control" name="description" placeholder="Team Target Description"></textarea>
                                                @error('description')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="start_date">Target Start From Date</label>
                                                <div class="row">
                                                    <div class="col-lg-12 mb-1">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <span class="ft-calendar"></span>
                                                                </span>
                                                            </div>
                                                            <input id="picker_from" name="start_date" class="form-control datepicker" type="date">
                                                        </div>
                                                        @error('start_date')
                                                        <label class="danger">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="end_date">Target End To Date</label>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <span class="ft-calendar"></span>
                                                                </span>
                                                            </div>
                                                            <input id="picker_to" name="end_date" class="form-control datepicker" type="date">
                                                        </div>
                                                        @error('end_date')
                                                        <label class="danger">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="fullName">Team Target Amount</label>
                                                <input type="text" id="amount" class="form-control" maxlength="6" onkeypress="return isNumberKey(this, event);" placeholder="Enter Team Target Amount" name="amount" required>
                                                @error('amount')
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



{{--            <input class="js-typeahead"--}}
{{--                   name="q"--}}
{{--                   type="search"--}}
{{--                   autofocus--}}
{{--                   autocomplete="off">--}}


{{--            <form id="form-country_v1" name="form-country_v1">--}}
{{--                <div class="typeahead__container">--}}
{{--                    <div class="typeahead__field">--}}
{{--                        <div class="typeahead__query">--}}
{{--                            <input class="js-typeahead" name="country_v1[query]" placeholder="Search" autocomplete="off">--}}
{{--                        </div>--}}
{{--                        <div class="typeahead__button">--}}
{{--                            <button type="submit">--}}
{{--                                <i class="typeahead__search-icon"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}


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
// Date Range from & to
            var from_$input = $('#picker_from').pickadate({
                    format: 'yyyy-mm-dd',
                    formatSubmit: 'yyyy-mm-dd',
                }),
                from_picker = from_$input.pickadate('picker');

            var to_$input = $('#picker_to').pickadate({
                    format: 'yyyy-mm-dd',
                    formatSubmit: 'yyyy-mm-dd',
                }),
                to_picker = to_$input.pickadate('picker');


            // Check if there’s a “from” or “to” date to start with.
            if ( from_picker.get('value') ) {
                to_picker.set('min', from_picker.get('select'));
            }
            if ( to_picker.get('value') ) {
                from_picker.set('max', to_picker.get('select'));
            }

            // When something is selected, update the “from” and “to” limits.
            from_picker.on('set', function(event) {
                if ( event.select ) {
                    to_picker.set('min', from_picker.get('select'));
                }
                else if ( 'clear' in event ) {
                    to_picker.set('min', false);
                }
            });
            to_picker.on('set', function(event) {
                if ( event.select ) {
                    from_picker.set('max', to_picker.get('select'));
                }
                else if ( 'clear' in event ) {
                    from_picker.set('max', false);
                }
            });
        });
    </script>



@endsection

