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
                    <form method="post" action="{{ route('faqs.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.title_ar') }}</label>
                                    <input type="text" name="title_ar" class="form-control" id="validationCustom01"
                                           placeholder="{{ __('dashboard.title_ar') }}" value="{{ old('title_ar') }}" required>
                                    @error('title_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.title_en') }}</label>
                                    <input type="text" name="title_en" class="form-control" id="validationCustom02"
                                           placeholder="{{ __('dashboard.title_en') }}" value="{{ old('title_en') }}" required>
                                    @error('title_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_ar">{{ __('dashboard.desc_ar') }}</label>
                                    <textarea rows="5" name="body_ar" class="form-control" id="body_ar"
                                              placeholder="{{ __('dashboard.desc_ar') }}" required>{{ old('body_ar') }}</textarea>
                                    @error('body_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_en">{{ __('dashboard.desc_en') }}</label>
                                    <textarea rows="5" name="body_en" class="form-control" id="body_en"
                                              placeholder="{{ __('dashboard.desc_en') }}" required>{{ old('body_en') }}</textarea>
                                    @error('body_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.kind') }}</label>
                                    <select name="kind" class="form-control select2" id="validationCustom03"
                                            required>
                                        <option hidden selected disabled value="">--- {{ __('dashboard.kind') }} ---</option>
                                        <option value="1">Faq Topics / التعليمات</option>
                                        <option value="2">Popular Faq / الاسئلة الشائعة</option>
                                    </select>
                                    @error('kind')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
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
