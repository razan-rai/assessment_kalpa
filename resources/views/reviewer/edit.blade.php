@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
    @if(session()->has('message'))
    <h2 class="font-semibold text-xl text-green-800 dark:text-green-200 leading-tight">
        {{ session()->get('message') }}
    </h2>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
            <form action="{{ route('reviewer.update',$drug->id) }}" method="POST">
                @method('PUT')
                    {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="name"> Registered By</label>
                        <span class="form-control"> {{ $drug->user->name }}
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="name"> Name</label>
                        <input type="text" name="name" value="{{ $drug->name }}" class="form-control" id="name"
                        placeholder="Enter Drugs Name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brand_name"
                                placeholder="Enter Brand Name" value="{{ $drug->brand_name }}">
                        @if ($errors->has('brand_name'))
                            <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="manufacture_at"> Manufacture Date</label>
                        <input type="text"  value="{{ $drug->manufacture_at }}" name="manufacture_at" class="form-control" id="manufacture_at"
                                placeholder="Enter Manufacture Date">
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="expires_at"> Expires Date</label>
                        <input type="text" name="expires_at" value="{{ $drug->expires_at }}" class="form-control" id="manufacture_at"
                                placeholder="Enter Expires Date">
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="description"> Description</label>
                        <textarea type="text" name="description" class="form-control" id="description"
                                placeholder="Enter Description">{{ $drug->description }} </textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        
                    </div>
                    
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="image"> Image</label>
                        <img src="{{ asset($drug->image) }} " class="img-fluid" style="max-width: 100%; height: auto;">
                        <input type="file" name="image" class="form-control" id="image"
                                placeholder="Enter Image ">
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="status"> Name</label>
                        <select class="form-select" name="status">
                            <option value="0" {{($drug->status === 0) ? 'Selected' : ''}}>Unverified</option>
                            <option value="1"  {{($drug->status === 1) ? 'Selected' : ''}}>Verified</option>
                            <option value="2"  {{($drug->status === 2) ? 'Selected' : ''}}>Rejected</option>
                          </select>
                        @if ($errors->has('stauts'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-lg-4 col-sm-4">
                        <label for="note"> Note</label>
                        <textarea type="text" name="note" class="form-control" id="note"
                               placeholder="Enter Note">{{ $drug->note }} </textarea>
                        @if ($errors->has('note'))
                            <span class="text-danger">{{ $errors->first('note') }}</span>
                        @endif
                        
                    </div>
                </div>
                    <div class="mb-3">
                        <button class="btn btn-success btn-submit">Submit</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    @endsection
