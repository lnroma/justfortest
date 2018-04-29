<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.02.18
 * Time: 19:33
 */
?>


<!-- Modal -->
<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/files/upload" method="post" id="upload_file" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Загрузить фаил</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('file') ? ' has-error' : ''}}">
                        {!! Form::label('file', 'Фаил: ', ['class' => '  control-label']) !!}
                        {!! Form::file('file', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                        {!! Form::label('title', 'Название: ', ['class' => '  control-label']) !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group{{ $errors->has('text') ? ' has-error' : ''}}">
                        {!! Form::label('text', 'Описания: ', ['class' => '  control-label']) !!}
                        {!! Form::textarea('text', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
                    </div>
                    {!! csrf_field() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Загрузить файл</button>
                </div>
            </form>
        </div>
    </div>
</div>
