@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Add Permission</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('permissions.store')}}" method= "POST">
                            @csrf
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control mb-2">

                          
                            <button type="submit" class="btn btn-md btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection