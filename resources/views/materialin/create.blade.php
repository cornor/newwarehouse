@extends('layouts.admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">新增入库记录</h3>
                </div>
                {!! Form::open(['route' => 'materialin.store']) !!}
                <div class="box-body">
                    @include('errors.submitError')
                    <div class="form-group">
                        <label for="xinghao" class="control-label">型号 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="xinghao" name="xinghao" type="text">
                    </div>
                    <div class="form-group">
                        <label for="material_name" class="control-label">名称 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="material_name" name="material_name" type="text">
                    </div>
                    {{ Form::label('forcateid','类别&nbsp;&nbsp;&nbsp;') }}
                    {{ Form::select('category_id',$categorys) }}
                    <br/>
                    <br/>
                    <div class="form-group">
                        <label for="price" class="control-label">价格 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="price" name="price" type="text">
                    </div>
                    <div class="form-group">
                        <label for="in_num" class="control-label">数量 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="in_num" name="in_num" type="text">
                    </div>
                    <div class="form-group">
                        <label for="check_user" class="control-label">入库验收人 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="check_user" name="check_user" type="text" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="store_place" class="control-label">存放位置 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="store_place" name="store_place" type="text">
                    </div>
                    {{ Form::bsTextArea('remark','备注') }}

                </div><!-- /.box-body -->
                <div class="box-footer">
                    {{ Form::bsButton('cancel','btn-default btn-lg ','取消',route('materialin.index')) }}
                    {{ Form::bsButton('submit','btn-info pull-right btn-lg','保存') }}
                </div><!-- /.box-footer-->
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection