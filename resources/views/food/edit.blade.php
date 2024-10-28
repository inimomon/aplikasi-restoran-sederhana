@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Food</div>

                <div class="card-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <form action="{{ route('food.update', [$food->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $food->name }}" name="name" class="form-control @error('name') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror">{{ $food->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" value="{{ $food->price }}" name="price" class="form-control @error('price') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="" selected disabled>Pilih kategori</option>
                            @foreach(App\Models\Categories::all() as $category)
                                <option value="{{ $category->id }}" @if($category->id == $food->category_id) selected @endif >{{ $category->name_categories }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection