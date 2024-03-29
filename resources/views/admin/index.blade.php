@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Selamat data di Dashboard</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                <span class="input-group-text input-group-addon bg-transparent border-haifa"><i data-feather="calendar"
                        class=" text-haifa"></i></span>
                <input type="text" class="form-control border-haifa bg-transparent">
            </div>
            {{-- <button type="button" class="btn btn-outline-haifa btn-icon-text me-2 mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="printer"></i>
                Print
            </button>
            <button type="button" class="btn btn-haifa btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                Download Report
            </button> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Jema'ah yang mendaftar Bulan Ini</h6>
                                {{-- <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                class="">Edit</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="trash" class="icon-sm me-2"></i> <span
                                                class="">Delete</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="printer" class="icon-sm me-2"></i> <span
                                                class="">Print</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="download" class="icon-sm me-2"></i> <span
                                                class="">Download</span></a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $jemaah_daftar_bulan_ini }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        @if ($persentase_peningkatan > 0)
                                            <p class="text-success">
                                                <span>+{{ $persentase_peningkatan }}%</span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($persentase_peningkatan == 0)
                                            <p class="text-haifa">
                                                <span>{{ $persentase_peningkatan }}%</span>
                                                <i data-feather="arrow-right" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($persentase_peningkatan < 0)
                                            <p class="text-danger">
                                                <span>{{ $persentase_peningkatan }}%</span>
                                                <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="jemaahsChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Jumlah Keberangkatan Bulan ini</h6>
                                {{-- <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                class="">Edit</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="trash" class="icon-sm me-2"></i> <span
                                                class="">Delete</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="printer" class="icon-sm me-2"></i> <span
                                                class="">Print</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="download" class="icon-sm me-2"></i> <span
                                                class="">Download</span></a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $jumlah_keberangkatan_bulan_ini }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        @if ($selisih_keberangkatan > 0)
                                            <p class="text-success">
                                                <span>+{{ $selisih_keberangkatan }}</span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($selisih_keberangkatan == 0)
                                            <p class="text-haifa">
                                                <span>{{ $selisih_keberangkatan }}</span>
                                                <i data-feather="arrow-right" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($selisih_keberangkatan < 0)
                                            <p class="text-danger">
                                                <span>{{ $selisih_keberangkatan }}</span>
                                                <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="keberangkatanChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Jumlah Transaksi Bulan Ini</h6>
                                {{-- <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                class="">Edit</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="trash" class="icon-sm me-2"></i> <span
                                                class="">Delete</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="printer" class="icon-sm me-2"></i> <span
                                                class="">Print</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                data-feather="download" class="icon-sm me-2"></i> <span
                                                class="">Download</span></a>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h5 class="mb-2">Rp.{{ number_format($jumlah_transaksi_bulan_ini, 2, ',', '.') }}</h5>
                                    <div class="d-flex align-items-baseline">
                                        @if ($kenaikan_persentase > 0)
                                            <p class="text-success">
                                                <span>+{{ $kenaikan_persentase }}%</span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($kenaikan_persentase == 0)
                                            <p class="text-haifa">
                                                <span>{{ $kenaikan_persentase }}%</span>
                                                <i data-feather="arrow-right" class="icon-sm mb-1"></i>
                                            </p>
                                        @elseif($kenaikan_persentase < 0)
                                            <p class="text-danger">
                                                <span>{{ $kenaikan_persentase }}%</span>
                                                <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="transaksiChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">Jema'ah Per Keberangkatan</h6>
                        {{-- <div class="dropdown">
                            <button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                        class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span
                                        class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row align-items-start">
                        {{-- <div class="col-md-7">
                            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business
                                has from its normal business activities, usually from the sale of goods and
                                services to customers.</p>
                        </div> --}}
                        {{-- <div class="col-md-5 d-flex justify-content-md-end">
                            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-haifa">Today</button>
                                <button type="button" class="btn btn-outline-haifa d-none d-md-block">Week</button>
                                <button type="button" class="btn btn-haifa">Month</button>
                                <button type="button" class="btn btn-outline-haifa">Year</button>
                            </div>
                        </div> --}}
                    </div>
                    <div id="jemaahChart"></div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    {{-- <div class="row">
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Monthly sales</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span
                                        class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Sales are activities related to selling or the number of goods or
                        services sold in a given time period.</p>
                    <div id="monthlySalesChart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Cloud storage</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span
                                        class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <div id="storageChart"></div>
                    <div class="row mb-3">
                        <div class="col-6 d-flex justify-content-end">
                            <div>
                                <label
                                    class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">Total
                                    storage <span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
                                <h5 class="fw-bolder mb-0 text-end">8TB</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span
                                        class="p-1 me-1 rounded-circle bg-haifa"></span> Used
                                    storage</label>
                                <h5 class="fw-bolder mb-0">~5TB</h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-haifa">Upgrade storage</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row --> --}}

    {{-- <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Inbox</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span
                                        class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">Leonardo Payne</h6>
                                    <p class="text-muted tx-12">12.30 PM</p>
                                </div>
                                <p class="text-muted tx-13">Hey! there I'm available...</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">Carl Henson</h6>
                                    <p class="text-muted tx-12">02.14 AM</p>
                                </div>
                                <p class="text-muted tx-13">I've finished it! See you so..</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">Jensen Combs</h6>
                                    <p class="text-muted tx-12">08.22 PM</p>
                                </div>
                                <p class="text-muted tx-13">This template is awesome!</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">Amiah Burton</h6>
                                    <p class="text-muted tx-12">05.49 AM</p>
                                </div>
                                <p class="text-muted tx-13">Nice to meet you</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">Yaretzi Mayo</h6>
                                    <p class="text-muted tx-12">01.19 AM</p>
                                </div>
                                <p class="text-muted tx-13">Hey! there I'm available...</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Projects</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span
                                        class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span
                                        class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span
                                        class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Project Name</th>
                                    <th class="pt-0">Start Date</th>
                                    <th class="pt-0">Due Date</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2021</td>
                                    <td>26/04/2021</td>
                                    <td><span class="badge bg-danger">Released</span></td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>NobleUI Angular</td>
                                    <td>01/01/2021</td>
                                    <td>26/04/2021</td>
                                    <td><span class="badge bg-success">Review</span></td>
                                    <td>Carl Henson</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>NobleUI ReactJs</td>
                                    <td>01/05/2021</td>
                                    <td>10/09/2021</td>
                                    <td><span class="badge bg-info">Pending</span></td>
                                    <td>Jensen Combs</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>NobleUI VueJs</td>
                                    <td>01/01/2021</td>
                                    <td>31/11/2021</td>
                                    <td><span class="badge bg-warning">Work in Progress</span>
                                    </td>
                                    <td>Amiah Burton</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>NobleUI Laravel</td>
                                    <td>01/01/2021</td>
                                    <td>31/12/2021</td>
                                    <td><span class="badge bg-danger">Coming soon</span></td>
                                    <td>Yaretzi Mayo</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>NobleUI NodeJs</td>
                                    <td>01/01/2021</td>
                                    <td>31/12/2021</td>
                                    <td><span class="badge bg-haifa">Coming soon</span></td>
                                    <td>Carl Henson</td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">3</td>
                                    <td class="border-bottom">NobleUI EmberJs</td>
                                    <td class="border-bottom">01/05/2021</td>
                                    <td class="border-bottom">10/11/2021</td>
                                    <td class="border-bottom"><span class="badge bg-info">Pending</span>
                                    </td>
                                    <td class="border-bottom">Jensen Combs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row --> --}}
@endsection
@section('script')
    <script src="/assets-nobleui/vendors/moment/moment.min.js"></script>
    <script>
        $(function() {

            moment.locale('id');
            'use strict'
            var colors = {
                haifa: "#282461",
                primary: "#6571ff",
                secondary: "#7987a1",
                success: "#05a34a",
                info: "#66d1d1",
                warning: "#fbbc06",
                danger: "#ff3366",
                light: "#e9ecef",
                dark: "#060c17",
                muted: "#7987a1",
                gridBorder: "rgba(77, 138, 240, .15)",
                bodyColor: "#000",
                cardBg: "#fff"
            }

            var fontFamily = "'Roboto', Helvetica, sans-serif"

            // Date Picker
            if ($('#dashboardDate').length) {
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $('#dashboardDate').datepicker({
                    format: "dd-MM-yyyy",
                    todayHighlight: true,
                    autoclose: true
                });
                $('#dashboardDate').datepicker('setDate', today);
            }
            // Date Picker - END
            // Jemaahs Chart
            @if (isset($jemaah_per_bulan))
                var jemaahsData = {!! json_encode($jemaah_per_bulan) !!};

                if ($('#jemaahsChart').length) {
                    var options1 = {
                        chart: {
                            type: "line",
                            height: 60,
                            sparkline: {
                                enabled: !0
                            }
                        },
                        series: [{
                            name: 'Jumlah Jemaah',
                            data: jemaahsData.map(item => item.jumlah_jemaah)
                        }],
                        xaxis: {
                            type: 'category',
                            categories: jemaahsData.map(item => {
                                // Format tanggal sesuai kebutuhan, misalnya "Jan 2021"
                                return moment().month(item.month - 1).format('MMM YYYY');
                            }),
                        },
                        stroke: {
                            width: 2,
                            curve: "smooth"
                        },
                        markers: {
                            size: 0
                        },
                        colors: [colors.haifa],
                    };
                    new ApexCharts(document.querySelector("#jemaahsChart"), options1).render();
                }
            @endif
            @if (isset($jumlah_keberangkatan_per_bulan))
                // Orders Chart
                var keberangkatanData = {!! json_encode($jumlah_keberangkatan_per_bulan) !!};
                if ($('#keberangkatanChart').length) {
                    var options2 = {
                        chart: {
                            type: "bar",
                            height: 60,
                            sparkline: {
                                enabled: !0
                            }
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 2,
                                columnWidth: "60%"
                            }
                        },
                        colors: [colors.haifa],
                        series: [{
                            name: 'Jumlah Keberangkatan',
                            data: keberangkatanData.map(item => item.jumlah_keberangkatan)
                        }],
                        xaxis: {
                            type: 'category',
                            categories: keberangkatanData.map(item => {
                                // Format tanggal sesuai kebutuhan, misalnya "Jan 2021"
                                return moment().month(item.month - 1).format('MMM YYYY');
                            }),
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return parseInt(value).toLocaleString('id-ID');
                                }
                            }
                        }
                    };
                    new ApexCharts(document.querySelector("#keberangkatanChart"), options2).render();
                }
            @endif
            @if (isset($jumlah_transaksi_per_bulan))
                // transaksi Chart
                var transaksiData = {!! json_encode($jumlah_transaksi_per_bulan) !!};
                if ($('#transaksiChart').length) {
                    var options3 = {
                        chart: {
                            type: "line",
                            height: 60,
                            sparkline: {
                                enabled: !0
                            }
                        },
                        series: [{
                            name: 'Jumlah Transaksi',
                            data: transaksiData.map(item => item.jumlah_transaksi)
                        }],
                        xaxis: {
                            type: 'category',
                            categories: transaksiData.map(item => {
                                // Format tanggal sesuai kebutuhan, misalnya "Jan 2021"
                                return moment().month(item.month - 1).format('MMM YYYY');
                            }),
                        },
                        stroke: {
                            width: 2,
                            curve: "smooth"
                        },
                        markers: {
                            size: 0
                        },
                        colors: [colors.haifa],
                    };
                    new ApexCharts(document.querySelector("#transaksiChart"), options3).render();
                }
            @endif
            @if (isset($total_jemaah_per_paket_tahun_ini))
                if ($('#jemaahChart').length) {
                    var jemaahData = {!! json_encode($total_jemaah_per_paket_tahun_ini) !!};
                    var paketData = {!! json_encode($paket_tahun_ini) !!};
                    var lineChartOptions = {
                        chart: {
                            type: "line",
                            height: '400',
                            parentHeightOffset: 0,
                            foreColor: colors.bodyColor,
                            background: colors.cardBg,
                            toolbar: {
                                show: false
                            },
                        },
                        theme: {
                            mode: 'light'
                        },
                        tooltip: {
                            theme: 'light'
                        },
                        colors: [colors.haifa, colors.danger, colors.warning],
                        grid: {
                            padding: {
                                bottom: -4,
                            },
                            borderColor: colors.gridBorder,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        series: [{
                            name: "Total Jemaah",
                            data: jemaahData.map(item => item.total_jemaah)
                        }, ],
                        xaxis: {
                            type: "datetime",
                            categories: paketData.map(item => {
                                return moment(item.tanggal_mulai).format('DD MMM YYYY');
                            }),
                            lines: {
                                show: true
                            },
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                            crosshairs: {
                                stroke: {
                                    color: colors.secondary,
                                },
                            },
                        },
                        yaxis: {
                            title: {
                                text: "Jumlah jema'ah",
                                style: {
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                            min: 0,
                            max: Math.max.apply(null, jemaahData.map(item => item.total_jemaah + 10)),
                            // tickAmount: 4,
                            labels: {
                                formatter: function(val) {
                                    return val.toFixed(0); // Format tanpa desimal
                                },
                            },
                            tooltip: {
                                enabled: true,
                            },
                            crosshairs: {
                                stroke: {
                                    color: colors.secondary,
                                },
                            },
                        },
                        markers: {
                            size: 0,
                        },
                        stroke: {
                            width: 2,
                            curve: "straight",
                        },
                    };
                    var apexLineChart = new ApexCharts(document.querySelector("#jemaahChart"), lineChartOptions);
                    apexLineChart.render();
                }
            @endif

        });
    </script>
@endsection
