@php
    if(Session::get('role') === 'ADMIN SATKER' || Session::get('role') === 'ADMIN SATKER WILAYAH')
    {
@endphp
 <!-- pengajuan-permohonan -->

 <li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'pengajuan-permohonan' ? 'active' : ''}}" href="/pengajuan-permohonan">
        <i class="nav-main-link-icon fas fa-book"></i>
        <span class="nav-main-link-name">Pengajuan Permohonan</span>
    </a>
</li>

<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'kanim' ? 'active' : ''}}" href="/kanim">
        <i class="nav-main-link-icon fas fa-building"></i>
        <span class="nav-main-link-name">Kanim</span>
    </a>
</li>

@php
    if(Session::get('role') === 'ADMIN SATKER')
    {
@endphp

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'rekonsiliasi' ? 'active' : ''}}" href="/rekonsiliasi">
        <i class="nav-main-link-icon fas fa-money-bill-alt"></i>
        <span class="nav-main-link-name">Rekonsiliasi </span>
    </a>
</li>

@php
   }
@endphp

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'logout' ? 'active' : ''}}" href="/logout">
        <span class="nav-main-link-name" style="color: #184a7c; ">Logout</span>
    </a>
</li>
@php
    }else if(Session::get('role') === 'PETUGAS LAPANGAN')
    {
@endphp

<!-- pengajuan-permohonan -->

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'pengajuan-permohonan' ? 'active' : ''}}" href="/pengajuan-permohonan">
        <i class="nav-main-link-icon fas fa-book"></i>
        <span class="nav-main-link-name">Pengajuan Permohonan</span>
    </a>
</li>

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'logout' ? 'active' : ''}}" href="/logout">
        <span class="nav-main-link-name" style="color: #184a7c; ">Logout</span>
    </a>
</li>

@php
    }else{
@endphp

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'logout' ? 'active' : ''}}" href="/logout">
        <span class="nav-main-link-name" style="color: #184a7c; ">Logout</span>
    </a>
</li>
@php
    }
@endphp