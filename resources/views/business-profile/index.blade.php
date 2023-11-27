@extends('layouts.app')

@section('content')

    

<section class="datatables">

<div class="card">
    <div class="card-body">
        <div class="mb-2">
            <h5 class="mb-0">Business Profile</h5>
        </div>

        <div class="table-responsive m-t-40 ">
            
            <div style="display:flex; align-items:center; justify-content: space-between; margin-bottom: 20px; margin-top:50px;">

                <a href="{{ route('business-profiles.create') }}" class="btn btn-primary mb-2">
                    <i class="ti ti-plus fs-4"></i>&nbsp; Add
                    new row
                </a>

                <input type="date" id="date" class="me-2 form-control"   name="date"  style="width:28%;">

                    
                <button type="submit" id="exportButton" class=" me-2 btn btn-primary">Export</button>
            </div>

            <!-- <form id="filter-form" style="display:flex; align-items:center;  flex-wrap: wrap; justify-content: space-between; margin-bottom: 0px;">
                <div class="d-flex">                    
                    <label for="date" class="me-2 h4"  ></label>
                    <button type="submit" class=" me-2 btn btn-primary" style="padding: 2px 10px;">Filter</button>
                </div>
            </form> -->

            <table id="config-table"
                    class="table border display table-bordered table-striped no-wrap profile-listing">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    <!-- end row -->
                </thead>
                
                <tbody style="vertical-align:middle;">
                {{--@foreach ($b_profiles  as $profile )
                    <tr>
                        <td>{{$profile->id}} </td>
                        <td>{{$profile->name}} </td>
                        <td>{{$profile->phone}} </td>
                        <td>{{$profile->category}} </td>
                        <td>{{$profile->address}} </td>
                        <td>{{$profile->created_at}}</td>

                        <td class="d-flex">
                            <a href="{{route('business-profiles.edit', [$profile])}}" class="btn btn-sm btn-primary m-2">Edit</a>
                            <form action="{{route('business-profiles.destroy', [$profile])}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger m-2">Del</button>
                            </form>
                        </td>

                    </tr>
                            
                @endforeach
                --}}
                <!-- end row -->
            </tbody>
        </table>
        </div>
    </div>
</div>

</section>





<script  type="text/javascript">
    document.getElementById('exportButton').addEventListener('click', function() {
        window.location.href = '{{ url('business-profiles-export') }}';
    });



    $(function () {
        var table = null; 
        var filter_date = $('#date').val();
        setTimeout(function () {

            if ($.fn.DataTable.isDataTable('.profile-listing')) {
                $('.profile-listing').DataTable().destroy();
            }

            
            table = $('.profile-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('/business-profiles-list') }}?date=" + filter_date,
                    data: function (d) {
                        
                        d.date = filter_date;
                    }
                },

                columns: [
                    {
                        data: '_id',
                        name: '_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'address',
                        name: 'address'
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

            $('#date').on('change', function () {
                filter_date = $(this).val(); // Update filter_date with the selected date
                table.ajax.reload(); // Reload DataTable with the new date filter
            });

        }, 2000); 
    });
</script>





@endsection

    
