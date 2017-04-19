@extends('layouts.admin_template')

@section('content')
    @include('admin.messages')
    <div class="row">
        <div class="col-lg-6" style="float: right;">
            {!! Form::open(['route' => 'materialout.index', 'method' => 'GET']) !!}
            <div class="input-group">
                <input type="text" class="form-control" value="{{$query}}" name="q" placeholder="请输入物资名称或类别...">
                <span class="input-group-btn">
                    {{--<button class="btn btn-primary" type="button">搜索</button>--}}
                    {{ Form::bsButton('submit','btn btn-primary','搜索') }}
                </span>
            </div>

        </div>
        <div class="col-lg-6" style="float: right;">
            {{ Form::select('cateId',$categorys, $cateId) }}
        </div>
        {!! Form::close() !!}
    </div>
    <p/>
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>型号</th>
                            <th>名称</th>
                            <th>类别</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>出库时间</th>
                            <th>出库验收人</th>
                            <th>备注</th>
                        </tr>
                        @foreach($outdatas as $outdata)
                            <tr >
                                <td>{{$outdata->xinghao}}</td>
                                <td>{{$outdata->material_name}}</td>
                                <td>{{$outdata->category_name}}</td>
                                <td>{{$outdata->out_num}}</td>
                                <td>{{$outdata->danwei}}</td>
                                <td>{{$outdata->out_time}}</td>
                                <td>{{$outdata->check_user}}</td>
                                <td>{{$outdata->remark}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection