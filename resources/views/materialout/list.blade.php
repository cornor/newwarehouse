@extends('layouts.admin_template')

@section('content')
    @include('admin.messages')
    <div class="box-body">
        <a href="{{route('materialout.create')}}" class="btn btn-lg btn-primary">出库添加</a>
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">出库列表</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>型号</th>
                            <th>名称</th>
                            <th>类别</th>
                            <th>规格</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>出库时间</th>
                            <th>出库验收人</th>
                            <th>备注</th>
                        </tr>
                        @foreach($outdatas as $outdata)
                            <tr>
                                <td>{{$outdata->xinghao}}</td>
                                <td>{{$outdata->material_name}}</td>
                                <td>{{$outdata->category_name}}</td>
                                <td>{{$outdata->guige}}</td>
                                <td>{{$outdata->out_num}}</td>
                                <td>个</td>
                                <td>{{$outdata->store_place}}</td>
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