<div class="bg-gray-200">
    <div>
        <a href="{{ url('/') }}">
            <img src="{{ asset('icons/icons8-google-earth-96.png') }}" alt="AtmoEcho">
        </a>
    </div>
    <div>
        <div>
            @foreach($menu as $item)
                <button type="button" class="btn btn-secondary" onclick="location.href='{{$item['url']}}';">
                    {{$item['name']}}
                </button>
            @endforeach
        </div>
    </div>
</div>