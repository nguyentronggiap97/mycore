@extends('backend::layout')

@section('title', 'Post create')
@section('description', 'Post create')

@section('body:class', 'sidebar-collapse')
@section('content:class', 'no-padding')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box without-border with-toolbar">
            <div class="box-header box-command with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools box-tools-r hidden-xs">
                    <a class="btn btn-default btn-icon" href="{{ route('post.index') }}" data-toggle="tooltip" data-placement="right" title="Back to management"><i class="ion ion-ios-arrow-left" style="font-size: 24px;"></i></a>
                    <!--
                    <button type="button" class="btn btn-default btn-icon"><i class="ion ion-ios-undo" style="font-size: 24px;"></i></button>
                    <button type="button" class="btn btn-default btn-icon"><i class="ion ion-ios-redo" style="font-size: 24px;"></i></button>
                    <button type="button" class="btn btn-default btn-icon"><i class="ion ion-ios-information-outline" style="font-size: 24px;"></i></button>
                    -->

                    <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="ion ion-android-menu" style="font-size: 24px;"></i></button>
                    <ul class="dropdown-menu dropdown-margin" role="menu">
                        <li><a href="{{ route('products.export', 'xlsx') }}"><i class="fa fa-file-code-o"></i> Preview in website</a></li>
                        <li><a href="{{ route('products.export', 'pdf') }}"><i class="fa fa-file-code-o"></i> Preview in modal</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('products.template', 'template') }}"><i class="fa fa-file-code-o"></i> Download pdf</a></li>
                    </ul>
                </div>

                <div class="box-tools">
                    <a class="btn btn-default btn-right" href="{{ route('post.index') }}" style="margin-right: 6px;"> @lang('blog::messages.back')</a>
                    <button class="btn btn-default btn-right hidden-xs" data-toggle="modal" data-target="#preview-modal" onclick="return preview(this);" style="margin-right: 6px;"> @lang('blog::messages.preview')</button>
                    <button type="submit" class="btn btn-primary" style="margin-right: 12px;" id="node-save"> @lang('blog::messages.save')</button>
                    <button type="button" class="btn btn-default btn-icon"><i class="ion ion-gear-b" style="font-size: 24px;"></i></button>
                    <!--
                    <button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="ion ion-more" style="font-size: 24px;"></i></button>
                    <ul class="dropdown-menu dropdown-margin" role="menu">
                        <li><a href="{{ route('products.export', 'xlsx') }}"><i class="fa fa-file-code-o"></i> Export to excel</a></li>
                        <li><a href="{{ route('products.export', 'pdf') }}"><i class="fa fa-file-code-o"></i> Export to pdf</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('products.template', 'template') }}"><i class="fa fa-file-code-o"></i> Download excel template</a></li>
                    </ul>
                    -->
                </div>
            </div>

            <div class="box-body no-padding">
                <div class="col-xs-12 col-md-9 editor-main">
                    <div class="editor-wrapper">
                        <div class="editor-inner">
                            <div class="editable" data-placeholder="Type your text">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 sidebar-panel editor-sidebar no-padding">
                    <form id="node-form" action="{{ route('post.update', $post->id) }}" method="POST">
                        @csrf
                        @alert
                        @method('PUT')

                        <input type="submit" class="hidden" value="Save" />
                        <textarea class="hidden" name="content">{!! $post->content !!}</textarea>

                        <div class="sidebar-inner">
                            <!-- Post section -->
                            <div class="box box-solid box-label">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion ion-ios-partlysunny-outline"></i> @lang('blog::messages.post')</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="title" class="required">@lang('blog::messages.title') </label>
                                        <input class="form-control" type="text" name="title" placeholder="@lang('blog::messages.title text')" value="{{ $post->title }}" data-rule-minlength="3" data-rule-maxlength="250" required />
                                        <small class="form-text text-muted">@lang('blog::messages.title guide')</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="summary">@lang('blog::messages.summary') </label>
                                        <textarea class="form-control" name="summary" placeholder="@lang('blog::messages.summary text')" data-rule-maxlength="1024" cols="30" rows="3">{{ $post->summary }}</textarea>
                                        <small class="form-text text-muted">@lang('blog::messages.summary guide')</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="cates" class="required">@lang('blog::messages.categories') </label>
                                        <select class="form-control" data-placeholder="@lang('blog::messages.categories text')" rel="select2" name="cates[]" multiple="multiple" required>
                                            @foreach($cates as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id, $post->cates)) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">@lang('blog::messages.categories guide')</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags">@lang('blog::messages.tags') </label>
                                        <select class="form-control" data-placeholder="@lang('blog::messages.tags text')" id="select2-tags" name="tags[]" multiple="multiple">
                                            @foreach($post->tags as $item)
                                            <option value="{{ $item }}" selected>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">@lang('blog::messages.tags guide')</small>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- Book section -->
                            <div class="box box-solid box-label">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion ion-ios-partlysunny-outline"></i> @lang('blog::messages.book')</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="cates">@lang('blog::messages.product review') </label>
                                        <select class="form-control select2-product" data-placeholder="@lang('blog::messages.product review text')" rel="select2" name="pid" id="select2-product">
                                            @if($post->pid)
                                            <option value="{{ $post->pid }}" selected>{{ $post->product->name }}</option>
                                            @endif
                                        </select>
                                        <small class="form-text text-muted">@lang('blog::messages.product review guide')</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags">@lang('blog::messages.related') </label>
                                        <select class="form-control select2-product" data-placeholder="@lang('blog::messages.related text')" name="products[]" multiple="multiple" id="select2-products">
                                            @foreach($post->products as $item)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">@lang('blog::messages.related guide')</small>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- Book shipping section -->
                            <div class="box box-solid box-label">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion ion-ios-videocam-outline"></i> @lang('blog::messages.featured')</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <input type="hidden" name="thumb" value="{{ $post->thumb->id }}" />
                                    @upload(['type' => $post->type, 'name' => 'thumb', 'vendor' => $post->id, 'thumb' => $post->thumb->cache, 'text' => trans('blog::messages.featured text')])
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- Search engine optimize -->
                            <div class="box box-solid box-label">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion ion-ios-people-outline"></i> @lang('blog::messages.seo')</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="slug">@lang('blog::messages.slug') </label>
                                        <input class="form-control" type="text" name="slug" placeholder="@lang('blog::messages.slug text')" value="{{ $post->slug }}" data-rule-maxlength="250" />
                                        <small class="form-text text-muted">@lang('blog::messages.slug guide')</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="metatitle">Meta title </label>
                                        <input class="form-control" type="text" name="meta[title]" placeholder="@lang('blog::messages.meta title text')" value="{{ $post->metaTitle }}" data-rule-maxlength="250" />
                                        <small class="form-text text-muted">@lang('blog::messages.meta title guide')</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="metakeywords">Meta keywords </label>
                                        <input class="form-control" type="text" name="meta[keywords]" placeholder="@lang('blog::messages.meta keywords text')" value="{{ $post->metaKeywords }}" data-rule-maxlength="250" />
                                        <small class="form-text text-muted">@lang('blog::messages.meta keywords guide')</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescription">Meta description </label>
                                        <input class="form-control" type="text" name="meta[description]" placeholder="@lang('blog::messages.meta description text')" value="{{ $post->metaDescription }}" data-rule-maxlength="250" />
                                        <small class="form-text text-muted">@lang('blog::messages.meta description guide')</small>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- Publish section -->
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion ion-ios-flame-outline"></i> @lang('blog::messages.publish')</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="flag[new]" value="1" class="icheck-green" @if($post->flag->new) checked @end />
                                        </label>
                                        <span>&nbsp;&nbsp;@lang('blog::messages.new')</span>
                                        <br>

                                        <label>
                                            <input type="checkbox" name="flag[hot]" value="1" class="icheck-green" @if($post->flag->hot) checked @end />
                                        </label>
                                        <span>&nbsp;&nbsp;@lang('blog::messages.hot')</span>
                                        <br>

                                        <label>
                                            <input type="checkbox" name="flag[cover]" value="1" class="icheck-green" @if($post->flag->cover) checked @end />
                                        </label>
                                        <span>&nbsp;&nbsp;@lang('blog::messages.allow cover')</span>
                                        <br>

                                        <label>
                                            <input type="checkbox" name="flag[comment]" value="1" class="icheck-green" @if($post->flag->comment) checked @end />
                                        </label>
                                        <span>&nbsp;&nbsp;@lang('blog::messages.allow comment')</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">@lang('blog::messages.status') </label>
                                        <select class="form-control" rel="select2" name="status">
                                        @foreach($dataset['status'] as $value => $name)
                                            @if($post->status == $value))
                                            <option value="{{ $value }}" selected>{{ $name }}</option>
                                            @else
                                            <option value="{{ $value }}">{{ $name }}</option>
                                            @end
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview modal -->
<div class="modal fade" id="preview-modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="preview-model-title">Preview</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="type" class="required">Type </label>
                        <select class="form-control" rel="select2" name="type" required>
                            <option value="blog" selected="selected">Blog</option>
                            <option value="page">Page</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Title </label>
                        <input class="form-control" type="text" name="title" value="" required placeholder="Enter post title" data-rule-maxlength="250">
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary </label>
                        <textarea class="form-control" name="summary" placeholder="Enter post summary" data-rule-maxlength="1000" cols="30" rows="3" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Preview modal -->

