<title>@yield('title', 'Bán hàng')</title>
@extends('layout.client')
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
    <!--Collection Banner-->
    <div class="collection-header">
        <div class="collection-hero">
            <div class="collection-hero__image"><img class="blur-up lazyload" data-src="{{asset('/')}}client/images/cat-women1.jpg" src="{{asset('/')}}client/images/cat-women1.jpg" alt="Women" title="Women" /></div>
            <div class="collection-hero__title-wrapper"><h1 class="collection-hero__title page-width">Shop Grid 4 Column</h1></div>
          </div>
    </div>
    <!--End Collection Banner-->
    
    <div class="container">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                <div class="sidebar_tags">
                    <!--Categories-->
                    <div class="sidebar_widget categories filter-widget">
                        <div class="widget-title"><h2>Categories</h2></div>
                        <div class="widget-content">
                            <ul class="sidebar_categories">
                                <li class="level1 sub-level"><a href="#;" class="site-nav">Clothing</a>
                                    <ul class="sublinks">
                                        <li class="level2"><a href="#;" class="site-nav">Men</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Women</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Child</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">View All Clothing</a></li>
                                    </ul>
                                </li>
                                <li class="level1 sub-level"><a href="#;" class="site-nav">Jewellery</a>
                                    <ul class="sublinks">
                                        <li class="level2"><a href="#;" class="site-nav">Ring</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Neckalses</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">Eaarings</a></li>
                                        <li class="level2"><a href="#;" class="site-nav">View All Jewellery</a></li>
                                    </ul>
                                </li>
                                <li class="lvl-1"><a href="#;" class="site-nav">Shoes</a></li>
                                <li class="lvl-1"><a href="#;" class="site-nav">Accessories</a></li>
                                <li class="lvl-1"><a href="#;" class="site-nav">Collections</a></li>
                                <li class="lvl-1"><a href="#;" class="site-nav">Sale</a></li>
                                <li class="lvl-1"><a href="#;" class="site-nav">Page</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!--Price Filter-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Price</h2>
                        </div>
                        <form action="#" method="post" class="price-filter">
                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="no-margin"><input id="amount" type="text"></p>
                                </div>
                                <div class="col-6 text-right margin-25px-top">
                                    <button class="btn btn-secondary btn--small">filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End Price Filter-->
                    <!--Size Swatches-->
                    <div class="sidebar_widget filterBox filter-widget size-swacthes">
                        <div class="widget-title"><h2>Size</h2></div>
                        <div class="filter-color swacth-list">
                            <ul>
                                <li><span class="swacth-btn checked">X</span></li>
                                <li><span class="swacth-btn">XL</span></li>
                                <li><span class="swacth-btn">XLL</span></li>
                                <li><span class="swacth-btn">M</span></li>
                                <li><span class="swacth-btn">L</span></li>
                                <li><span class="swacth-btn">S</span></li>
                                <li><span class="swacth-btn">XXXL</span></li>
                                <li><span class="swacth-btn">XXL</span></li>
                                <li><span class="swacth-btn">XS</span></span></li>
                            </ul>
                        </div>
                    </div>
                    <!--End Size Swatches-->
                    <!--Color Swatches-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title"><h2>Color</h2></div>
                        <div class="filter-color swacth-list clearfix">
                            <span class="swacth-btn black"></span>
                            <span class="swacth-btn white checked"></span>
                            <span class="swacth-btn red"></span>
                            <span class="swacth-btn blue"></span>
                            <span class="swacth-btn pink"></span>
                            <span class="swacth-btn gray"></span>
                            <span class="swacth-btn green"></span>
                            <span class="swacth-btn orange"></span>
                            <span class="swacth-btn yellow"></span>
                            <span class="swacth-btn blueviolet"></span>
                            <span class="swacth-btn brown"></span>
                            <span class="swacth-btn darkGoldenRod"></span> 
                            <span class="swacth-btn darkGreen"></span> 
                            <span class="swacth-btn darkRed"></span> 
                            <span class="swacth-btn dimGrey"></span>
                            <span class="swacth-btn khaki"></span> 
                        </div>
                    </div>
                    <!--End Color Swatches-->
                    <!--Brand-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title"><h2>Brands</h2></div>
                        <ul>
                            <li>
                              <input type="checkbox" value="allen-vela" id="check1">
                              <label for="check1"><span><span></span></span>Allen Vela</label>
                            </li>
                            <li>
                              <input type="checkbox" value="oxymat" id="check3">
                              <label for="check3"><span><span></span></span>Oxymat</label>
                            </li>
                            <li>
                              <input type="checkbox" value="vanelas" id="check4">
                              <label for="check4"><span><span></span></span>Vanelas</label>
                            </li>
                            <li>
                              <input type="checkbox" value="pagini" id="check5">
                              <label for="check5"><span><span></span></span>Pagini</label>
                            </li>
                            <li>
                              <input type="checkbox" value="monark" id="check6">
                              <label for="check6"><span><span></span></span>Monark</label>
                            </li>
                        </ul>
                    </div>
                    <!--End Brand-->
                    <!--Popular Products-->
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Popular Products</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="#">
                                            <img class="grid-view-item__image" src="{{asset('/')}}client/images/product-images/mini-product-img.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Cena Skirt</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$173.60</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('/')}}client/images/product-images/mini-product-img1.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Block Button Up</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$378.00</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('/')}}client/images/product-images/mini-product-img2.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Balda Button Pant</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$278.60</span></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image" src="{{asset('/')}}client/images/product-images/mini-product-img3.jpg" alt="" /></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Border Dress in Black/Silver</a>
                                      <div class="grid-view-item__meta"><span class="product-price__price"><span class="money">$228.00</span></span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <!--End Popular Products-->
                    <!--Banner-->
                    <div class="sidebar_widget static-banner">
                        <img src="{{asset('/')}}client/images/side-banner-2.jpg" alt="" />
                    </div>
                    <!--Banner-->
                    <!--Information-->
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Information</h2></div>
                        <div class="widget-content"><p>Use this text to share information about your brand with your customers. Describe a product, share announcements, or welcome customers to your store.</p></div>
                    </div>
                    <!--end Information-->
                    <!--Product Tags-->
                    <div class="sidebar_widget">
                      <div class="widget-title">
                        <h2>Product Tags</h2>
                      </div>
                      <div class="widget-content">
                        <ul class="product-tags">
                          <li><a href="#" title="Show products matching tag $100 - $400">$100 - $400</a></li>
                          <li><a href="#" title="Show products matching tag $400 - $600">$400 - $600</a></li>
                          <li><a href="#" title="Show products matching tag $600 - $800">$600 - $800</a></li>
                          <li><a href="#" title="Show products matching tag Above $800">Above $800</a></li>
                          <li><a href="#" title="Show products matching tag Allen Vela">Allen Vela</a></li>
                          <li><a href="#" title="Show products matching tag Black">Black</a></li>
                          <li><a href="#" title="Show products matching tag Blue">Blue</a></li>
                          <li><a href="#" title="Show products matching tag Cantitate">Cantitate</a></li>
                          <li><a href="#" title="Show products matching tag Famiza">Famiza</a></li>
                          <li><a href="#" title="Show products matching tag Gray">Gray</a></li>
                          <li><a href="#" title="Show products matching tag Green">Green</a></li>
                          <li><a href="#" title="Show products matching tag Hot">Hot</a></li>
                          <li><a href="#" title="Show products matching tag jean shop">jean shop</a></li>
                          <li><a href="#" title="Show products matching tag jesse kamm">jesse kamm</a></li>
                          <li><a href="#" title="Show products matching tag L">L</a></li>
                          <li><a href="#" title="Show products matching tag Lardini">Lardini</a></li>
                          <li><a href="#" title="Show products matching tag lareida">lareida</a></li>
                          <li><a href="#" title="Show products matching tag Lirisla">Lirisla</a></li>
                          <li><a href="#" title="Show products matching tag M">M</a></li>
                          <li><a href="#" title="Show products matching tag mini-dress">mini-dress</a></li>
                          <li><a href="#" title="Show products matching tag Monark">Monark</a></li>
                          <li><a href="#" title="Show products matching tag Navy">Navy</a></li>
                          <li><a href="#" title="Show products matching tag new">new</a></li>
                          <li><a href="#" title="Show products matching tag new arrivals">new arrivals</a></li>
                          <li><a href="#" title="Show products matching tag Orange">Orange</a></li>
                          <li><a href="#" title="Show products matching tag oxford">oxford</a></li>
                          <li><a href="#" title="Show products matching tag Oxymat">Oxymat</a></li>
                        </ul>
                        <span class="btn btn--small btnview">View all</span> </div>
                    </div>
                    <!--end Product Tags-->
                </div>
            </div>
            <!--End Sidebar-->
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="productList">
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                                    <a href="shop-left-sidebar.html" title="Grid View" class="change-view change-view--active">
                                        <img src="{{asset('/')}}client/images/grid.jpg" alt="Grid" />
                                    </a>
                                    <a href="shop-listview.html" title="List View" class="change-view">
                                        <img src="{{asset('/')}}client/images/list.jpg" alt="List" />
                                    </a>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                    <span class="filters-toolbar__product-count">Showing: 22</span>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-right">
                                    <div class="filters-toolbar__item">
                                          <label for="SortBy" class="hidden">Sort</label>
                                          <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="title-ascending" selected="selected">Sort</option>
                                            <option>Best Selling</option>
                                            <option>Alphabetically, A-Z</option>
                                            <option>Alphabetically, Z-A</option>
                                            <option>Price, low to high</option>
                                            <option>Price, high to low</option>
                                            <option>Date, new to old</option>
                                            <option>Date, old to new</option>
                                          </select>
                                          <input class="collection-header__default-sort" type="hidden" value="manual">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <div class="grid-products grid--view-items">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image1.jpg" src="{{asset('/')}}client/images/product-images/product-image1.jpg" alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image1-1.jpg" src="{{asset('/')}}client/images/product-images/product-image1-1.jpg" alt="image" title="product">
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->
                                    
                                    <!-- countdown start -->
                                    <div class="saleTime desktop" data-countdown="2022/03/01"></div>
                                    <!-- countdown end -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Select Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Edna Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price">$500.00</span>
                                        <span class="price">$600.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant2.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant4.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant5.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant6.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                                <!-- countdown start -->
                                <div class="timermobile"><div class="saleTime desktop" data-countdown="2022/03/01"></div></div>
                                <!-- countdown end -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image2.jpg" src="{{asset('/')}}client/images/product-images/product-image2.jpg" alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image2-1.jpg" src="{{asset('/')}}client/images/product-images/product-image2-1.jpg" alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Select Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Elastic Waist Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$748.00</span>
                                    </div>
                                    <!-- End product price -->
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant2-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant2-2.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant2-3.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant2-4.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image3.jpg" src="{{asset('/')}}client/images/product-images/product-image3.jpg" alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image3-1.jpg" src="{{asset('/')}}client/images/product-images/product-image3-1.jpg" alt="image" title="product">
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels rectangular"><span class="lbl pr-label2">Hot</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Select Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">3/4 Sleeve Kimono Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$550.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-2.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-3.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-4.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image4.jpg" src="{{asset('/')}}client/images/product-images/product-image4.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image4-1.jpg" src="{{asset('/')}}client/images/product-images/product-image4-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add To Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Cape Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price">$900.00</span>
                                        <span class="price">$788.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant4-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant4-2.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant4-3.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant4-4.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image5.jpg" src="{{asset('/')}}client/images/product-images/product-image5.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image5-1.jpg" src="{{asset('/')}}client/images/product-images/product-image5-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Select Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Paper Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$550.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-2.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-3.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant3-4.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image17.jpg" src="{{asset('/')}}client/images/product-images/product-image17.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image17-1.jpg" src="{{asset('/')}}client/images/product-images/product-image17-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add To Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Buttercup Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$420.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image18.jpg" src="{{asset('/')}}client/images/product-images/product-image18.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image18-1.jpg" src="{{asset('/')}}client/images/product-images/product-image18-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add To Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Lima Shirt</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$698.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                    <!-- Variant -->
                                    <ul class="swatches">
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant5-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant5-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant5-1.jpg" alt="image" /></li>
                                        <li class="swatch medium rounded"><img src="{{asset('/')}}client/images/product-images/variant5-1.jpg" alt="image" /></li>
                                    </ul>
                                    <!-- End Variant -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image19.jpg" src="{{asset('/')}}client/images/product-images/product-image19.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image19-1.jpg" src="{{asset('/')}}client/images/product-images/product-image19-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Select Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Romary Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$348.60</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image20.jpg" src="{{asset('/')}}client/images/product-images/product-image20.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image20-1.jpg" src="{{asset('/')}}client/images/product-images/product-image20-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                        <!-- product label -->
                                        <div class="product-labels"><span class="lbl pr-label3">Popular</span></div>
                                        <!-- End product label -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Floral Sleeveless Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$380.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image21.jpg" src="{{asset('/')}}client/images/product-images/product-image21.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image21-1.jpg" src="{{asset('/')}}client/images/product-images/product-image21-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Button Up Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$400.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image22.jpg" src="{{asset('/')}}client/images/product-images/product-image22.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image22-1.jpg" src="{{asset('/')}}client/images/product-images/product-image22-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Lexie Shirt</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$200.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image23.jpg" src="{{asset('/')}}client/images/product-images/product-image23.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image23-1.jpg" src="{{asset('/')}}client/images/product-images/product-image23-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">One Shoulder Dress in Navy</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$1,048.60</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                        <i class="font-13 fa fa-star"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image24.jpg" src="{{asset('/')}}client/images/product-images/product-image24.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image24-1.jpg" src="{{asset('/')}}client/images/product-images/product-image24-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Triangle Sleeveless Dress in Multi</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$684.60</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image25.jpg" src="{{asset('/')}}client/images/product-images/product-image25.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image25-1.jpg" src="{{asset('/')}}client/images/product-images/product-image25-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">ACB Top</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$280.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image26.jpg" src="{{asset('/')}}client/images/product-images/product-image26.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image26-1.jpg" src="{{asset('/')}}client/images/product-images/product-image26-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">A-Line Jacket</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$698.60</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item grid-view-item--sold-out">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="grid-view-item__image primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image27.jpg" src="{{asset('/')}}client/images/product-images/product-image27.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="grid-view-item__image hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image27-1.jpg" src="{{asset('/')}}client/images/product-images/product-image27-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                        <span class="sold-out"><span>Sold out</span></span>
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Camelia Reversible Jacket in Navy/Blue</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$488.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image28.jpg" src="{{asset('/')}}client/images/product-images/product-image28.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image28-1.jpg" src="{{asset('/')}}client/images/product-images/product-image28-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Wrinkled Tux Shirt in Navy</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$158.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image29.jpg" src="{{asset('/')}}client/images/product-images/product-image29.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image29-1.jpg" src="{{asset('/')}}client/images/product-images/product-image29-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">A-Line Mini Dress in Blue</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$348.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image30.jpg" src="{{asset('/')}}client/images/product-images/product-image30.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image30-1.jpg" src="{{asset('/')}}client/images/product-images/product-image30-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Asymmetric Dress in Black</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$578.00</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="#">
                                        <!-- image -->
                                        <img class="primary blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image31.jpg" src="{{asset('/')}}client/images/product-images/product-image31.jpg" alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover blur-up lazyload" data-src="{{asset('/')}}client/images/product-images/product-image31-1.jpg" src="{{asset('/')}}client/images/product-images/product-image31-1.jpg" alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button">Add to cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="#">Babydoll Bow Dress</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$313.60</span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <div class="product-review">
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                        <i class="font-13 fa fa-star-o"></i>
                                    </div>
                                </div>
                                <!-- End product details -->
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="infinitpaginOuter">
                    <div class="infinitpagin">	
                        <a href="#" class="btn loadMore">Load More</a>
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

