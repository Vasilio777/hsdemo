<div>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach ($data as $groupKey => $items)
            <a class="nav-item nav-link" id="nav-{{ $groupKey }}-tab" data-toggle="tab" href="#nav-{{ $groupKey }}" role="tab" aria-controls="nav-{{ $groupKey }}" aria-selected="true">{{ $groupKey }}</a>
        @endforeach
    </div>
    <div class="tab-content" id="nav-tabContent">
        @foreach ($data as $groupKey => $items)
            <div class="tab-pane fade" id="nav-{{ $groupKey }}" role="tabpanel" aria-labelledby="nav-{{ $groupKey }}-tab">
                <ul class="list-group ul-bg">
                    @foreach ($items as $row)
                        <li class="entry list-group-item" data-age="{{ $row[4] }}_{{ $row[5] }}">
                            Age: {{ $row[5] }} / Duration: {{$row[7] }} mln years
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>

<div class="age-display" id="ageDisplay"></div>
