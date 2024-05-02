<div class="scroller-container">
    <ul class="horizontal-scroll">
        @foreach ($data as $groupKey => $items)
            @foreach ($items as $row)
                @if(isset($row->eon) && isset($row->duration))
                    <li class="horizontal-scroll-item" data-eon="{{ $row->eon }}" duration="{{ $row->duration }}">|</li>
                @endif
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

<div class="container-fluid">
    @foreach($data as $key => $eons)
        <div class="row h-100 eons" base="{{ $eons[0]->base }}" base_end="{{ $eons[0]->base_end }}">
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <div>
                            <h2>{{ $eons[0]->getName() }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row eon-desc-container">
                    <div class="col">
                        <div class="eon-desc">
                            {{ $eons[0]->eon_desc }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="image-container vertical-center">
                    <img src="{{ $eons[0]->getUrl() }}" alt="{{ $eons[0]->getName() }}" style="max-width:100%;height:auto;">
                </div>
            </div>
        </div>
    @endforeach
</div>

