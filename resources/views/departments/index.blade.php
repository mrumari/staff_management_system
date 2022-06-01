@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
    <section id="file-export">
        <div class="row">
            <div class="col-12">
            <div class="card">
            <div class="card-header">
            <h4 class="card-title">File export</h4>
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
                <div class="col-md-12">
                    <div class="form-actions float-right">
                        <button id='delete_record' value='Delete' class="btn btn-danger"><i class="la la-trash-o"></i>Delete</button>
                        <a href="{{route('departments.create')}}" class="btn btn-primary">
                            <i class="la la-plus-square-o"></i> Add New
                        </a>
                    </div>
                </div>
{{--            <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export.</p>--}}
            <div class="table-responsive">
                @if ($message = Session::get('success'))
                    <div class="col-md-12 pt-1">
                    <div class="alert alert-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Well done!</strong> {{ $message }}.
                    </div>
                    </div>
                @endif
            <table class="table table-striped table-bordered file-export">
            <thead>
            <tr>
            <th>Check All <input type="checkbox" class='checkall' id='checkall'></th>
            <th>S.No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th width="280px">Action</th>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/buttons.flash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/jszip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/pdfmake.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/vfs_fonts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/buttons.html5.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/buttons.print.min.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>--}}
{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var dataTable = $('.file-export').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('departments') }}",
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
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                responsive:true,
                order:[0,'desc']
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');



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
                                url: '{{route('departments.deleteAll')}}',
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {request: 2, deleteids_arr: deleteids_arr},
                                success: function (response) {
                                    // $("input:checkbox[class=delete_check]:checked").each(function() {
                                    //     $(this).parents("tr").remove();
                                    // });
                                    swal('Deleted!', response.success, 'success')
                                    dataTable.ajax.reload();
                                    //window.location='{{route('departments.index')}}'
                                    //dataTable.ajax.reload();
                                }
                            });
                        }).catch(swal.noop);

            }else{
                swal('Warning!', 'There is no checkbox checked', 'warning')
            }
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
