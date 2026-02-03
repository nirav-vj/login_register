@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Contact</div>
                <div class="card-body">
                    <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gender:</label><br>
                            <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}> Male
                            <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}> Female
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Interests:</label><br>
                            <input type="checkbox" name="interests[]" value="Coding" {{ in_array('Coding', old('interests', [])) ? 'checked' : '' }}> Coding
                            <input type="checkbox" name="interests[]" value="Reading" {{ in_array('Reading', old('interests', [])) ? 'checked' : '' }}> Reading
                            <input type="checkbox" name="interests[]" value="Traveling" {{ in_array('Traveling', old('interests', [])) ? 'checked' : '' }}> Traveling
                            @error('interests')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category:</label>
                            <div class="d-flex">
                                <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#createCategoryModal">
                                <i class="fa fa-plus " style="color: white;"></i>
                            </button>
                            </div>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Skills:</label>
                            <select name="skills[]" class="form-control" multiple>
                                <option value="Laravel" {{ in_array('Laravel', old('skills', [])) ? 'selected' : '' }}>Laravel</option>
                                <option value="CodeIgniter" {{ in_array('CodeIgniter', old('skills', [])) ? 'selected' : '' }}>CodeIgniter</option>
                                <option value="React JS" {{ in_array('React JS', old('skills', [])) ? 'selected' : '' }}>React JS</option>
                            </select>
                            @error('skills')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Images:</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-error-message" class="alert alert-danger d-none"></div>
                <form id="createCategoryForm" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="categorySlug">Slug</label>
                        <input type="text" class="form-control" id="categorySlug" name="slug" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="createCategoryForm" class="btn btn-primary">Save Category</button>
            </div>
                </form>
        </div>
    </div>
</div>
@endsection
