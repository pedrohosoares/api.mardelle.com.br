<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        @if ($admin_logo_img == '')
                            <img src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon">
                        @else
                            <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                        @endif
                    </div>
                    <div class="title">{{ Voyager::setting('admin.title', 'VOYAGER') }}</div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage"
                style="background-image:url({{ Voyager::image(Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg')) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('voyager.profile') }}"
                        class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            @php
                $roleName = Auth()->user()->role->name;
                $menu = menu($roleName, '_json');
            @endphp
            @if (!$menu)
                @php
                    $menu = menu('admin', '_json');
                @endphp
                <admin-menu :items="{{ $menu }}"></admin-menu>
            @else
                <ul class="nav navbar-nav">
                    @foreach ($menu as $m)
                        @if ($m->children->count() > 0)
                            <li class="dropdown">
                                <a target="{{ !empty($m->target) ? $m->target : '_self' }}"
                                    href="#{{ $m->id }}-dropdown-element" data-toggle="collapse"
                                    aria-expanded="undefined">
                                    <span class="icon {{ $m->icon_class }}"></span>
                                    <span class="title">{{ $m->title }}</span>
                                </a>
                                <div id="{{ $m->id }}-dropdown-element" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            @foreach ($m->children as $children)
                                                <li class="">
                                                    <a target="{{ !empty($children->target) ? $children->target : '_self' }}"
                                                        href="{{ !empty($children->url) ? $children->url : route($children->route) }}">
                                                        <span class="icon {{ $children->icon_class }}"></span>
                                                        <span class="title">{{ $children->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="">
                                <a target="{{ !empty($m->target) ? $m->target : '_self' }}"
                                    href="{{ !empty($m->url) ? $m->url : route($m->route) }}">
                                    <span class="icon {{ $m->icon_class }}"></span>
                                    <span class="title">{{ $m->title }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </nav>
</div>
