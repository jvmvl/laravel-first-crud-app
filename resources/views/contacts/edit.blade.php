@extends('layouts.app-master')
@section('content')
<div class="row">
    
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Edit contact</h1>
    <div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        
        <form method="post" action="{{ route('contacts.update', $contact->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">    
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" name="first_name" value="{{$contact->first_name}}"/>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" name="last_name" value="{{$contact->last_name}}"/>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="{{$contact->email}}"/>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" value="{{$contact->city}}"/>
            </div>
            
            <div class="form-group">
                <label for="countries">Country:</label>
                <select name="countries" class="form-select">
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ $country->id == $contact->country_id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                    @endforeach
                </select>
            </div> 

            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" class="form-control" name="job_title" value="{{$contact->job_title}}"/>
            </div>   

            <button type="submit" class="btn btn-primary">Edit contact</button>
        </form>
    </div>
</div>
</div>
@endsection