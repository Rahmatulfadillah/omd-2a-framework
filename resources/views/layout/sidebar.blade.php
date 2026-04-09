<div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">Rahmatul fadillah</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">RF</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Pages</li>
                        <li class="dropdown active">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-film"></i><span>Movies</span></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="nav-link" href="{{ url('dashboard') }}">Search Movies</a>
                                </li>
                                <li><a class="nav-link" href="{{ url('favorite') }}">My Favorites</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>