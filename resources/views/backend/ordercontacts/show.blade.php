@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style-rtl.css">
@endsection
@section('backend-main')
    <div class="card" style="width:100%;">
        <div class="card-body">
            <h6>
                {{ __('dashboard.message_frome_email') }} ( {{ $contact->email }} ) ---- {{ __('dashboard.username') }} ( {{ $contact->user->name }} )
            </h6>
            <h5 class="card-title">{{ __('dashboard.name') }} : {{ $contact->name }}</h5>
            <h5 class="card-title">{{ __('dashboard.type') }} : {{ $contact->getType() }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('dashboard.email') }} : {{ $contact->email }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('dashboard.phone') }} : {{ $contact->phone }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('dashboard.order_no') }} : <a target="_blank" href="{{ route('orders.show' , $contact->order->id) }}">{{ $contact->order->order_no }}</a> </h6>
            <hr>
            <p class="card-text">
                {{ __('dashboard.message') }} :
                {{ $contact->message }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.replay_msg') }}</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{route('send')}}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('dashboard.email') }}</label>
                                    <select name="email" class="form-control select2" id="email">
                                        <option selected disabled hidden value="">{{ __('dashboard.email') }}</option>
                                            <option value="{{ $contact->user->email }}">{{ __('dashboard.login_email') }} : {{ $contact->user->email }}</option>
                                            <option value="{{ $contact->email }}">{{ __('dashboard.sender_email') }} : {{ $contact->email }}</option>
                                    </select>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.title') }}</label>
                                    <input type="text" name="title" class="form-control" id="validationCustom02"
                                           placeholder="{{ __('dashboard.title') }}" value="{{ old('title') }}" required>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom05">{{ __('dashboard.message') }}</label>
                                    <textarea type="text" name="msg" class="form-control" id="validationCustom05"
                                              placeholder="{{ __('dashboard.message') }}" value="{{ old('msg') }}" required></textarea>
                                    @error('msg')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">{{ __('dashboard.click') }}</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <br>
    <div class="col-md-12">
        <a href="{{ route('ordercontacts.index') }}" style="width: 100%" class="btn btn-primary">{{ __('dashboard.back') }}</a>
    </div>
@endsection
@section('backend-footer')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backend') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    <!-- END: Theme JS-->
    <script src="{{ asset('backend') }}/summernote.min.js"></script>
@endsection
