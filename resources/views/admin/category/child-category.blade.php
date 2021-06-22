<ul>
    @foreach($childs as $item)
        <li class="hover-point">
            {{$item->name}}
            <span data-link="{{route('admin.category.edit', ['id' => $item->id, 'slug' => $item->slug])}}" class="ml-2 js-detail-category"><i class="fas fa-edit"></i></span>
            @if(count($item->childs))
                {{-- ĐỆ QUY --}}
                @include('admin.category.child-category', ['childs' => $item->childs])
            @endif
        </li>
    @endforeach
</ul>

@push('script')
    <script>
        $(function(){
            $('.js-detail-category').on('click', function(e){
                e.preventDefault();
                var url = $(this).data('link');
                window.location.href = url;
            });
        })
    </script>
@endpush
