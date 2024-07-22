@extends('layouts.master')

@section('content')   
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Data Presensi Piket</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('presensi_piket.index') }}" class="text-slate-400 dark:text-zink-200">Presensi Piket</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Detail
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
            <div class="col-span-12 card lg:col-span-12 2xl:col-span-12">
                <div class="card-body">
                    <h6>Nama Petugas Piket</h6><h3>{{ $presensi_piket->nama }}</h3>
                    <hr/><br/>
                    <h6>NIM Petugas Piket</h6><h3>{{ $presensi_piket->nim }}</h3>
                    <hr/><br/>
                    <h6>Tanggal</h6><h3>{{ $presensi_piket->tanggal }}</h3>
                    <hr/><br/>
                    <h6>Jam Datang</h6><h3>{{ $presensi_piket->jam_datang }}</h3>
                    <hr/><br/>
                    <h6>Jam Pulang</h6><h3>{{ $presensi_piket->jam_pulang }}</h3>
                    <hr/><br/>
                    <h6>Deskripsi Tugas</h6><h3>{{ $presensi_piket->tugas }}</h3>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection