<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- logo  --}}
    <a href="#" class="brand-link">
        <img src="{{asset('admins/dist/img/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-weight: 600 !important;">Green Love</span>
    </a>
    {{-- sidebar  --}}
    <div class="sidebar">
        {{--Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admins/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block info-name">Alexander Pierce</a>
            </div>
        </div>

        {{-- sidebar menu  --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library  --}}
                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{request()->is('admin/categories*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Chủ đề
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('posts.index')}}" class="nav-link {{request()->is('admin/posts*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                           Bài viết
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('audios.index')}}" class="nav-link {{request()->is('admin/audios*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-audio"></i>
                        <p>
                            Âm thanh
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('videos.index')}}" class="nav-link {{request()->is('admin/videos*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-video"></i>
                        <p>
                            Video
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        {{-- end sidebar menu  --}}
    </div>
    {{-- end sidebar  --}}
</aside>