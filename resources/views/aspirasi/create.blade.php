@extends('layouts.master')

@section('content')   
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Data Aspirasi</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('aspirasi.index') }}" class="text-slate-400 dark:text-zink-200">Aspirasi</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Tambah Data
                </li>
            </ul>
        </div>
        <div class="card border-0 shadow-sm rounded">
            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                    <div class="col-span-12 card lg:col-span-6 2xl:col-span-6">
                        <div class="card-body">
                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Aspirasi">
                            
                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">NIM Pengusul</label>
                                <!-- <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM Pengusul"> -->
                                <input type="text" class="typeahead form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM Pengusul">
                            
                                <!-- error message untuk nim pengusul -->
                                @error('nim')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">Nama Pengusul</label>
                                <input type="text" class="form-control @error('pengusul') is-invalid @enderror" name="pengusul" value="{{ old('pengusul') }}" placeholder="Masukkan Nama Pengusul">
                            
                                <!-- error message untuk nama pengusul -->
                                @error('pengusul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>    

                    <div class="col-span-12 card lg:col-span-6 2xl:col-span-6">
                        <div class="card-body">
                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">Isi Aspirasi yang diusulkan</label>
                                <textarea rows="8" class="form-control @error('isi') is-invalid @enderror" name="isi" placeholder="Tuliskan Isi Aspirasi">{{ old('isi') }}</textarea>
                            
                                <!-- error message untuk judul -->
                                @error('isi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>   
                    
                    <div class="col-span-12 card lg:col-span-12 2xl:col-span-12">
                        <div class="card-body">
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Simpan Data</button>
                            <button type="reset" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Ulangi Pengisian</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- container-fluid -->
</div>


<!-- End Page-content -->
@endsection