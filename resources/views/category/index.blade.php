@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">All Category</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Show</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($categories) > 0)
                            @foreach($categories as $key => $category)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $category->name_categories }}</td>
                                <td>
                                    <a href="{{ route('category.show', [$category->id]) }}"><button class="btn btn-outline-primary">Show</button></a>
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', [$category->id]) }}"><button class="btn btn-outline-success">Edit</button></a>
                                </td>
                                <td>
                                    <a href="">
                                        <form action="{{ route('category.destroy', [$category->id]) }}" method="POST">
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
            </div>
        </div>
    </div>
</div>
@endsection
