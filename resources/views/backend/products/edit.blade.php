@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.edit') }} {{ __('dashboard.product') }} {{ $product['name_'.app()->getLocale()] }}</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('products.update' , $product->id) }}" class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01"
                                           placeholder="{{ __('dashboard.name_ar') }}" value="{{ $product->name_ar }}" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02"
                                           placeholder="{{ __('dashboard.name_en') }}" value="{{ $product->name_en }}" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code">{{ __('dashboard.code') }}</label>
                                    <input type="text" name="code" class="form-control" id="code"
                                           placeholder="{{ __('dashboard.code') }}" value="{{ $product->code }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ __('dashboard.price') }} "QAR"</label>
                                    <input min="0" step="0.1" type="number" name="price" class="form-control" id="price"
                                           placeholder="{{ __('dashboard.price') }}" value="{{ $product->price }}" required>
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">{{ __('dashboard.discount') }} </label>
                                    <input min="0" step="0.1" type="number" name="discount_price" class="form-control"
                                           id="discount_price" placeholder="{{ __('dashboard.discount') }} "
                                           value="{{ $product->discount_price }}">
                                    @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_qty">{{ __('dashboard.in_stock') }}</label>
                                    <input min="0" step="1" type="number" name="max_qty" class="form-control"
                                           id="max_qty" placeholder="{{ __('dashboard.in_stock') }}"
                                           value="{{ $product->max_qty }}" required>
                                    @error('max_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_qty">{{ __('dashboard.min_order') }}</label>
                                    <input min="0" step="1" type="number" name="min_qty" class="form-control"
                                           id="min_qty" placeholder="{{ __('dashboard.min_order') }}"
                                           value="{{ $product->min_qty }}" required>
                                    @error('min_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_ar">{{ __('dashboard.desc_ar') }}</label>
                                    <textarea rows="10" type="text" name="body_ar" class="form-control summernote"
                                              id="body_ar" placeholder="{{ __('dashboard.desc_ar') }}"
                                              required>{{ $product->body_ar }}</textarea>
                                    @error('body_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_en">{{ __('dashboard.desc_en') }}</label>
                                    <textarea rows="10" type="text" name="body_en" class="form-control summernote"
                                              id="body_en" placeholder="{{ __('dashboard.desc_en') }}"
                                              required>{{ $product->body_en }}</textarea>
                                    @error('body_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.select_cat') }}</label>
                                    <select name="category_id" class="form-control select2" id="category_id" required>
                                        @foreach($categories as $category)
                                            <option
                                                    @if($category->id == $product->category_id) selected @endif
                                                    value="{{ $category->id }}">{{ $category->name_en }}
                                                / {{ $category->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.select_subcat') }}</label>
                                    <select name="subcategory_id" class="form-control select2" id="subcategory_id">
                                        @foreach($subcategories as $subcategory)
                                            <option
                                                    @if($subcategory->id == $product->subcategory_id) selected @endif
                                            value="{{ $subcategory->id }}">{{ $subcategory->name_en }}
                                                / {{ $subcategory->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.material') }}</label>
                                    <select name="material_id" class="form-control select2" required>
                                        <option>Select</option>
                                        @foreach($materials as $material)
                                            <option
                                                    @if($material->id == $product->material_id) selected @endif
                                                    value="{{ $material->id }}">{{ $material->name_en }}
                                                / {{ $material->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="col-lg-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label">Select Brand</label>--}}
                                    {{--<select name="brand_id" class="form-control select2" required>--}}
                                        {{--<option>Select</option>--}}
                                        {{--@foreach($brands as $brand)--}}
                                            {{--<option--}}
                                                    {{--@if($brand->id == $product->brand_id) selected @endif--}}
                                                    {{--value="{{ $brand->id }}">{{ $brand->name_en }}--}}
                                                {{--/ {{ $brand->name_ar }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--@error('brand_id')--}}
                                    {{--<span class="text-danger">{{ $message }}</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.color') }}</label>
                                    <div>
                                        @foreach($colors as $color)
                                            <input
                                                    @foreach($selected_colors as $selected_color)
                                                        @if($selected_color->color_id == $color->id) checked @endif
                                                    @endforeach
                                                    value="{{ $color->id }}" id="checkboxid{{ $loop->index }}" name="colors[]" type="checkbox"
                                                   class="css-checkbox">
                                            <label style="background: {{ $color->color }}"
                                                   for="checkboxid{{ $loop->index }}" class="css-label"></label>
                                        @endforeach
                                    </div>
                                    @error('colors')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group color">
                                    <label class="control-label">{{ __('dashboard.sizes') }}</label>
                                    <div>
                                        @foreach($sizes as $size)
                                            <input
                                                    @foreach($selected_sizes as $selected_size)
                                                        @if($selected_size->size_id == $size->id) checked @endif
                                                    @endforeach
                                                    value="{{ $size->id }}" id="checkid{{ $loop->index }}" type="checkbox" name="sizes[]"
                                                   class="css-checkbox">
                                            <label for="checkid{{ $loop->index }}" class="css-label">
                                                <h4>
                                                    {{ $size->code }}
                                                </h4>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('sizes')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.main_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile"
                                               onchange="readURL(this);">
                                        <label class="custom-file-label" for="customFile">{{ __('dashboard.main_image') }}</label>
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        @if(isset($product->mainImage))
                                            <img id="blah" class="mt-3" src="{{ asset('pictures/products/' . $product->mainImage->image) }}"/>
                                        @else
                                            <img id="blah" class="mt-3" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 images mt-3">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.sub_images') }}</label>
                                    <span class="btn btn-success fileinput-button">
                                <span>{{ __('dashboard.sub_images') }}</span>
                                <input type="file" name="images[]" id="files" multiple
                                       accept="image/jpeg, image/png, image/gif,"><br/>
                                </span>
                                    <br>
                                    <output class="mt-3" id="Filelist"></output>
                                    <div class="col-md-12">
                                        @foreach($product->subImages as $image)
                                            <div class="image_class{{ $image->id }}" style="width:102px;display: inline-block">
                                                <img width="100" height="100" src="{{ asset('pictures/products/' . $image->image) }}">
                                                <a  style="width: 100px;border-radius: 0;text-align: center" title="" onclick="return false;" object_id="{{ $image->id }}"
                                                    delete_url="/delete_product_image/" class="btn btn-danger edit-btn-table delete_event_image" href="#">
                                                    Delete
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.sizes_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="size_image" class="custom-file-input" id="customFile2"
                                               onchange="readURL2(this);">
                                        <label class="custom-file-label" for="customFile">{{ __('dashboard.sizes_image') }}</label>
                                        @error('size_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        @if(isset($product->sizeImage))
                                            <img id="blah2" class="mt-3" src="{{ asset('pictures/products/' . $product->sizeImage->image) }}"/>
                                        @else
                                            <img id="blah2" class="mt-3" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input
                                            @if($product->chosen == 1) checked="" @endif
                                            type="checkbox" name="chosen" class="custom-control-input" id="customCheck2"
                                           value="1">
                                    <label class="custom-control-label" for="customCheck2">{{ __('dashboard.chosen') }}</label>
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
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/image_uploader.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/sweet-alerts.init.js"></script>
    @if(app()->getLocale() == 'en')
        <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    @else
        <script src="{{ asset('backend') }}/custom-sweetalert-ar.js"></script>
    @endif
@endsection
