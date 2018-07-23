@extends('blank')

@section('content')
        <div id="page-wrapper">
            <!--<div class="row">-->
            @foreach($files as $file)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="https://javfree.me/?s={{$file->filename}}" target="_blank">{{$file->filename}}</a>
                    </div>
                    <div class="panel-body" style="height: 320px">
                        <a href="http://{{$file->host . $file->path . $file->filename}}.{{$file->extension}}" target="_blank">
                            <img src="http://{{$file->host}}{{$file->path}}{{($file->filename == "") ? $file->filename. '.jpg' : $file->photo_name}}" class="img-round img-responsive">
                        </a>
                        @foreach(explode(",", $file->tags) as $file_tag)
                        <a href="https://media.aqua.tw/search/{{urlencode($file_tag)}}">{{$file_tag}}</a> 
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <a href="" target="_blank" type="submit" class="btn btn-danger btn-xs">
                        <i class="fa fa-remove"> </i> Delete
                        </a>
                        <a href="" target="_blank" type="submit" class="btn btn-primary btn-xs edt" data-toggle="modal" data-target="#myModal" data-filename="{{$file->filename}}" data-id="{{$file->ID}}" data-photo_name="{{$file->photo_name}}">
                        <input type="hidden" id="{{$file->ID}}" value=“{{$file->tags}}">
                        <input type="hidden" id="path“{{$file->ID}}" value=“{{$file->path}}">
                        <input type="hidden" id="photo_name“{{$file->ID}}" value=“{{$file->photo_name}}">
                        <i class="fa fa-edit"> </i> Edit
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-4 -->
            @endforeach
            <!--</div>-->
            {{ $files->links() }}


            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Tags</h4>
                    </div>
                    <div class="modal-body col-xs-12">
                        <div>
                        <img id="img_edit" src="images/user.png" alt="" onerror="load_again();" class="img-responsive">
                        </div>
                        <form id="tags_form">
                        <input type="hidden" name="filename" id="filename">
                        <input type="hidden" name="file_id" id="file_id">
                        <div class="col-xs-12 col-sm-12">
                            <input id="tags" name="tags" type="text" class="form-control" />
                        </div>
                        <div class="tags_name_auc col-xs-6 col-sm-6 input-group">
                            <input type="text" id="tags_name_ac" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false">
                            <span class="input-group-btn">
                            <button type="button" id="clear_tt" class="btn btn-primary"><i class="fa fa-close"></i></button>
                            </span>
                            <input type="text" name="photo_name" id="photo_name" class="form-control">
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="reload_image" class="btn btn-primary" onClick="load_again();">Reload</button>
                        <button type="button" id="clean_tags" class="btn btn-warning">Clean</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit_tags" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
            </div>


        </div>
        <!-- /#page-wrapper -->
@stop