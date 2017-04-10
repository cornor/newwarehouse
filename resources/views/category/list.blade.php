@extends('layouts.admin_template')

@section('content')
    @include('admin.messages')
    <div class="box-body">
        <a href="{{route('category.create')}}" class="btn btn-lg btn-primary">新建类别</a>
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">类别列表</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>类别</th>
                            <th>父类别</th>
                            <th>操作</th>
                        </tr>
                        @foreach($categorys as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->pname}}</td>
                                <td>
                                    <a class="btn btn-xs" href="{{('category/delete/'.$category->id)}}">删除</a>
                                </td>
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