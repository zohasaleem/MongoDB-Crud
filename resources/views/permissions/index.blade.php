@include('layouts.app')


<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed"  style="margin-top:-30px;">

    <div class="body-wrapper">
    
        <div class="container">

            <div class="widget-content searchable-container list">

                <div class="card card-body">
                    
                    <div style="display:flex; align-items:center; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; margin-top:50px;">

                        <form id="filter-form" style="display:flex; align-items:center; justify-content: space-between; margin-bottom: 0px;">
                    
                            <label for="from_date" class="me-2 h4"  ></label>
                            <input type="date" id="from_date"class="me-2 form-control"   name="from_date"  style="width:40%;">

                            <label for="to_date" class="me-2 h4" >-</label>
                            <input type="date" id="to_date" class="me-2 form-control" name="to_date"  style="width:40%;">

                            <button type="submit" class=" me-2 btn btn-primary" style="padding: 6px 9px;"><i class="fas fa-check"></i></button>
                            
                        </form>

                    </div>

                    <div class="table-responsive" style="overflow:inherit">
                        <table class="table search-table align-middle text-nowrap permission-listing">
                            <thead class="header-item">

                            
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th>Registered</th>
                                <th>Action</th>

                            </thead>
                            <tbody>
                        

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>



<script  type="text/javascript">

    $(function () {
 
        setTimeout(function () {

            table = $('.permission-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('/permissions-list') }}",
                    
                    data: function (d) {
                        d.from_date = $('#from_date').val(),
                        d.to_date = $('#to_date').val()
                    }
                },

                columns: [
                  
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'guard_name',
                        name: 'guard_name'
                    },
                    {
                        data: 'created',
                        name: 'created'
                    },
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },

                ],

                order: [[0, 'desc']],

            });

            $('#filter-form').on('submit', function (e) {
                e.preventDefault();
                $('.permission-listing').DataTable().ajax.reload();
            });

        }, 2000); 
    });


</script>













{{--@extends('layouts.app')

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

--}}