@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Faq element " {{ $faq->title_en }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('faqs.update' , $faq->id) }}" class="needs-validation"
                          novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">Title in Arabic</label>
                                    <input type="text" name="title_ar" class="form-control" id="validationCustom01"
                                           placeholder="Name in Arabic" value="{{ $faq->title_ar }}" required>
                                    @error('title_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">Title in English</label>
                                    <input type="text" name="title_en" class="form-control" id="validationCustom02"
                                           placeholder="Name in English" value="{{ $faq->title_en }}" required>
                                    @error('title_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_ar">Description in Arabic</label>
                                    <input type="text" name="body_ar" class="form-control" id="body_ar"
                                           placeholder="Description in Arabic" value="{{ $faq->body_ar }}" required>
                                    @error('body_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_en">Description in English</label>
                                    <input type="text" name="body_en" class="form-control" id="body_en"
                                           placeholder="Description in Arabic" value="{{ $faq->body_en }}" required>
                                    @error('body_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">Kind</label>
                                    <select name="kind" class="form-control select2" id="validationCustom03"
                                            required>
                                            <option
                                                    @if($faq->kind == 1) selected @endif
                                            value="1">Faq Topics / التعليمات</option>
                                        <option
                                                @if($faq->kind == 2) selected @endif
                                        value="2">Popular Faq / الاسئلة الشائعة</option>
                                    </select>
                                    @error('kind')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">Submit</button>
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
