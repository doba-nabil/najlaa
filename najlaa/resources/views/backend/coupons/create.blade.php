@extends('backend.layout.master')
@section('backend-head')
@endsection    
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.add_new') }} {{ __('dashboard.brand') }}</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('coupons.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.coupon_code') }}</label>
                                    <input type="text" name="code" class="form-control" id="validationCustom01" placeholder="{{ __('dashboard.coupon_code') }}" value="" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.perc') }}</label>
                                    <input type="number" name="value" class="form-control" id="validationCustom02" placeholder="{{ __('dashboard.perc') }}" value="" required>
                                    @error('perc')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="used_count">{{ __('dashboard.used_count') }}</label>
                                    <input type="number" name="used_count" class="form-control" id="used_count" placeholder="{{ __('dashboard.used_count') }}" value="" required>
                                    @error('used_count')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_used_count">{{ __('dashboard.user_used_count') }}</label>
                                    <input type="number" name="user_used_count" class="form-control" id="user_used_count" placeholder="{{ __('dashboard.user_used_count') }}" value="" required>
                                    @error('user_used_count')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">{{ __('dashboard.coupon_date') }}</label>
                                    <input type="date" name="end_date" class="form-control" id="end_date" placeholder="{{ __('dashboard.coupon_date') }}" value="" required>
                                    @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
