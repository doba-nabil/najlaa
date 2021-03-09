@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">

    </div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ __('dashboard.dash') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">
                                @if(app()->getLocale() == 'en')
                                    NAJLA
                                @else
                                    نجلاء
                                @endif

                            </a></li>
                        <li class="breadcrumb-item active">{{ __('dashboard.dash') }}</li>
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
                                    <p class="text-truncate font-size-14 mb-2">
                                        {{ __('dashboard.products') }}
                                    </p>
                                    <h4 class="mb-0">{{ App\Models\Product::count() }}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-boxes font-size-24"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border-top py-3">
                            <div class="text-truncate">
                                <span class="text-muted ml-2">
                                    <a href="{{ route('products.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.main_categories') }}</p>
                                    <h4 class="mb-0">{{ App\Models\Category::whereNull('parent_id')->count() }}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-folder-open font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <span class="text-muted ml-2">
                                    <a href="{{ route('categories.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.sub_categories') }}</p>
                                    <h4 class="mb-0">{{ App\Models\Category::whereNull('parent_id')->count() }}</h4>
                                </div>
                                <div class="text-info">
                                    <i class="fas fa-folder-open font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <span class="text-muted ml-2">
                                    <a href="{{ route('subcategories.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.countries') }}</p>
                                    <h4 class="mb-0">{{ App\Models\Country::count() }}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-globe font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <span class="text-muted ml-2">
                                    <a href="{{ route('countries.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.cities') }}</p>
                                    <h4 class="mb-0">{{ App\Models\City::count() }}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-city font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <span class="text-muted ml-2">
                                    <a href="{{ route('cities.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.currencies') }}</p>
                                    <h4 class="mb-0">{{ App\Models\Currency::count() }}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-dollar-sign font-size-24"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top py-3">
                            <span class="text-muted ml-2">
                                    <a href="{{ route('currencies.index') }}">
                                          {{ __('dashboard.visit') }}
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">{{ __('dashboard.orders') }}</p>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-shopping-cart font-size-24"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i style="color: #33AFFF" class="mdi mdi-circle font-size-10 mr-1"></i>
                                    @if(app()->getLocale() == 'en')
                                        New Orders
                                    @else
                                        الطلبات الجديدة
                                    @endif
                                </p>
                                <h5>{{ \App\Models\Order::where('status' , 0)->count() }}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i style="color: #9333FF" class="mdi mdi-circle font-size-10 mr-1"></i>
                                    @if(app()->getLocale() == 'en')
                                        Processed Orders
                                    @else
                                        الطلبات المجهزة
                                    @endif

                                </p>
                                <h5>{{ \App\Models\Order::where('status' , 1)->count() }}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i style="color: #FF33FC" class="mdi mdi-circle font-size-10 mr-1"></i>
                                    @if(app()->getLocale() == 'en')
                                        Shipped Orders
                                    @else
                                        الطلبات في انتظار الشحن
                                    @endif

                                </p>
                                <h5>{{ \App\Models\Order::where('status' , 2)->count() }}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i style="color: #FF3352" class="mdi mdi-circle font-size-10 mr-1"></i>
                                    @if(app()->getLocale() == 'en')
                                        Out to delivery
                                    @else
                                        في الطريق الى العميل
                                    @endif

                                </p>
                                <h5>{{ \App\Models\Order::where('status' , 3)->count() }}</h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center mt-4">
                                <p class="mb-2 text-truncate"><i style="color: #33FF3C" class="mdi mdi-circle font-size-10 mr-1"></i>
                                    @if(app()->getLocale() == 'en')
                                        Delivered Orders
                                    @else
                                        تم التوصيل
                                    @endif
                                </p>
                                <h5>{{ \App\Models\Order::where('status' , 4)->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <?php
                $allOrders = \App\Models\Order::count();
                ?>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">
                                @if(app()->getLocale() == 'en')
                                    Orders
                                @else
                                    طلبات الشراء
                                @endif
                            </p>
                            <h4 class="mb-0">{{ $allOrders }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-shopping-cart font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <?php
                $ordersLastWeek = \App\Models\Order::select('created_at')
                    ->where('created_at', '>', now()->subWeek()->startOfWeek())
                    ->where('created_at', '<', now()->subWeek()->endOfWeek())
                    ->count();
                ?>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">
                                @if(app()->getLocale() == 'en')
                                    Orders Last weak
                                @else
                                    طلبات الشراء الاسبوع الماضي
                                @endif
                            </p>
                            <h4 class="mb-0">{{ $ordersLastWeek }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-shopping-cart font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <?php
                $ordersLastMonth = \App\Models\Order::select('created_at')
                    ->where('created_at', '>', now()->subMonth()->startOfMonth())
                    ->where('created_at', '<', now()->subMonth()->endOfMonth())
                    ->count();
                ?>
                <div class="card-body">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <p class="text-truncate font-size-14 mb-2">
                                @if(app()->getLocale() == 'en')
                                    Orders Last weak
                                @else
                                    طلبات الشراء الشهر الماضي
                                @endif
                            </p>
                            <h4 class="mb-0">{{ $ordersLastMonth }}</h4>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-shopping-cart font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        <h5 class="font-size-13">{{ $user->created_at }}</h5>
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