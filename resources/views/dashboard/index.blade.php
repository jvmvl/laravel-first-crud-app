@php use Carbon\Carbon; @endphp

@extends('layouts.app-master')
@section('content')
<div class="container px-4 py-5" id="featured-3">
    <h1 class="display-3 fw-bold">My Dashboard</h1>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-2">
      <div class="feature col">
        <h3 class="fs-2 text-body-emphasis">Total Contacts</h3>
        <h4>{{$contacts}}</h4>
      </div>
      <div class="feature col">
        <h3 class="fs-2 text-body-emphasis">Total countries</h3>
        <h4>{{$countries}}</h4>
      </div>
    </div>
  </div>
@endsection