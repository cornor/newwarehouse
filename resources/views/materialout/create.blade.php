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
                    {{ Form::bsText('xinghao','型号') }}
                    {{ Form::bsText('material_name','名称') }}
                    {{ Form::bsText('guige','规格') }}
                    {{ Form::label('forcateid','类别&nbsp;&nbsp;&nbsp;') }}
                    {{ Form::select('category_id',$categorys) }}
                    <br/>
                    <br/>
                    {{ Form::bsText('out_num','数量') }}
                    {{ Form::bsText('check_user','出库验收人', $user->name) }}
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