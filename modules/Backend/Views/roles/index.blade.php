@extends('backend::layout')

@section('title', 'Roles')
@section('description', 'Roles management')

@section('header')
    <h1>
        Roles
        <small>Roles management</small>
    </h1>
    @can('role.create')
    <span class="headerElems">
        <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Role</button>
    </span>
    @endcan
@endsection

@section('content')

    @alert()

    <!-- Show datatable -->
    <div class="box box-success">
        <div class="box-body">
            <table id="example" class="table table-condensed table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $nodes as $k => $item )
                <tr>
                    <td class="text-center">{{ $k + 1 }}.</td>
                    <td>{{ $item->id }}</td>
                    <td>
                    <a href="{{ route('roles.show', $item->id) }}">{{ $item->name }}</a>
                    </td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->level }}</td>
                    <td>
                        @if($item->status)
                        <span class="label label-success">Enable</span>
                        @else
                        <span class="label label-danger">Disable</span>
                        @endif
                    </td>
                    <td>{{ $item->created }}</td>
                    <td>{{ $item->updated }}</td>
                    <td>
                        @can('role.update')
                        <a href="{{ route('roles.edit', $item->id) }}#tab-access" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>
                        @end

                        @can('role.view')
                        <a href="{{ route('roles.show', $item->id) }}#tab-access" class="btn btn-primary btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-street-view"></i></a>
                        @end

                        @can('role.delete')
                        <form method="POST" action="{{ route('roles.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
                        </form>
                        @end
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <!-- End: Show datatable -->

    @can('role.create')
    <!-- Show create form modal -->
    <div class="modal fade" id="AddModal" role="dialog" aria-labelledby="configModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="configModalLabel">Add Role</h4>
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
                                <label for="name">Name* :</label>
                                <input class="form-control" placeholder="Enter role name" data-rule-maxlength="250" required="1" name="name" type="text" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="description">Description* :</label>
                                <textarea class="form-control" placeholder="Enter role description" data-rule-maxlength="1000" cols="30" rows="3" name="description" required="1" aria-required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="level">Level :</label>
                                <input class="form-control" placeholder="Enter role level" data-rule-maxlength="3" required="1" name="level" type="number" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="description">Status :</label>
                                <select class="form-control" required="1" data-placeholder="Select status" rel="select2" name="status">
                                    <option value="0">Disable</option>
                                    <option value="1" selected="selected">Enable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-success" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Show create form modal -->
    @endcan

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
        $("#example").DataTable({
            processing: false,
            serverSide: false, // Disable server request data 
            paging: false,
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search"
            },
            columnDefs: [ { orderable: false, targets: [-1] }],
        });

        $("#node-add-form").validate({
            
        });
    });
    </script>
@endpush