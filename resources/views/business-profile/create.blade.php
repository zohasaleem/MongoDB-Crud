@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="mb-2">
                            <h5 class="mb-5">Add Business Profile</h5>
                        </div>
                        <form action="{{route('business-profiles.store')}}" method= "POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control mb-2">
                                </div>

                                <div class="col-md-6">

                                    <label for="name">Phone</label>
                                    <input type="text" name="phone" class="form-control mb-3">
                                </div>

                                <div class="col-md-6">

                                    <label for="name">Category</label>
                                    <input type="text" name="category" class="form-control mb-3">
                                </div>

                                <div class="col-md-6">

                                    <label for="name">Latitude</label>
                                    <input type="text" name="latitude" class="form-control mb-3">
                                </div>

                                <div class="col-md-6">

                                    <label for="name">Longitude</label>
                                    <input type="text" name="longitude" class="form-control mb-3">
                                </div>

                                <div class="col-md-6">
                                    <label for="name">Address</label>
                                    <input type="text" name="address" class="form-control mb-3">
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