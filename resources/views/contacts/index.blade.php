@php use Carbon\Carbon; @endphp

@extends('layouts.app-master')

@section('content')
  <div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">Contacts</h1> 
        @if(auth()->user()->type === 'admin')  
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add contact</a> 
        @endif
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Name</td>
              <td>Email</td>
              <td>Job Title</td>
              <td>City</td>
              <td>Country</td>
              <td>Created at</td>
              <td colspan = 3>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->job_title}}</td>
                <td>{{$contact->city}}</td>
                <td>{{$contact->countries->name??'Unknown'}}</td>
                <td>{{Carbon::parse($contact->created_at)->format('Y-m-d H:i:s')}}</td>
                
                <td><a href="{{ route('contacts.show', $contact->id)}}" class="btn btn-success">View</a></td>

                @if(auth()->user()->type === 'admin')
                <td>
                  
                    <a href="{{ route('contacts.edit', $contact->id)}}" class="btn {{ ($contact->created_at->eq($contact->updated_at)) ? 'btn-primary' : 'btn-secondary' }}" >Edit</a>
                  
                  
                </td>
                <td>
                    <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
      </table>
      <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif

        @if(session()->get('failed'))
            <div class="alert alert-danger">
            {{ session()->get('failed') }}  
            </div>
        @endif
        </div>
    <div>
  </div>
@endsection
