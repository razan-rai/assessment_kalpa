@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                    <caption>List of registered drugs</caption>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Applied By</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Manufactured Date</th>
                        <th scope="col">Expired Date</th>
                        <th scope="col">Descreption</th>
                        <th scope="col">Images</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($unverified_drugs as $drugs)
                        <tr>
                          <th scope="row">{{ $drugs->id }}</th>
                          <td>{{ $drugs->name }}</td>
                          <td>{{ $drugs->user->name }}</td>
                          <td> {{ $drugs->brand_name }}</td>
                          <td> {{ $drugs->manufacture_at }}</td>
                          <td> {{ $drugs->expires_at }}</td>
                          <td> {{ $drugs->description }}</td>
                          <td> <img src="{{ asset($drugs->image) }} " class="img-fluid" style="max-width: 100%; height: auto;"></td>
                          <td> <a href="{{ route('reviewer.edit', $drugs->id) }}" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">Edit/View</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection