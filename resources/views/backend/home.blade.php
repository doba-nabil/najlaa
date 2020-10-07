@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-12">
            @include('common.done')
            @include('common.errors')
        </div>
    </div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Nazox</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Number of Sales</p>
                                    <h4 class="mb-0">1452</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-stack-line font-size-24"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border-top py-3">
                            <div class="text-truncate">
                                <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                <span class="text-muted ml-2">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Sales Revenue</p>
                                    <h4 class="mb-0">$ 38452</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-store-2-line font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <div class="text-truncate">
                                <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                <span class="text-muted ml-2">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Average Price</p>
                                    <h4 class="mb-0">$ 15.4</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-briefcase-4-line font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <div class="text-truncate">
                                <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                <span class="text-muted ml-2">From previous period</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-sm btn-light">Today</button>
                            <button type="button" class="btn btn-sm btn-light active">Weekly</button>
                            <button type="button" class="btn btn-sm btn-light">Monthly</button>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Revenue Analytics</h4>
                    <div>
                        <div id="line-column-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <div class="card-body border-top text-center">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="d-inline-flex">
                                <h5 class="mr-2">$12,253</h5>
                                <div class="text-success">
                                    <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                </div>
                            </div>
                            <p class="text-muted text-truncate mb-0">This month</p>
                        </div>

                        <div class="col-sm-4">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-2 text-muted text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> This Year :</p>
                                <div class="d-inline-flex">
                                    <h5 class="mb-0 mr-2">$ 34,254</h5>
                                    <div class="text-success">
                                        <i class="mdi mdi-menu-up font-size-14"> </i>2.1 %
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-2 text-muted text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i> Previous Year :</p>
                                <div class="d-inline-flex">
                                    <h5 class="mb-0">$ 32,695</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <select class="custom-select custom-select-sm">
                            <option selected>Apr</option>
                            <option value="1">Mar</option>
                            <option value="2">Feb</option>
                            <option value="3">Jan</option>
                        </select>
                    </div>
                    <h4 class="card-title mb-4">Sales Analytics</h4>

                    <div id="donut-chart" class="apex-charts"></div>

                    <div class="row">
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 mr-1"></i> Product A</p>
                                <h5>42 %</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 mr-1"></i> Product B</p>
                                <h5>26 %</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 mr-1"></i> Product C</p>
                                <h5>42 %</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Earning Reports</h4>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <div class="mb-3">
                                        <div id="radialchart-1" class="apex-charts"></div>
                                    </div>

                                    <p class="text-muted text-truncate mb-2">Weekly Earnings</p>
                                    <h5 class="mb-0">$2,523</h5>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mt-5 mt-sm-0">
                                    <div class="mb-3">
                                        <div id="radialchart-2" class="apex-charts"></div>
                                    </div>

                                    <p class="text-muted text-truncate mb-2">Monthly Earnings</p>
                                    <h5 class="mb-0">$11,235</h5>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-3">Sources</h4>

                    <div>
                        <div class="text-center">
                            <p class="mb-2">Total sources</p>
                            <h4>$ 7652</h4>
                            <div class="text-success">
                                <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-hover mb-0 table-centered table-nowrap">
                                <tbody>
                                <tr>
                                    <td style="width: 60px;">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('backend') }}/assets/images/companies/img-1.png" alt="" height="20">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <h5 class="font-size-14 mb-0">Source 1</h5>
                                    </td>
                                    <td><div id="spak-chart1"></div></td>
                                    <td>
                                        <p class="text-muted mb-0">$ 2478</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('backend') }}/assets/images/companies/img-2.png" alt="" height="20">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 mb-0">Source 2</h5>
                                    </td>

                                    <td><div id="spak-chart2"></div></td>
                                    <td>
                                        <p class="text-muted mb-0">$ 2625</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('backend') }}/assets/images/companies/img-3.png" alt="" height="20">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 mb-0">Source 3</h5>
                                    </td>
                                    <td><div id="spak-chart3"></div></td>
                                    <td>
                                        <p class="text-muted mb-0">$ 2856</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary btn-sm">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Recent Activity Feed</h4>

                    <div data-simplebar style="max-height: 330px;">
                        <ul class="list-unstyled activity-wid">
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-edit-2-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">28 Apr, 2020 <small class="text-muted">12:07 am</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Responded to need “Volunteer Activities”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-user-2-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">21 Apr, 2020 <small class="text-muted">08:01 pm</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Added an interest “Volunteer Activities”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-bar-chart-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">17 Apr, 2020 <small class="text-muted">09:23 am</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Joined the group “Boardsmanship Forum”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-mail-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">11 Apr, 2020 <small class="text-muted">05:10 pm</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Responded to need “In-Kind Opportunity”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-calendar-2-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">07 Apr, 2020 <small class="text-muted">12:47 pm</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Created need “Volunteer Activities”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-edit-2-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">05 Apr, 2020 <small class="text-muted">03:09 pm</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Attending the event “Some New Event”</p>
                                    </div>
                                </div>
                            </li>
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-user-2-fill"></i>
                                                        </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">02 Apr, 2020 <small class="text-muted">12:07 am</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">Responded to need “In-Kind Opportunity”</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Revenue by Locations</h4>

                    <div id="usa-vectormap" style="height: 196px"></div>

                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-md-6">
                            <div class="mt-2">
                                <div class="clearfix py-2">
                                    <h5 class="float-right font-size-16 m-0">$ 2542</h5>
                                    <p class="text-muted mb-0 text-truncate">California :</p>

                                </div>
                                <div class="clearfix py-2">
                                    <h5 class="float-right font-size-16 m-0">$ 2245</h5>
                                    <p class="text-muted mb-0 text-truncate">Nevada :</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-md-6">
                            <div class="mt-2">
                                <div class="clearfix py-2">
                                    <h5 class="float-right font-size-16 m-0">$ 2156</h5>
                                    <p class="text-muted mb-0 text-truncate">Montana :</p>

                                </div>
                                <div class="clearfix py-2">
                                    <h5 class="float-right font-size-16 m-0">$ 1845</h5>
                                    <p class="text-muted mb-0 text-truncate">Texas :</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary btn-sm">Learn more</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')

@endsection