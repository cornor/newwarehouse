@extends('layouts.admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">新增出库记录</h3>
                </div>
                {!! Form::open(['route' => 'materialout.store']) !!}
                <div class="box-body">
                    @include('errors.submitError')
                    <div class="form-group">
                        <label for="xinghao" class="control-label">型号 <span style="color: red;"> * </span></label>
                        <input class="form-control" id="xinghao" name="xinghao" type="text" value="{{$storage->xinghao}}">
                    </div>
                    <div class="form-group">
                        <label for="material_name" class="control-label">名称 <span style="color: red;"> * </span></label>
                        <input class="form-control" id="material_name" name="material_name" type="text" value="{{$storage->material_name}}">
                    </div>
                    {{ Form::label('forcateid','类别&nbsp;&nbsp;&nbsp;') }}
                    {{ Form::select('category_id',$categorys, $storage->category_id) }}
                    <br/>
                    <br/>
                    <div class="form-group">
                        <label for="out_num" class="control-label">数量 <span style="color: red;"> * </span>&nbsp;(当前库存<span style="color: red;"> {{$storage->storage_num}}{{$storage->danwei}} </span>)</label>
                        <input class="form-control" id="out_num" name="out_num" type="text">
                    </div>

                    <div class="form-group">
                        <label for="fordanwei" class="control-label">单位 <span style="color: red;"> * </span></label>
                        {{ Form::select('danwei',$danweis) }}
                    </div>

                    <div class="form-group">
                        <label for="check_user" class="control-label">出库验收人 <span style="color: red;"> * </span></label>
                        <input class="form-control" id="check_user" name="check_user" type="text" value="{{$user->name}}">
                    </div>
                    {{ Form::bsTextArea('remark','备注') }}

                </div><!-- /.box-body -->
                <div class="box-footer">
                    {{ Form::bsButton('cancel','btn-default btn-lg','取消',route('materialout.index')) }}
                    {{ Form::bsButton('submit','btn-info pull-right btn-lg','保存') }}
                </div><!-- /.box-footer-->
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection