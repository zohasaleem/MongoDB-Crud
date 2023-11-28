@extends('layouts.app')

@section('content')


<div class="container">
  <div class="card overflow-hidden">
    <div class="card-body p-0">
      <img src="../../dist/images/backgrounds/profilebg.jpg" alt="" class="img-fluid">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-1 order-2">      
        </div>
            
        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
          <div class="mt-n5">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;" ;="">
                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;" ;="">
                    <img src="../../dist/images/profile/user-1.jpg" alt="" class="w-100 h-100">
                </div>
              </div>
            </div>
            <div class="text-center">
                <h5 class="fs-5 mb-0 fw-semibold">{{ auth()->user()->name }}</h5>
                <p class="mb-0 fs-4">Admin</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 order-last">  
        </div>

        </div>

      <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2 p-4" id="pills-tab" role="tablist">
      </ul>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="card shadow-none border">
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-center gap-3 mb-4">
            <i class="ti ti-user text-dark fs-6"></i>
            <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->name }}</h6>
          </li>
          <li class="d-flex align-items-center gap-3 mb-4">
            <i class="ti ti-mail text-dark fs-6"></i>
            <h6 class="fs-4 fw-semibold mb-0">{{ auth()->user()->email }}</h6>
          </li>
        
        </ul>
      </div>
    </div>
    
  </div>
  <div class="col-lg-8">
    <div class="card shadow-none border">
      <div class="card-body">
        <div class="form-floating mb-3">
          <form action="{{ route('users.update') }}" method="POST">
              @csrf 
              
              <input type="hidden" name="id" value="{{ auth()->user()->_id }}">

              <label for="name"> Name</label>
              <input type="text" name="name" class="form-control mb-3" value="{{ auth()->user()->name }}">

              <label for="email"> Email</label>
              <input type="email" name="email" class="form-control mb-3" value="{{ auth()->user()->email }}">

              <label for="password"> Password</label>
              <input type="password" name="password" class="form-control mb-3" value="">

              <button type="submit" class="btn btn-primary ms-auto">Update</button>
          </form>
          
    
        </div>
      
      </div>
    </div>
    
  
    
  </div>
</div>


@endsection
