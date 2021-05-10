<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('backend-home') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        {{--<span class="badge badge-pill badge-success float-right">3</span>--}}
                        <span>{{ __('dashboard.dash') }}</span>
                    </a>
                </li>
                @if(Auth::user()->can('admin-list') || Auth::user()->can('admin-create') || Auth::user()->can('admin-edit') || Auth::user()->can('admin-delete') ||
                    Auth::user()->can('role-list') || Auth::user()->can('role-create') || Auth::user()->can('role-edit') || Auth::user()->can('role-delete'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-user-shield"></i>
                            <span>@lang('dashboard.admin_roles')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(Auth::user()->can('admin-list') || Auth::user()->can('admin-create') || Auth::user()->can('admin-edit') || Auth::user()->can('admin-delete'))
                                <li class="{{ Request::is('admin/moderators*')? 'mm-active': '' }}">
                                    <a href="{{ route('moderators.index') }}">
                                        @lang('dashboard.admins')
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->can('role-list') || Auth::user()->can('role-create') || Auth::user()->can('role-edit') || Auth::user()->can('role-delete'))
                                <li class="{{ Request::is('admin/roles*')? 'mm-active': '' }}">
                                    <a href="{{ route('roles.index') }}">
                                        @lang('dashboard.roles')
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->can('delivery-list') || Auth::user()->can('delivery-create') || Auth::user()->can('delivery-edit') || Auth::user()->can('delivery-delete'))
                    <li>
                        <a href="{{ route('deliveries.index') }}" class="waves-effect">
                            <i class="fas fa-truck"></i>
                            <span>{{ __('dashboard.deliveries') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('coupon-list') || Auth::user()->can('coupon-create') || Auth::user()->can('coupon-edit') || Auth::user()->can('coupon-delete'))
                    <li>
                        <a href="{{ route('coupons.index') }}" class="waves-effect">
                            <i class="fas fa-ticket-alt"></i>
                            <span>{{ __('dashboard.coupons') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('product-list') || Auth::user()->can('product-create') || Auth::user()->can('product-edit') || Auth::user()->can('product-delete'))
                    <li>
                        <a href="{{ route('products.index') }}" class="waves-effect">
                            <i class="fas fa-shopping-cart"></i>
                            <span>{{ __('dashboard.products') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('order-list') || Auth::user()->can('order-edit') || Auth::user()->can('order-delete'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-cart-plus"></i>
                            <span>{{ __('dashboard.orders') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('orders.index') }}">{{ __('dashboard.all_orders') }}</a></li>
                            <li class="{{ Request::is('new/orders')? 'mm-active': '' }}">
                                <a href="{{ route('new_orders') }}">
                                    <span class="badge badge-pill badge-danger float-right">{{ \App\Models\Order::where('new' , 1)->count() }}</span>
                                    {{ __('dashboard.unshown_orders') }}
                                </a>
                            </li>
                            <li class="{{ Request::is('old/orders')? 'mm-active': '' }}">
                                <a href="{{ route('old_orders') }}">
                                    <span class="badge badge-pill badge-soft-danger float-right">{{ \App\Models\Order::where('new' , 0)->count() }}</span>
                                    {{ __('dashboard.shown_orders') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->can('category-list') || Auth::user()->can('category-create') || Auth::user()->can('category-edit') || Auth::user()->can('category-delete'))

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-align-left"></i>
                            <span>{{ __('dashboard.categories') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('categories.index') }}">{{ __('dashboard.main_categories') }}</a></li>
                            <li><a href="{{ route('subcategories.index') }}">{{ __('dashboard.sub_categories') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('category_sliders.index') }}">{{ __('dashboard.categories_slider') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->can('property-list') || Auth::user()->can('property-create') || Auth::user()->can('property-edit') || Auth::user()->can('property-delete'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-file-search-line"></i>
                            <span>{{ __('dashboard.pros_products') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('materials.index') }}">{{ __('dashboard.materials') }}</a></li>
                            {{--<li><a href="{{ route('colors.index') }}">{{ __('dashboard.colors') }}</a></li>--}}
                            {{--<li><a href="{{ route('sizes.index') }}">{{ __('dashboard.sizes') }}</a></li>--}}
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->can('location-list') || Auth::user()->can('location-create') || Auth::user()->can('location-edit') || Auth::user()->can('location-delete'))
                    <li>
                        <a href="{{ route('countries.index') }}" class="waves-effect">
                            <i class="mdi mdi-earth"></i>
                            <span>{{ __('dashboard.countries') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cities.index') }}" class="waves-effect">
                            <i class="mdi mdi-city"></i>
                            <span>{{ __('dashboard.cities') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('currencies.index') }}" class="waves-effect">
                            <i class="far fa-money-bill-alt"></i>
                            <span>{{ __('dashboard.currencies') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('user-list') || Auth::user()->can('user-create') || Auth::user()->can('user-edit') || Auth::user()->can('user-delete'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-users"></i>
                            <span>{{ __('dashboard.store_users') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('users.index') }}">{{ __('dashboard.all_users') }}</a></li>
                            <li class="{{ Request::is('admin/blocked')? 'mm-active': '' }}"><a
                                        href="{{ route('blocked') }}">{{ __('dashboard.blocked_users') }}</a></li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->can('page-list') || Auth::user()->can('page-create') || Auth::user()->can('page-edit') || Auth::user()->can('page-delete'))
                    <li>
                        <a href="{{ route('pages.index') }}" class="waves-effect">
                            <i class="far fa-file-alt"></i>
                            <span>{{ __('dashboard.store_pages') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('slider-list') || Auth::user()->can('slider-create') || Auth::user()->can('slider-edit') || Auth::user()->can('slider-delete'))
                    <li>
                        <a href="{{ route('sliders.index') }}" class="waves-effect">
                            <i class="fas fa-images"></i>
                            <span>{{ __('dashboard.ad_banners') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('contact-list') || Auth::user()->can('contact-delete'))
                    <li>
                        <a href="{{ route('ordercontacts.index') }}" class="waves-effect">
                            <i class="fas fa-comment-dots"></i>
                            <span>{{ __('dashboard.feedbacks') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacts.index') }}" class="waves-effect">
                            <i class="fas fa-envelope"></i>
                            <span>{{ __('dashboard.messages') }}</span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('subscribe-list') || Auth::user()->can('subscribe-delete'))
                    <li>
                        <a href="{{ route('subscribers.index') }}" class="waves-effect">
                            <i class="fas fa-envelope-open-text"></i>
                            <span class="badge badge-pill badge-success float-right">{{ \App\Models\Subscribe::count() }}</span>
                            {{ __('dashboard.subscribers') }}
                        </a>
                    </li>
                @endif
                @if(Auth::user()->can('message-list'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-paper-plane"></i>
                            <span>{{ __('dashboard.send_email') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('send_form') }}">
                                    @if(app()->getLocale() == 'en')
                                        Send Random Email
                                    @else
                                        ارسال بريد عشوائي
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('send_users_form') }}">
                                    @if(app()->getLocale() == 'en')
                                        Send Email To Users
                                    @else
                                        ارسال بريد للمستخدمين
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('send_subscribers_form') }}">
                                    @if(app()->getLocale() == 'en')
                                        Send Email To Subscribers
                                    @else
                                        ارسال بريد للمتابعين
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <hr>
                @if(Auth::user()->can('order-list') || Auth::user()->can('order-edit') || Auth::user()->can('order-delete'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-scroll"></i>
                        <span>
                            @if(app()->getLocale() == 'en')
                                Reports
                            @else
                                التقارير
                            @endif
                        </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('daily_report') }}">
                                @if(app()->getLocale() == 'en')
                                    Daily Reports
                                @else
                                    التقارير اليومية
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('monthly_report') }}">
                                @if(app()->getLocale() == 'en')
                                    Monthly Reports
                                @else
                                    التقارير الشهرية
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('yearly_report') }}">
                                @if(app()->getLocale() == 'en')
                                    Yearly Reports
                                @else
                                    التقارير السنوية
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all_report') }}">
                                @if(app()->getLocale() == 'en')
                                    Reports
                                @else
                                    التقارير
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('best_selling') }}">
                                @if(app()->getLocale() == 'en')
                                    Best selling
                                @else
                                    الافضل مبيعا
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->can('message-list'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bell"></i>
                        <span>
           @if(app()->getLocale() == 'en')
                                Send Notifications
                            @else
                                ارسال اشعارات
                            @endif
       </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('fcm_users') }}">
                                @if(app()->getLocale() == 'en')
                                    To Users
                                @else
                                    الى المستخدمين
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fcm') }}">
                                @if(app()->getLocale() == 'en')
                                    To All Devices
                                @else
                                    الى جميع الهواتف
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fcm_not_users') }}">
                                @if(app()->getLocale() == 'en')
                                    To Devices Without Register
                                @else
                                    الى الهواتف غير المسجلة
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <hr>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->