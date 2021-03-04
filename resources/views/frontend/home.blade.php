@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('frontend-main')
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="shadow"></div>
            <div class="box"></div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Start Coming Soon Area -->
    <div class="coming-soon-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="coming-soon-content">
                        <div class="logo">
                            <a href="/"><img src="{{ asset('frontend') }}/assets/img/logo.png" alt="image"></a>
                        </div>
                        <h1>we are comming soon </h1>
                        <p>Best shopping experience online in the middle east</p>
                        <p class="pp">Sign up now and be first to know when it's ready </p>
                        <div class="newsletter-form">
                            <input name="email" type="email" class="search-box input-newsletter" id="kk" value="" placeholder="Enter email address" autocomplete="off">
                            <button type="submit" data-token="{{ csrf_token() }}" class="sub-submit"></button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('frontend-footer')
    <script>

    </script>
@endsection