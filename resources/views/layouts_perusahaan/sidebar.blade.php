{{--  berisi kodingan sidebar yang dipecah --}}

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header py-3 d-flex justify-content-center"> <a class="d-flex align-items-center gap-2"
            href="/"> <span class="text-primary fs-4">✦</span> <span class="brand fw-bold">KONEKSIBILITAS</span> </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- 🔹 Link Dashboard Perusahaan --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('perusahaan/dashboard') ? 'active' : '' }}"
                    href="/perusahaan/dashboard">
                    <i class="ni ni-tv-2 text-dark text-sm opacity-10 me-2"></i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{--  Link Data Lowongan --}}
            <li class="nav-item"> <a class="nav-link {{ Request::is('informasi-lowongan') ? 'active' : '' }}"
                    href="/informasi-lowongan"> <i class="ni ni-single-copy-04 text-dark text-sm opacity-10 me-2"></i>
                    <span class="nav-link-text ms-1">Data lowongan</span> </a> </li>

            {{--  Link Logout --}}
            <li class="nav-item"> <a class="nav-link" href="#" onclick="confirmLogout()"> <i
                        class="ni ni-user-run text-dark text-sm opacity-10 me-2"></i> <span
                        class="nav-link-text ms-1">Logout</span> </a> </li>
        </ul>
    </div>
</aside>
