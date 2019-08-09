@extends('backend::layout')

@section('title', 'User create')
@section('description', 'User create')
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
                        <h4 class="name">@lang('messages.user_name')</h4>
                        <p class="desc">@lang('messages.create') @lang('messages.user_name')</p>
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
            <li class=""><a href="{{ route('users.index') }}" data-toggle="tooltip" data-placement="right" title="@lang('messages.back') @lang('messages.user_name')"><i class="ion ion-chevron-left"></i></a></li>
            <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General</a></li>
        </ul>
        
        <!-- Tab content -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                <div class="tab-content">
                    <!-- Show form create user -->
                    <form id="user-form" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="panel infolist">
                            <div class="panel-default panel-heading">
                                <h4>Profile</h4>
                            </div>
                            <div class="panel-body">
                                
                                @alert()

                                <div class="form-group">
                                    <label for="name" class="col-md-2">@lang('messages.user.name') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="name" placeholder="Enter user name" value="" data-rule-minlength="3" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="col-md-2">@lang('messages.user.gender') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" required="1" data-placeholder="Select gender" rel="select2" name="gender">
                                        @foreach($collection['gender'] as $value => $name)
                                            <option value="{{ $value }}">{{ $name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-md-2">@lang('messages.user.mobile') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="mobile" placeholder="Enter user mobile" value="" data-rule-minlength="6" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-2">@lang('messages.user.email') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="email" placeholder="Enter user email" value="" data-rule-minlength="6" data-rule-maxlength="250" required="1" aria-required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id" class="col-md-2">@lang('messages.user.password') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" placeholder="Enter new password" name="password" type="password" value="" data-rule-minlength="8" data-rule-maxlength="250" required="1" aria-required="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2">@lang('messages.user.confirm_password') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" placeholder="Retype new password" name="password_confirmation" type="password" value="" data-rule-minlength="8" data-rule-maxlength="250" required="1" aria-required="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="col-md-2">@lang('messages.user.city') :</label>
                                    <div class="col-md-6 fvalue">
                                        <input class="form-control" type="text" name="location[city]" placeholder="Enter user city" value="" data-rule-minlength="2" data-rule-maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-md-2">@lang('messages.user.address') :</label>
                                    <div class="col-md-6 fvalue">
                                    <input class="form-control" type="text" name="location[address]" placeholder="Enter user address" value="" data-rule-minlength="2" data-rule-maxlength="250">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="about" class="col-md-2">@lang('messages.user.about') :</label>
                                    <div class="col-md-6 fvalue">
                                        <textarea class="form-control" style="height:100px" name="about" placeholder="Enter user about" data-rule-maxlength="1024" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-datepicker">
                                    <label for="birthday" class="col-md-2">@lang('messages.user.birth_day') :</label>
                                    <div class="col-md-6 fvalue">
                                        <div class="input-group" id='datetimepicker'>
                                            <input class="form-control" placeholder="Enter date of birth" name="birthday" type="text" value="" aria-invalid="false">
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
                                        <select class="form-control" data-placeholder="Select Role" rel="select2" name="roles[]" multiple="multiple">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End: Check for user roles -->

                                <!-- Check for user has supplier -->
                                <div class="form-group">
                                    <label for="suppliers" class="col-md-2">@lang('messages.user.suppliers') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" data-placeholder="Select Suppliers" rel="select2" name="suppliers[]" multiple="multiple">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End: Check for user has supplier -->

                                <!-- Check for user has retailer -->
                                <div class="form-group">
                                    <label for="retailers" class="col-md-2">@lang('messages.user.retailers') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" data-placeholder="Select Retailers" rel="select2" name="retailers[]" multiple="multiple">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End: Check for user has retailer -->

                                <div class="form-group">
                                    <label for="status" class="col-md-2">@lang('messages.status') :</label>
                                    <div class="col-md-6 fvalue">
                                        <select class="form-control" data-placeholder="Select status" rel="select2" name="status">
                                            @foreach($collection['status'] as $value => $name)
                                            <option value="{{ $value }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2"></label>
                                    <div class="col-md-6 fvalue">
                                        <button type="submit" class="btn btn-primary" style="margin-right:5px;">@lang('messages.save')</button>
                                        <a class="btn btn-default" href="{{ route('users.index') }}">@lang('messages.cancel')</a>
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
        $("#user-form").validate({});
        $("#datetimepicker").datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: '1992'
        });
    });
    </script>
@endpush