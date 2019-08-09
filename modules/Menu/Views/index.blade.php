@extends('backend::layout')

@section('title', 'Menu')
@section('description', 'Menu management')

@section('content:class', 'no-padding')
@section('content')
    <div id="page-content" class="profile2">

        @include('store::partials.header', ['publisher' => $publisher])

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general" data-target="#tab-general" data-filter=""><i class="fa fa-bars"></i> @lang('menu::menu.all')</a></li>
            @can('menu.create')
            <a href="{{ route('menu.create') }}" class="btn btn-success btn-sm pull-right btn-add-field" style="margin-top:10px;margin-right:10px;"> @lang('menu::menu.create')</a>
            @end
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab-general">
                <div class="tab-content">
                    <div class="col-xs-12" style="margin-top: 15px;">
                        @alert()
                    </div>

                    <div class="panel infolist">
                        <div class="panel-body">
                            <!-- Show datatables -->
                            <div class="box-body no-padding">
                                <table id="example" class="table table-condensed table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('menu::menu.name')</th>
                                            <th class="text-center">@lang('menu::menu.link')</th>
                                            <th class="text-center">@lang('menu::menu.sort')</th>
                                            <th class="text-center">@lang('menu::menu.status')</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($listAll)) {
                                                foreach ($listAll as $val) {
                                        ?>
                                                    <tr>
                                                        <td><a href="{{ route('menu.show', $val->_id) }}" title="@lang('menu::menu.link')">{{ $val->name }}</a></td>
                                                        <td>{{ $val->link }}</td>
                                                        <td>{{ $val->sort }}</td>
                                                        <th>{!! \Modules\Menu\Controllers\MenuController::getMarkupStatus($val) !!}</th>
                                                        <th>{!! \Modules\Menu\Controllers\MenuController::getMarkupAction($val) !!}</th>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        ?>
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
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/datatables/datatables.min.css') }}"/>
@endpush
