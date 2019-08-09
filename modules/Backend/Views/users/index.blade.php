@extends('backend::layout')

@section('title', 'Users')
@section('description', 'Users listing')

@section('content:class', 'no-padding')
@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="ion ion-ios-people"></i></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="name">@lang('messages.user_name')</h4>
                        <p class="desc">@lang('messages.show_list') @lang('messages.user_name')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dats1"><i class="fa fa-users"></i>{{ $count }}</div>
                <div class="dats1"><i class="fa fa-database"></i> {{ Auth::user()->name }}</div>
                <div class="dats1"><i class="fa fa-map-marker"></i> Sunt in Culpa</div>
            </div>
            <div class="col-md-1 actions">
                <!-- Show element actions here -->
                <!-- End: Show element actions here -->
            </div>
        </div>

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('users.index') }}" data-toggle="tooltip" data-placement="right" title="Back to roles"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general" data-target="#tab-general" data-type=""><i class="fa fa-bars"></i> @lang('messages.user_name')</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#" data-target="#tab-publisher" data-type="publisher"><i class="fa fa-gift"></i> @lang('messages.user.publisher')</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#" data-target="#tab-sponsor" data-type="sponsor"><i class="fa fa-cart-plus"></i> @lang('messages.user.sponsor')</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#" data-target="#tab-school" data-type="school"><i class="fa fa-cart-plus"></i> @lang('messages.user.school')</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#" data-target="#tab-admin" data-type="admin"><i class="fa fa-users"></i> @lang('messages.user.admin')</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#" data-target="#tab-manager" data-type="manager"><i class="fa fa-users"></i> @lang('messages.user.manager')</a></li>
            @can('user.create')
            <a href="{{ route('users.create') }}" class="btn btn-success btn-tab-header btn-add-field pull-right">@lang('messages.create') @lang('messages.user_name')</a>
            @end
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab-general">
                <div class="tab-content">
                    <div class="panel infolist">
                        <div class="panel-body">
                            <!-- Show datatables -->
                            <div class="box-body no-padding">
                                <table id="example" class="table table-condensed table-bordered table-hover responsive">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>@lang('messages.user.name')</th>
                                            <th>@lang('messages.email')</th>
                                            <th>@lang('messages.roles')</th>
                                            <th class="text-center">@lang('messages.status')</th>
                                            <th>@lang('messages.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End: Show datatables -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>

    <!-- Show create form modal: disable -->
    @can('user.create')
    <div class="modal fade" id="node-add-modal" role="dialog" aria-labelledby="add-new-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="add-new-modal">@lang('messages.create') @lang('messages.user_name')</h4>
                </div>
                <form action="{{ route('roles.store') }}" method="POST" id="node-add-form" novalidate="novalidate" accept-charset="UTF-8">
    	            @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="_id">Id* :</label>
                                <input class="form-control" placeholder="Enter role id" data-rule-maxlength="250" required="1" name="_id" type="text" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('messages.user.name')* :</label>
                                <input class="form-control" placeholder="Enter role name" data-rule-maxlength="250" required="1" name="name" type="text" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('messages.user.description')* :</label>
                                <textarea class="form-control" placeholder="Enter role description" data-rule-maxlength="1000" cols="30" rows="3" name="description" required="1" aria-required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="level">@lang('messages.school.level') :</label>
                                <input class="form-control" placeholder="Enter role level" data-rule-maxlength="3" required="1" name="level" type="number" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('messages.status') :</label>
                                <select class="form-control" required="1" data-placeholder="Select status" rel="select2" name="status">
                                    <option value="0">@lang('messages.disable')</option>
                                    <option value="1" selected="selected">@lang('messages.enable')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
                        <input class="btn btn-success" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    <!-- End: Show create form modal -->

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('admin/plugins/datatables/datatables.min.js') }}"></script>
    <script>
    /**
     * DataTable handle
     * @file config/index
     */
    $(function () {
        var filter = '';
        var table = $("#example").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                url: cedu.route('/users/ajax'),
                data: (data) => {
                    data.type = filter;
                }
            },
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search"
            },
            lengthMenu: [ 20, 50, 75, 100 ],
            pageLength: 20,
            columns: [
                {data: "_id", orderable: true},
                {data: "name", orderable: true},
                {data: "email", orderable: true},
                {data: "roles", orderable: true},
                {data: "status", orderable: true},
                {data: "action", orderable: false},
            ]
        });

        // Event when user click to tab filter
        $('[data-type]').click(function() {
            filter = $(this).data('type');
            table.ajax.reload();
        });

        // Event for validate form
        $("#add-form").validate({
            
        });
    });
    </script>
@endpush