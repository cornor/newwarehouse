@extends('layouts.admin_template')

@section('content')
    @include('admin.messages')
    <div class="box-body">
        <a href="{{route('materialin.create')}}" class="btn btn-lg btn-primary">入库添加</a>
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">入库列表</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>型号</th>
                            <th>名称</th>
                            <th>类别</th>
                            <th>价格</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>存放位置</th>
                            <th>入库时间</th>
                            <th>入库验收人</th>
                            <th>备注</th>
                        </tr>
                        @foreach($indatas as $indata)
                            <tr>
                                <td>{{$indata->xinghao}}</td>
                                <td>{{$indata->material_name}}</td>
                                <td>{{$indata->category_name}}</td>
                                <td>{{$indata->price}}</td>
                                <td>{{$indata->in_num}}</td>
                                <td>个</td>
                                <td>{{$indata->store_place}}</td>
                                <td>{{$indata->in_time}}</td>
                                <td>{{$indata->check_user}}</td>
                                <td>{{$indata->remark}}</td>
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