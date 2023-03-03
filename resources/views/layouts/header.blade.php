<div class="header_wrap position-fixed">
    <div class="header_top {{ str_contains(Route::currentRouteName(), 'confirm_link') ? 'justify-content-start' : '' }} ">

        @include('layouts._header_top')
    </div>
    <div class="header_middle">
        @include('layouts._header_middle')
    </div>
    <div class="menu_wrap fade_anim">
        @include('layouts._header_menu')
    </div>
</div>
<div style="height:150px"></div>
