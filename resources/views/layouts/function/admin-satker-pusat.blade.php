
<!-- Menu Master -->
<li class="nav-main-heading nav-main-item {{Request::segment(1) == 'admin' || Request::segment(1) == 'pemohon' ? 'open' : ''}}"" style="text-transform: capitalize; padding-top:10px;"> 
                        
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
        <i class="nav-main-link-icon fas fa-user-circle"></i>
        <span class="nav-main-link-name">Pengaturan Pengguna</span>
    </a>
    
    <!-- Sub Menu -->
    <ul class="nav-main-submenu" style="padding-left: 1px; background-color: #FFF;">
        <!-- admin -->
        <li class="nav-main-item">
            <a class="nav-main-link nav-expand link-button {{Request::segment(1) == 'admin' ? 'active' : ''}}" href="/admin">
                <i class="nav-main-link-icon "></i>
                <span class="nav-main-link-name">Admin </span>
            </a>
        </li>  
        <!-- pemohon -->
        <li class="nav-main-item">
            <a class="nav-main-link nav-expand link-button {{Request::segment(1) == 'pemohon' ? 'active' : ''}}" href="/pemohon">
                <i class="nav-main-link-icon "></i>
                <span class="nav-main-link-name">Pemohon</span>
            </a>
        </li>  
    </ul>
    <!-- End Sub Menu -->
    
</li>
<!-- End Menu Master -->
<!-- pengajuan-permohonan -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'pengajuan-permohonan' ? 'active' : ''}}" href="/pengajuan-permohonan">
        <i class="nav-main-link-icon fas fa-book"></i>
        <span class="nav-main-link-name">Pengajuan Permohonan</span>
    </a>
</li>
@php
    if(Session::get('role') === 'SUPERADMIN')
    {
@endphp
<!-- negara -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'negara' ? 'active' : ''}}" href="/negara">
        <i class="nav-main-link-icon fas fa-globe"></i>
        <span class="nav-main-link-name">Negara</span>
    </a>
</li>

<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'paspor' ? 'active' : ''}}" href="/paspor">
        <i class="nav-main-link-icon fas fa-book-open"></i>
        <span class="nav-main-link-name">Paspor</span>
    </a>
</li>

@php
    }
@endphp
<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'kanim' ? 'active' : ''}}" href="/kanim">
        <i class="nav-main-link-icon fas fa-building"></i>
        <span class="nav-main-link-name">Kanim</span>
    </a>
</li>

@php
    if(Session::get('role') === 'SUPERADMIN')
    {
@endphp
<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'satker' ? 'active' : ''}}" href="/satker">
        <i class="nav-main-link-icon fas fa-briefcase"></i>
        <span class="nav-main-link-name">Satker</span>
    </a>
</li>

@php
    }
@endphp

<li class="nav-main-item">
    <a class="nav-main-link " data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
        <span class="nav-main-link-name">Mobile</span>
    </a>
</li>

@php
    if(Session::get('role') === 'SUPERADMIN')
    {
@endphp
<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'list-of-value' ? 'active' : ''}}" href="/list-of-value">
        <i class="nav-main-link-icon fas fa-file-alt"></i>
        <span class="nav-main-link-name">Konten Mobile</span>
    </a>
</li>


@php
    }
@endphp
<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'banner' ? 'active' : ''}}" href="/banner">
        <i class="nav-main-link-icon fas fa-image"></i>
        <span class="nav-main-link-name">Banner</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'pendaftaran-mobile' ? 'active' : ''}}" href="/pendaftaran-mobile">
        <i class="nav-main-link-icon fas fa-clone"></i>
        <span class="nav-main-link-name">Panduan dan informasi </span>
    </a>
</li>

<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'rekonsiliasi' ? 'active' : ''}}" href="/rekonsiliasi">
        <i class="nav-main-link-icon fas fa-money-bill-alt"></i>
        <span class="nav-main-link-name">Rekonsiliasi </span>
    </a>
</li>

@php
    if(Session::get('role') === 'SUPERADMIN')
    {
@endphp
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'konfigurasi' ? 'active' : ''}}" href="/konfigurasi">
        <i class="nav-main-link-icon fas fa-sun"></i>
        <span class="nav-main-link-name">Konfigurasi </span>
    </a>
</li>

<!--  -->
<li class="nav-main-item">
    <a class="nav-main-link link-button {{Request::segment(1) == 'log-system' ? 'active' : ''}}" href="/log-system">
        <i class="nav-main-link-icon fas fa-list-alt"></i>
        <span class="nav-main-link-name">Log System</span>
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
<!-- End Menu Dynamic -->