@extends('admin.layouts.app')
@section('title', 'List Blog Post')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog</span></h4>   
    <h6 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Number of posts {{$postsCount}}</span></h6>
    <div class="card">
        {{-- <h5 class="card-header">Blog Posts <span class="badge bg-primary">{{ $blogCount }}</span></h5> --}}
        <div class="table-responsive text-nowrap">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($posts as $post)
                    <tr>
                        <td><strong>{{$post->title}}</strong></td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td><img src="{{ asset('storage/Posts_images/' . $post->image) }}" alt="{{ $post->title }}" style="width: 32px;"></td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('admin.posts.destroy', $post->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="/admin/posts/create" class="btn btn-success">Create New Post</a>
        </div>
    </div>
</div
@endsection