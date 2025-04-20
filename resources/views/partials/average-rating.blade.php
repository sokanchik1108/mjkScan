<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


@php
    $average = $item->averageRating(); // например, 3.6
    $fullStars = floor($average);      // 3
    $halfStar = ($average - $fullStars) >= 0.5 ? true : false;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp

@for ($i = 1; $i <= 5; $i++)
    @php
        $diff = $average - $i;
    @endphp

    @if ($diff >= 0)
        <i class="fas fa-star" style="color: gold;"></i>
    @elseif ($diff > -1 && $diff < 0)
        <i class="fas fa-star-half-alt" style="color: gold;"></i>
    @else
        <i class="far fa-star" style="color: gold;"></i>
    @endif
@endfor
<span class="rating-number">({{ $average }})</span>

