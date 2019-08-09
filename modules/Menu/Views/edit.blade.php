@extends('backend::layout')

@section('title', 'Menu edit')
@section('description', 'Menu edit')
@section('content:class', 'no-padding')

@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="fa fa-user-plus"></i></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="name">@lang('menu::menu.show_list')</h4>
                        <p class="desc">@lang('menu::menu.edit')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dats1"><i class="fa fa-heart-o"></i><div class="label2">{{ Auth::user()->name }}</div></div>
                <div class="dats1"><i class="fa fa-envelope-o"></i> {{ Auth::user()->email }}</div>
                <div class="dats1"><i class="fa fa-map-marker"></i> Pune, India</div>
            </div>
            <div class="col-md-1 actions">
            </div>
        </div>

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('menu.index') }}" data-toggle="tooltip" data-placement="right" title="@lang('menu::menu.show_list')"><i class="fa fa-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> @lang('messages.general')</a></li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                <div class="tab-content">
                    <!-- Show form create user -->
                    <form id="useredit-form" action="{{ route('menu.update', $node->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="panel infolist">
                            <div class="panel-default panel-heading">
                                <h4>@lang('messages.infor')</h4>
                            </div>
                            <div class="panel-body">

                                @alert()

                                <div class="form-group">
                                    <label for="name" class="col-md-2">@lang('menu::menu.name') *:</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="name" placeholder="@lang('menu::menu.name')" value="{{ $node->name }}" data-rule-minlength="3" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2">@lang('menu::menu.link') *:</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="link" placeholder="@lang('menu::menu.link')" value="{{ $node->link }}" data-rule-minlength="3" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="about" class="col-md-2">{{ __('menu::menu.parent') }} :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" data-placeholder="{{ __('menu:menu.select_parent') }}" required name="pid">
                                            <option value="0">{{ __('menu::menu.parent_root') }}</option>
                                            @foreach($menu as $value)
                                                <option {{ ($node->pid == $value['_id']) ? 'selected' : '' }} value="{{ $value['_id'] }}">{{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2">{{ __('menu::menu.sort') }} :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="number" min="1" name="sort" value="{{ $node->sort ?? 1 }}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-md-2">@lang('menu::menu.status') *:</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" rel="select2" name="status">
                                            @foreach($collection['status'] as $value => $name)
                                                <option {{ ($node->status == $value) ? 'selected' : '' }} value="{{ $value }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2"></label>
                                    <div class="col-md-6 fvalue">
                                        <button type="submit" class="btn btn-primary" style="margin-right:5px;">@lang('menu::menu.save')</button>
                                        <a class="btn btn-default" href="{{ route('menu.index') }}">@lang('menu::menu.cancel')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End: Show form create user -->
                </div>
            </div>
        </div>
    </div>
@endsection
