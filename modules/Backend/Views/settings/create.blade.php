@extends('backend::layout')

@section('title', 'Config create')
@section('description', 'Config create')
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
                        <h4 class="name">Add config</h4>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dats1"><i class="fa fa-heart-o"></i><div class="label2">{{ Auth::user()->name }}</div></div>
                <div class="dats1"><i class="fa fa-envelope-o"></i> {{ Auth::user()->email }}</div>
                <div class="dats1"><i class="fa fa-map-marker"></i> Sunt in Culpa</div>
            </div>
            <div class="col-md-1 actions">
                <!-- Show element actions here -->
                <!-- End: Show element actions here -->
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
                            <h4>Add Config</h4>
                        </div>
                        <div class="panel-body">
                            <!-- Show save errors message -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- End: Show errors message -->

                            <!-- Form: config edit -->
                            <form action="{{ route('settings.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="id" class="col-md-2">Key :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" placeholder="Enter config key" data-rule-maxlength="250" required="1" name="_id" type="text" value="" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="data" class="col-md-2">Data :</label>
                                    <div class="col-md-6 fvalue">
                                        <textarea class="form-control" style="height:150px" name="data" placeholder="Enter config data" data-rule-maxlength="1024" required="1" aria-required="true"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-2">Description :</label>
                                    <div class="col-md-6 fvalue">
                                        <textarea class="form-control" style="height:150px" name="description" placeholder="Enter config description" data-rule-maxlength="1024" required="1" aria-required="true"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-md-2">Status :</label>
                                    <div class="col-md-6 fvalue">
                                        {!! Form::select('status', ['0' => 'Disable', '1' => 'Enable'], '1', ['class' => 'form-control', 'rel' => 'select2']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="updated" class="col-md-2"></label>
                                    <div class="col-md-6 fvalue">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('settings.index') }}" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                            </form>
                            <!-- End: Form config edit -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
@endsection
