<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend') }}/assets/images/logo-sm-light.png" alt=""
                                         height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('backend') }}/assets/images/logo-dark.png" alt=""
                                         style="width: 95%;height: 10%;border-radius: 5px;opacity: 0.7">
                                </span>
                </a>

                <a href="/" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend') }}/assets/images/logo-sm-light.png" alt=""
                                         height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('backend') }}/assets/images/logo-light.png" alt=""
                                         style="width: 95%;height: 10%;border-radius: 5px;opacity: 0.7">
                                </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">
            @if(\App::getLocale() == 'ar')
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button class="btn header-item noti-icon waves-effect">
                        <a href="{{url('lang/en')}}">
                            EN
                        </a>
                    </button>
                </div>
            @elseif(\App::getLocale() == 'en')
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button class="btn header-item noti-icon waves-effect">
                        <a href="{{url('lang/ar')}}">
                            عربي
                        </a>
                    </button>
                </div>
            @endif
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>
            {{--   notifications  --}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-notifications-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @if(count($ordersNots) + count($contactNots) + count($contactOrderNots) + count($userNots) > 0)
                        <span class="noti-dot"></span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">
                                    @if(app()->getLocale() == 'ar')
                                        الاشعارات
                                    @else
                                        Notifications
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @if(count(Auth::user()->unreadNotifications) > 0)
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            @if(isset($notification->data['order']))
                                <?php
                                $user = \App\User::find($notification->data['user']['id']);
                                ?>
                                <a href="{{ route('orders.show' ,$notification->data['order']['id'] ) }}" class="text-reset notification-item deletenot" notification="{{ $notification->id }}" data-token="{{ csrf_token() }}">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">
                                                @if(app()->getLocale() == 'ar')
                                                    طلب جديد من المستخدم
                                                @else
                                                    New Order From User
                                                @endif
                                                 " {{ $user->name ?? '' }} "
                                            </h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">
                                                    @if(app()->getLocale() == 'ar')
                                                        قم بالضغط لزيارة الطلب
                                                    @else
                                                        Click To Visit order Information
                                                    @endif

                                                </p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                                @if(isset($notification->data['contact']))
                                    <a href="{{ route('contacts.show' ,$notification->data['contact']['id'] ) }}" class="text-reset notification-item deletenot" notification="{{ $notification->id }}" data-token="{{ csrf_token() }}">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">
                                                    @if(app()->getLocale() == 'ar')
                                                        رسالة جديدة من
                                                    @else
                                                        New Message From
                                                    @endif
                                                     " {{ $notification->data['contact']['name'] }} "
                                                </h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">
                                                        @if(app()->getLocale() == 'ar')
                                                            قم بالضغط لزيارة الرسالة
                                                        @else
                                                            Click To Visit Message Information
                                                        @endif

                                                    </p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                @if(isset($notification->data['ordercontact']))
                                    <?php
                                    $contact = \App\Models\ContactOrder::find($notification->data['ordercontact']['id']);
                                    $user = \App\User::find($contact->user_id);
                                    ?>
                                    <a href="{{ route('ordercontacts.show' ,$notification->data['ordercontact']['id'] ) }}" class="text-reset notification-item deletenot" notification="{{ $notification->id }}" data-token="{{ csrf_token() }}">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">
                                                    @if(app()->getLocale() == 'ar')
                                                        ملاحظات على الطلب الجديد من
                                                    @else
                                                        New Order Feed Back From
                                                    @endif
                                                     " {{ $user->name ?? '' }} "
                                                </h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">
                                                        @if(app()->getLocale() == 'ar')
                                                            قم بالضغط لزيارة الملاحظات
                                                        @else
                                                            Click To Show FeedBack Information
                                                        @endif

                                                    </p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                @if(isset($notification->data['user']) && !isset($notification->data['order']))
                                    <?php
                                        $user = \App\User::where('email' , $notification->data['user']['email'])->first();
                                    ?>
                                    <a href="@if(isset($user)){{ route('users.edit' , $user->id ) }}@else / @endif" class="text-reset notification-item deletenot" notification="{{ $notification->id }}" data-token="{{ csrf_token() }}">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                    <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                        <i class="fas fa-user-plus"></i>
                                                    </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">
                                                    @if(app()->getLocale() == 'ar')
                                                        مستخدم جديد
                                                    @else
                                                        New User
                                                    @endif

                                                    " {{ $user->name ?? '' }} "
                                                </h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">
                                                        @if(app()->getLocale() == 'ar')
                                                            قم بالضغط لزيارة المستخدم
                                                        @else
                                                            Click Show User Information
                                                        @endif

                                                    </p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>{{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                        @endforeach
                        @else
                            <h5 class="alert alert-warning text-center">
                                @if(app()->getLocale() == 'ar')
                                    لا يوجد جديد....
                                @else
                                    Nothing New ....
                                @endif

                            </h5>
                        @endif
                    </div>
                </div>
            </div>
            {{-- end notifications  --}}

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button class="btn header-item noti-icon waves-effect">
                    <a href="{{ route('options.edit' , 1) }}">
                        <i class="fas fa-cogs"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn header-item noti-icon waves-effect">
                        <i class="ri-logout-circle-r-line"></i></button>
                </form>
            </div>
        </div>
    </div>
</header>