@inject('usermenu', 'usermenu')

<div id="sidebar" class="card sidebar col-3 col-sm-2 col-md-2 col-lg-2 pull-left">
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

    <button id="sidebar-toggle" type="button" class="btn btn-light" onclick="toggleSideBar()">
        <i class="fas fa-angle-double-left"></i>
    </button>
    <script>
        function toggleSideBar() {
            $('#sidebar').toggleClass("col-3 col-sm-2 col-md-2 col-lg-2");
            $('#sidebar').toggleClass("col-2 col-sm-1 col-md-1 col-lg-1 p-1 m-1 thin-border");

            if ($('#sidebar').hasClass('col-3')) {
                $('#sidebar-toggle').html('<i class="fas fa-angle-double-left"></i>');
            } else {
                $('#sidebar-toggle').html('<i class="fas fa-angle-double-right"></i>');
            }
        }
    </script>
    <style>
        #sidebar-toggle {
            margin-bottom: 30px;
        }

        .thin-border {
            border-width: 3px !important;
        }
    </style>
</div>

