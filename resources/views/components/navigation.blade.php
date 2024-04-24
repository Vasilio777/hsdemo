<div class="bg-gray-200">
    <div>
        <a href="{{ url('/') }}">
            <img src="{{ asset('icons/icons8-google-earth-96.png') }}" alt="AtmoEcho">
        </a>
    </div>
    <div>
        <div>
            @foreach($menu as $item)
                <button type="button" class="btn btn-secondary">
                    <a href="{{$item['url']}}">{{$item['name']}}</a>
                </button>
            @endforeach
        </div>
    </div>
</div>