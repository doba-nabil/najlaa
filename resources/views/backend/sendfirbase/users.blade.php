@extends('backend.layout.master')
@section('backend-head')
@endsection    
@section('backend-main')
    <div id="app" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                <div class="card">
                        <div class="card-header">
                            @if(app()->getLocale() == 'en')
                                Send to User's Devices
                            @else
                                ارسال هواتف الاعضاء
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('send_push_users') }}" class="needs-validation" novalidate
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_ar">{{ __('dashboard.title_ar') }}</label>
                                            <input type="text" name="title_ar" class="form-control" id="title_ar" placeholder="{{ __('dashboard.title_ar') }}" value="{{ old('title_ar') }}" required>
                                            @error('title_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_en">{{ __('dashboard.title_en') }}</label>
                                            <input type="text" name="title_en" class="form-control" id="title_en" placeholder="{{ __('dashboard.title_en') }}" value="{{ old('title_en') }}" required>
                                            @error('title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_ar">{{ __('dashboard.desc_ar') }}</label>
                                            <input type="text" name="desc_ar" class="form-control" id="desc_ar" placeholder="{{ __('dashboard.desc_ar') }}" value="{{ old('title_ar') }}" required>
                                            @error('desc_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desc_en">{{ __('dashboard.desc_en') }}</label>
                                            <input type="text" name="desc_en" class="form-control" id="desc_en" placeholder="{{ __('dashboard.desc_en') }}" value="{{ old('title_en') }}" required>
                                            @error('desc_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="desc_en">{{ __('dashboard.store_users') }}</label>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label>
                                    </div>
                                    <?php
                                        $users = \App\User::all();
                                    ?>
                                    @foreach($users as $user)
                                        <div class="col-md-2">
                                            <input id="{{ $user->id }}" type="checkbox" name="user_ids[]" value="{{ $user->id }}" /><label for="{{ $user->id }}">{{ $user->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <button class="btn btn-primary" type="submit">{{ __('dashboard.submit') }}</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });

        jackHarnerSig();
    </script>
@endsection
