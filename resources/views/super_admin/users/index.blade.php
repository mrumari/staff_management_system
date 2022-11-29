@extends('layouts.app_super_admin')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('super-admin-theme/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('super-admin-theme/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('super-admin-theme/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('super-admin-theme/app-assets/css/plugins/extensions/toastr.css')}}">

    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
        .toggle.ios .toggle-handle { border-radius: 20rem; }
        .ios  .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }

        .button {
            background-color: transparent;
            background-repeat: no-repeat;
            border: none;
            cursor: pointer;
            overflow: hidden;
            outline: none;
            padding: 0px;
        }

        .fonticon-container > .fonticon-wrap {
            float: left;
            line-height: 4.8rem;
            text-align: center;
            margin-right: 0.00rem;
            margin-bottom: 0.00rem;
        }
    </style>

@endsection

@section('content')

    <!-- BEGIN: Content-->

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">User Listing</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('super-admin.home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('super-admin.users.index')}}">User Listing</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card overlay">
                                <div class="card-header">
                                    <h4 class="card-title">User Listing</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        @if ($message = Session::get('success'))
                                            <div class="col-md-12 pt-1">
                                                <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>Alert!  </strong> {{ $message }}.
                                                </div>
                                            </div>
                                        @endif


                                        <div class="col-md-12 pt-1">
                                            <div id="alertDev" style="display: none" class="alert alert-dismissible mb-2" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>Alert!  </strong> <span id="alertMessage"></span>.
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                        <div class="form-actions float-right">
                                            <button id='delete_record' value='Delete' class="btn btn-danger"><i class="la la-trash-o"></i>Delete</button>
                                            <a href="{{route('super-admin.users.create')}}" class="btn btn-primary">
                                                <i class="la la-plus-square-o"></i> Add New
                                            </a>
                                        </div>
                                        </div>


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered file-export">
                                                <thead>
                                                <tr>
                                                    <th>Check All <input type="checkbox" class='checkall' id='checkall'></th>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th width="280px" style="text-align: center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/buttons.flash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/tables/buttons.print.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    {{--    <script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('super-admin-theme/app-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
    <!-- END: Page JS-->


    <script src="{{ asset('super-admin-theme/app-assets/vendors/js/extensions/sweetalert2.all.js') }}" type="text/javascript"></script>
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


        $(document).ajaxComplete(function() {
            $("[data-toggle=tooltip]").tooltip();
        });

        function loadToggle(){
            $("[data-toggle='toggle']").bootstrapToggle('destroy')
            $("[data-toggle='toggle']").bootstrapToggle();
            $('[data-toggle="tooltip"]').tooltip();
        }


        $(function () {
            var dataTable = $('.file-export').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('super-admin.users.index') }}",
                //dom: 'Bfrtip',
                // buttons: [
                //     {
                //         text: 'Delete',
                //         id:'delete_record',
                //         action: function ( e, dt, node, config ) {
                //             alert( 'Button activated' );
                //         }
                //     }
                // ],
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                columns: [
                    {data:"checkbox", name: 'checkbox', orderable:false, searchable:false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                responsive:true,
                order:[0,'desc'],
                drawCallback: function( settings ) {// it run when table render (run again and again)
                    loadToggle();
                },
                initComplete: function () { // once run as view load
                    loadToggle();
                },
            });
            // $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');



            // Check all
            $('#checkall').click(function(){
                if($(this).is(':checked')){
                    $('.delete_check').prop('checked', true);
                }else{
                    $('.delete_check').prop('checked', false);
                }
            });

            // Delete record
            $('#delete_record').click(function(){

                var deleteids_arr = [];
                // Read all checked checkboxes
                $("input:checkbox[class=delete_check]:checked").each(function () {
                    deleteids_arr.push($(this).val());
                });

                // Check checkbox checked or not
                if(deleteids_arr.length > 0){

                    swal({
                        title: 'Are you sure you want to delete selected record(s)?',
                        text: 'You won\'t be able to revert this!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function () {
                        /* Read more about isConfirmed, isDenied below */
                        $.ajax({
                            url: '{{route('super-admin.users.deleteAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {request: 2, deleteids_arr: deleteids_arr},
                            beforeSend: function () {
                                overlay_ajax();
                            },
                            success: function (response) {
                                // $("input:checkbox[class=delete_check]:checked").each(function() {
                                //     $(this).parents("tr").remove();
                                // });
                                swal('Deleted!', response.success, 'success')
                                dataTable.ajax.reload();
                            },
                            error: function () {
                                $('#modal-default').modal('show');
                            },
                            complete: function () {
                                $('.card').unblock();
                            }
                        });
                    }).catch(swal.noop);

                }else{
                    swal('Warning!', 'There is no checkbox checked', 'warning')
                }
            });

            ////////////////// Change status by ID //////////
            $(document).on("change", ".switchery", function () {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');

                $.ajax({
                    url: '{{route('super-admin.users.changeStatus')}}',
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id: id, status: status},
                    beforeSend: function () {
                        $(".alert").css('display','none');
                        overlay_ajax();
                    },
                    success: function (response) {
                        if(response.flag){
                            //toastr.success(response.msg,'Success Alert!');
                            // swal('Deleted!', response.success, 'success')
                            $("#alertDev").addClass('alert-success').css('display','block');
                            $('#alertMessage').text(response.msg);
                            dataTable.ajax.reload();
                        }else{
                            // toastr.error(response.msg, 'Error Alert.');
                            $("#alertDev").addClass('alert-danger').css('display','block');
                            $('#alertMessage').text(response.msg);
                        }
                    },
                    error: function () {
                        // $('#modal-default').modal('show');
                        $("#alertDev").addClass('alert-danger').css('display','block');
                        $('#alertMessage').text(response.msg);
                    },
                    complete: function () {
                        $('.overlay').unblock();
                    }
                });
                // alert($(this).find('input').data('value'));
            });




        });
        // Checkbox checked
        function checkcheckbox(){

            // Total checkboxes
            var length = $('.delete_check').length;

            // Total checked checkboxes
            var totalchecked = 0;
            $('.delete_check').each(function(){
                if($(this).is(':checked')){
                    totalchecked+=1;
                }
            });

            // Checked unchecked checkbox
            if(totalchecked == length){
                $("#checkall").prop('checked', true);
            }else{
                $('#checkall').prop('checked', false);
            }
        }
    </script>
@endsection
