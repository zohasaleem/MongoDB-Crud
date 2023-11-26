@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Add Roles</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('roles.store')}}" method= "POST">
                            @csrf
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control mb-2">


                            <label for="permissions" class="form-label">Assign Permissions</label>

                            <table class="table table-striped">
                                <thead>
                                    <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="1%">Guard</th> 
                                </thead>

                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" 
                                            name="permission[{{ $permission->name }}]"
                                            value="{{ $permission->name }}"
                                            class='permission'>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>

                          
                            <button type="submit" class="btn btn-md btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection

