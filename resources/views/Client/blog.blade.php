<title>@yield('title', 'Bài viết')</title>
@extends('layout.client')
@section('body')
<!--Mobile Menu-->

<!--End Mobile Menu-->

<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Blog Gridview</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Blog Gridview</span>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
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
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Recent Comments</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="#">
                                            <img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/recent-commnet-img.jpg" src="{{asset('/')}}client/images/recent-commnet-img.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="details">
                                        <div class="grid-view-item__meta"><strong>Tim</strong> On <a href="#">Lorem Ipsum</a></div>
                                        <a class="grid-view-item__title" href="#">On sait depuis longtemps que travailler avec</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/recent-commnet-img.jpg" src="{{asset('/')}}client/images/recent-commnet-img.jpg" alt="" /></a> </div>
                                    <div class="details">
                                        <div class="grid-view-item__meta"><strong>Joy</strong> On <a href="#">Lorem Ipsum</a></div>
                                        <a class="grid-view-item__title" href="#">On sait depuis longtemps que travailler avec</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/recent-commnet-img.jpg" src="{{asset('/')}}client/images/recent-commnet-img.jpg" alt="" /></a> </div>
                                    <div class="details">
                                        <div class="grid-view-item__meta"><strong>Jhon</strong> On <a href="#">Lorem Ipsum</a></div>
                                        <a class="grid-view-item__title" href="#">On sait depuis longtemps que travailler avec</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up lazyload" data-src="{{asset('/')}}client/images/recent-commnet-img.jpg" src="{{asset('/')}}client/images/recent-commnet-img.jpg" alt="" /></a> </div>
                                    <div class="details">
                                        <div class="grid-view-item__meta"><strong>Tim</strong> On <a href="#">Lorem Ipsum</a></div>
                                        <a class="grid-view-item__title" href="#">On sait depuis longtemps que travailler avec</a>
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
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="custom-search">
                    <form action="http://annimexweb.com/search" method="get" class="input-group search-header search" role="search" style="position: relative;">
                        <input class="search-header__input search__input input-group__field" type="search" name="q" placeholder="Search" aria-label="Search" autocomplete="off">
                        <span class="input-group__btn"><button class="btnSearch" type="submit"> <i class="icon anm anm-search-l"></i> </button></span>
                    </form>
                </div>
                <div class="blog--list-view">
                    <div class="row">
                       @foreach($blogs as $blog) 
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="/posts/{{$blog['slug']}}"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-1.jpg" src="{{asset('/')}}client/images/blog/blog-post-1.jpg" alt="It's all about how you wear"></a> 
                            <h2 class="h3"><a href="blog-left-sidebar.html">{{ $blog['title'] }}</a></h2>
                            <p>{{ $blog['tags'] }}</p>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $blog['views'] }}</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">{{ $blog['updated_at'] }}</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>{{ $blog['post_type']}} </p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Xem Chi Tiết <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        @endforeach
                       
                       
                    </div>
                    <hr/>
                    <div class="pagination">
                        <ul>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="next"><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
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

<!-- belle/blog-grid-view.html   11 Nov 2019 12:47:01 GMT -->
</html>
@endsection