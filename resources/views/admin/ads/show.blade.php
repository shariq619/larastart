@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            Show Role
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>{{$ad->id}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$ad->name}}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td><img src="{{asset('img/ads/'.$ad->image)}}" alt="{{$ad->name}}" class="img-thumbnail"></td>
                                </tr>

                                <tr>
                                    <td>URL</td>
                                     <td>{{$ad->url}}</td>
                                </tr>

                                <tr>
                                    <td>Type</td>
                                     <td>{{$ad->type}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{route('ads.index')}}"  class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
