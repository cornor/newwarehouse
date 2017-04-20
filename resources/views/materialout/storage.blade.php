@extends('layouts.admin_template')

@section('content')
    @include('admin.messages')
    {!! Form::open(['route' => 'materialout.storage', 'method' => 'GET']) !!}
    <div class="row">
        <div class="col-lg-6" style="float: right;">
            <div class="input-group">
                <input type="text" class="form-control" value="{{$query}}" name="q" placeholder="请输入物资名称...">
                <span class="input-group-btn">
                    {{--<button class="btn btn-primary" type="button">搜索</button>--}}
                    {{ Form::bsButton('submit','btn btn-primary','搜索') }}
                </span>
            </div>
        </div>
    </div>
    <ul class="list-inline">
        <li style="font-weight: bold;">其他搜索条件:</li>
        <li>{{ Form::select('cateId',$categorys, $cateId) }}</li>
    </ul>

    {!! Form::close() !!}
    <p/>
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">库存列表</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>型号</th>
                            <th>名称</th>
                            <th>类别</th>
                            <th>库存</th>
                            <th>单位</th>
                            <th>报警数量</th>
                            <th>存放位置</th>
                            <th>操作</th>
                        </tr>
                        @foreach($storages as $storage)
                            <tr @if($storage->baojing > 0) style="color: red;" @endif>
                                <td>{{$storage->xinghao}}</td>
                                <td>{{$storage->material_name}}</td>
                                <td>{{$storage->category_name}}</td>
                                <td>{{$storage->storage_num}}</td>
                                <td>{{$storage->danwei}}</td>
                                <td>{{$storage->xianding_num}}</td>
                                <td>{{$storage->store_place}}</td>
                                <td><a href="{{url('materialout/create/'.$storage->id)}}" class="btn btn-primary btn-lg" role="button">出  库</a></td>
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