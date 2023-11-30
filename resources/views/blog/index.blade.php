@include('layouts.app')


<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed"  style="margin-top:-30px;">

    <div class="body-wrapper">
    
        <div class="container">

     
            <div class="widget-content searchable-container list">

                <div style="display:flex; align-items:center; justify-content: space-between; flex-wrap: wrap; margin-bottom: 20px; margin-top:50px;">

                    <a href="{{route('blogs.create')}}" class="btn btn-primary" style="margin-right: 10px;">Add</a>

                    <form id="filter-form" style="display:flex; align-items:center; justify-content: space-between; margin-bottom: 0px;">
                
                        <label for="from_date" class="me-2 h4"  ></label>
                        <input type="date" id="from_date"class="me-2 form-control"   name="from_date"  style="width:40%;">

                        <label for="to_date" class="me-2 h4" >-</label>
                        <input type="date" id="to_date" class="me-2 form-control" name="to_date"  style="width:40%;">

                        <button type="submit" class=" me-2 btn btn-primary" style="padding: 6px 9px;"><i class="fas fa-check"></i></button>
                        
                    </form>
                </div>
       
            
                <div class="card card-body">
                    <div class="table-responsive" style="overflow:inherit;">
                        <table class="table search-table align-middle blog-listing">
                            <thead class="header-item">

                                <th>Title</th>
                                <th>Content</th>
                                <th>Created At</th>
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

            table = $('.blog-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('/blogs-list') }}",
                    data: function (d) {

                        d.from_date = $('#from_date').val(),
                        d.to_date = $('#to_date').val()
                    }
                },

                columns: [
                  
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'content',
                        name: 'content'
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
                $('.blog-listing').DataTable().ajax.reload();
            });

        }, 2000); 
    });


</script>
