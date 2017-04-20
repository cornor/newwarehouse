@extends('layouts.admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                {!! Form::open(['route' => 'category.store']) !!}
                <div class="box-body">
                    @include('errors.submitError')

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" checked>
                            <span style="font-weight: bold;">添加父类别</span>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                            <span style="font-weight: bold;">添加子类别</span>
                        </label>
                    </div>
                    <br/>
                    <div class="form-group" id="cateDiv" style="display: none;">
                        {{ Form::label('forpid','父类别&nbsp;&nbsp;&nbsp;') }}
                        {{ Form::select('pid',$parents) }}
                    </div>

                    <br/>

                    <div class="form-group">
                        <label for="name" class="control-label">类别名称 (<span style="color: red;"> * </span>)</label>
                        <input class="form-control" id="name" name="name" type="text">
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    {{ Form::bsButton('cancel','btn-default btn-lg ','取消',route('category.index')) }}
                    {{ Form::bsButton('submit','btn-info pull-right btn-lg','保存') }}
                </div><!-- /.box-footer-->
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    @push('runningScripts')
    <script src="{{ asset("/js/jquery.form.min.js")}}"></script>
    <script>
        $(function () {

            function OnSelectCheck(ac) {
                if (ac == 1) {
                    $('#cateDiv').hide();
                } else {
                    $('#cateDiv').show();
                }
            }
            $('#inlineRadio1').click(function(){
                OnSelectCheck(1);
            })

            $('#inlineRadio2').click(function(){
                OnSelectCheck(2);
            })
        })
    </script>
    @endpush
@endsection