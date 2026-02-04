@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Categories') }}
                    <a class="btn btn-success float-right " href="{{ route('categories.create') }}"> Create Category</a>
                    <a class="btn btn-primary float-right"  href="{{ route('contacts.index') }}">Contact</a>
                </div>

                <div class="card-body">
                    <!-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif -->

                    <table class="table table-bordered text-center">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
