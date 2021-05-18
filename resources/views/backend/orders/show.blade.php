@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
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
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.order_no') }} {{ $order->order_no }}</h4>
                    <p class="card-title-desc"></p>
                    <hr>
                    <div class="table-responsive">
                        <h4>
                            @if(app()->getLocale() == 'en')
                                Order Main Informations
                            @else
                                المعلومات الرئيسية للطلب
                            @endif
                        </h4>
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 400px;">{{ __('dashboard.username') }}</th>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.city') }}</th>
                                <td>{{ $order->city->name_ar }} / {{ $order->city->name_en }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.fullname') }}</th>
                                <td>{{ $order->fullname }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.street_address') }}</th>
                                <td>{{ $order->street_address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.building_no') }}</th>
                                <td>{{ $order->building_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.area') }}</th>
                                <td>{{ $order->area }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('dashboard.phone') }}</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            @if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">{{ __('dashboard.signed') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->time)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">{{ __('dashboard.processed') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->processed)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->processed)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">{{ __('dashboard.shipped') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->shipped)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->shipped)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">{{ __('dashboard.out_to_delivery') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->out_to_delivery)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->out_to_delivery)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 4)
                                <tr>
                                    <th scope="row">{{ __('dashboard.delivered') }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->delivered)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->delivered)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="text-danger" scope="row">{{ __('dashboard.total_price') }}</th>
                                <td class="text-danger">{{ $order->total_price }} QAR</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <h4>
                            @if(app()->getLocale() == 'en')
                                Order Products
                            @else
                                منتجات الطلب
                            @endif

                        </h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('dashboard.image') }}</th>
                                <th>{{ __('dashboard.name') }}</th>
                                <th>{{ __('dashboard.code') }}</th>
                                <th>{{ __('dashboard.color') }}</th>
                                <th>{{ __('dashboard.size') }}</th>
                                <th>{{ __('dashboard.qty') }}</th>
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
                            </div>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <form method="post" action="{{ route('orders.update' , $order->id) }}" class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-12 ml-auto">
                                <div class="mt-4 mt-lg-0">
                                    <h5 class="font-size-14 mb-4">
                                        {{ __('dashboard.trucking_status') }}
                                    </h5>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 0) checked @endif type="radio" id="customRadio1" name="status" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">{{ __('dashboard.signed') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 1) checked @endif type="radio" id="customRadio2" name="status" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2"> {{ __('dashboard.processed') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 2) checked @endif type="radio" id="customRadio3" name="status" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">{{ __('dashboard.shipped') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 3) checked @endif type="radio" id="customRadio4" name="status" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio4">{{ __('dashboard.out_to_delivery') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 4) checked @endif type="radio" id="customRadio5" name="status" value="4" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio5"> {{ __('dashboard.delivered') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="delivery_id"> {{ __('dashboard.delivery_captain') }}</label>
                                    <select name="delivery_id" class="form-control" id="delivery_id" required>
                                        <option value="" disabled="" hidden @if(empty($order->delivery_id)) selected @endif> {{ __('dashboard.delivery_captain') }}</option>
                                        @foreach($dels as $del)
                                            <option
                                                    @if($del->id == $order->delivery_id) selected @endif
                                            value="{{ $del->id }}">{{ $del->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('dashboard.submit') }}</button>
                        <a style="float: right" href="{{ route('orders.index') }}" class="btn btn-warning" type="submit">{{ __('dashboard.back') }}</a>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <hr>

    <!-- end row -->
    @if(isset($phone))
        <h3>
            {{ __('dashboard.click_whats') }}
        </h3>
        <a href="https://api.whatsapp.com/send?phone={{ $phone ?? '' }}&text={{ route('share_order' , $order->order_no) }}" data-action="share/whatsapp/share" class="mr-3 text-success"><i style="font-size:40px" class="mdi mdi-whatsapp"></i></a>
    @endif
    @if(!isset($phone))
        <h3>
            {{ __('dashboard.put_whats') }}
        </h3>
    <form action="{{ route('send_whats_message' , $order->id) }}" method="get">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="phone">{{ __('dashboard.phone') }}</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="{{ __('dashboard.phone') }}" value="{{ old('phone') }}" required>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">{{ __('dashboard.click') }}</button>
    </form>
    @endif
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
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
    @else
        <script>
            var map = new google.maps.Map(document.getElementById('map-canvas'),{
                center:{
                    lat: 25.286106,
                    lng: 51.534817,
                },
                zoom:15
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: 25.286106,
                    lng: 51.534817,
                },
                map: map,
                draggable: false
            });
        </script>
    @endif
@endsection