@endsection

@push('styles')
<link href="{{ asset('admin/plugins/iCheck/all.css') }}" rel="stylesheet" />
<!-- <link href="{{ asset('admin/plugins/medium/editor/css/medium-editor.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/plugins/medium/editor/css/themes/default.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/plugins/medium/plugin/css/medium-editor-insert-plugin.css') }}" rel="stylesheet" /> -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor-insert-plugin/2.5.0/css/medium-editor-insert-plugin-frontend.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor-insert-plugin/2.5.0/css/medium-editor-insert-plugin.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/themes/default.min.css" rel="stylesheet" />
<style>
    .medium-insert-images figure figcaption,
    .mediumInsert figure figcaption,
    .medium-insert-embeds figure figcaption,
    .mediumInsert-embeds figure figcaption {
        font-size: 12px;
        line-height: 1.2em;
    }
    .medium-insert-images-slideshow figure {
        width: 100%;
    }
    .medium-insert-images-slideshow figure img {
        margin: 0;
    }
    .medium-insert-images.medium-insert-images-grid.small-grid figure {
        width: 12.5%;
    }
    @media (max-width: 750px) {
        .medium-insert-images.medium-insert-images-grid.small-grid figure {
            width: 25%;
        }
    }
    @media (max-width: 450px) {
        .medium-insert-images.medium-insert-images-grid.small-grid figure {
            width: 50%;
        }
    }
