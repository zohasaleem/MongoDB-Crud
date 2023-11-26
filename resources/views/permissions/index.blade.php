@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Permissions</h4>
                        <a href="{{route('permissions.create')}}" class="btn btn-primary">Add Permission</a>
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
                                    <th>Guard</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission )

                                    <tr>
                                        <td>{{ $permission->name }} </td>
                                        <td>{{ $permission->guard_name }} </td>
                                        <td class="d-flex">
                                            <a href="{{route('permissions.edit', [$permission])}}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                            <form action="{{route('permissions.destroy', [$permission])}}" method = "POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mr-2">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                            
                                @empty
                                    <tr>
                                        <td>No permission</td>
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