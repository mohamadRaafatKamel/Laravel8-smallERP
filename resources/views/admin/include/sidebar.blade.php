<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{ __('Home') }} </span></a>
            </li>

            
            

            {{-- @if(\App\Models\Role::havePremission(['user_doctor','user_nurse','user_driver']))
            <li class="nav-item">
                <a href=""><i class="ft-users"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Stuff') }} </span>
                </a>
                <ul class="menu-content" >
                    @if(\App\Models\Role::havePremission(['user_doctor']))
                    <li
                    @if(View::hasSection('all_doctor')) class="active" @endif
                    ><a class="menu-item" href="{{route('admin.user.doctor')}}"   class="active"
                           data-i18n="nav.dash.ecommerce"> {{ __('All Doctor') }} </a>
                    </li>
                    @endif
                    @if(\App\Models\Role::havePremission(['user_nurse']))
                    <li
                    @if(View::hasSection('all_nurse')) class="active" @endif
                    ><a class="menu-item" href="{{route('admin.user.nurse')}}"   class="active"
                        data-i18n="nav.dash.ecommerce"> {{ __('All Nurse') }} </a>
                    </li>
                    @endif
                    @if(\App\Models\Role::havePremission(['user_driver']))
                    <li
                    @if(View::hasSection('all_driver')) class="active" @endif
                    ><a class="menu-item" href="{{route('admin.user.driver')}}"   class="active"
                        data-i18n="nav.dash.ecommerce"> {{ __('All Driver') }} </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif --}}

            {{-- @if(\App\Models\Role::havePremission(['specialty_view','specialty_cr','specialty_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-map-signs"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> التخصصات </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['specialty_view','specialty_idt']))
                            <li
                            @if(View::hasSection('specialty_view')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.specialty')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['specialty_cr']))
                            <li
                            @if(View::hasSection('specialty_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.specialty.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['pricelist_view','pricelist_cr','pricelist_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-map-signs"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{{ __('Price List') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['pricelist_view','pricelist_idt']))
                            <li
                            @if(View::hasSection('pricelist_view')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.pricelist')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['pricelist_cr']))
                            <li
                            @if(View::hasSection('pricelist_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.pricelist.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['medicaltype_view','medicaltype_cr','medicaltype_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-map-signs"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{{ __('Medical Type') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['medicaltype_view','medicaltype_idt']))
                            <li
                            @if(View::hasSection('medicaltype_view')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.medicaltype')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['medicaltype_cr']))
                            <li
                            @if(View::hasSection('medicaltype_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.medicaltype.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['category_view','category_cr','category_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-map-signs"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Category') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['category_view','category_idt']))
                            <li
                            @if(View::hasSection('category_view')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.category')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['category_cr']))
                            <li
                            @if(View::hasSection('category_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.category.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['serves_view','serves_cr','serves_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-server"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> الخدمات </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['serves_view','serves_idt']))
                            <li 
                            @if(View::hasSection('serves_view')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.service')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['serves_cr']))
                            <li
                            @if(View::hasSection('serves_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.service.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['survey_view']))
                <li class="nav-item">
                    <a href=""><i class="la la-bar-chart"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Survey') }} </span>
                    </a>
                    <ul class="menu-content">
                        <li
                        @if(View::hasSection('survey_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.survay')}}"
                               data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li
                        @if(View::hasSection('serves_static')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.statistics')}}"
                            data-i18n="nav.dash.ecommerce"> الاحصائيات </a>
                     </li>
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['company_view','company_cr','company_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-pencil-square"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Company') }} </span>
                    </a>
                    <ul class="menu-content">
                        
                        @if(\App\Models\Role::havePremission(['company_view','company_idt']))
                            <li @if(View::hasSection('company_view')) class="active" @endif >
                                <a class="menu-item" href="{{route('admin.company')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['company_cr']))
                            <li
                            @if(View::hasSection('company_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.company.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['package_view','package_cr','package_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-inbox"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Package') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['package_view','package_idt']))
                        <li
                        @if(View::hasSection('package_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.package')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['package_cr']))
                            <li
                            @if(View::hasSection('package_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.package.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Models\Role::havePremission(['physician_view','physician_cr','physician_idt']))
                <li class="nav-item">
                    <a href=""><i class="la la-stethoscope"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ __('Physician') }} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\App\Models\Role::havePremission(['physician_view','physician_idt']))
                        <li
                        @if(View::hasSection('physician_view')) class="active" @endif
                        ><a class="menu-item" href="{{route('admin.physician')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        @endif
                        @if(\App\Models\Role::havePremission(['physician_cr']))
                            <li
                            @if(View::hasSection('physician_cr')) class="active" @endif
                            ><a class="menu-item" href="{{route('admin.physician.create')}}" data-i18n="nav.dash.crypto">
                                    أضافه جديد </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}

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
