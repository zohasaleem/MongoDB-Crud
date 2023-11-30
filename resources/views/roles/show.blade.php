@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
            <h3 class="m-3">{{ ucfirst($role->name) }} Role</h3>

                <div class="card">

                    <div class="card-body">
                        
                        <h4>Assigned permissions</h4>

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
                                            <a href="{{route('permissions.edit', [$permission])}}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                           
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