@extends('backend::layout')

@section('title', 'User view')
@section('description', 'User view')
@section('content:class', 'no-padding')

@section('content')
    <div id="page-content" class="profile2">
        <!-- Header information section -->
        <div class="bg-primary clearfix">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-icon text-primary"><i class="fa fa-user"></i></div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="name">{{ $node->name }}</h4>
                        <p class="desc">ID: {{ $node->id }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dats1"><i class="fa fa-heart-o"></i><div class="label2">{{ Auth::user()->name }}</div></div>
                <div class="dats1"><i class="fa fa-envelope-o"></i> {{ Auth::user()->email }}</div>
                <div class="dats1"><i class="fa fa-map-marker"></i> Pune, India</div>
            </div>
            <div class="col-md-1 actions">
                @can('user.update', $node)
                <a href="{{ route('users.edit', $node->id) }}" class="btn btn-xs btn-edit btn-default" data-toggle="tooltip" data-placement="left" title="Edit user"><i class="fa fa-pencil"></i></a><br>
                @end
                
                @can('user.delete', $node)
                <form method="POST" action="{{ route('users.destroy', $node->id) }}" accept-charset="UTF-8" style="display:inline" data-toggle="tooltip" data-placement="left" title="Delete user">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
                </form>
                @end
            </div>
        </div>

        <!-- Tab header -->
        <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
            <li class=""><a href="{{ route('users.index') }}" data-toggle="tooltip" data-placement="right" title="Back to users"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#tab-payment" data-target="#tab-payment"><i class="fa fa-credit-card"></i> Payment</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#tab-access" data-target="#tab-access"><i class="fa fa-tasks"></i> Access</a></li>
            <li class=""><a role="tab" data-toggle="tab" href="#tab-password" data-target="#tab-password"><i class="fa fa-tasks"></i> Password</a></li>
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
                                <label for="name" class="col-md-2">Name :</label>
                                <div class="col-md-10 fvalue">{{ $node->name }}</div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-md-2">Gender :</label>
                                <div class="col-md-10 fvalue">{{ $node->gender }}</div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2">Mobile :</label>
                                <div class="col-md-10 fvalue">
                                    <a href="tel:{{ $node->mobile }}" target="_blank">{{ $node->mobile }}</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2">Email :</label>
                                <div class="col-md-10 fvalue">
                                    <a href="mailto:{{ $node->email }}">{{ $node->email }}</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-md-2">City :</label>
                                <div class="col-md-10 fvalue">
                                    {{ $node->city }}
                                    <a target="_blank" class="pull-right btn btn-xs btn-primary btn-circle" href="https://www.google.com/maps?q={{ str_replace(' ', '+', $node->city) }}" data-toggle="tooltip" data-placement="left" title="" data-original-title="Check location on Map"><i class="fa fa-map-marker"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-md-2">Address :</label>
                                <div class="col-md-10 fvalue">
                                    {{ $node->address }}
                                    <a target="_blank" class="pull-right btn btn-xs btn-primary btn-circle" href="https://www.google.com/maps?q={{ str_replace(' ', '+', $node->address) }}" data-toggle="tooltip" data-placement="left" title="" data-original-title="Check location on Map"><i class="fa fa-map-marker"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="about" class="col-md-2">About :</label>
                                <div class="col-md-10 fvalue">{{ $node->about }}</div>
                            </div>
                            <div class="form-group">
                                <label for="birthday" class="col-md-2">Date of Birth :</label>
                                <div class="col-md-10 fvalue">{{ $node->birthday }}</div>
                            </div>
                            <div class="form-group">
                                <label for="roles" class="col-md-2">Roles :</label>
                                <div class="col-md-10 fvalue">
                                    @foreach($node->roles as $item)
                                    <a href="{{ route('users.show', $item) }}" class="label label-primary">{{ $item }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-2">Status :</label>
                                <div class="col-md-10 fvalue">
                                    @if($node->status == 1)
                                    <span class="label label-success">{{ $collection['status'][$node->status] }}</span>
                                    @elseif($node->status == 0)
                                    <span class="label label-warning">{{ $collection['status'][$node->status] }}</span>
                                    @else
                                    <span class="label label-danger">{{ $collection['status'][$node->status] }}</span>
                                    @end
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created" class="col-md-2">Avatar :</label>
                                <div class="col-md-6 fvalue">
                                    <div class="uploaded_image"><img src="{{ $node->avatar->thumb }}"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="created" class="col-md-2">Cover :</label>
                                <div class="col-md-6 fvalue">
                                    <div class="uploaded_image"><img src="{{ $node->cover->thumb }}"></div>
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
            <div role="tabpanel" class="tab-pane fade in" id="tab-payment">
                <div class="tab-content">
                    <!-- Show user payment information -->
                    <div class="panel infolist">
                        <div class="panel-default panel-heading">
                            <h4>Payment Information</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2">Bank Name :</label>
                                <div class="col-md-10 fvalue">{{ $node->payment['bank'] ?? 'N/A' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2">Bank Branch :</label>
                                <div class="col-md-10 fvalue">{{ $node->payment['branch'] ?? 'N/A' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-md-2">Bank Province:</label>
                                <div class="col-md-10 fvalue">{{ $node->payment['province'] ?? 'N/A' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2">Bank Owner :</label>
                                <div class="col-md-10 fvalue">{{ $node->payment['owner'] ?? 'N/A' }}</div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2">Bank Number:</label>
                                <div class="col-md-10 fvalue">{{ $node->payment['number'] ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- EndShow user payment information -->
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade in bg-white" id="tab-access">
                <div class="tab-content">
                    <div class="panel infolist">                        
                        <div class="panel-default panel-heading">
                            <h4>Permissions</h4>
                        </div>
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
                                                @isset($node->perms[$module . '.' . $column])
                                                <span class="text-green" style="font-size:18px;"><i class="icon ion-ios-checkmark"></i></span>
                                                @elseif(isset($perms[$column]))
                                                <span class="text-red" style="font-size:18px;"><i class="icon ion-ios-close"></i></span>
                                                @else
                                                <span class="text-gray" style="font-size:18px;"><i class="icon ion-minus-circled"></i></span>
                                                @endif
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
            <div role="tabpanel" class="tab-pane fade in" id="tab-password">
                <div class="tab-content">
                    <!-- Show form change user password -->
                    <form id="password-form" action="{{ route('users.password', $node->id) }}#tab-password" method="POST">
                        @csrf
                        <div class="panel infolist">
                            <div class="panel-default panel-heading">
                                <h4>Change password</h4>
                            </div>
                            <div class="panel-body">
                                
                                @alert()

                                <div class="form-group">
                                    <label for="id" class="col-xs-2 col-md-2 col-lg-2">Password :</label>
                                    <div class="col-xs-10 col-md-6 col-lg-4 fvalue">
                                        <input class="form-control" placeholder="Enter new password" name="password" type="password" value="" data-rule-minlength="8" data-rule-maxlength="250" required="1" aria-required="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-xs-2 col-md-2 col-lg-2">Confirm :</label>
                                    <div class="col-xs-10 col-md-6 col-lg-4 fvalue">
                                        <input class="form-control" placeholder="Retype new password" name="password_confirmation" type="password" value="" data-rule-minlength="8" data-rule-maxlength="250" required="1" aria-required="true" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> Change Password</button>
                            </div>
                        </div>
                    </form>
                    <!-- End: Show form change user password -->
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
     * Change password validate form
     * @file users/show
     */
    $(function () {
        $("#password-form").validate({});
    });
    </script>
@endpush