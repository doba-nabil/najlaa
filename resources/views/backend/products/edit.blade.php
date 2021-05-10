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
                                    <label for="price">{{ __('dashboard.price') }}</label>
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
                            <div class="col-lg-12">
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
                        <div class="row ">
                            <div class="col-md-12">
                                <label class="control-label">{{ __('dashboard.colors') }} & {{ __('dashboard.sizes') }}</label>
                                <div id="parent">
                                    @foreach($product->colors as $key => $color)
                                    <div style="border: 1px solid grey;" class="row mt-2 pt-2">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="colors[{{ $key }}][color]">
                                                {{ __('dashboard.color') }}
                                            </label>
                                            <input type="color" placeholder="colors" class="form-control" value="{{ $color->color }}" name="colors[{{ $key }}][color]" required>
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="colors[{{ $key }}][qty]">
                                                {{ __('dashboard.in_stock') }}
                                            </label>
                                            <input type="number" min="0" placeholder="{{ __('dashboard.in_stock') }}" value="{{ $color->stock_qty }}" class="form-control" name="colors[{{ $key }}][qty]" required>
                                        </div>
                                        <div class="form-group col-md-12 col-xs-12">
                                            <label style="color: red;" for="size[{{ $key }}]">
                                                {{ __('dashboard.sizes_shape') }}
                                                <br>
                                                <small>
                                                    {{ __('dashboard.sizes_shape_example') }}
                                                </small>
                                            </label>
                                            <input type="text" placeholder="{{ __('dashboard.sizes') }}" class="form-control" value="@foreach($color->sizes as $size){{ $size->size }}@if(!$loop->last)-@endif @endforeach" name="colors[{{ $key }}][sizes]" id="size[{{ $key }}]" required>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">

                                    <div style="display: flex;justify-content:space-between"
                                         class="col-md-12 mt-2">
                                        <a type="submit" onclick="addChild();"
                                           class="btn btn-success text-white">@lang('dashboard.add_more')</a>
                                        <a id="removePrice"
                                           class="btn btn-danger text-white">@lang('dashboard.remove_last')</a>
                                    </div>
                                    @error('colors')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
    <script>
        var childNumber = <?php echo $product->colors->count() ?>;
        var max_fields = '10';

        function addChild() {

            @if(app()->getLocale() == 'en')
            if (childNumber == max_fields) {
                alert('Max Fields Number');
            }
            @else
            if (childNumber == max_fields) {
                alert('تم الوصول الى الحد الاقصى من الحقول');
            }
            @endif
            if (childNumber < max_fields) {
                var parent = document.getElementById('parent');
                var newChild = `
            <div style="border: 1px solid grey;" class="row mt-2 pt-2">
            <div class="form-group col-md-6 col-xs-12">
                     <label for="colors[` + childNumber + `][color]">
                                                {{ __('dashboard.color') }}
                    </label>
                     <input type="color" placeholder="{{ __('dashboard.color') }}" class="form-control" name="colors[` + childNumber + `][color]" required>
                 </div>
                             <div class="form-group col-md-6 col-xs-12">
                              <label for="colors[` + childNumber + `][qty]">
                                                {{ __('dashboard.in_stock') }}
                    </label>
                <input type="number" min="0" placeholder="{{ __('dashboard.in_stock') }}" class="form-control" name="colors[` + childNumber + `][qty]" required>

            </div>
            <div class="form-group col-md-12 col-xs-12">
             <label style="color: red;" for="size[` + childNumber + `]">
                                                {{ __('dashboard.sizes_shape') }}
                    </label>
     <input type="text" placeholder=" {{ __('dashboard.sizes') }}" class="form-control" name="colors[` + childNumber + `][sizes]" id="size[` + childNumber + `]" required>

            </div>

            </div>
            `;
                parent.insertAdjacentHTML('beforeend', newChild);
                childNumber++;
                $('select').niceSelect();
            }
        }

        $("#removePrice").on("click", function () {
            if (childNumber > 1) {
                $("#parent").children().last().remove();
                childNumber--;
            }
        });
    </script>
@endsection
