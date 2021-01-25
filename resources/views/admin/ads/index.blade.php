@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Ads/banner management</span>
                        <span class="info-box-number">{{$total}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-right">
                            <a href="{{route('ads.create')}}" class="btn btn-primary">Add Ad/Banner</a>
                        </h3>
                        <h3 class="card-title float-left">
                            Ads/banner management
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ads as $ad)
                                <tr>
                                    <td>{{$ad->id}}</td>
                                    <td>{{$ad->name}}</td>
                                    <td><img src="{{asset('img/ads/'.$ad->image)}}" alt="{{$ad->name}}" class="img-thumbnail"></td>
                                    <td>{{$ad->url}}</td>
                                    <td>{{$ad->type}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-primary"
                                           href="{{route('ads.show',$ad->id)}}">
                                            View
                                        </a>
                                        <a class="btn btn-xs btn-info"
                                           href="{{route('ads.edit',$ad->id)}}">
                                            Edit
                                        </a>
                                        <form action="{{route('ads.destroy',$ad->id)}}" method="POST"
                                              onsubmit="return confirm('Are you sure?');"
                                              style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Ads Found!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
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

@push('scripts')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endpush
