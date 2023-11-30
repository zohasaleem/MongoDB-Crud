@extends('layouts.app')

@section('content')



<div class="row">
  
  <div class="col-lg-12">
    <div class="card shadow-none border">
      <div class="card-body">
        <div class="form-floating mb-3">
          <form action="{{ route('users.update') }}" method="POST">
              @csrf 
              
                <input type="hidden" name="id" value="{{ $user->_id }}">

                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control mb-3" value="{{ $user->name }}">

                <label for="email"> Email</label>
                <input type="email" name="email" class="form-control mb-3" value="{{ $user->email }}">

                <label for="password"> Password</label>
                <input type="password" name="password" class="form-control mb-3" value="">

                <div class="mb-3">
                    <label>Select Role</label>
                    <select name="role_id" class="form-select col-12" id="inlineFormCustomSelect">
                      @if(empty($user->role_ids))
                          <option value="" selected>Choose role...</option>
                      @endif

                      @foreach ($roles as $role)
                          <option value="{{ $role->_id }}" {{ (in_array($role->_id, $user->role_ids)) ? 'selected' : '' }}>
                              {{ $role->name }}
                          </option>
                      @endforeach
                    </select>

                </div>

              <button type="submit" class="btn btn-primary ms-auto">Update</button>
          </form>
          
    
        </div>
      
      </div>
    </div>
    
  
    
  </div>
</div>


@endsection
