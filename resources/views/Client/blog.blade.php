<title>@yield('title', 'Bài viết')</title>
@extends('layout.client')
@section('body')
    <div id="page-content">
        <div class="page section-header text-center mb-0">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">{{ $titleHeading ?? 'Bản tin' }}</h1>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <!--Sidebar-->
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
                    <div class="sidebar_tags">
                        <div class="sidebar_widget">
                            <div class="widget-title">
                                <h2>Tin nổi bật</h2>
                            </div>
                            <div class="widget-content">
                                <div class="list list-sidebar-products">
                                    @foreach ($getMostPost as $mostpost)
                                        <div class="d-flex mb-3">
                                            <a class="" href="/posts/{{ $mostpost->slug }}">
                                                <img class="rounded" style="max-width: 80px" src="{{ $mostpost->image }}"
                                                    alt="{{ $mostpost->title }}" />
                                            </a>

                                            <div class="title_blog">
                                                <a class="title"
                                                    href="/posts/{{ $mostpost->slug }}">{{ $mostpost->title }}</a>
                                                <div class="">
                                                    <span class=""> <time
                                                            datetime="">{{ date('d-m-Y', strtotime($mostpost->created_at)) }}</time></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                    <div class="custom-search">
                        <form action="" method="get"
                            class="input-group search-header search position-relative rounded" role="search">
                            <input class="search-header__input search__input input-group__field rounded" type="search"
                                name="q" placeholder="Tìm kiếm bài viết theo tên, nội dung" autocomplete="off"
                                value="{{ $_GET['q'] ?? '' }}">
                            <span class="input-group__btn"><button class="btnSearch" type="submit"> <i
                                        class="icon anm anm-search-l"></i> </button></span>
                        </form>
                    </div>
                    <div class="blog--list-view">
                        <div class="row">
                            @if ($blogs->isEmpty())
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 article">
                                    <div class="__custom_cart_empty">
                                        <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="blog empty">
                                        <h4 class="">Không tìm thấy bản tin nào.</h4>
                                    </div>
                                </div>
                            @else
                                @foreach ($blogs as $blog)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 article">
                                        <!-- Article Image -->
                                        <a class="article_featured-image" href="/posts/{{ $blog['slug'] }}"><img
                                                class=" rounded"
                                                src="{{ asset($blog->image ? $blog->image : 'no_image.jpg') }}"
                                                alt="{{ $blog['title'] }}"></a>
                                        <h2 class="h3"><a href="/posts/{{ $blog['slug'] }}">{{ $blog['title'] }}</a>
                                        </h2>
                                        <p>{{ $blog['tags'] }}</p>
                                        <ul class="publish-detail">
                                            <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $blog['views'] }}</li>
                                            <li><i class="icon anm anm-clock-r"></i> <time
                                                    datetime="{{ date('d-m-Y', strtotime($blog['created_at'])) }}">{{ date('H:i d-m-Y', strtotime($blog['created_at'])) }}</time>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <hr />
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
