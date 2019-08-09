@push('scripts')
<script src="{{ asset('admin/plugins/dropzone/dropzone.js') }}"></script>
@endpush

<div class="modal fade" id="fm" role="dialog" aria-labelledby="fileManagerLabel">
	<div class="modal-dialog" role="document" style="width: 90vw; max-width: 1024px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="fileManagerLabel">Select File</h4>
			</div>
			<div class="modal-body p0">
				<div class="row">
					<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="fm_folder_selector">
							<form action="{{ route('media.upload') }}" id="fm_dropzone" enctype="multipart/form-data" method="POST" style="border: none;">
								{{ csrf_field() }}

								<!-- Save uploader metadata here -->
								<input type="hidden" id="upload-data" value="" />
								<input type="hidden" id="upload-data-uid" value="" />
								<input type="hidden" id="upload-data-type" value="" />
								<input type="hidden" id="upload-data-name" value="" />
								<input type="hidden" id="upload-data-vendor" value="" />
								<!-- End save uploader metadata -->

								<div class="dz-message"><i class="fa fa-cloud-upload"></i><br>Drop files here to upload</div>
							</form>
						</div>
					</div>
					<div class="col-xs-9 col-sm-9 col-md-9 pl0">
						<div class="nav">
							<div class="row">
								<div class="col-xs-2 col-sm-7 col-md-7"></div>
								<div class="col-xs-10 col-sm-5 col-md-5">
									<input type="search" class="form-control pull-right" placeholder="Search file name">
								</div>
							</div>
						</div>
						<div class="fm_file_selector">
							<ul>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>