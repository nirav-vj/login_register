@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Trashed Contacts
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary float-right">Back to Contacts</a>
                </div>

                <div class="card-body">
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
                        @forelse ($contacts as $contact)
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
                                @if($contact->interests)
                                    @foreach($contact->interests as $interest)
                                        <span>{{ $interest }},</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if($contact->skills)
                                    @foreach($contact->skills as $skill)
                                        <span>{{ $skill }},</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" style="display:inline-block; margin-bottom:5px;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                                <form action="{{ route('contacts.force-delete', $contact->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No soft deleted contacts found.</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
