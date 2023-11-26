@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Role Management</h4>
                        <a href="{{route('roles.create')}}" class="btn btn-primary">Add Role</a>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles  as $role )

                                    <tr>
                                        <td>{{$role->name}} </td>
                                        <td class="d-flex">
                                            <a href="{{route('roles.show', [$role])}}" class="btn btn-sm btn-info mr-2">Show</a>
                                            <a href="{{route('roles.edit', [$role])}}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                            <form action="{{route('roles.destroy', [$role])}}" method = "POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mr-2">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                            
                                @empty
                                    <tr>
                                        <td>No Roles</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection