@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 margin-tb">
            <h2>Add New FAQs</h2>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('FAQs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <span style="color: red;">*</span><strong>Question:</strong>
                    <input type="text" name="question" value="{{old('question')}}" class="form-control" placeholder="Question">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <span style="color: red;">*</span><strong>Answer:</strong>
                    <textarea class="form-control" style="height:150px" name="answer" placeholder="Answer">{{old('answer')}}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" class="form-control">
                        <option></option>
                        @if(isset($category_id))
                        @foreach($categories as $category)
                        @if($category->id == $category_id)
                        <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                        @endif
                        @endforeach
                        @else
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Service:</strong>
                    <select name="service_id" class="form-control">
                        <option></option>
                        @if(isset($service_id))
                        @foreach($services as $service)
                        @if($service->id == $service_id)
                        <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                        @endif
                        @endforeach
                        @else
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                        <select name="status" class="form-control">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection