@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.edit') }} {{ __('dashboard.country') }} " {{ $country['name_'.app()->getLocale()] }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('countries.update' , $country->id) }}" class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01" placeholder="{{ __('dashboard.name_ar') }}" value="{{ $country->name_ar }}" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02" placeholder="{{ __('dashboard.name_en') }}" value="{{ $country->name_en }}" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">{{ __('dashboard.country_code') }}<small> <a target="_blank" href="https://www.iban.com/country-codes">"
                                                @if(app()->getLocale() == 'ar')
                                                    قم بالضغط لزيارة اكواد المدن
                                                @else
                                                    click to visit codes
                                                @endif
                                                "</a> </small></label>
                                    <input type="text" name="code" class="form-control" id="code" placeholder="Country Code" value="{{ $country->code }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="call_code">{{ __('dashboard.country_calling_code') }}<small> <a target="_blank" href="https://countrycode.org/">"
                                                @if(app()->getLocale() == 'ar')
                                                    قم بالضغط لزيارة اكواد المدن
                                                @else
                                                    click to visit codes
                                                @endif
                                                "</a> </small></label>
                                    <input type="text" name="call_code" class="form-control" id="call_code" placeholder="Calling Code" value="{{ $country->call_code }}" required>
                                    @error('call_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile" onchange="readURL(this);" >
                                    <label class="custom-file-label" for="customFile">{{ __('dashboard.country_flag') }}</label>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    @if(isset($country->mainImage))
                                        <img id="blah" class="mt-3" src="{{ asset('pictures/countries/' . $country->mainImage->image) }}"/>
                                    @else
                                        <img id="blah" class="mt-3" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox"
                                           @if($country->active == 1) checked="" @endif
                                           name="active" class="custom-control-input" id="customCheck1" >
                                    <label class="custom-control-label" for="customCheck1">{{ __('dashboard.active') }}</label>
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
@endsection