<!--Quick View popup-->
<div class="modal fade quick-view-popup" id="content_quickview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
            <div class="product-single">
            <!-- Start model close -->
            <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
            <!-- End model close -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="product-details-img">
                        <div class="pl-20">
                            <img src="{{asset('/')}}client/images/product-detail-page/camelia-reversible-big1.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-single__meta">
                            <h2 class="product-single__title">Product Quick View Popup</h2>
                            <div class="prInfoRow">
                                <div class="product-stock"> <span class="instock ">In Stock</span> <span class="outstock hide">Unavailable</span> </div>
                                <div class="product-sku">SKU: <span class="variant-sku">19115-rdxs</span></div>
                            </div>
                            <p class="product-single__price product-single__price-product-template">
                                <span class="visually-hidden">Regular price</span>
                                <s id="ComparePrice-product-template"><span class="money">$600.00</span></s>
                                <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                    <span id="ProductPrice-product-template"><span class="money">$500.00</span></span>
                                </span>
                            </p>
                            <div class="product-single__description rte">
                                Belle Multipurpose Bootstrap 4 Html Template that will give you and your customers a smooth shopping experience which can be used for various kinds of stores such as fashion,...
                            </div>
                            
                        <form method="post" action="http://annimexweb.com/cart/add" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                            <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                <div class="product-form__item">
                                  <label class="header">Color: <span class="slVariant">Red</span></label>
                                  <div data-value="Red" class="swatch-element color red available">
                                    <input class="swatchInput" id="swatch-0-red" type="radio" name="option-0" value="Red">
                                    <label class="swatchLbl color medium rectangle" for="swatch-0-red" style="background-image:url({{asset('/')}}client/images/product-detail-page/variant1-1.jpg);" title="Red"></label>
                                  </div>
                                  <div data-value="Blue" class="swatch-element color blue available">
                                    <input class="swatchInput" id="swatch-0-blue" type="radio" name="option-0" value="Blue">
                                    <label class="swatchLbl color medium rectangle" for="swatch-0-blue" style="background-image:url({{asset('/')}}client/images/product-detail-page/variant1-2.jpg);" title="Blue"></label>
                                  </div>
                                  <div data-value="Green" class="swatch-element color green available">
                                    <input class="swatchInput" id="swatch-0-green" type="radio" name="option-0" value="Green">
                                    <label class="swatchLbl color medium rectangle" for="swatch-0-green" style="background-image:url({{asset('/')}}client/images/product-detail-page/variant1-3.jpg);" title="Green"></label>
                                  </div>
                                  <div data-value="Gray" class="swatch-element color gray available">
                                    <input class="swatchInput" id="swatch-0-gray" type="radio" name="option-0" value="Gray">
                                    <label class="swatchLbl color medium rectangle" for="swatch-0-gray" style="background-image:url({{asset('/')}}client/images/product-detail-page/variant1-4.jpg);" title="Gray"></label>
                                  </div>
                                </div>
                            </div>
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                  <label class="header">Size: <span class="slVariant">XS</span></label>
                                  <div data-value="XS" class="swatch-element xs available">
                                    <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
                                    <label class="swatchLbl medium rectangle" for="swatch-1-xs" title="XS">XS</label>
                                  </div>
                                  <div data-value="S" class="swatch-element s available">
                                    <input class="swatchInput" id="swatch-1-s" type="radio" name="option-1" value="S">
                                    <label class="swatchLbl medium rectangle" for="swatch-1-s" title="S">S</label>
                                  </div>
                                  <div data-value="M" class="swatch-element m available">
                                    <input class="swatchInput" id="swatch-1-m" type="radio" name="option-1" value="M">
                                    <label class="swatchLbl medium rectangle" for="swatch-1-m" title="M">M</label>
                                  </div>
                                  <div data-value="L" class="swatch-element l available">
                                    <input class="swatchInput" id="swatch-1-l" type="radio" name="option-1" value="L">
                                    <label class="swatchLbl medium rectangle" for="swatch-1-l" title="L">L</label>
                                  </div>
                                </div>
                            </div>
                            <!-- Product Action -->
                            <div class="product-action clearfix">
                                <div class="product-form__item--quantity">
                                    <div class="wrapQtyBtn">
                                        <div class="qtyField">
                                            <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                            <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty">
                                            <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="product-form__item--submit">
                                    <button type="button" name="add" class="btn product-form__cart-submit">
                                        <span>Add to cart</span>
                                    </button>
                                </div>
                            </div>
                            <!-- End Product Action -->
                        </form>
                        <div class="display-table shareRow">
                                <div class="display-table-cell">
                                    <div class="wishlist-btn">
                                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
            <!--End-product-single-->
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
<!--End Quick View popup-->

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

<!-- belle/shop-grid-4.html   11 Nov 2019 12:39:07 GMT -->
</html>
@endsection