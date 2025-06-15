@extends('layouts.master')

@section('title', 'Blog')

@section('content')
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-right-sidebar p-3">
                    @foreach($posts as $post)
                        <div class="card mb-4">
                            <img src="{{ asset('storage/Posts_images/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; " class="card-img-top mx-auto d-block">
                            <div class="card-body">
                                <div class="list-inline">	<a href="javascript:;" class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bx-comment-detail me-1'></i>16 Comments</a>
                                    <a href="javascript:;" class="list-inline-item">
                                        <i class='bx bx-calendar me-1'></i>{{ $post->created_at->format('d.m.Y.') }}
                                    </a>
                                </div>
                                <h4 class="mt-4">{{$post->title}}</h4>
                               <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                <a href="{{ route('blog.show', $post->id) }}" class="btn btn-dark btn-ecomm">Pročitaj više <i class='bx bx-chevrons-right'></i></a> 
                             
                            </div>
                        </div>
                    @endforeach
                    <hr>
                     {{ $posts->links() }}
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</section>
@endsection