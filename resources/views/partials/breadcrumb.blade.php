<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        {{-- Главная --}}
        @if (!empty($activeHome) && $activeHome === true)
            <li class="breadcrumb-item active" aria-current="page">Главная</li>
        @else
            <li class="breadcrumb-item"><a href="{{ route('website') }}">Главная</a></li>
        @endif

        {{-- Категория --}}
        @if (!empty($category))
            @if (!empty($activeCategory) && $activeCategory === true)
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.items', $category->id) }}">{{ $category->name }}</a>
                </li>
            @endif
        @endif

        {{-- Тип --}}
        @if (!empty($type))
            @if (!empty($activeType) && $activeType === true)
                <li class="breadcrumb-item active" aria-current="page">{{ $type->name }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ route('types.show', ['categoryId' => $category->id, 'typeId' => $type->id]) }}">{{ $type->name }}</a>
                </li>
            @endif
        @endif
    </ol>
</nav>
