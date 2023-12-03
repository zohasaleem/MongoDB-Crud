@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                
                    <div class="card-body">

                        <div class="mb-2">
                            <h5 class="mb-5">Edit Business Profile</h5>
                        </div>

                        <form action="{{route('business-profiles.update', [$businessProfile])}}" method= "POST">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-6">
                                <label for="name"> Name</label>
                                <input type="text" name="name" id="name" class="form-control mb-2" value="{{$businessProfile->name}}">
                            </div>
                            <div class="col-md-6">
                                
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control mb-3" value="{{$businessProfile->phone}}">

                            </div>
                            <div class="col-md-6">
                                <label for="category">Category</label>
                                <input type="text" name="category" class="form-control mb-3" value="{{$businessProfile->category}}">
                            </div>

                            <div class="col-md-6">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" class="form-control mb-3" value="{{$businessProfile->latitude}}">
                            </div>

                            <div class="col-md-6">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" class="form-control mb-3" value="{{$businessProfile->longitude}}">
                            </div>

                            <div class="col-md-6">
                                <label for="address"><Address></Address></label>
                                <input type="text" name="address" class="form-control mb-3" value="{{$businessProfile->address}}">
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