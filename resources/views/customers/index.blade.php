@extends('layouts.master')

@section('content')   
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Database Customers</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('customers') }}" class="text-slate-400 dark:text-zink-200">Customers</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Data
                </li>
            </ul>
        </div>
        <div class="card border-0 shadow-sm rounded">
            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                    <div class="col-span-12 card lg:col-span-6 2xl:col-span-6">
                        <div class="card-body">
                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">Nama Pelanggan</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-2 py-4">
                                <label class="font-weight-bold">ID / No HP Telepon</label>
                                <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" placeholder="Masukkan ID / No. HP">
                                <!-- error message untuk nim -->
                                @error('id')
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
                                <label class="font-weight-bold">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" row="2" name="address" value="{{ old('address') }}" placeholder="Masukkan Alamat"></textarea>
                                <!-- error message untuk angkatan -->
                                @error('address')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Tambah Data Pelanggan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card border-0 shadow-sm rounded">
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">ID / No HP Pelanggan</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nama Pelanggan</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Alamat</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Riwayat Transaksi</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total Transaksi</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total Point</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Grade Member</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Diskon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                <tr>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">@phone($customer->id)</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $customer->name }}</td>    
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $customer->address }}</td>
                                    <?php $total_transaction = 0 ?>
                                    <?php $total_point = 0 ?>
                                    <?php $grade_member = "C" ?>
                                    <?php $discount = 0 ?>
                                    <td>
                                        @foreach($customer->transactions()->get() as $transaction)
                                            <div class="flex items-center space-x-2">
                                                @currency($transaction->amount_transaction)
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($customer->transactions()->get() as $transaction)
                                            <?php $total_transaction += $transaction->amount_transaction ?>
                                        @endforeach
                                        @currency($total_transaction)
                                    </td>
                                    <td>
                                        @foreach($customer->transactions()->get() as $transaction)
                                            <?php $total_point += floor($transaction->amount_transaction / 100000) ?>
                                        @endforeach
                                        {{$total_point}}
                                    </td> 
                                    <td>
                                        <?php 
                                            if($total_transaction > 1000000 and $total_transaction <= 5000000){
                                                $grade_member = "B";
                                            }
                                            elseif($total_transaction > 5000000){
                                                $grade_member = "A";
                                            }
                                        ?>
                                        Kelas {{$grade_member}}
                                    </td>                                                                        
                                    <td>
                                        <?php
                                            if($total_transaction < 1000000){
                                                $discount = $total_point * 1/5 * 5;
                                            } 
                                            elseif($total_transaction > 1000000 and $total_transaction <= 5000000){
                                                $discount = $total_point * 1/25 * 25;
                                            }
                                            elseif($total_transaction > 5000000){
                                                $discount = $total_point * 1/25 * 25;
                                            }
                                        ?>
                                        {{$discount}} %
                                    </td> 
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Customers belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

<script>
    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

</script>
<!-- End Page-content -->
@endsection