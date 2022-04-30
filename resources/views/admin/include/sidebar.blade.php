<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{ __('Home') }} </span></a>
            </li>

            @if(\App\Models\Role::havePremission(['order_view','order_cr','order_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Order') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['order_view','order_idt']))
                        <li
                        @if(View::hasSection('order_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.order')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['order_cr']))
                            <li
                            @if(View::hasSection('order_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.order.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 
            
            @if(\App\Models\Role::havePremission(['product_view','product_cr','product_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Product') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['product_view','product_idt']))
                        <li
                        @if(View::hasSection('product_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.product')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['product_cr']))
                            <li
                            @if(View::hasSection('product_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.product.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['supplier_view','supplier_cr','supplier_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Supplier') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['supplier_view','supplier_idt']))
                        <li
                        @if(View::hasSection('supplier_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.supplier')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['supplier_cr']))
                            <li
                            @if(View::hasSection('supplier_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.supplier.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['unit_view','unit_cr','unit_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Unit') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['unit_view','unit_idt']))
                        <li
                        @if(View::hasSection('unit_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.unit')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['unit_cr']))
                            <li
                            @if(View::hasSection('unit_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.unit.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['stock_view','stock_cr','stock_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Stock') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['stock_view','stock_idt']))
                        <li
                        @if(View::hasSection('stock_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.stock')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['stock_cr']))
                            <li
                            @if(View::hasSection('stock_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.stock.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['customer_view','customer_cr','customer_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Customer') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['customer_view','customer_idt']))
                        <li
                        @if(View::hasSection('customer_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.customer')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['customer_cr']))
                            <li
                            @if(View::hasSection('customer_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.customer.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['transfer_view','transfer_cr','transfer_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Transfer Company') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['transfer_view','transfer_idt']))
                        <li
                        @if(View::hasSection('transfer_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.transfer')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['transfer_cr']))
                            <li
                            @if(View::hasSection('transfer_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.transfer.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['clearance_view','clearance_cr','clearance_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Clearance Company') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['clearance_view','clearance_idt']))
                        <li
                        @if(View::hasSection('clearance_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.clearance')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['clearance_cr']))
                            <li
                            @if(View::hasSection('clearance_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.clearance.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

            @if(\App\Models\Role::havePremission(['employ_view','employ_cr','employ_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-undo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Employ') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['employ_view','employ_idt']))
                        <li
                        @if(View::hasSection('employ_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.employ')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['employ_cr']))
                            <li
                            @if(View::hasSection('employ_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.employ.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif 

           
            @if(\App\Models\Role::havePremission(['admin_view','admin_cr','admin_idt']))
            <li class="nav-item">
                <a href=""><i class="la la-user-secret"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Admin') }} </span>
                </a>
                <ul class="menu-content">
                    
                    @if(\App\Models\Role::havePremission(['admin_view','admin_idt']))
                    <li @if(View::hasSection('admin_view')) class="active" @endif
                    ><a class="menu-item" href="{{route('admin.admin')}}"
                           data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @endif
                    @if(\App\Models\Role::havePremission(['admin_cr']))
                    <li @if(View::hasSection('admin_cr')) class="active" @endif
                    ><a class="menu-item" href="{{route('admin.admin.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                    @endif
                   
                    
                    
                </ul>
            </li>
            @endif
            {{-- @if(\App\Models\Role::havePremission(['setting_view']))
                <li class="nav-item">
                    <a href=""><i class="ft-settings"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Setting') }} </span>
                    </a>
                    <ul class="menu-content">
                        <li @if(View::hasSection('setting_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.setting')}}"
                               data-i18n="nav.dash.ecommerce"> {{ __('Setting') }} </a>
                        </li>
                    </ul>
                </li>
            @endif --}}


        </ul>
    </div>
</div>
