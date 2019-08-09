<!-- Start uploader multiple images -->
<div id="fm_dropzone_main" data-vendor="{{ $vendor }}" data-upload="{{ json_encode($encode) }}">
    <div class="dz-message"><i class="fa fa-cloud-upload"></i><br>@lang('media::messages.message')</div>
</div>

<div class="box box-success">
	<div class="box-body">
		<ul class="files_container">
            @foreach([] as $item)
            <li>
                <a class="fm_file_sel" data-toggle="tooltip" data-placement="top" data-original-title="heavens_gate.jpg" upload="@json($item)">
                    <img src="{{ $item['src'] }}">
                </a>
            </li>
            @endforeach
        </ul>
	</div>
</div>
<!-- End uploader multiple images -->

@push('scripts')
<!-- Start uploader edit image -->
<div class="modal fade" id="EditFileModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="max-width: 1440px;">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
				<h4 class="modal-title" id="myModalLabel">@lang('media::messages.file'): </h4>
			</div>
			<div class="modal-body p0">
                    <div class="row m0 modal-flex">
                        <div class="col-xs-12 col-sm-8 col-md-8" style="flex: 1">
                            <div class="fileObject">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4" style="flex: 0.4;background: #f3f3f3; border-left: solid 1px #ddd;">
                            <form method="POST" action="{{ route('media.update') }}" accept-charset="UTF-8" class="file-info-form" style="min-height: 30px;">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="0">
                                <div class="form-group">
                                    <label for="filename">@lang('media::messages.name')</label>
                                    <input class="form-control" placeholder="File Name" name="filename" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="url">@lang('media::messages.url')</label>
                                    <input class="form-control" placeholder="URL" name="url" type="text" readonly value="">
                                </div>
                                <div class="form-group">
                                    <label for="caption">@lang('media::messages.label')</label>
                                    <input class="form-control" placeholder="Caption" name="caption" type="text" value="">
                                </div>
                            </form>
                        </div>
                    </div><!--.row-->
			</div>
			<div class="modal-footer">
                <a class="btn btn-success btn-image-download hidden-xs" href="" target="_blank" download>Download</a>
                <a class="btn btn-warning btn-image-preview" href="" target="_blank">Thumb</a>
				@can("media.delete")
                <button type="button" class="btn btn-danger" id="delFileBtn">Delete</button>
				@end
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End uploader edit image -->
@endpush

@push('styles')
<style type="text/css">
/*Style for media edit popup */
@media(min-width: 768px) {
    .modal-flex {
        display: flex;
    }
}
/* End style for media edit popup */
</style>
@endpush

@push('scripts')
<!-- Media upload multiple script -->
<script>

var cedu = cedu || {};

cedu.dropzones = null;
cedu.uploads = {
    selector: '#fm_dropzone_main',
    files: null,
    uploaded: function() {},
    deleted: function() {}
};

$(function () {
    /**
     * Show dropzone upload section
     */
    $(cedu.uploads.selector).slideDown();

    /**
     * Initialize dropzone instance
     */
	cedu.dropzones = new Dropzone(cedu.uploads.selector, {
        url: "{{ route('media.upload') }}",
        maxFilesize: 100, // 100M
        resizeWidth: '{{ config("media.max.width") }}',
        resizeHeight: '{{ config("media.max.height") }}',
        resizeQuality: 1.0,
        resizeMethod: 'contain',
        autoDiscover: false,
        acceptedFiles: "image/*",
        init: function() {
            this.on("complete", function(file) {
                this.removeFile(file);
            });
            this.on("success", function(file) {
                console.log("addedfile");
                console.log(file);
                cedu.uploads.getUploadedFiles();
            });
            this.on('sending', function(file, xhr, formData) {
                // Get upload metadata
                var upload = $("#fm_dropzone_main").data('upload');

                formData.append("_token", "{{ csrf_token() }}");
                formData.append("uid",      upload.uid);
                formData.append("type",     upload.type);
                formData.append("vendor",   upload.vendor);
                formData.append("private",  upload.private);

                console.log('[uploader] upload data', formData);
            });
        }
    });
    
    /**
     * Event when user select a image in container
     * Show image modal dialog to edit
     */
    $("body").on("click", "ul.files_container .fm_file_sel", function() {
        // Decode media json string to object
        var media  = $(this).attr("upload");
        var upload = JSON.parse(media);

        console.log("[uploads] select file:", upload);

        $("#EditFileModal .modal-title").html("File: " + upload.name);
        $(".file-info-form input[name=id]").val(upload.id);
        $(".file-info-form input[name=filename]").val(upload.name);
        $(".file-info-form input[name=url]").val(upload.link);
        $(".file-info-form input[name=caption]").val(upload.caption);
        $("#EditFileModal .btn-image-download").attr("href", upload.link);
        $("#EditFileModal .btn-image-preview").attr("href", upload.link);
        
        $("#EditFileModal .fileObject").empty();

        // Show image preview 
        if($.inArray(upload.ext, ["jpg", "jpeg", "png", "gif", "bmp"]) > -1) {
            $("#EditFileModal .fileObject").append('<img src="' + upload.link + '" style="max-height:90vh; padding: 0px 15px;" />');
            $("#EditFileModal .fileObject").css("padding", "15px 0px");
        } else {
            switch (upload.ext) {
                case "pdf":
                    // TODO: Object PDF
                    $("#EditFileModal .fileObject").append('<object width="100%" height="325" data="' + upload.link + '"></object>');
                    $("#EditFileModal .fileObject").css("padding", "0px");
                    break;
                default:
                    $("#EditFileModal .fileObject").append('<i class="fa fa-file-text-o"></i>');
                    $("#EditFileModal .fileObject").css("padding", "15px 0px");
                    break;
            }
        }
        $("#EditFileModal").modal("show");
    });
    
    /**
     * Event update media caption when blur
     */
    $(".file-info-form input[name=caption]").on("blur", function() {
        // TODO: Update Caption
        $.ajax({
            url: "{{ route('media.update') }}",
            method: 'POST',
            data: $("form.file-info-form").serialize(),
            success: function( data ) {
                console.log('[uploads] update', data);
                cedu.uploads.getUploadedFiles();
            }
        });
    });
    
    /**
     * Event delete media click
     */
    $("#EditFileModal #delFileBtn").on("click", function() {
        if(confirm("Delete image "+$(".file-info-form input[name=filename]").val()+" ?")) {
            $.ajax({
                url: "{{ route('media.delete') }}",
                method: 'POST',
                data: $("form.file-info-form").serialize(),
                success: function( data ) {
                    console.log('[uploads] delete', data);
                    cedu.uploads.getUploadedFiles();
                    $("#EditFileModal").modal('hide');
                }
            });
        }
    });
	
    cedu.uploads.getUploadedFiles();
});

cedu.uploads.getUploadedFiles = function() {
    // Get uploader metadata
    var upload = $("#fm_dropzone_main").data('upload');

    console.log('[uploader] upload object', upload);

    // load folder files
    $.ajax({
        dataType: 'json',
        url: cedu.url("/media/uploaded?" + jQuery.param(upload)),
        success: function ( json ) {
            // Show debug information
            console.log('[uploads] files', json);

            // Save to uploads object
            cedu.uploads.files = json.uploads;

            $("ul.files_container").empty();

            if(cedu.uploads.files.length) {
                for (var index = 0; index < cedu.uploads.files.length; index++) {
                    var el = cedu.uploads.files[index];
                    var li = cedu.uploads.getThumb(el);
                    $("ul.files_container").append(li);
                }
            } else {
                $("ul.files_container").html("<div class='text-center text-danger' style='margin-top:40px;'>You do not have image files</div>");
            }
        }
    });
}

cedu.uploads.getThumb = function(upload) {
    var image = '';
    if($.inArray(upload.ext, ["jpg", "jpeg", "png", "gif", "bmp"]) > -1) {
        image = '<img src="' + upload.thumb + '" />';
    } else {
        switch (upload.ext) {
            case "pdf":
                image = '<i class="fa fa-file-pdf-o"></i>';
                break;
            default:
                image = '<i class="fa fa-file-text-o"></i>';
                break;
        }
    }
    return '<li><a class="fm_file_sel" data-toggle="tooltip" data-placement="top" title="'+upload.name+'" upload=\''+JSON.stringify(upload)+'\'>'+image+'</a></li>';
}
</script>
<!-- End media upload multiple script -->
@endpush