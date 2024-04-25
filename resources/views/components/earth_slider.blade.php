<div>
    <div id="nav-container">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach ($data as $groupKey => $items)
                <a class="nav-item nav-link eon-{{ $groupKey}}" id="nav-{{ $groupKey }}-tab" data-toggle="tab" href="#nav-{{ $groupKey }}" role="tab" aria-controls="nav-{{ $groupKey }}" aria-selected="true">{{ $groupKey }}</a>
            @endforeach
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="list-header">
                <strong>Age</strong> / <strong>Duration (mln years)</strong>
            </div>
            @foreach ($data as $groupKey => $items)
                <div class="tab-pane fade" id="nav-{{ $groupKey }}" role="tabpanel" aria-labelledby="nav-{{ $groupKey }}-tab">
                    <ul class="list-group ul-bg">
                        @foreach ($items as $row)
                            <li class="entry list-group-item" data-age="{{ $row[4] }}_{{ $row[5] }}" scroll_pos="{{ $row[9] }}">
                                <span>{{ $row[5] }} </span>
                                <span>{{ $loop->parent->last ? '~4529,2' : $row[7] }} </span> 
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <div class="scroller-container">
        <ul class="horizontal-scroll">
            @foreach ($data as $groupKey => $items)
                @foreach ($items as $row)
                    <li class="horizontal-scroll-item" data-eon="{{ $row[0] }}" duration="{{ $row[8] }}">|</li>
                @endforeach
            @endforeach
        </ul>
        <div id="scroll-carriage">
            <div id="info-block">
                <span id="info-text">0</span>
                <span>m.y.a.</span>
            </div>
            <div id="carriage-img"></div>
        </div>
        <div class="time-labels">
            <span class="tl-start">nowadays</span> 
            <span class="tl-end">past</span>
        </div>
    </div>
</div>


