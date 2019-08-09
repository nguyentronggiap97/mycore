@extends('backend::layout')

@section('title', 'Permissions')
@section('description', 'Permissions listing')

@section('content:class', 'no-padding')
@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="ion ion-ios-filing"></i></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="name">Permissions</h4>
                        <p class="desc">Show module permissions</p>
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
            <li class=""><a href="{{ route('roles.index') }}" data-toggle="tooltip" data-placement="right" title="Back to roles"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                <div class="tab-content">
                    <div class="panel infolist">
                        <!--
                        <div class="panel-default panel-heading">
                            <h4>Add Config</h4>
                        </div>
                        -->
                        <div class="panel-body">
                            <!-- Show datatables -->
                            <div class="box-body no-padding">
                                <table class="table table-condensed table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Module</th>
                                            @foreach($roles['columns'] as $column)
                                            <th class="text-center">{{ ucfirst($column) }}</th>
                                            @endforeach
                                        </tr>
                                        @php $i = 1; @endphp
                                        @foreach($roles['modules'] as $module => $perms)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}.</td>
                                            <td>{{ ucfirst($module) }}</td>
                                            @foreach($roles['columns'] as $column)
                                            <td class="text-center">
                                                @isset($perms[$column])
                                                <span class="text-green" style="font-size:18px;"><i class="icon ion-ios-checkmark"></i></span>
                                                @else
                                                <span class="text-gray" style="font-size:18px;"><i class="icon ion-minus-circled"></i></span>
                                                @end
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
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
        $("#example1").DataTable({
            processing: false,
            serverSide: false,
            paging: false,
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search"
            }
        });
    });
    </script>
@endpush