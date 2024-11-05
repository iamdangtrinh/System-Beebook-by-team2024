@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{-- "Previous" button --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link text-danger" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ route($routeName, $paginator->currentPage() - 1) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            {{-- Page numbers with ellipses --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $startPage = max(1, $currentPage - 2);
                $endPage = min($lastPage, $currentPage + 2);
            @endphp

            {{-- First Page --}}
            @if ($startPage > 1)
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ route($routeName, 1) }}">1</a>
                </li>
                @if ($startPage > 2)
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link text-danger">...</span></li>
                @endif
            @endif

            {{-- Page Range --}}
            @foreach (range($startPage, $endPage) as $page)
                @if ($page == $currentPage)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link bg-danger border-danger">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-danger" href="{{ route($routeName, $page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Last Page --}}
            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link text-danger">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ route($routeName, $lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- "Next" button --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ route($routeName, $paginator->currentPage() + 1) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link text-danger" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
