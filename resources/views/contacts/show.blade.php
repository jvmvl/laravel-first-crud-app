@extends('layouts.app-master')
@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Show contact</h1>
  <div>
          <div class="form-group">    
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" name="first_name" value="{{$contact->first_name}}" readonly />
          </div>

          <div class="form-group">
              <label for="last_name">Last Name:</label>
              <input type="text" class="form-control" name="last_name" value="{{$contact->last_name}}" readonly/>
          </div>

          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="{{$contact->email}}" readonly/>
          </div>
          <div class="form-group">
              <label for="city">City:</label>
              <input type="text" class="form-control" name="city" value="{{$contact->city}}" readonly/>
          </div>
          <div class="form-group">
              <label for="country">Country:</label>
              <input type="text" class="form-control" name="country" value="{{$contact->countries->name??'Unknown'}}" readonly/>
          </div>
          <div class="form-group">
              <label for="job_title">Job Title:</label>
              <input type="text" class="form-control" name="job_title" value="{{$contact->job_title}}" readonly/>
          </div>                         
          <a href="{{ route('contacts.index') }}" class="btn btn-primary">Return</a>
  </div>
</div>
</div>
@endsection