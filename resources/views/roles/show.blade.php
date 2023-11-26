@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>{{$role->name}} Role</h4>
                    </div>

                    <div class="card-body">
                        
                        <h3>Assigned permissions</h3>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Guard</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rolePermissions as $permission)

                                    <tr>
                                        <td>{{ $permission->name }} </td>
                                        <td>{{ $permission->guard_name }}</td>

                                        <td class="d-flex">
                                            <a href="{{route('roles.edit', [$role])}}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                           
                                        </td>

                                    </tr>
                                        
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection