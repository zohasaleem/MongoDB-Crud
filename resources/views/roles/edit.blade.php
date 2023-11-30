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
                        <form action="{{route('roles.update', [$role])}}" method= "POST">
                            @csrf
                            @method("PUT")

                            <input type="hidden" name="id" value="{{ $role->_id }}">

                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control mb-2" value="{{$role->name}}">
                            
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
                                            class='permission'
                                            {{ in_array($permission->name, $rolePermissions) 
                                                ? 'checked'
                                                : '' }}>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

