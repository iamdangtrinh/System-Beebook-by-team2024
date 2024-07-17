@foreach ($users as $item)
    {{ $item->id }}
    </br>
    {{ $item->name }}
    </br>
@endforeach

{{ $users->links() }}
