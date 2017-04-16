@extends('layouts.admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                {!! Form::open(['route' => 'category.store']) !!}
                <div class="box-body">
                    @include('errors.submitError')
                    {{ Form::label('forpid','父类别&nbsp;&nbsp;&nbsp;') }}
                    {{ Form::select('pid',$parents) }}
                    <br/>
                    <br/>
                    {{ Form::bsText('name','类别名称') }}

                </div><!-- /.box-body -->
                <div class="box-footer">
                    {{ Form::bsButton('cancel','btn-default btn-lg ','取消',route('category.index')) }}
                    {{ Form::bsButton('submit','btn-info pull-right btn-lg','保存') }}
                </div><!-- /.box-footer-->
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection