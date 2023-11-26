@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Permission</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('permissions.update', [$permission])}}" method= "POST">
                            @csrf
                            @method("PUT")
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control mb-2" value="{{$permission->name}}">


                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection