<!-- Start upload widget -->
<input class="form-control" data-rule-maxlength="250" name="{{ $name }}" type="hidden" value="{{ $value }}" />
@if($thumb)
<a class="btn btn-default btn_upload_image hide" data-upload="{{ json_encode($encode) }}">
    {{ $text }} <i class="fa fa-cloud-upload"></i>
</a>
<div class="uploaded_image"><img src="{{ $thumb }}"><i title="@lang('media::messages.remove')" class="fa fa-times"></i></div>
@else
<a class="btn btn-default btn_upload_image" data-upload="{{ json_encode($encode) }}">
	{{ $text }} <i class="fa fa-cloud-upload"></i>
</a>
<div class="uploaded_image hide"><img src=""><i title="@lang('media::messages.remove')" class="fa fa-times"></i></div>
@endif
<!-- End upload widget -->