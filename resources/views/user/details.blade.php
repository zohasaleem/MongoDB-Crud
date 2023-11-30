@extends('layouts.app')

@section('content')


<div class="container">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">User Details</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">detail</li>
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

                <div class="chat-list chat active-chat" data-user-id="1">
                <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                    <img src="../../dist/images/profile/user-4.jpg" alt="user4" width="72" height="72" class="rounded-circle">
                    <div>
                        <h6 class="fw-semibold fs-4 mb-0">{{ $user->name}} </h6>
                        <p class="mb-0">{{  $user->roles->name }}</p>
                    </div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-4 mb-7">
                        <p class="mb-1 fs-2">Email address</p>
                        <h6 class="fw-semibold mb-0">{{ $user->email }}</h6>
                    </div>
                    <div class="col-4 mb-7">
                        <p class="mb-1 fs-2">Role</p>
                        <h6 class="fw-semibold mb-0">{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</h6>
                    </div>
                    <div class="col-4 mb-9">
                        <p class="mb-1 fs-2">Registered</p>
                        <h6 class="fw-semibold mb-0">{{ $user->created_at }}</h6>
                    </div>
                 
                </div>
             

    </div>

</div>
@endsection
