<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN MENU</li>
            <li>
                <a href="{{ url('/') }}">
                    <i class="material-icons">home</i>
                    <span>Trang Chủ</span>
                </a>
            </li>
            <li class="{{ request()->is('the-loai/*') ? 'active' : '' }}" >
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">view_list</i>
                    <span>Thể Loại</span>
                </a>
                <ul class="ml-menu">
                    @foreach($storyType as $key => $value)
                    <li class="{{ request()->is('the-loai/' . $value->type_name_link) ? 'active' : '' }}">
                        <a href="{{route('typepage.index',['type_name_link'=>$value->type_name_link])}}">{{$value ->type_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 <a href="javascript:void(0);">Admin - TruyenTienHiepFull</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.0
        </div>
    </div>
    <!-- #Footer -->
</aside>