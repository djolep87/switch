@extends('layouts.master')

@section('title', 'Blog')

@section('content')
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="blog-right-sidebar p-3">
                    <div class="card shadow-none bg-transparent">
                        <img src="{{ asset('storage/Posts_images/' . $post->image) }}" class="card-img-top mx-auto d-block" style="width: 100%; max-width: 600px;" alt="">
                        <div class="card-body p-0">
                            <div class="list-inline mt-4">	<a href="javascript:;" class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-comment-detail me-1'></i>16 Comments</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>November 5, 2021</a>
                            </div>
                            <h4 class="mt-4">{{$post->title}}</h4>
                           {!! $post->content !!}
                            {{-- <div class="d-flex align-items-center gap-2 py-4 border-top border-bottom">
                                <div class="">
                                    <h6 class="mb-0 text-uppercase">Share This Post</h6>
                                </div>
                                <div class="list-inline blog-sharing">	<a href="javascript:;" class="list-inline-item"><i class='bx bxl-facebook'></i></a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bxl-twitter'></i></a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bxl-linkedin'></i></a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bxl-instagram'></i></a>
                                    <a href="javascript:;" class="list-inline-item"><i class='bx bxl-tumblr'></i></a>
                                </div>
                            </div>
                            <div class="author d-flex align-items-center gap-3 py-4">
                                <img src="assets/images/avatars/avatar-1.png" alt="" width="80">
                                <div class="">
                                    <h6 class="mb-0">Jhon Doe</h6>
                                    <p class="mb-0">Donec egestas metus non vehicula accumsan. Pellentesque sit amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa eget viverra. Suspendisse vitae dolor erat. Morbi id rhoncus enim. In hac habitasse platea dictumst. Aenean lorem diam, venenatis nec venenatis id, adipiscing ac massa.</p>
                                </div>
                            </div>
                            <div class="reply-form p-4 border bg-dark-1">
                                <h6 class="mb-0">Leave a Reply</h6>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Comment</label>
                                        <textarea class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Website</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-light btn-ecomm">Post Comment</button>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</section>
@endsection