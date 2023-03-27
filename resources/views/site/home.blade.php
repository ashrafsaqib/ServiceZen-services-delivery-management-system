@extends('site.layout.app')
@section('content')
<style>
  .card-img-top{
    height: 250px;
  }
</style>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Services</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
  </div>
</section>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      @foreach ($services as $service)
      <div class="col-md-4">
        <div class="card mb-4 box-shadow">
          <img class="card-img-top" src="./service-images/{{ $service->image }}" alt="Card image cap">
          <div class="card-body">
            <p class="card-text"><b>{{ $service->name }}</b></p>
            <p class="card-text">{{ substr($service->description,0,100)}}....</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
              <small class="text-muted"><b>${{ $service->price }}</b></small>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection