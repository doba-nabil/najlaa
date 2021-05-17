@extends('backend.layout.master')
@section('backend-head')
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
                    <h4 class="card-title">{{ __('dashboard.edit') }} {{ __('dashboard.address') }} " {{ $address->street_address }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('edit_form' , $address->id) }}" class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.fullname') }}</label>
                                    <input type="text" name="fullname" class="form-control" id="validationCustom01" placeholder="{{ __('dashboard.fullname') }}" value="{{ $address->fullname }}" required>
                                    @error('fullname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.street_address') }}</label>
                                    <input type="text" name="street_address" class="form-control" id="validationCustom02" placeholder="{{ __('dashboard.street_address') }}" value="{{ $address->street_address }}" required>
                                    @error('street_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.building_no') }}</label>
                                    <input type="number" name="building_no" class="form-control" id="validationCustom03" placeholder="{{ __('dashboard.building_no') }}" value="{{ $address->building_no }}" required>
                                    @error('building_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom04">{{ __('dashboard.area') }}</label>
                                    <input type="text" name="area" class="form-control" id="validationCustom04" placeholder="{{ __('dashboard.area') }}" value="{{ $address->area }}" required>
                                    @error('area')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom05">{{ __('dashboard.phone') }}</label>
                                    <input type="text" name="phone" class="form-control" id="validationCustom05" placeholder="{{ __('dashboard.phone') }}" value="{{ $address->phone }}" required>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.city') }}</label>
                                    <select name="city_id" class="form-control" id="validationCustom03" required>
                                        <option selected disabled hidden value="">---- {{ __('dashboard.select_city') }} ----</option>
                                        @foreach($cities as $city)
                                            <option
                                                    @if($city->id == $address->city_id) selected @endif
                                                    value="{{ $city->id }}">{{ $city['name_'.app()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{ __('dashboard.location') }}
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
                                                <div id="map-canvas"></div>
                                                <input id="pac-input"  type="text" placeholder="{{ __('dashboard.search_here') }}....">
                                                <input type="hidden" id="lat" name="lat" value="{{ $address->lat }}" required>
                                                <input type="hidden" id="lng" name="lng" value="{{ $address->lng }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="active" class="custom-control-input" id="customCheck1"
                                           @if( $address->active == 1 ) checked="" @endif>
                                    <label class="custom-control-label" for="customCheck1">{{ __('dashboard.main_address') }}</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('dashboard.submit') }}</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
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
                draggable: true
            });
            var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
            google.maps.event.addListener(searchBox,'places_changed',function(){
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;
                for(i=0; place=places[i];i++){
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location); //set marker position new...
                }
                map.fitBounds(bounds);
                map.setZoom(15);
            });
            google.maps.event.addListener(marker,'position_changed',function(){
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
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
                draggable: true
            });
            var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
            google.maps.event.addListener(searchBox,'places_changed',function(){
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i, place;
                for(i=0; place=places[i];i++){
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location); //set marker position new...
                }
                map.fitBounds(bounds);
                map.setZoom(15);
            });
            google.maps.event.addListener(marker,'position_changed',function(){
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
            });
        </script>
    @endif
@endsection
