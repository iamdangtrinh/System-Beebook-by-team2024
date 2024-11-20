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
                                    <div class="grid">
                                        @foreach ($getMostPost as $mostpost)
                                            <div class="grid__item">
                                                <div class="mini-list-item">
                                                    <div class="mini-view_image">
                                                        <a class="grid-view-item__link" href="/posts/{{$mostpost->slug}}">
                                                            <img class="grid-view-item__image blur-up lazyload"
                                                                data-src="{{ asset($mostpost->image ? $mostpost->image : 'no_image.jpg') }}"
                                                                alt="{{ $mostpost->title }}" />

                                                        </a>
                                                    </div>
                                                    <div class="details"> <a class="grid-view-item__title"
                                                            href="/posts/{{$mostpost->slug}}">{{ $mostpost->title }}</a>
                                                        <div class="grid-view-item__meta"><span class="article__date"> <time
                                                                    datetime="">{{ date('d-m-Y', strtotime($mostpost->created_at)) }}</time></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                        <form action="" method="get"
                            class="input-group search-header search position-relative rounded" role="search">
                            <input class="search-header__input search__input input-group__field rounded" type="search"
                                name="q" placeholder="Tìm kiếm bài viết theo tên, nội dung" aria-label="Search" autocomplete="off">
                            <span class="input-group__btn"><button class="btnSearch" type="submit"> <i
                                        class="icon anm anm-search-l"></i> </button></span>
                        </form>
                    </div>
                    <div class="blog--list-view">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 article">
                                    <!-- Article Image -->
                                    <a class="article_featured-image" href="/posts/{{ $blog['slug'] }}"><img
                                            class="blur-up lazyload rounded"
                                            src="{{ asset($blog['image'] ? $blog['image'] : 'no_image.jpg') }}"
                                            alt="{{ $blog['title'] }}"></a>
                                    <h2 class="h3"><a href="/posts/{{ $blog['slug'] }}">{{ $blog['title'] }}</a></h2>
                                    <p>{{ $blog['tags'] }}</p>
                                    <ul class="publish-detail">
                                        <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $blog['views'] }}</li>
                                        <li><i class="icon anm anm-clock-r"></i> <time
                                                datetime="{{ date('d-m-Y', strtotime($blog['created_at'])) }}">{{ date('H:i d-m-Y', strtotime($blog['created_at'])) }}</time>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <hr />
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