</style>

<style type="text/css">

    @import url('https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700&display=swap');

    #preview-modal {
        font-family: 'Muli', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 32px;
    }

    @media (min-width: 992px) {
        #preview-modal .modal-lg {
            width: 780px;
        }

        #preview-modal .modal-lg .modal-body {
            padding: 20px 50px;
        }
    }

    .btn_upload_image {
        width: 100%;
        border: 1px dashed #a2aab2 !important;
        background-color: #edeff0 !important;
    }
    .btn_upload_image i {
        display: none;
    }

    .editable {
        font-family: 'Muli', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 32px;
    }

    .box.with-toolbar {
        margin-bottom: 0px;
        border-top: none;
    }

    /*.editable, .sidebar-panel {
        overflow-y: auto;
    }*/

    /* Scroll bar style */
    ::-webkit-scrollbar {
        height: 16px;
        width: 16px;
        overflow: visible;
    }

    ::-webkit-scrollbar-button {
        height: 0px;
        width: 0px;
    }

    ::-webkit-scrollbar-corner {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        background-clip: padding-box;
        min-height: 28px;
        box-shadow: rgba(0, 0, 0, 0.1) 1px 1px 0px inset, rgba(0, 0, 0, 0.07) 0px -1px 0px inset;
        border-style: solid;
        border-color: transparent;
        border-image: initial;
        border-width: 1px 1px 1px 6px;
        padding: 100px 0px 0px;
    }

    ::-webkit-scrollbar-track {
        background-clip: padding-box;
        border-style: solid;
        border-color: transparent;
        border-image: initial;
        border-width: 0px 0px 0px 4px;
    }

    .editor-main::-webkit-scrollbar-thumb,
    .editor-sidebar::-webkit-scrollbar-thumb {
        background-color: rgb(218, 220, 224);
        box-shadow: none;
        border-style: solid;
        border-color: transparent;
        border-width: 4px;
        border-radius: 8px;
    }

    .editor-main::-webkit-scrollbar-track,
    .editor-sidebar::-webkit-scrollbar-track {
        box-shadow: none;
        margin: 0px 4px;
    }

    @media(max-width: 992px) {
        .sidebar-panel .box:first-child {
            border-top: 1px solid #f4f4f4;
        }
    }

    @media(min-width: 992px) {
        .editor-wrapper {
            padding-top: 20px;
        }
        .editor-main {
            font-family: 'Muli', sans-serif;
            position: fixed;
            background: rgb(248, 249, 250);
            overflow-y: scroll;
            top: 100px;
            bottom: 0;
            left: 50px;
            width: calc(100% - 370px);
        }
        .editor-sidebar {
            font-family: 'Muli', sans-serif;
            position: fixed;
            width: 320px;
            top: 101px;
            right: 0;
            bottom: 0;
        }
        .editor-sidebar::-webkit-scrollbar { width: 0 !important }
        .editor-sidebar:hover {
            overflow-y: auto;
        }
        .editor-inner {
            background: #fff;
            box-shadow: rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            padding: 50px;
            max-width: 80%;
        }
    }

    @media(min-width: 992px) {
        .editor-inner {
            max-width: 720px;
            margin: 0 auto;
        }
    }
