@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                
                    <div class="card-body">

                        <div class="mb-2">
                            <h5 class="mb-5">Edit Blog</h5>
                        </div>

                        <form action="{{route('blogs.update', [$blog])}}" method= "POST">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title"> Title</label>
                                    <input type="text" name="title" id="title" class="form-control mb-2" value="{{$blog->title}}">
                                </div>
                                <div class="col-md-12">
                                    
                                    <label for="content">Content</label>
                                    <textarea name="content" class="form-control mb-2" value="{{$blog->content}}" style="height:200px;">{{ $blog->content }}</textarea>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">Update</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection