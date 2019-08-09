@extends('backend::layout')

@section('title', 'Config view')
@section('description', 'Config view')
@section('content:class', 'no-padding')

@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="fa fa-university"></i></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="name">{{ $node->id }}</h4>
                        <p class="desc">{{ $node->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dats1"><i class="fa fa-heart-o"></i><div class="label2">{{ Auth::user()->name }}</div></div>
                <div class="dats1"><i class="fa fa-envelope-o"></i> {{ Auth::user()->email }}</div>
                <div class="dats1"><i class="fa fa-map-marker"></i> Pune, India</div>
            </div>
            <div class="col-md-1 actions">
                @can('config.update')
                <a href="{{ route('settings.edit', $node->id) }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
                @end
                
                @can('config.delete')
                <form method="POST" action="{{ route('settings.destroy', $node->id) }}" accept-charset="UTF-8" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
                </form>
                @end
            </div>
        </div>

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('settings.index') }}" data-toggle="tooltip" data-placement="right" title="Back to Configurations"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
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
                                <label for="id" class="col-md-2">Key :</label>
                                <div class="col-md-10 fvalue">{{ $node->id }}</div>
                            </div>
                            <div class="form-group">
                                <label for="data" class="col-md-2">Data :</label>
                                <div class="col-md-10 fvalue">{{ $node->data }}</div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-2">Description :</label>
                                <div class="col-md-10 fvalue">{{ $node->description }}</div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-2">Status :</label>
                                <div class="col-md-10 fvalue">
                                    @if($node->status == 1)
                                    <span class="label label-success">Enable</span>
                                    @else
                                    <span class="label label-danger">Disable</span>
                                    @end
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created" class="col-md-2">Created :</label>
                                <div class="col-md-10 fvalue">{{ $node->created }}</div>
                            </div>

                            <div class="form-group">
                                <label for="updated" class="col-md-2">Updated :</label>
                                <div class="col-md-10 fvalue">{{ $node->updated }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
@endsection
