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

            {{-- Page numbers --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link bg-danger border-danger">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-danger" href="{{ route($routeName, $page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

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
