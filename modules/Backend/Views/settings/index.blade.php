@extends('backend::layout')

@section('title', 'Settings')
@section('description', 'Settings management')

@section('header')
    <h1>
        Configuration
        <small>Configuration management</small>
    </h1>
    @can('setting.create')
    <span class="headerElems">
        <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Config</button>
    </span>
    @endcan
@endsection

@section('content')

    @alert()

    <div class="box box-success">
        <div class="box-body">
            <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    @foreach( $columns as $col )
                    <th>{{ ucfirst($col) }}</th>
                    @endforeach
                    
                    @if($actions)
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            </table>
        </div>
    </div>

    @can('setting.create')
    <div class="modal fade" id="AddModal" role="dialog" aria-labelledby="configModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="configModalLabel">Add Config</h4>
                </div>
                <form action="{{ route('settings.store') }}" method="POST" id="role-add-form" novalidate="novalidate" accept-charset="UTF-8">
    	            @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="_id">Key* :</label>
                                <input class="form-control" placeholder="Enter config key" data-rule-maxlength="250" required="1" name="_id" type="text" value="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="data">Data* :</label>
                                <textarea class="form-control" placeholder="Enter config data" data-rule-maxlength="1000" cols="30" rows="3" name="data" required="1" aria-required="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description* :</label>
                                <textarea class="form-control" placeholder="Enter config description" data-rule-maxlength="1000" cols="30" rows="3" name="description" required="1" aria-required="true"></textarea>
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
            processing: true,
            serverSide: true,
            ajax: cedu.route('/settings/ajax'),
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search"
            },
            columns: [
                {data: "_id", orderable: true},
                {data: "name", orderable: true},
                {data: "value", orderable: true},
                {data: "status", orderable: true},
                {data: "updated", orderable: true},
                {data: "action", orderable: false},
            ]
        });

        $("#role-add-form").validate({
            
        });
    });
    </script>
@endpush