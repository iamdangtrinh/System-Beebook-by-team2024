<title>@yield('title', 'Chi tiết bài viết')</title>
@extends('layout.client')
@section('body')
<!--Mobile Menu-->

<!--End Mobile Menu-->

<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">{{$getPost['title']}}</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span>
            <a href="blog-left-sidebar.html" title="Back to News">News</a><span aria-hidden="true">›</span><span>Blog Article</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="blog--list-view">
                    <div class="article"> 
                      
                        <!-- Article Image --> 
                         <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-1.jpg" src="{{asset('/')}}client/images/blog/blog-post-1.jpg" alt="It's all about how you wear"></a> 
                        <h1><a href="blog-left-sidebar.html">{{$getPost['title']}}</a></h1>
                        <ul class="publish-detail">                      
                            <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                            <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">{{$getPost['updated_at']}}</time></li>
                            <li>
                                <ul class="inline-list">   
                                    <li><i class="icon anm anm-comments-l"></i> <a href="#"> 0 comments</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="rte"> 
                            <p>{{$getProduct['name']}}</p>
                            <h3>Sample Text Listing</h3>
                            <ul class="list-items">
                                <li>Donec et lacus mattis ipsum feugiat interdum non id sapien.</li>
                                <li>Quisque et mauris eget nisi vestibulum rhoncus molestie a ante.</li>
                                <li>Curabitur pulvinar ex at tempus sodales.</li>
                                <li>Mauris efficitur magna quis lectus lobortis venenatis.</li>
                                <li>Nunc id enim eget augue molestie lobortis in a purus.</li>
                            </ul>
                            <h3>Donec maximus quam at lectus bibendum, non suscipit nunc tristique.</h3>
                            <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                        </div>
                        <hr/>
                        <div class="social-sharing">
                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-facebook" title="Share on Facebook">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                            </a>
                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-twitter" title="Tweet on Twitter">
                                <i class="fa fa-twitter" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Tweet</span>
                            </a>
                            <a href="#" title="Share on google+" class="btn btn--small btn--secondary btn--share" >
                                <i class="fa fa-google-plus" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Google+</span>
                            </a>
                            <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Pin on Pinterest">
                                <i class="fa fa-pinterest" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Pin it</span>
                            </a>
                            <a href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Share by Email" target="_blank">
                                <i class="fa fa-envelope" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Email</span>
                            </a>
                        </div>
                        <div class="blog-nav">
                            <div class="text-left">
                                <i class="icon icon-arrow-circle-left"></i>
                                <a href="#" title="">Previous</a>
                            </div>
                            <div class="text-right">
                                <a href="#" title="">Next</a>
                                <i class="icon icon-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!--End Main Content-->
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
                <div class="sidebar_tags">
                    <div class="sidebar_widget categories">
                        <div class="widget-title"><h2>Category</h2></div>
                        <div class="widget-content">
                            <ul class="sidebar_categories">
                                <li class="lvl-1 "><a href="http://annimexweb.com/" class="site-nav lvl-1">Beauty</a></li>
                                <li class="lvl-1  active"><a href="#" class="site-nav lvl-1">fashion</a></li>
                                <li class="lvl-1 "><a href="#" class="site-nav lvl-1">summer</a></li>
                                <li class="lvl-1 "><a href="#" class="site-nav lvl-1">trend</a></li>
                                <li class="lvl-1 "><a href="#" class="site-nav lvl-1">winter</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Recent Posts</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="#">
                                            <img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-sml-1.jpg" src="{{asset('/')}}client/images/blog/blog-post-sml-1.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">It's all about how you wear</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May 02, 2017</time></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-sml-2.jpg" src="{{asset('/')}}client/images/blog/blog-post-sml-2.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">27 Days of Spring Fashion Recap</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-sml-3.jpg" src="{{asset('/')}}client/images/blog/blog-post-sml-3.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">How to Wear The Folds Trend Four Ways</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:14:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-sml-4.jpg" src="{{asset('/')}}client/images/blog/blog-post-sml-4.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Accusantium doloremque</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:12:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="sidebar_widget static-banner">
                        <img src="{{asset('/')}}client/images/side-banner-2.jpg" alt="">
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Trending Now</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="#">
                                            <img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/mini-product-img.jpg" src="{{asset('/')}}client/images/product-images/mini-product-img.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Cena Skirt</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$173.60</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/mini-product-img1.jpg" src="{{asset('/')}}client/images/product-images/mini-product-img1.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Block Button Up</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$378.00</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/mini-product-img2.jpg" src="{{asset('/')}}client/images/product-images/mini-product-img2.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Balda Button Pant</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$278.60</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/mini-product-img3.jpg" src="{{asset('/')}}client/images/product-images/mini-product-img3.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Border Dress in Black/Silver</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$228.00</span></span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <!--End Sidebar-->
        </div>
    </div>
    
</div>
<!--End Body Content-->

<!--Footer-->

<!--End Footer-->
<!--Scoll Top-->
<span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
<!--End Scoll Top-->

 <!-- Including Jquery -->
 <script src="{{asset('/')}}client/js/vendor/jquery-3.3.1.min.js"></script>
 <script src="{{asset('/')}}client/js/vendor/jquery.cookie.js"></script>
 <script src="{{asset('/')}}client/js/vendor/modernizr-3.6.0.min.js"></script>
 <script src="{{asset('/')}}client/js/vendor/wow.min.js"></script>
 <!-- Including Javascript -->
 <script src="{{asset('/')}}client/js/bootstrap.min.js"></script>
 <script src="{{asset('/')}}client/js/plugins.js"></script>
 <script src="{{asset('/')}}client/js/popper.min.js"></script>
 <script src="{{asset('/')}}client/js/lazysizes.js"></script>
 <script src="{{asset('/')}}client/js/main.js"></script>
</div>
</body>

<!-- belle/blog-article.html   11 Nov 2019 12:47:01 GMT -->
</html>
@endsection