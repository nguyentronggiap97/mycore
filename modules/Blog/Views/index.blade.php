@extends('backend::layout')

@section('title', 'Blog')
@section('description', 'Blog listing')

@section('header')
<section class="content-header">
    <h1>
        Content <small>posts management</small>
    </h1>
    <div class="toolbar-item toolbar-primary">
        <!-- 
        <div class="btn-group offset-right">
            <button type="button" class="btn btn-primary">Upload</button>
            <a type="button" class="btn btn-primary" href="{{ route('post.create') }}">Add new</a>
        </div>
        -->

        <!-- 
        <div class="btn-group offset-right">
            <button type="button" class="btn btn-default oc-icon-reply-all" data-command="move">Move</button>
            <button type="button" class="btn btn-default oc-icon-trash" data-command="delete">Delete</button>
        </div>
        -->
    </div>
</section>
@endsection

@section('content:class', 'no-padding')
@section('content')
<div class="content row">
    
    <!-- Tab header -->
    <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
        <li><a href="{{ route('admin.index') }}" data-toggle="tooltip" data-placement="right" title="Back to dashboard"><i class="ion ion-chevron-left"></i></a></li>
        <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general" data-filter="">Posts </a></li>
        <li><a role="tab" data-toggle="tab" href="#" data-filter="published"><i class="fa fa-toggle-on text-success"></i>Published</a></li>
        <li><a role="tab" data-toggle="tab" href="#" data-filter="draft"><i class="fa fa-toggle-off text-red"></i>Draft</a></li>
        <li><a role="tab" data-toggle="tab" href="#" data-filter="trash"><i class="fa fa-toggle-off text-red"></i>Trash</a></li>
        @can('post.create')
        <!-- <a href="{{ route('post.create')}}" class="btn btn-primary btn-tab-header pull-right">Add new</a> -->
        <button class="btn btn-primary btn-tab-header pull-right" data-toggle="modal" data-target="#add-modal">Add post</button>
        @endcan
    </ul>

    <!-- Tab content -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab-general">
            <div class="tab-content">
                <div class="panel infolist">
                    <div class="panel-body">
                        <!-- Show datatables -->
                        <div class="box-body no-padding">
                            <table id="example" class="table table-condensed table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Author</th>
                                        <th>Categories</th>
                                        <th>Updated</th>
                                        <th>Status</th>
                                        <th>Action</th>
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


@can('post.create')
<!-- Show create form modal -->
<div class="modal fade" id="add-modal" role="dialog" aria-labelledby="configModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="configModalLabel">Add Post</h4>
            </div>
            <form action="{{ route('post.store') }}" method="POST" id="node-add-form" novalidate="novalidate" accept-charset="UTF-8">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="type" class="required">Type </label>
                            <select class="form-control" rel="select2" name="type" required>
                                <option value="blog" selected="selected">Blog</option>
                                <option value="page">Page</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" class="required">Title </label>
                            <input class="form-control" type="text" name="title" value="" required placeholder="Enter post title" data-rule-maxlength="250">
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary </label>
                            <textarea class="form-control" name="summary" placeholder="Enter post summary" data-rule-maxlength="1000" cols="30" rows="3" required></textarea>
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
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/datatables/datatables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/animate.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('admin/plugins/autoresize/autosize.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap-notify.min.js') }}"></script>
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
            url: '{{ route("post.datatable") }}',
            data: (data) => {
                data.filter = filter;
            }
        },
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search"
        },
        lengthMenu: [ 20, 50, 75, 100 ],
        pageLength: 20,
        order: [[ 4, "desc" ]],
        columns: [
            {data: "title", orderable: true},
            {data: "type", orderable: true},
            {data: "author", orderable: false},
            {data: "cates", orderable: false},
            {data: "updated", orderable: true},
            {data: "status", orderable: true},
            {data: "action", orderable: false},
        ]
    });

    // Event when user click to tab filter
    $('[data-filter]').click(function() {
        filter = $(this).data('filter');
        table.ajax.reload();
    });

    // Validate add new form
    $("#node-add-form").validate({
    });

    /**
     * Add summary auto resize
     */
    autosize($('[name="summary"]'));

    /**
     * Show success messages
     */
@if ($message = Session::get('success'))
    $.notify({
        message: '{!! $message !!}',
    }, {
        type: 'success',
        placement: {
            from: "bottom",
            align: "right"
        },
        animate: {
            enter: 'animated fadeInUp',
            exit: 'animated fadeOutDown'
        },
    });
@endif

    /**
     * Show error messages
     */
@if (count($errors) > 0)
    $.notify({
        message: '<h4><i class="ion ion-sad"></i> Alert</h4>' + 
            'Có vấn đề với dữ liệu bạn nhập, vui lòng kiểm tra lại' +
            '<ul>' +
            @foreach($errors->all() as $error)
                '<li>' +
                    '{{ $error }}' +
                '</li>' +
            @endforeach
            '</ul>'
    },{
        type: 'danger',
        placement: {
            from: "bottom",
            align: "right"
        },
        animate: {
            enter: 'animated fadeInUp',
            exit: 'animated fadeOutDown'
        },
    });
@endif

});
</script>
@endpush