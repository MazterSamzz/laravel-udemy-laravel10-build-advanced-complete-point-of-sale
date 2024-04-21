@extends('frontend.main_master')

@section('title')
    Blog | Ivan - Personal Portfolio
@endsection

@section('main')

    <main>

        <!-- breadcrumb-area -->
            @include('frontend.blog.breadcrumb')
        <!-- breadcrumb-area-end -->


        <!-- blog-area -->
        <section class="standard__blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        
                        @foreach ($blogs as $blog)
                        <div class="standard__blog__post">
                            <div class="standard__blog__thumb">
                                <a href="{{ route('blogs.show', ['blog'=>$blog->slug]) }}"><img src="{{ asset($blog->image) }}" alt=""></a>
                                <a href="{{ route('blogs.show', ['blog'=>$blog->slug]) }}" class="blog__link"><i class="far fa-long-arrow-right"></i></a>
                            </div>
                            <div class="standard__blog__content">
                                <div class="blog__post__avatar">
                                    <div class="thumb"><img src="assets/img/blog/blog_avatar.png" alt=""></div>
                                    <span class="post__by">By : <a href="#">Halina Spond</a></span>
                                </div>
                                <h2 class="title"><a href="{{ route('blogs.show', ['blog'=>$blog->slug]) }}">{{ $blog->title }}</a></h2>
                                <p>{!! strlen($blog->description) > 200 ? substr($blog->description, 0, 200) . '...' : $blog->description !!}</p>
                                <ul class="blog__post__meta">
                                    <li><i class="fal fa-calendar-alt"></i> 25 january 2021</li>
                                    <li><i class="fal fa-comments-alt"></i> <a href="#">Comment (08)</a></li>
                                    <li class="post-share"><a href="#"><i class="fal fa-share-all"></i> (18)</a></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="pagination-wrap">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i class="far fa-long-arrow-left"></i></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="far fa-long-arrow-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @include('frontend.blog.right_sidebar')
                </div>
            </div>
        </section>
        <!-- blog-area-end -->


        <!-- contact-area -->
        <section class="homeContact homeContact__style__two">
            <div class="container">
                <div class="homeContact__wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="section__title">
                                <span class="sub-title">07 - Say hello</span>
                                <h2 class="title">Any questions? Feel free <br> to contact</h2>
                            </div>
                            <div class="homeContact__content">
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <h2 class="mail"><a href="mailto:Info@webmail.com">Info@webmail.com</a></h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="homeContact__form">
                                <form action="#">
                                    <input type="text" placeholder="Enter name*">
                                    <input type="email" placeholder="Enter mail*">
                                    <input type="number" placeholder="Enter number*">
                                    <textarea name="message" placeholder="Enter Massage*"></textarea>
                                    <button type="submit">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>

@endsection