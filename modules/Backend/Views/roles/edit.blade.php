@extends('backend::layout')

@section('title', 'Role edit')
@section('description', 'Role edit')
@section('content:class', 'no-padding')

@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="fa fa-sitemap"></i></div>
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
                @can('role.update')
                <a href="{{ route('roles.show', $node->id) }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
                @end
                
                @can('role.delete')
                <form method="POST" action="{{ route('roles.destroy', $node->id) }}" accept-charset="UTF-8" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
                </form>
                @end
            </div>
        </div>

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('roles.index') }}" data-toggle="tooltip" data-placement="right" title="Back to roles"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#tab-access" data-target="#tab-access"><i class="fa fa-tasks"></i> Access</a></li>
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
                            
                            <!-- Form: role edit -->
                            <form action="{{ route('roles.update', $node->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="id" class="col-md-2">ID :</label>
                                    <div class="col-md-6 fvalue">{{ $node->id }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2">Name :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" placeholder="Enter role name" data-rule-maxlength="250" required="1" name="name" type="text" value="{{ $node->name }}" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-2">Description :</label>
                                    <div class="col-md-6 fvalue">
                                        <textarea class="form-control" style="height:150px" name="description" placeholder="Enter role description">{{ $node->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="level" class="col-md-2">Level :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" placeholder="Enter role level" data-rule-maxlength="3" required="1" name="level" type="number" value="{{ $node->level }}" aria-required="true">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-md-2">Status :</label>
                                    <div class="col-md-6 fvalue">
                                        {!! Form::select('status', ['0' => 'Disable', '1' => 'Enable'], $node->status, ['class' => 'form-control', 'rel' => 'select2']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="created" class="col-md-2">Created :</label>
                                    <div class="col-md-6 fvalue">{{ $node->created }}</div>
                                </div>

                                <div class="form-group">
                                    <label for="updated" class="col-md-2">Updated :</label>
                                    <div class="col-md-6 fvalue">{{ $node->updated }}</div>
                                </div>

                                <div class="form-group">
                                    <label for="updated" class="col-md-2"></label>
                                    <div class="col-md-6 fvalue">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Save</button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                            </form>
                            <!-- End: Form role edit -->
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in bg-white" id="tab-access">
                <div class="tab-content">
                    <div class="panel infolist">                        
                        <div class="panel-default panel-heading">
                            <h4>Permissions</h4>
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

                            <!-- Show datatables -->
                            <div class="box-body no-padding">
                                <form action="{{ route('roles.update', $node->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-roles table-condensed table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>
                                                    <input type="checkbox" class="perm-event" data-target=".table-roles .perms-module">&nbsp;
                                                    Module
                                                </th>
                                                @foreach($roles['columns'] as $column)
                                                <th class="text-center">
                                                    <input type="checkbox" class="perm-event perm-column" data-target=".table-roles .module-perm-{{ $column }} input">&nbsp;
                                                    {{ ucfirst($column) }}
                                                </th>
                                                @endforeach
                                            </tr>
                                            @php $i = 1; @endphp
                                            @foreach($roles['modules'] as $module => $perms)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}.</td>
                                                <td>
                                                    <input type="checkbox" class="perm-event perms-module perms-{{ $module }}" data-target=".table-roles .module-{{ $module }} input">&nbsp;
                                                    {{ ucfirst($module) }}
                                                </td>
                                                @foreach($roles['columns'] as $column)
                                                <td class="module-{{ $module }} module-perm-{{ $column }} text-center">
                                                    @isset($roles['modules'][$module][$column])
                                                    {!! Form::checkbox("perms[$module][$column]", 1, isset($node->modules[$module][$column])) !!}
                                                    @else
                                                    <span class="text-gray" style="font-size:18px;"><i class="icon ion-minus-circled"></i></span>
                                                    @end
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <div class="col-md-6 fvalue" style="margin-left: -15px;">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Save</button>
                                            <a href="{{ route('roles.index') }}" class="btn btn-warning">Back</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- End: Form role edit -->
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
@endsection

@push('scripts')
    <script>
    /**
     * Add perms event click
     * @file roles/edit
     */
    $(function () {
        $('.perm-event').change(function() {
            var target = $(this).data('target');
            var status = $(this).prop('checked');
            
            $(target).prop('checked', status).trigger('change');

            // Check for click to all module, active column
            if (target.indexOf('perms-module') > 0) {
                $('.table-roles .perm-column').prop('checked', status)
            }
        });
    });
    </script>
@endpush