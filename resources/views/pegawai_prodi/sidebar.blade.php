@section('sidebar')
    <li class="sidebar-item">
        <a href="dashboard" class='sidebar-link'>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item has-sub ">
        <a href="/jadwalSeminarSidang" class='sidebar-link'>
            <span>Penjadwalan</span>
        </a>
        <ul class="submenu">
            {{-- <li class="submenu-item ">
                <a href="{{ route('uji_kelayakan_penjadwalan') }}">Uji Kelayakan Seminar Proposal</a>
            </li> --}}
            <li class="submenu-item ">
                <a href="{{ route('sempro_penjadwalan') }}">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('semhas_penjadwalan') }}">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('sidang_penjadwalan') }}">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item  ">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="sidebar-link">
            @csrf
            <button class="btn btn-primary" type="submit"> Logout </button>
        </form>
    </li>
@endsection
