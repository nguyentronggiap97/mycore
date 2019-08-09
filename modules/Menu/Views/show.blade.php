@extends('backend::layout')

@section('title', 'Category view')
@section('description', 'Category view')
@section('content:class', 'no-padding')

@section('content')
    <div id="page-content" class="profile2">
        @include('store::partials.header', ['publisher' => $publisher])

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('menu.index') }}" data-toggle="tooltip" data-placement="right" title="@lang('menu::menu.show_list')"><i class="fa fa-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general" data-target="#tab-general" data-filter=""><i class="fa fa-bars"></i> @lang('menu::menu.edit')</a></li>
            @can('menu.create')
            <a href="{{ route('menu.create') }}" class="btn btn-success btn-sm pull-right btn-add-field" style="margin-top:10px;margin-right:10px;"> @lang('menu::menu.create')</a>
            @end
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                <div class="tab-content">
                    <div class="panel infolist">
                        <div class="panel-default panel-heading">
                            <h4>General</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2">ID :</label>
                                <div class="col-md-10 fvalue">{{ $node->id }}</div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2">{{ __('menu::menu.name') }} :</label>
                                <div class="col-md-10 fvalue">{{ $node->name }}</div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2">{{ __('menu::menu.link') }} :</label>
                                <div class="col-md-10 fvalue">{{ $node->link }}</div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-2">{{ __('menu::menu.status') }} :</label>
                                <div class="col-md-10 fvalue">
                                    @foreach($collection['status'] as $value => $name)
                                        @if($value == $node->status)
                                            {{ $name }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created" class="col-md-2">Created :</label>
                                <div class="col-md-10 fvalue">{{ $node->created_at }}</div>
                            </div>

                            <div class="form-group">
                                <label for="updated" class="col-md-2">Updated :</label>
                                <div class="col-md-10 fvalue">{{ $node->updated_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
