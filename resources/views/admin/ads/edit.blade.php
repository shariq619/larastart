@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            Edit Role
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" action="{{route('ads.update',$ad->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name<code>*</code></label>
                                    <input type="text" class="form-control" name="name" value="{{$ad->name}}" id="name" placeholder="Enter Name">
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{asset('img/ads/' . $ad->image)}}" alt="{{$ad->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Ad/Banner Image<code>*</code></label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url">Ad/Banner URL</label>
                                    <input type="text" class="form-control" value="{{$ad->url}}" name="url" id="url">
                                </div>
                                <div class="form-group">
                                    <label>Ad/Banner Type</label>
                                    <select class="select2" name="type"  data-placeholder="Select a type"
                                            style="width: 100%;">
                                        <option value="Event" {{ ($ad->type == 'Event') ? 'selected' : '' }} >Event</option>
                                        <option value="Brand" {{ ($ad->type == 'Brand') ? 'selected' : '' }}>Brand</option>
                                        <option value="Feature" {{ ($ad->type == 'Feature') ? 'selected' : '' }}>Feature</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('ads.index')}}"  class="btn btn-secondary">Back</a>
                            </div>
                        </form>
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
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
