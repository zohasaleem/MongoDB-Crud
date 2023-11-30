@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="mb-2">
                            <h5 class="mb-5">Add Blog</h5>
                        </div>
                        <form action="{{route('blogs.store')}}" method= "POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">Name</label>
                                    <input type="text" name="title" class="form-control mb-2">
                                </div>

                                <div class="col-md-12">

                                    <label for="content">Content</label>
                                    <textarea  name="content" class="form-control mb-2" style="height: 200px;"></textarea>
                                </div>

                                
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection