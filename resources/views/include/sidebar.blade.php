@inject('usermenu', 'usermenu')

<div class="card sidebar col-3 col-sm-2 col-md-2 col-lg-2 pull-left">
    <div style="padding-bottom: 50px;">
        @foreach ($usermenu as $name => $details)
            @if (Request::url() == str_replace('https', 'http', $details['url']))
                <a class="flex-center sidebar-button btn btn-warning text-secondary btn-lg" href="{{$details['url']}}" role="button">
                    <div style="padding: 5px;">
                        <i class="{{$details['icon']}}"></i>
                    </div>
                    <div class="hiding-text">
                        {{$name}}
                    </div>
                </a>
            @else
                <a class="flex-center sidebar-button btn btn-secondary btn-lg" href="{{$details['url']}}" role="button">
                    <div style="padding: 5px;">
                        <i class="{{$details['icon']}}"></i>
                    </div>
                    <div class="hiding-text">
                        {{$name}}
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>

