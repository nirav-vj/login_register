@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Contacts
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary float-right">Create Contact</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-success float-right">Category</a>
                
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered text-center">
                        <tr>
                            <th>No</th>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Interests</th>
                            <th>Skills</th>
                            <th width="200px">Action</th>
                        </tr>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($contact->images)
                                    @foreach($contact->images as $image)
                                        <img src="/storage/{{ $image }}" style="border-radius: 50%; width:70px; height:70px;object-fit: cover;">
                                    @endforeach
                                @endif
                            </td>
                            <td style="width: 150px;">{{ $contact->name }}</td>
                            <td>{{ $contact->category->name ?? 'N/A' }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->gender }}</td>
                            <td>
                                @foreach($contact->interests as $interest)
                                    <span>{{ $interest }},</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($contact->skills as $skill)
                                    <span>{{ $skill }},</span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>
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