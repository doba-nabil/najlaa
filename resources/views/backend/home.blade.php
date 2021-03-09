@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">

    </div>
    <!-- start page title -->

    <!-- end page title -->

    <hr>

    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        @if(app()->getLocale() == 'en')
                            Registed Users This Year
                        @else
                            عمليات التسجيل الجديدة السنة الحالية
                        @endif
                    </h4>
                    <div style="width: 80%;margin: 0 auto;">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        @if(app()->getLocale() == 'en')
                            Orders in This Year
                        @else
                            عمليات الشراء الجديدة السنة الحالية
                        @endif
                    </h4>
                    <div style="width: 80%;margin: 0 auto;">
                        {!! $chartt->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div style="padding-bottom: 8px;" class="card-body">
                    <h4 class="card-title mb-3">
                        @if(app()->getLocale() == 'en')
                            More Visited Products
                        @else
                            المنتجات الاكثر زيارة
                        @endif
                    </h4>
                    <div>
                        <div class="table-responsive mt-4">
                            <table class="table table-hover mb-0 table-centered table-nowrap">
                                <tbody>
                                <tr style="background: rgba(3,3,3,0.2)">
                                    <td style="width: 60px;">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-light">
                                                #
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <h5 class="font-size-14 mb-0">{{ __('dashboard.name') }}</h5>
                                    </td>
                                    <td><div id="spak-chart1"></div></td>
                                    <td>
                                        <p class="text-muted mb-0">
                                            @if(app()->getLocale() == 'en')
                                                views
                                            @else
                                                 زيارة
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                @foreach(\App\Models\Product::orderBy('views' , 'desc')->paginate(5) as $product)
                                    <tr>
                                    <td style="width: 60px;">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-light">
                                                @if(isset($product->mainImage->image))
                                                    <img src="{{ asset('pictures/products/' . $product->mainImage->image) }}" alt="image"  height="20"/>
                                                @else
                                                    <img src="{{ asset('backend/assets/images/empty.jpg') }}" alt="no image" height="20">
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <h5 class="font-size-14 mb-0">{{ $product['name_'.app()->getLocale()] }}</h5>
                                    </td>
                                    <td><div id="spak-chart1"><a href="{{ route('products.show' , $product->id) }}"><i class="fa fa-eye"></i> </a> </div></td>
                                    <td>
                                        <p class="text-muted mb-0">{{ $product->views }}</p>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        @if(app()->getLocale() == 'en')
                            Recent Registed Users
                        @else
                            اخر عمليات التسجيل
                        @endif
                    </h4>
                    <div data-simplebar style="max-height: 330px;">
                        <ul class="list-unstyled activity-wid">
                            @foreach(\App\User::orderBy('id' ,'desc')->paginate(6) as $user)
                            <li class="activity-list">
                                <div class="activity-icon avatar-xs">
                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                        <i class="ri-user-2-fill"></i>
                                    </span>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="font-size-13">{{ $user->created_at->format('d M Y') }} <small class="text-muted">{{ $user->created_at->format('H:i A') }}</small></h5>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div style="padding-bottom: 8px;" class="card-body">
                    <h4 class="card-title mb-3">
                        @if(app()->getLocale() == 'en')
                            Annual sales income
                        @else
                            الدخل السنوي للمبيعات
                        @endif
                    </h4>
                    <div>
                        <table class="table table-hover mb-0 table-centered table-nowrap" style="width:100%">
                            @foreach($uniqueCollection as $u)
                            <tr>
                                <th>{{ $u }}</th>
                                <td>
                                    <?php
                                        $orders = \App\Models\Order::where('created_at',  'LIKE' , '%' . $u . '%')->get();
                                        $total = 0;
                                        foreach ($orders as $order){
                                            $total+= $order->total_price;
                                        }
                                    ?>
                                    {{ $total }} <small style="color: lightblue">QAR</small>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div style="padding-bottom: 8px;" class="card-body">
                    <h4 class="card-title mb-3">
                        @if(app()->getLocale() == 'en')
                            Monthly sales income
                        @else
                            الدخل الشهري للمبيعات
                        @endif
                    </h4>
                    <div>
                        <table class="table table-hover mb-0 table-centered table-nowrap" style="width:100%">
                            <?php
                            $months = \App\Models\Order::select(
                                DB::raw('sum(total_price) as `sums`'),
                                DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
                                DB::raw('max(created_at) as createdAt')
                            )
                                ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(1000))
                                ->orderBy('createdAt', 'desc')
                                ->groupBy('months')
                                ->get();
                            ?>
                            @foreach($months as $month)
                            <tr>
                                <th>{{ $month->months }}</th>
                                <td>
                                    {{ $month->sums }} <small style="color: lightblue">QAR</small>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    {!! $chartt->script() !!}
@endsection