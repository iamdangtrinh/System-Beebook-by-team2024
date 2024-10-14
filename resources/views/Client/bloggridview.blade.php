@extends('Client.components.header')
@section('body')
<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1 parent megamenu"><a href="index.html">Home <i class="anm anm-plus-l"></i></a>
      <ul>
        <li><a href="#" class="site-nav">Home Group 1<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="index.html" class="site-nav">Home 1 - Classic</a></li>
            <li><a href="home2-default.html" class="site-nav">Home 2 - Default</a></li>
            <li><a href="home15-funiture.html" class="site-nav">Home 15 - Furniture </a></li>
            <li><a href="home3-boxed.html" class="site-nav">Home 3 - Boxed</a></li>
            <li><a href="home4-fullwidth.html" class="site-nav">Home 4 - Fullwidth</a></li>
            <li><a href="home5-cosmetic.html" class="site-nav">Home 5 - Cosmetic</a></li>
            <li><a href="home6-modern.html" class="site-nav">Home 6 - Modern</a></li>
            <li><a href="home7-shoes.html" class="site-nav last">Home 7 - Shoes</a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">Home Group 2<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="home8-jewellery.html" class="site-nav">Home 8 - Jewellery</a></li>
            <li><a href="home9-parallax.html" class="site-nav">Home 9 - Parallax</a></li>
            <li><a href="home10-minimal.html" class="site-nav">Home 10 - Minimal</a></li>
            <li><a href="home11-grid.html" class="site-nav">Home 11 - Grid</a></li>
            <li><a href="home12-category.html" class="site-nav">Home 12 - Category</a></li>
            <li><a href="home13-auto-parts.html" class="site-nav">Home 13 - Auto Parts</a></li>
            <li><a href="home14-bags.html" class="site-nav last">Home 14 - Bags</a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">New Sections<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="home11-grid.html" class="site-nav">Image Gallery</a></li>
            <li><a href="home5-cosmetic.html" class="site-nav">Featured Product</a></li>
            <li><a href="home7-shoes.html" class="site-nav">Columns with Items</a></li>
            <li><a href="home6-modern.html" class="site-nav">Text columns with images</a></li>
            <li><a href="home2-default.html" class="site-nav">Products Carousel</a></li>
            <li><a href="home9-parallax.html" class="site-nav last">Parallax Banner</a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">New Features<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="home13-auto-parts.html" class="site-nav">Top Information Bar </a></li>
            <li><a href="#" class="site-nav">Age Varification </a></li>
            <li><a href="#" class="site-nav">Footer Blocks</a></li>
            <li><a href="#" class="site-nav">2 New Megamenu style</a></li>
            <li><a href="#" class="site-nav">Show Total Savings </a></li>
            <li><a href="#" class="site-nav">New Custom Icons</a></li>
            <li><a href="#" class="site-nav last">Auto Currency</a></li>
          </ul>
        </li>
      </ul>
    </li>
        <li class="lvl1 parent megamenu"><a href="#">Shop <i class="anm anm-plus-l"></i></a>
      <ul>
        <li><a href="#" class="site-nav">Shop Pages<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="shop-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
            <li><a href="shop-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
            <li><a href="shop-fullwidth.html" class="site-nav">Fullwidth</a></li>
            <li><a href="shop-grid-3.html" class="site-nav">3 items per row</a></li>
            <li><a href="shop-grid-4.html" class="site-nav">4 items per row</a></li>
            <li><a href="shop-grid-5.html" class="site-nav">5 items per row</a></li>
            <li><a href="shop-grid-6.html" class="site-nav">6 items per row</a></li>
            <li><a href="shop-grid-7.html" class="site-nav">7 items per row</a></li>
            <li><a href="shop-listview.html" class="site-nav last">Product Listview</a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">Shop Features<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="shop-left-sidebar.html" class="site-nav">Product Countdown </a></li>
            <li><a href="shop-right-sidebar.html" class="site-nav">Infinite Scrolling</a></li>

            <li><a href="shop-grid-3.html" class="site-nav">Pagination - Classic</a></li>
            <li><a href="shop-grid-6.html" class="site-nav">Pagination - Load More</a></li>
            <li><a href="product-labels.html" class="site-nav">Dynamic Product Labels</a></li>
            <li><a href="product-swatches-style.html" class="site-nav">Product Swatches </a></li>
            <li><a href="product-hover-info.html" class="site-nav">Product Hover Info</a></li>
            <li><a href="shop-grid-3.html" class="site-nav">Product Reviews</a></li>
            <li><a href="shop-left-sidebar.html" class="site-nav last">Discount Label </a></li>
          </ul>
        </li>
      </ul>
    </li>
        <li class="lvl1 parent megamenu"><a href="product-layout-1.html">Product <i class="anm anm-plus-l"></i></a>
      <ul>
        <li><a href="product-layout-1.html" class="site-nav">Product Page<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="product-layout-1.html" class="site-nav">Product Layout 1</a></li>
            <li><a href="product-layout-2.html" class="site-nav">Product Layout 2</a></li>
            <li><a href="product-layout-3.html" class="site-nav">Product Layout 3</a></li>
            <li><a href="product-with-left-thumbs.html" class="site-nav">Product With Left Thumbs</a></li>
            <li><a href="product-with-right-thumbs.html" class="site-nav">Product With Right Thumbs</a></li>
            <li><a href="product-with-bottom-thumbs.html" class="site-nav last">Product With Bottom Thumbs</a></li>
          </ul>
        </li>
        <li><a href="short-description.html" class="site-nav">Product Features<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="short-description.html" class="site-nav">Short Description</a></li>
            <li><a href="product-countdown.html" class="site-nav">Product Countdown</a></li>
            <li><a href="product-video.html" class="site-nav">Product Video</a></li>
            <li><a href="product-quantity-message.html" class="site-nav">Product Quantity Message</a></li>
            <li><a href="product-visitor-sold-count.html" class="site-nav">Product Visitor/Sold Count </a></li>
            <li><a href="product-zoom-lightbox.html" class="site-nav last">Product Zoom/Lightbox </a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">Product Features<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="product-with-variant-image.html" class="site-nav">Product with Variant Image</a></li>
            <li><a href="product-with-color-swatch.html" class="site-nav">Product with Color Swatch</a></li>
            <li><a href="product-with-image-swatch.html" class="site-nav">Product with Image Swatch</a></li>
            <li><a href="product-with-dropdown.html" class="site-nav">Product with Dropdown</a></li>
            <li><a href="product-with-rounded-square.html" class="site-nav">Product with Rounded Square</a></li>
            <li><a href="swatches-style.html" class="site-nav last">Product Swatches All Style</a></li>
          </ul>
        </li>
        <li><a href="#" class="site-nav">Product Features<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="product-accordion.html" class="site-nav">Product Accordion</a></li>
            <li><a href="product-pre-orders.html" class="site-nav">Product Pre-orders </a></li>
            <li><a href="product-labels-detail.html" class="site-nav">Product Labels</a></li>
            <li><a href="product-discount.html" class="site-nav">Product Discount In %</a></li>
            <li><a href="product-shipping-message.html" class="site-nav">Product Shipping Message</a></li>
            <li><a href="product-shipping-message.html" class="site-nav last">Size Guide </a></li>
          </ul>
        </li>
      </ul>
    </li>
        <li class="lvl1 parent megamenu"><a href="about-us.html">Pages <i class="anm anm-plus-l"></i></a>
      <ul>
          <li><a href="cart-variant1.html" class="site-nav">Cart Page <i class="anm anm-plus-l"></i></a>
            <ul class="dropdown">
                <li><a href="cart-variant1.html" class="site-nav">Cart Variant1</a></li>
                <li><a href="cart-variant2.html" class="site-nav">Cart Variant2</a></li>
             </ul>
        </li>
        <li><a href="compare-variant1.html" class="site-nav">Compare Product <i class="anm anm-plus-l"></i></a>
            <ul class="dropdown">
                <li><a href="compare-variant1.html" class="site-nav">Compare Variant1</a></li>
                <li><a href="compare-variant2.html" class="site-nav">Compare Variant2</a></li>
             </ul>
        </li>
        <li><a href="checkout.html" class="site-nav">Checkout</a></li>
        <li><a href="about-us.html" class="site-nav">About Us<span class="lbl nm_label1">New</span></a></li>
        <li><a href="contact-us.html" class="site-nav">Contact Us</a></li>
        <li><a href="faqs.html" class="site-nav">FAQs</a></li>
        <li><a href="lookbook1.html" class="site-nav">Lookbook<i class="anm anm-plus-l"></i></a>
          <ul>
            <li><a href="lookbook1.html" class="site-nav">Style 1</a></li>
            <li><a href="lookbook2.html" class="site-nav last">Style 2</a></li>
          </ul>
        </li>
        <li><a href="404.html" class="site-nav">404</a></li>
        <li><a href="coming-soon.html" class="site-nav">Coming soon<span class="lbl nm_label1">New</span></a></li>
      </ul>
    </li>
        <li class="lvl1 parent megamenu"><a href="blog-left-sidebar.html">Blog <i class="anm anm-plus-l"></i></a>
      <ul>
        <li><a href="blog-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
        <li><a href="blog-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
        <li><a href="blog-fullwidth.html" class="site-nav">Fullwidth</a></li>
        <li><a href="blog-grid-view.html" class="site-nav">Gridview</a></li>
        <li><a href="blog-article.html" class="site-nav">Article</a></li>
      </ul>
    </li>
        <li class="lvl1"><a href="#"><b>Buy Now!</b></a>
    </li>
  </ul>
