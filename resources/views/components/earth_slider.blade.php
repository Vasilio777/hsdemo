<ul id="slider" class="list-group">
    @foreach ($data as $row)
    {{-- style="height: calc(1vh * {{ $row[7] }});" --}}
        <li class="entry list-group-item" data-age="{{ $row[4] }}_{{ $row[5] }}">
            {{ implode(', ', $row) }}
        </li>
    @endforeach
</ul>



<div class="age-display" id="ageDisplay"></div>
