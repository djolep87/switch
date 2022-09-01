@extends('layouts.master')

@section('title', 'Proizvod')

@section('content')
@php
    $images = explode(",",$product->images)
@endphp
<div class="page-wrapper">
    <div class="page-content"
        <!--start product detail-->
        <section class="py-4">
            <div class="container">
                <div class="product-detail-card">
                    <div class="product-detail-body">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5">
                                <div class="image-zoom-section">
                                    <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
                                        <div class="item">
                                            <img src="/storage/Product_images/{{ $product->image }}" class="img-fluid" alt="">
                                        </div>
                                        @foreach ( $images as $image)
                                            <div class="item">
                                                <img src="/storage/Product_images/{{ $image }}" class="" alt="">
                                            </div>
                                        @endforeach                                      
                                    </div>
                                        
                                    <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                        <button class="owl-thumb-item">
                                            <img src="/storage/Product_images/{{ $product->image }}" class="img-fluid" alt="">
                                        </button>
                                        @foreach ( $images as $image)
                                            <button class="owl-thumb-item">
                                                <img src="/storage/Product_images/{{ $image }}" class="" alt="">
                                            </button>
                                        @endforeach
                                    </div>
                                      
                                    
                                    
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="product-info-section p-3">
                                    <h3 class="mt-3 mt-lg-0 mb-0">{{$product->name}}</h3>
                                    <h6 class="">({{$product->condition}})</h6>

                                    <div class="mt-3">
                                        <h6>Opis :</h6>
                                        <p class="mb-0">{{ $product->description }}</p>
                                        
                                    </div>
                                    <dl class="row mt-3">	<dt class="col-sm-3">Product id</dt>
                                        <dd class="col-sm-9">#{{$product->id}}</dd>	<dt class="col-sm-3">Delivery</dt>
                                        <dd class="col-sm-9">Srbija</dd>
                                    </dl>

                                    <div class="my-3">
                                        {{$product->user->city}}<br/>
                                        {{$product->user->firstName}}<br/>
                                        {{$product->user->phone}}                                        
                                    </div>

                                    <div class="d-flex gap-2 mt-3">
                                        <a href="javascript:;" class="btn btn-white btn-ecomm">	<i class="bx bxs-cart-add"></i>Pošalji zahtev za zamenu</a> <a href="javascript:;" class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Sačuvaj</a>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </section>
        <!--end product detail-->
        <!--start product more info-->
        <section class="py-4">
            <div class="container">
                <div class="product-more-info">
                    <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#discription" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">Description</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#more-info" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">More Info</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tags" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">Tags</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#reviews" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title text-uppercase fw-500">(3) Reviews</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="discription" role="tabpanel">
                            <p>{{$product->description}}</p>
                            
                            <p class="mb-1">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone.</p>
                            <p class="mb-1">Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
                        </div>
                        <div class="tab-pane fade" id="more-info" role="tabpanel">
                            <p></p>
                        </div>
                        <div class="tab-pane fade" id="tags" role="tabpanel">
                            <div class="tags-box w-50">	<a href="javascript:;" class="tag-link">Cloths</a>
                                <a href="javascript:;" class="tag-link">Electronis</a>
                                <a href="javascript:;" class="tag-link">Furniture</a>
                                <a href="javascript:;" class="tag-link">Sports</a>
                                <a href="javascript:;" class="tag-link">Men Wear</a>
                                <a href="javascript:;" class="tag-link">Women Wear</a>
                                <a href="javascript:;" class="tag-link">Laptops</a>
                                <a href="javascript:;" class="tag-link">Formal Shirts</a>
                                <a href="javascript:;" class="tag-link">Topwear</a>
                                <a href="javascript:;" class="tag-link">Headphones</a>
                                <a href="javascript:;" class="tag-link">Bottom Wear</a>
                                <a href="javascript:;" class="tag-link">Bags</a>
                                <a href="javascript:;" class="tag-link">Sofa</a>
                                <a href="javascript:;" class="tag-link">Shoes</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col col-lg-8">
                                    <div class="product-review">
                                        <h5 class="mb-4">3 Reviews For The Product</h5>
                                        <div class="review-list">
                                            <div class="d-flex align-items-start">
                                                <div class="review-user">
                                                    <img src="assets/images/avatars/avatar-1.png" width="65" height="65" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="review-content ms-3">
                                                    <div class="rates cursor-pointer fs-6">	<i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-light-4"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <h6 class="mb-0">James Caviness</h6>
                                                        <p class="mb-0 ms-auto">February 16, 2021</p>
                                                    </div>
                                                    <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan</p>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="d-flex align-items-start">
                                                <div class="review-user">
                                                    <img src="assets/images/avatars/avatar-2.png" width="65" height="65" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="review-content ms-3">
                                                    <div class="rates cursor-pointer fs-6"> <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-light-4"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <h6 class="mb-0">David Buckley</h6>
                                                        <p class="mb-0 ms-auto">February 22, 2021</p>
                                                    </div>
                                                    <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan</p>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="d-flex align-items-start">
                                                <div class="review-user">
                                                    <img src="assets/images/avatars/avatar-3.png" width="65" height="65" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="review-content ms-3">
                                                    <div class="rates cursor-pointer fs-6">	<i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-white"></i>
                                                        <i class="bx bxs-star text-light-4"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <h6 class="mb-0">Peter Costanzo</h6>
                                                        <p class="mb-0 ms-auto">February 26, 2021</p>
                                                    </div>
                                                    <p>Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <div class="add-review bg-dark-1">
                                        <div class="form-body p-3">
                                            <h4 class="mb-4">Write a Review</h4>
                                            <div class="mb-3">
                                                <label class="form-label">Your Name</label>
                                                <input type="text" class="form-control rounded-0">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Your Email</label>
                                                <input type="text" class="form-control rounded-0">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rating</label>
                                                <select class="form-select rounded-0">
                                                    <option selected>Choose Rating</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="3">4</option>
                                                    <option value="3">5</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Example textarea</label>
                                                <textarea class="form-control rounded-0" rows="3"></textarea>
                                            </div>
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-light btn-ecomm">Submit a Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end product more info-->
    </div>
</div>
@endsection
