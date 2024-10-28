@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">All Food</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($foods) > 0)
                            @foreach($foods as $key => $food)
                            <tr>
                                <td><img src="{{ asset('images') }}/{{ $food->image }}" height="50" width="50"></td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->description }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->category_id }}</td>
                                <td>
                                    <a href="{{ route('food.edit', [$food->id]) }}">
                                        <button class="btn btn-outline-success">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <form action="{{ route('food.destroy', [$food->id]) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-outline-danger">
                                            Delete
                                            </button>
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">No category found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                <div class="d-flex justify-content-center">
                    {{ $foods->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection