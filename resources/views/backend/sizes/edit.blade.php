@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.edit') }} {{ __('dashboard.size') }} " {{ $size->code }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('sizes.update' , $size->id) }}" class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.size') }}</label>
                                    <input type="text" name="code" class="form-control" id="validationCustom01" placeholder="{{ __('dashboard.size') }} (xl , lg)" value="{{ $size->code }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox"
                                           @if($size->active == 1) checked="" @endif
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
@endsection
