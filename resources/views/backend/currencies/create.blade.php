@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.add_new') }}</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('currencies.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01" placeholder="{{ __('dashboard.name_ar') }}" value="{{ old('name_ar') }}" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02" placeholder="{{ __('dashboard.name_en') }}" value="{{ old('name_en') }}" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code">{{ __('dashboard.currency_code') }}<small> <a target="_blank" href="https://www.iban.com/currency-codes">"
                                                @if(app()->getLocale() == 'ar')
                                                    قم بالضغط لزيارة الاكواد
                                                @else
                                                    click to visit codes
                                                @endif
                                                "</a></small></label>
                                    <input type="text" name="code" class="form-control" id="code" placeholder="{{ __('dashboard.currency_code') }}" value="{{ old('code') }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.country') }}</label>
                                    <select name="country_id" class="form-control select2" id="validationCustom03" required>
                                        <option selected disabled hidden value="">---- {{ __('dashboard.country') }} ----</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country['name_'.app()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" checked="" name="active" class="custom-control-input" id="customCheck1" >
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
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
@endsection
