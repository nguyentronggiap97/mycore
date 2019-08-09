@extends('backend::layout')

@section('title', 'User edit')
@section('description', 'User edit')
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
                @can('user.view', $node)
                <a href="{{ route('users.show', $node->id) }}" class="btn btn-xs btn-edit btn-default" data-toggle="tooltip" data-placement="left" title="Show user"><i class="fa fa-eye"></i></a><br>
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
            <li class=""><a href="{{ route('users.index') }}" data-toggle="tooltip" data-placement="right" title="@lang('messages.back') @lang('messages.user_name')"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
        </ul>
        
        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                <div class="tab-content">
                    <!-- Show form change user password -->
                    <form id="useredit-form" action="{{ route('users.update', $node->id) }}#tab-password" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="panel infolist">
                            <div class="panel-default panel-heading">
                                <h4>Editable</h4>
                            </div>
                            <div class="panel-body">

                                @alert()

                                <div class="form-group">
                                    <label for="id" class="col-md-2">ID :</label>
                                    <div class="col-md-6 fvalue">{{ $node->id }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2">@lang('messages.user.name') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="name" placeholder="Enter user name" value="{{ $node->name }}" data-rule-minlength="3" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="col-md-2">@lang('messages.user.gender') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select gender" rel="select2" name="gender">
                                        @foreach($collection['gender'] as $value => $name)
                                            @if($node->gender == $value))
                                                <option value="{{ $value }}" selected>{{ $name }}</option>
                                            @else
                                                <option value="{{ $value }}">{{ $name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-md-2">@lang('messages.user.mobile') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="mobile" placeholder="Enter user mobile" value="{{ $node->mobile }}" data-rule-minlength="6" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="email" class="col-md-2">@lang('messages.user.email') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" placeholder="Enter user email" value="{{ $node->email }}" data-rule-minlength="6" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="col-md-2">@lang('messages.user.city') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="location[city]" placeholder="Enter user city" value="{{ $node->city }}" data-rule-minlength="2" data-rule-maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-md-2">@lang('messages.user.address') :</label>
                                    <div class="col-md-6 fvalue">
                                    <input class="form-control" type="text" name="location[address]" placeholder="Enter user address" value="{{ $node->address }}" data-rule-minlength="2" data-rule-maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="about" class="col-md-2">@lang('messages.user.about') :</label>
                                    <div class="col-md-6 fvalue">
                                        <textarea class="form-control" style="height:100px" name="about" placeholder="Enter user about" data-rule-maxlength="1024" cols="30" rows="3">{{ $node->about }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group form-datepicker">
                                    <label for="birthday" class="col-md-2">@lang('messages.user.birth_day') :</label>
                                    <div class="col-md-6 fvalue">
                                        <div class="input-group" id='datetimepicker'>
                                            <input class="form-control" placeholder="Enter date of birth" name="birthday" type="text" value="{{ date('Y-m-d', strtotime($node->birthday)) }}" aria-invalid="false">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Check for user roles -->
                                <div class="form-group">
                                    <label for="roles" class="col-md-2">@lang('messages.roles') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select Role" rel="select2" name="roles[]" multiple="multiple">
                                        @foreach($roles as $role)
                                            @if($node->has($role->id))
                                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End: Check for user roles -->

                                <!-- Check for user has supplier -->
                                @if($node->has('supplier'))
                                <div class="form-group">
                                    <label for="retailers" class="col-md-2">@lang('messages.user.suppliers') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select Suppliers" rel="select2" name="suppliers[]" multiple="multiple">
                                        @foreach($roles as $role)
                                            @if($node->has($role->id))
                                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <!-- End: Check for user has supplier -->

                                <!-- Check for user has retailer -->
                                @if($node->has('retailer'))
                                <div class="form-group">
                                    <label for="retailers" class="col-md-2">@lang('messages.user.retailers') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select Retailers" rel="select2" name="retailers[]" multiple="multiple">
                                        @foreach($roles as $role)
                                            @if($node->has($role->id))
                                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <!-- End: Check for user has retailer -->

                                <div class="form-group">
                                    <label for="status" class="col-md-2">@lang('messages.status') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select status" rel="select2" name="status">
                                        @foreach($collection['status'] as $value => $name)
                                            @if($node->status == $value))
                                                <option value="{{ $value }}" selected>{{ $name }}</option>
                                            @else
                                                <option value="{{ $value }}">{{ $name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="created" class="col-md-2">Avatar :</label>
                                    <div class="col-md-6 fvalue">
                                        @upload(['type' => 'avatar', 'vendor' => Auth::user()->id, 'name' => 'avatar', 'thumb' => $node->avatar->thumb])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="created" class="col-md-2">Cover :</label>
                                    <div class="col-md-6 fvalue">
                                        @upload(['type' => 'cover', 'vendor' => Auth::user()->id, 'name' => 'cover', 'thumb' => $node->cover->thumb])
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
                                    <label class="col-md-2"></label>
                                    <div class="col-md-6 fvalue">
                                        <button type="submit" class="btn btn-primary" style="margin-right:5px;">Update</button>
                                        <a class="btn btn-warning" href="#" onclick="return cedu.back();" style="margin-right:5px;">Back</a>
                                        <a class="btn btn-default" href="{{ route('users.index') }}">Cancel</a>
                                    </div>
                                </div>
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
        $("#useredit-form").validate({});
        $("#datetimepicker").datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    </script>
@endpush