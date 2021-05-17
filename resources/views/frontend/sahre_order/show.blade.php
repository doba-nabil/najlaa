<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/logo-sm-dark.png">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('backend') }}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
        #map-canvas {
            width: 100%;
            height: 350px;
        }
        #pac-input {
            z-index: 0 !important;
            position: absolute !important;
            top: 0px !important;
            left: 0 !important;
            width: 100% !important;
            height: 40px !important;
            padding: 0 6px !important;
            border: 2px solid #ce8483 !important;
            border-radius: 3px!important;
        }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAbukNOXKPE1M-2Duze7aLXcRLguKXbJQ&libraries=places&sensor=false"></script>
    <!-- App Css-->

    @if(app()->getLocale() == 'en')
        <link href="{{ asset('backend') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('backend') }}/assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{ asset('backend') }}/mine.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body data-sidebar="dark">

<input type="hidden" value="{{URL::to('/')}}" id="base_url">
<div id="layout-wrapper">
    <div style="margin-left: 0;margin-right: 0" class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order No {{ $order->order_no }}</h4>
                                <p class="card-title-desc"></p>
                                <hr>
                                <div class="table-responsive">
                                    <h4>
                                        Order Main Informations
                                    </h4>
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                        <tr>
                                            <th scope="row" style="width: 400px;">User Name</th>
                                            <td>{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">City</th>
                                            <td>{{ $order->city->name_ar }} / {{ $order->city->name_en }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">FullName</th>
                                            <td>{{ $order->fullname }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Street Address</th>
                                            <td>{{ $order->street_address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Building no</th>
                                            <td>{{ $order->building_no }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Area</th>
                                            <td>{{ $order->area }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                        @if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                            <tr>
                                                <th scope="row">signed</th>
                                                <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->time)->format('h:i A') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                            <tr>
                                                <th scope="row">processed</th>
                                                <td>{{ \Carbon\Carbon::parse($order->processed)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->processed)->format('h:i A') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->status == 2 || $order->status == 3 || $order->status == 4)
                                            <tr>
                                                <th scope="row">shipped</th>
                                                <td>{{ \Carbon\Carbon::parse($order->shipped)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->shipped)->format('h:i A') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->status == 3 || $order->status == 4)
                                            <tr>
                                                <th scope="row">out to delivery</th>
                                                <td>{{ \Carbon\Carbon::parse($order->out_to_delivery)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->out_to_delivery)->format('h:i A') }}</td>
                                            </tr>
                                        @endif
                                        @if($order->status == 4)
                                            <tr>
                                                <th scope="row">signed</th>
                                                <td>{{ \Carbon\Carbon::parse($order->delivered)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->delivered)->format('h:i A') }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th class="text-danger" scope="row">Total Price</th>
                                            <td class="text-danger">{{ $order->total_price }} QAR</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <h4>
                                         Products
                                    </h4>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Count</th>
                                            <th>price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->pays as $pay)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td width="100" height="100">
                                                    @if(isset($pay->product->mainImage))
                                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('pictures/products/' . $pay->product->mainImage->image) }}"/>
                                                    @else
                                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                                    @endif
                                                </td>
                                                <td>{{ $pay->product->name_ar }} <br> {{ $pay->product->name_en }}</td>
                                                <td>{{ $pay->product->code }}</td>
                                                <td style="background: {{ $pay->color->color }}">{{ $pay->color->name_ar }} <br> {{ $pay->color->name_en }}</td>
                                                <td>
                                                    {{ $pay->size->code }}
                                                </td>
                                                <td>
                                                    {{ $pay->count }}
                                                </td>
                                                <td>
                                                    @if($pay->product->price == 0 || empty($pay->product->price ))
                                                     {{ $pay->product->price }} QAR
                                                    @else
                                                        {{ $pay->product->discount_price }} QAR
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <?php
                                    $address = \App\Models\Address::where('user_id' , $order->user_id)->where('building_no',$order->building_no)->where('street_address',$order->street_address)->first();
                                    ?>
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    {{ __('dashboard.location') }}
                                                    <strong style="font-size: 12px;color: red;">
                                                        @if(app()->getLocale() == 'en')
                                                            @if(!isset($address->lat))
                                                                No Location To This Address
                                                            @endif
                                                        @else
                                                            @if(!isset($address->lat))
                                                                لا يوجد تحديد على الخريطة لذلك العنوان
                                                            @endif
                                                        @endif

                                                    </strong>
                                                </h3>
                                            </div>
                                            @if(isset($address->lat))
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @if(isset($address))
                                                            <div id="map-canvas"></div>
                                                            <input type="hidden" id="lat" name="lat" value="{{ $address->lat }}" required>
                                                            <input type="hidden" id="lng" name="lng" value="{{ $address->lng }}" required>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <!-- /Main Content -->
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
    </div>
    <!-- END layout-wrapper -->
</div>
@if(isset($address->lat))
    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat: {{ $address->lat }},
                lng: {{ $address->lng }},
            },
            zoom:15
        });
        var marker = new google.maps.Marker({
            position: {
                lat: {{ $address->lat }},
                lng: {{ $address->lng }},
            },
            map: map,
            draggable: false
        });
    </script>
@endif
</body>
</html>