</div>
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
                    <div class="sidebar_widget tags-clouds">
                        <div class="widget-title"><h2>Tags Cloud</h2></div>
                        <div class="widget-content">
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Clothes</a></li>
                                <li><a href="#">Shoes</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">Furniture</a></li>
                                <li><a href="#">Sun Glasses</a></li>
                                <li><a href="#">Winter</a></li>
                                <li><a href="#">Autoparts</a></li>
                            </ul>
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
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-1.jpg" src="{{asset('/')}}client/images/blog/blog-post-1.jpg" alt="It's all about how you wear"></a> 
                            <h2 class="h3"><a href="blog-left-sidebar.html">It's all about how you wear</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la m... </p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-2.jpg" src="{{asset('/')}}client/images/blog/blog-post-2.jpg" alt="27 Days of Spring Fashion Recap"></a> 
                            <h2 class="h3"><a href="blog-right-sidebar.html">27 Days of Spring Fashion Recap</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la m... </p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-3.jpg" src="{{asset('/')}}client/images/blog/blog-post-3.jpg" alt="How to Wear The Folds Trend Four Ways"></a> 
                            <h2 class="h3"><a href="#">How to Wear The Folds Trend Four Ways</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la m... </p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-4.jpg" src="{{asset('/')}}client/images/blog/blog-post-4.jpg" alt="Accusantium doloremque"></a> 
                            <h2 class="h3"><a href="#">Accusantium doloremque</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la m... </p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-5.jpg" src="{{asset('/')}}client/images/blog/blog-post-5.jpg" alt=""></a> 
                            <h2 class="h3"><a href="#">Neque porro quisquam est</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-6.jpg" src="{{asset('/')}}client/images/blog/blog-post-6.jpg" alt=""></a> 
                            <h2 class="h3"><a href="#">Contrary to popular belief</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum</p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 article"> 
                            <!-- Article Image --> 
                             <a class="article_featured-image" href="#"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/blog/blog-post-7.jpg" src="{{asset('/')}}client/images/blog/blog-post-7.jpg" alt=""></a> 
                            <h2 class="h3"><a href="#">The standard chunk of Lorem</a></h2>
                            <ul class="publish-detail">                      
                                <li><i class="anm anm-user-al" aria-hidden="true"></i>  User</li>
                                <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">May 02, 2017</time></li>
                            </ul>
                            <div class="rte"> 
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum</p>
                                 </div>
                            <p><a href="#" class="btn btn-secondary btn--small">Read more <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                        </div>
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
<footer id="footer">
    <div class="newsletter-section">
        <div class="container">
            <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
                        <div class="display-table">
                            <div class="display-table-cell footer-newsletter">
                                <div class="section-header text-center">
                                    <label class="h2"><span>sign up for </span>newsletter</label>
                                </div>
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="email" class="input-group__field newsletter__input" name="EMAIL" value="" placeholder="Email address" required="">
                                        <span class="input-group__btn">
                                            <button type="submit" class="btn newsletter__submit" name="commit" id="Subscribe"><span class="newsletter__submit-text--large">Subscribe</span></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
                        <div class="footer-social">
                            <ul class="list--inline site-footer__social-icons social-icons">
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i class="icon icon-facebook"></i></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i class="icon icon-twitter"></i> <span class="icon__fallback-text">Twitter</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Pinterest"><i class="icon icon-pinterest"></i> <span class="icon__fallback-text">Pinterest</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i class="icon icon-instagram"></i> <span class="icon__fallback-text">Instagram</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Tumblr"><i class="icon icon-tumblr-alt"></i> <span class="icon__fallback-text">Tumblr</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on YouTube"><i class="icon icon-youtube"></i> <span class="icon__fallback-text">YouTube</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Vimeo"><i class="icon icon-vimeo-alt"></i> <span class="icon__fallback-text">Vimeo</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>    
    </div>
    <div class="site-footer">
        <div class="container">
             <!--Footer Links-->
            <div class="footer-top">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Quick Shop</h4>
                        <ul>
                            <li><a href="#">Women</a></li>
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Kids</a></li>
                            <li><a href="#">Sportswear</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Informations</h4>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Terms &amp; condition</a></li>
                            <li><a href="#">My Account</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Customer Services</h4>
                        <ul>
                            <li><a href="#">Request Personal Data</a></li>
                            <li><a href="#">FAQ's</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="#">Support Center</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                        <h4 class="h4">Contact Us</h4>
                        <ul class="addressFooter">
                            <li><i class="icon anm anm-map-marker-al"></i><p>55 Gallaxy Enque,<br>2568 steet, 23568 NY</p></li>
                            <li class="phone"><i class="icon anm anm-phone-s"></i><p>(440) 000 000 0000</p></li>
                            <li class="email"><i class="icon anm anm-envelope-l"></i><p>sales@yousite.com</p></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End Footer Links-->
            <hr>
            <div class="footer-bottom">
                <div class="row">
                    <!--Footer Copyright-->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left"><span></span> <a href="templateshub.net">Templates Hub</a></div>
                    <!--End Footer Copyright-->
                    <!--Footer Payment Icon-->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                        <ul class="payment-icons list--inline">
                            <li><i class="icon fa fa-cc-visa" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-mastercard" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-discover" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-paypal" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-amex" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-credit-card" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <!--End Footer Payment Icon-->
                </div>
            </div>
        </div>
    </div>
</footer>
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