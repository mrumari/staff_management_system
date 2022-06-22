@extends('layouts.app_admin')
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
                                    <form class="form" action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section">
                                                <i class="ft-flag"></i> User Info</h4>
                                            <div class="form-group">
                                                <label for="departmentStatus">Department Name</label>
                                                <select name="department_id" class="form-control" required>
                                                    <option value="">----- SELECT -----</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="fullName">Team Name</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter Team Name" name="name" required>
                                                @error('name')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="teamDescription">Team Description</label>
                                                <textarea id="teamDescription" rows="5" class="form-control" name="description" placeholder="Team Description"></textarea>
                                                @error('description')
                                                <label class="danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="repeater-default">
                                                    <div data-repeater-list="users">
                                                        <div data-repeater-item>
                                                            <div class="form row">
                                                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                    <input type="Text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required>
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                    <div class="form-group">
                                                                        <div class="typeahead__container">
                                                                            <div class="typeahead__field">
                                                                                <div class="typeahead__query">
                                                                                    <input type="search" class="js-typeahead form-control" name="email" placeholder="Search (Email)" autocomplete="off" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
{{--                                                                        <var id="result-container" class="result-container"></var>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <input type="password" class="form-control" id="password" name="password" maxlength="8" placeholder="Enter Password" required>
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <select class="form-control" name="role" id="role">
                                                                        <option value="">-Select-</option>
                                                                        <option value="1">Team Lead</option>
                                                                        <option value="2">Team Member</option>
                                                                        <option value="3">Manger</option>
                                                                        <option value="4">Project Manger</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                    <button type="button" class="btn btn-danger" data-repeater-delete>
                                                                        <i class="ft-x"></i> </button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="form-group overflow-hidden">
                                                        <div class="col-12">
                                                            <button data-repeater-create class="btn btn-primary">
                                                                <i class="ft-plus"></i> Add
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
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
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('team-member-theme/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
{{--    <script src="{{asset('team-member-theme/app-assets/js/scripts/forms/form-repeater.js')}}" type="text/javascript"></script>--}}
    <!-- END: Page JS-->

      <script src="{{ asset('admin-theme/app-assets/vendors/jquery-typeahead/dist/jquery.typeahead.min.js') }}" type="text/javascript"></script>

    <script>
        $('.js-typeahead1').typeahead(
            {
            minLength: 1,
            maxItem: 20,
            order: "asc",
            hint: true,
            dynamic: true,
            delay: 500,
            source: {
                email: {
                    display: "email",
                    // data: [{
                    //     "id": 1,
                    //     "email": "iqbalchannar796@gmail.com",
                    // }],
                    ajax: function (query) {
                        return {
                            type: "GET",
                            url: "{{route('admin.teams.autocompleteSearch')}}",
                            path: "data.email",
                            data: {
                                q: query
                            }
                        }
                    }
                }
            },
            callback: {
                onNavigateAfter: function (node, lis, a, item, query, event) {
                    if (~[38,40].indexOf(event.keyCode)) {
                        var resultList = node.closest("form").find("ul.typeahead__list"),
                            activeLi = lis.filter("li.active"),
                            offsetTop = activeLi[0] && activeLi[0].offsetTop - (resultList.height() / 2) || 0;

                        resultList.scrollTop(offsetTop);
                    }

                },
                onClickAfter: function (node, a, item, event) {

                    event.preventDefault();

                    // var r = confirm("You will be redirected to:\n" + item.href + "\n\nContinue?");
                    // if (r == true) {
                    //     window.open(item.href);
                    // }
                    //
                     $('#result-container').text('');
                   // alert(item.id)

                },
                onResult: function (node, query, result, resultCount) {
                    if (query === "") return;

                    var text = "";
                    if (result.length > 0 && result.length < resultCount) {
                        text = "Showing <strong>" + result.length + "</strong> of <strong>" + resultCount + '</strong> elements matching "' + query + '"';
                    } else if (result.length > 0) {
                        text = 'Showing <strong>' + result.length + '</strong> elements matching "' + query + '"';
                    } else {
                        text = 'No results matching "' + query + '"';
                    }
                    $('#result-container').html(text);

                },
                onMouseEnter: function (node, a, item, event) {

                    if (item.group === "email") {
                        $(a).append('<span class="flag-chart flag-' + item.display.replace(' ', '-').toLowerCase() + '"></span>')
                    }

                },
                onMouseLeave: function (node, a, item, event) {

                    $(a).find('.flag-chart').remove();

                }
            }
        });







        $(document).ready(function () {
        var typeaheadSettings = {
            minLength: 1,
            maxItem: 20,
            order: "asc",
            highlight: false,
            hint: true,
            dynamic: true,
            delay: 500,
            source: {
                email: {
                    display: "email",
                    // data: [{
                    //     "id": 1,
                    //     "email": "iqbalchannar796@gmail.com",
                    // }],
                    ajax: function (query) {
                        return {
                            type: "GET",
                            url: "{{route('admin.teams.autocompleteSearch')}}",
                            path: "data.email",
                            data: {
                                q: query
                            }
                        }
                    }
                }
            },
            callback: {
                onNavigateAfter: function (node, lis, a, item, query, event) {
                    if (~[38,40].indexOf(event.keyCode)) {
                        var resultList = node.closest("form").find("ul.typeahead__list"),
                            activeLi = lis.filter("li.active"),
                            offsetTop = activeLi[0] && activeLi[0].offsetTop - (resultList.height() / 2) || 0;

                        resultList.scrollTop(offsetTop);
                    }

                },
                onClickAfter: function (node, a, item, event) {

                    event.preventDefault();

                    // var r = confirm("You will be redirected to:\n" + item.href + "\n\nContinue?");
                    // if (r == true) {
                    //     window.open(item.href);
                    // }
                    //
                    $('#result-container').text('');
                    // alert(item.id)

                },
                onResult: function (node, query, result, resultCount) {
                    if (query === "") return;

                    var text = "";
                    if (result.length > 0 && result.length < resultCount) {
                        text = "Showing <strong>" + result.length + "</strong> of <strong>" + resultCount + '</strong> elements matching "' + query + '"';
                    } else if (result.length > 0) {
                        text = 'Showing <strong>' + result.length + '</strong> elements matching "' + query + '"';
                    } else {
                        text = 'No results matching "' + query + '"';
                    }
                    $('#result-container').html(text);

                },
                onMouseEnter: function (node, a, item, event) {

                    if (item.group === "email") {
                        $(a).append('<span class="flag-chart flag-' + item.display.replace(' ', '-').toLowerCase() + '"></span>')
                    }

                },
                onMouseLeave: function (node, a, item, event) {

                    $(a).find('.flag-chart').remove();

                }
            }
        };

            $('.js-typeahead').typeahead(typeaheadSettings); /* init first input */

            $('.js-typeahead').on('added',function(){
            $('.js-typeahead').typeahead(typeaheadSettings);
        });

        });


        $(document).ready(function () {
            $('.repeater-default').repeater({
                // (Optional)
                // start with an empty list of repeaters. Set your first (and only)
                // "data-repeater-item" with style="display:none;" and pass the
                // following configuration flag
               // initEmpty: true,
                // (Optional)
                // "defaultValues" sets the values of added items.  The keys of
                // defaultValues refer to the value of the input's name attribute.
                // If a default value is not specified for an input, then it will
                // have its value cleared.
                // defaultValues: {
                //    // 'text-input': 'foo'
                // },
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function () {
                    $(this).slideDown();
                    $('.js-typeahead').trigger('added');
                },
                // (Optional)
                // "hide" is called when a user clicks on a data-repeater-delete
                // element.  The item is still visible.  "hide" is passed a function
                // as its first argument which will properly remove the item.
                // "hide" allows for a confirmation step, to send a delete request
                // to the server, etc.  If a hide callback is not given the item
                // will be deleted.
                hide: function (deleteElement) {
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                // (Optional)
                // You can use this if you need to manually re-index the list
                // for example if you are using a drag and drop library to reorder
                // list items.
                //ready: function (setIndexes) {
                    //$dragAndDrop.on('drop', setIndexes);
               // },
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            })
        });
    </script>



@endsection