</style>

@endpush

@push('scripts')
<script src="{{ asset('admin/plugins/autoresize/autosize.min.js') }}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- <script src="{{ asset('admin/plugins/medium/editor/js/medium-editor.min.js') }}"></script> -->
<!-- <script src="{{ asset('admin/plugins/medium/plugin/js/medium-editor-insert-plugin.js') }}"></script> -->
<!-- <script src="{{ asset('admin/plugins/medium/plugin/js/handlebars.runtime.min.js') }}"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.12/handlebars.runtime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.ui.widget@1.10.3/jquery.ui.widget.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.iframe-transport/1.0.1/jquery.iframe-transport.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.28.0/js/jquery.fileupload.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor-insert-plugin/2.5.0/js/medium-editor-insert-plugin.min.js"></script> -->
<script src="{{ asset('admin/plugins/medium/plugin/js/medium-editor-insert-plugin.js') }}"></script>

<script>

function preview() {
    var modal = $('#preview-modal');
    var editor = $('.editable');
    var text = editor.html();
    $('.modal-body', modal).html(text);
}

/**
 * Post edit script
 */
$(function() {
    /**
     * Tag with select2 & ajax search from server side
     */
    $("#select2-tags").select2({
        tags: true,
        language: '{{ config("app.locale") }}',
        tokenSeparators: [','],
        minimumInputLength: 1,
        ajax: {
            dataType: 'json',
            url: cedu.route('/tags/search'),
            type: 'GET',
            quietMillis: 50,
            data: function (params) {
                return {
                    q: params.term // Data send to server
                };
            },
            processResults: function (data) {
                return {results: data}; // Build data from response for select2 {id, text}
            }
        }
    });

    /**
     * Tag with select2 & ajax search from server side
     */
    $(".select2-product").select2({
        tags: true,
        language: '{{ config("app.locale") }}',
        tokenSeparators: [','],
        minimumInputLength: 0,
        ajax: {
            dataType: 'json',
            url: '{{ route("products.search") }}',
            type: 'GET',
            quietMillis: 50,
            data: function (params) {
                return {
                    q: params.term // Data send to server
                };
            },
            processResults: function (data) {
                return {results: data}; // Build data from response for select2 {id, text}
            }
        }
    });

    /**
     * iCheck for checkbox
     */
    $('input[type="checkbox"].icheck-green, input[type="radio"].icheck-green').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
    });

    /**
     * Medium editor initialize
     */
    var editor = new MediumEditor('.editable');

    $('.editable').mediumInsert({
        editor: editor,
        addons: {
            images: {
                uploadScript: null,
                deleteScript: null,
                captionPlaceholder: 'Type caption for image',
                styles: {
                    slideshow: {
                        label: '<span class="fa fa-play"></span>',
                        added: function ($el) {
                            $el
                                .data('cycle-center-vert', true)
                                .cycle({
                                    slides: 'figure'
                                });
                        },
                        removed: function ($el) {
                            $el.cycle('destroy');
                        }
                    }
                },
                actions: null,
                fileUploadOptions: {
                    url: '{{ route("media.upload") }}',
                    type: 'POST',
                    paramName: 'file',
                    singleFileUploads: true,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    formData: {
                        '_token': '{{ csrf_token() }}',
                        'type': '{{ $post->type }}',
                        'vendor': '{{ $post->id }}'
                    }
                },
                fileDeleteOptions: {},
                uploadCompleted: ($el, data) => {},
                uploadFailed: (errors, data) => {}
            },
            embeds: {
                // oembedProxy: '{{ route("embed") }}',
                oembedProxy: 'https://medium.iframe.ly/api/oembed?iframe=1&api_key=364f7b433faf41f6e3b5f0'
            }
        }
    });

    /**
     * Form validate
     */
    $("#node-form").validate({
        submitHandler: function(form) {
            var html = '';
            var content = $('[name="content"]');
            var bucket = editor.serialize();

            for (var key in bucket) {
                html += bucket[key].value;
            }

            content.val(html);
            form.submit();
        }
    });

    $('#node-save').click(function() {
        $("#node-form").submit();
    });

    /**
     * Add summary auto resize
     */
    autosize($('[name="summary"]'));

});

</script>
@endpush