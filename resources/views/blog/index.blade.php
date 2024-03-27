@extends('layouts.master')

@section('title', 'Blog')

@section('content')
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="blog-right-sidebar p-3">
                    <div class="card mb-4">
                        <img src="assets/images/posts/01.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="list-inline">	<a href="javascript:;" class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-comment-detail me-1'></i>16 Comments</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>November 5, 2021</a>
                            </div>
                            <h4 class="mt-4">Post Title Here</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>	<a href="single.html" class="btn btn-dark btn-ecomm">Read More <i class='bx bx-chevrons-right' ></i></a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <img src="assets/images/posts/02.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="list-inline">	<a href="javascript:;" class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-comment-detail me-1'></i>16 Comments</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>November 5, 2021</a>
                            </div>
                            <h4 class="mt-4">Post Title Here</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>	<a href="single.html" class="btn btn-dark btn-ecomm">Read More <i class='bx bx-chevrons-right' ></i></a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <img src="assets/images/posts/03.png" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="list-inline">	<a href="javascript:;" class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-comment-detail me-1'></i>16 Comments</a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bx-calendar me-1'></i>November 5, 2021</a>
                            </div>
                            <h4 class="mt-4">Post Title Here</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>	<a href="single.html" class="btn btn-dark btn-ecomm">Read More <i class='bx bx-chevrons-right' ></i></a>
                        </div>
                    </div>
                    <hr>
                    <nav class="d-flex justify-content-between" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:;"><i class="bx bx-chevron-left"></i> Prev</a>
                            </li>
                        </ul>
                        <ul class="pagination">
                            <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span>
                            </li>
                            <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">2</a>
                            </li>
                            <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">3</a>
                            </li>
                            <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">4</a>
                            </li>
                            <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript:;">5</a>
                            </li>
                        </ul>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:;" aria-label="Next">Next <i class="bx bx-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</section>
@endsection