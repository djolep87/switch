@extends('admin.layouts.app')
@section('title', 'Update Blog Post')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog /</span> Update Post</h4>
    <div class="card">
        <h5 class="card-header">Update Blog Post</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $post->title }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div id="container">
                    <div id="editorContainer">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="description">{{ $post->content }}</textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>
@endsection