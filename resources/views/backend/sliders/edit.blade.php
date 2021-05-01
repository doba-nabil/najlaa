@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.edit') }} {{ __('dashboard.ad_banners') }} " {{ $slider['title_'.app()->getLocale()] }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('sliders.update' , $slider->id) }}" class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_ar">{{ __('dashboard.title_ar') }}</label>
                                    <input type="text" name="title_ar" class="form-control" id="title_ar" placeholder="{{ __('dashboard.title_ar') }}" value="{{ $slider->title_ar }}" required>
                                    @error('title_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">{{ __('dashboard.title_en') }}</label>
                                    <input type="text" name="title_en" class="form-control" id="title_en" placeholder="{{ __('dashboard.title_en') }}" value="{{ $slider->title_en }}" required>
                                    @error('title_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subtitle_ar">{{ __('dashboard.subtitle_ar') }} ({{ __('dashboard.optional') }})</label>
                                    <input type="text" name="subtitle_ar" class="form-control" id="subtitle_ar" placeholder="{{ __('dashboard.subtitle_ar') }}" value="{{ $slider->subtitle_ar }}">
                                    @error('subtitle_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subtitle_en">{{ __('dashboard.subtitle_en') }} ({{ __('dashboard.optional') }})</label>
                                    <input type="text" name="subtitle_en" class="form-control" id="subtitle_en" placeholder="{{ __('dashboard.subtitle_en') }}" value="{{ $slider->subtitle_en }}">
                                    @error('subtitle_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-3">
                                <label>
                                    @lang('dashboard.products')
                                </label>
                                <div class="form-group" data-select2-id="126">
                                    <select style="width: 100%" name="product_ids[]" class="select2 form-control select2-hidden-accessible" multiple="" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                        @foreach($products as $product)
                                            <option
                                                    @foreach($usedProducts as $uproduct)
                                                    @if($uproduct->product_id == $product->id)
                                                    selected
                                                    @endif
                                                    @endforeach
                                                    value="{{ $product->id }}">{{ $product['name_'.app()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile" onchange="readURL(this);">
                                    <label class="custom-file-label" for="customFile">{{ __('dashboard.image') }}</label>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    @if(isset($slider->mainImage))
                                        <img id="blah" class="mt-3" src="{{ asset('pictures/sliders/' . $slider->mainImage->image) }}"/>
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
                                           @if($slider->active == 1) checked="" @endif
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
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
@endsection
