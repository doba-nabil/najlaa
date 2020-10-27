@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Store Option</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('options.update' , 1) }}" class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">Facebook</label>
                                    <input type="text" name="face" class="form-control" id="validationCustom01" placeholder="Facebook" value="{{ $option->face }}" required>
                                    @error('face')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom04">Instagram</label>
                                    <input type="text" name="insta" class="form-control" id="validationCustom04" placeholder="instagram" value="{{ $option->insta }}" required>
                                    @error('insta')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">Whatsapp number</label>
                                    <input type="text" name="whats" class="form-control" id="validationCustom02" placeholder="whatsapp number" value="{{ $option->whats }}" required>
                                    @error('whats')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom03">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="validationCustom03" placeholder="phone" value="{{ $option->phone }}" required>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address_ar">address in arabic</label>
                                    <input type="address" name="address_ar" class="form-control" id="address_ar" placeholder="address in arabic" value="{{ old('address_ar') }}" required>
                                    @error('address_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address_en">address in english</label>
                                    <input type="address" name="address_en" class="form-control" id="address_en" placeholder="address in english" value="{{ old('address_en') }}" required>
                                    @error('address_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ios">Ios APP Link</label>
                                    <input type="text" name="ios" class="form-control" id="ios" placeholder="Facebook" value="{{ $option->ios }}">
                                    @error('ios')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ios">Andriod APP Link</label>
                                    <input type="text" name="andriod" class="form-control" id="andriod" placeholder="Facebook" value="{{ $option->andriod }}">
                                    @error('andriod')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
@endsection
