@include('layouts.app')


<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed"  style="margin-top:-30px;">

    <div class="body-wrapper">
    
        <div class="container">

            <div class="owl-carousel counter-carousel owl-theme">
                <div class="item">
                    <div class="card border-0 zoom-in bg-light-primary shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles')}}" >  
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-user-male.svg" width="50" height="50" class="mb-3" alt="" />
                                </a>
                                <p class="fw-semibold fs-3 text-primary mb-1"> Today Signup </p>
                                <h5 class="fw-semibold text-primary mb-0">{{@$dataToday}}</h5>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="item">
                        <div class="card border-0 zoom-in bg-light-warning shadow-none">
                            <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles?t=yesterday')}}" > <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-3" alt="" />   
                            </a>
                                <p class="fw-semibold fs-3 text-warning mb-1">Yesterday</p>
                                <h5 class="fw-semibold text-warning mb-0">{{@$dataYesterday}}</h5>
                            </div>
                        </div>
                        </div>
                </div>

                <div class="item" >
                    <div class="card border-0 zoom-in bg-light-info shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles?t=week')}}">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-mailbox.svg" width="50" height="50" class="mb-3" alt="" />
                                <p class="fw-semibold fs-3 text-info mb-1">This Week</p>
                                <h5 class="fw-semibold text-info mb-0">{{@$dataThisWeek}}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item"   >
                    <div class="card border-0 zoom-in bg-light-danger shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles?t=month')}}">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-favorites.svg" width="50" height="50" class="mb-3" alt="" />
                                <p class="fw-semibold fs-3 text-danger mb-1">This Month</p>
                                <h5 class="fw-semibold text-danger mb-0">{{@$dataThisMonth}}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card border-0 zoom-in bg-light-primary shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles?t=lastmonth')}}" >  
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-user-male.svg" width="50" height="50" class="mb-3" alt="" />
                                </a>
                                <p class="fw-semibold fs-3 text-primary mb-1"> Last Month </p>
                                <h5 class="fw-semibold text-primary mb-0">{{@$dataLastMonth}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item"  >
                    <div class="card border-0 zoom-in bg-light-success shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="{{url('/business-profiles?t=year')}}" >  
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-speech-bubble.svg" width="50" height="50" class="mb-3" alt="" />
                                </a>
                                <p class="fw-semibold fs-3 text-success mb-1">This Year</p>
                                <h5 class="fw-semibold text-success mb-0">{{@$dataThisYear}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            
            
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Business Profile for {{$time}}</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted" href="{{url('/dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Business Pofile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content searchable-container list">
                <!-- --------------------- start Contact ---------------- -->
                {{--<div class="card card-body">
                    <div class="row">
                        <div class="col-md-4 col-xl-3"  style="visibility: hidden">
                            <form class="position-relative">
                                <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search Contacts..." />
                                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            </form>
                        </div>
                        
                    </div>
                </div>--}}


                <!-- Daily Business Profiles Graph -->
                @include('components.graphs.daily-business-profiles')


                <!-- Business Profiles Map -->
                @include('components.map.business-profile')

                <!-- ---------------------
                                end Contact
                            ---------------- -->
                <div style="display:flex; align-items:center; justify-content: space-between; flex-wrap: wrap; margin-bottom: 20px; margin-top:50px;">


                    <div style="display:flex; align-items:center; justify-content: space-between; margin-bottom: 0px;">

                        <a href="{{route('business-profiles.create')}}" class="btn btn-primary" style="margin-right: 10px;">Add</a>

                        <form id="exportForm" action="{{ url('business-profiles-export') }}" method="GET">
                            <input type="hidden" name="filterType" id="filterType" value="">
                            <input type="hidden" name="exportFromDate" id="exportFromDate" value="">
                            <input type="hidden" name="exportToDate" id="exportToDate" value="">
                            <button type="submit" id="exportButton" class="btn btn-primary">Export</button>
                        </form>

                        <button type="button" class="btn btn-primary" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#import-modal" data-bs-whatever="@mdo">
                            Import
                        </button>
                    </div>
                    <form id="filter-form" style="display:flex; align-items:center; justify-content: space-between; margin-bottom: 0px;">
                
                        <label for="from_date" class="me-2 h4"  ></label>
                        <input type="date" id="from_date"class="me-2 form-control"   name="from_date"  style="width:40%;">

                        <label for="to_date" class="me-2 h4" >-</label>
                        <input type="date" id="to_date" class="me-2 form-control" name="to_date"  style="width:40%;">

                        <button type="submit" class=" me-2 btn btn-primary" style="padding: 6px 9px;"><i class="fas fa-check"></i></button>
                        
                    </form>
                </div>

              
                
                <!-- Import Modal  -->
                <div class="modal fade" id="import-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('business-profiles.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="exampleModalLabel1">
                                Upload Excel File
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" enctype="multipart/form-data" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-light-primary text-primary font-medium" >
                                    Import
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
       
            
                <div class="card card-body">
                    <div class="table-responsive" style="overflow:inherit;">
                        <table class="table search-table align-middle text-nowrap profile-listing">
                            <thead class="header-item">

                            
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Category</th>
                                <!-- <th>Lat & Lng</th> -->
                                <th>Signup Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            {{--
                                @foreach($data as $post)

                                    <tr class="search-items">

                                        <div class="d-flex align-items-center">
                                            <img src="../../dist/images/profile/user-1.jpg" alt="avatar" class="rounded-circle" width="35" />
                                            <div class="ms-3">
                                                <div class="user-meta-info">
                                                    <h6 class="user-name mb-0" data-name="Emma Adams">Emma Adams</h6>
                                                    <span class="user-work fs-3" data-occupation="Web Developer">Web Developer</span>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td>{{@$post->name}}</td>
                                        <td>{{@$post->category}}</td>
                                        <td>{{@$post->phone}}</td>
                                        
                                        <td>
                                            <?php
                                            $timestamp = @$post->created_at->toDateTime()->getTimestamp() * 1000;
                                            $divisor = 1000;

                                            $result = $timestamp / $divisor;
                                            $dateTime = date('Y-m-d H:i:s', $result);


                                            echo $dateTime;

                                            ?>
                                        </td>
            
                                        <td>
                                            <div class="action-btn">
                                                <a href="{{url('/user-details?username='.$post->phone)}}" class="text-info edit">
                                                    <i class="ti ti-eye fs-5"></i>
                                                </a>
                                            
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<script  type="text/javascript">

    var urlParams = new URLSearchParams(window.location.search);
    var filterType = urlParams.get('t');

    document.getElementById('exportButton').addEventListener('click', function() {

        $('#filterType').val(filterType);
        var fromDate =  $('#exportFromDate').val($('#from_date').val());
        var toDate =  $('#exportToDate').val($('#to_date').val());

        $('#exportForm').submit();

    });



    $(function () {
 
        setTimeout(function () {
            console.log(filterType);

            table = $('.profile-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url :"{{ url('/business-profiles-list') }}",
                    data: function (d) {

                        d.from_date = $('#from_date').val(),
                        d.to_date = $('#to_date').val(),
                        d.time = filterType

                    }
                },

                columns: [
                  
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
            
                    // {
                    //     data: 'lat_lng',
                    //     name: 'lat_lng'
                    // },
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
                $('.profile-listing').DataTable().ajax.reload();
            });

        }, 2000); 
    });


</script>
