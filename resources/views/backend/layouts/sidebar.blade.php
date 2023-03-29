<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="text-center image">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" class="" alt="{{ config('app.name', 'Laravel') }}">
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">القائمة الرئيسية</li>
            <li  @if(Request::segment(2) == '') class="active" @endif >
                <a href="{{ url('/'.config('app.prefix','admin')) }}">
                    <i class="fa fa-dashboard"></i> <span>لوحة التحكم</span>
                </a>
            </li>

                <li @if(Request::segment(2) == 'categories') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/categories') }}">
                        <i class="fa fa-th"></i> <span>التصنيفات</span>
                    </a>
                </li>

                <li @if(Request::segment(2) == 'pages') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/pages') }}">
                        <i class="fa fa-edit"></i> <span>الصفحات الثابتة</span>
                    </a>
                </li>

                <li @if(Request::segment(2) == 'banners') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/banners') }}">
                        <i class="fa fa-laptop"></i> <span>البنرات</span>
                    </a>
                </li>

            <li @if(Request::segment(2) == 'brands') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/brands') }}">
                    <i class="fa fa-star"></i> <span>العلامات التجارية</span>
                </a>
            </li>

            <li @if(Request::segment(2) == 'models') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/models') }}">
                    <i class="fa fa-calendar"></i> <span>الموديل</span>
                </a>
            </li>

            <li @if(Request::segment(2) == 'colors') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/colors') }}">
                    <i class="fa fa-paint-brush"></i> <span>الألوان</span>
                </a>
            </li>
            <li @if(Request::segment(2) == 'options') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/options') }}">
                    <i class="fa fa-th-list"></i> <span>خيارات المنتجات</span>
                </a>
            </li>
            <li @if(Request::segment(2) == 'guides') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/guides') }}">
                    <i class="fa fa-align-right"></i> <span>كيفية الاستخدام</span>
                </a>
            </li>


                <li @if(Request::segment(2) == 'cars') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/cars') }}">
                        <i class="fa fa-car"></i> <span>السيارات</span>
                    </a>
                </li>
				<li @if(Request::segment(2) == 'accessories') class="active" @endif >
					<a href="{{ url(config('app.prefix','admin').'/accessories') }}">
						<i class="fa fa-american-sign-language-interpreting"></i> <span>الاكسسوارات</span>
					</a>
				</li>
                <li @if(Request::segment(2) == 'offers') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/offers') }}">
                        <i class="fa fa-percent"></i> <span>العروض</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'orders') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/orders') }}">
                        <i class="fa fa-opencart"></i> <span>الطلبات</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'tracking') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/tracking') }}">
                        <i class="fa fa-list"></i> <span>حالات الطلب</span>
                    </a>
                </li>

            <li @if(Request::segment(2) == 'fqa') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/fqa') }}">
                    <i class="fa fa-edit"></i> <span>الأسئلة الشائعة</span>
                </a>
            </li>

            <li @if(Request::segment(2) == 'notification') class="active" @endif >
                <a href="{{ url(config('app.prefix','admin').'/notification/push') }}">
                    <i class="fa fa-bell"></i> <span>الاشعارات</span>
                </a>
            </li>

                <li @if(Request::segment(2) == 'administrators') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/administrators') }}">
                        <i class="fa fa-users"></i> <span>مدراء لوحة التحكم</span>
                    </a>
                </li>
                
                <li @if(Request::segment(2) == 'webcars') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/webcars') }}">
                        <i class="fa fa-th"></i> <span>سيارات الويب</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'settings') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/settings') }}">
                        <i class="fa fa-cogs"></i> <span>الإعدادت</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'addresses') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/addresses') }}">
                        <i class="fa fa-th"></i> <span>مقرات الشركة</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'contacts') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/contacts') }}">
                        <i class="fa fa-th"></i> <span>تواصل معنا</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'features') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/features') }}">
                        <i class="fa fa-th"></i> <span>مميزاتنا</span>
                    </a>
                </li>
                <li @if(Request::segment(2) == 'methodologies') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/methodologies') }}">
                        <i class="fa fa-th"></i> <span>منهجية العمل</span>
                    </a>
                </li>

                <li @if(Request::segment(2) == 'countries') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/countries') }}">
                        <i class="fa fa-th"></i> <span>الدول</span>
                    </a>
                </li>

                <li @if(Request::segment(2) == 'evaluations') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/evaluations') }}">
                        <i class="fa fa-th"></i> <span>التقييمات</span>
                    </a>
                </li>

                
                <li @if(Request::segment(2) == 'exports') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/exports') }}">
                        <i class="fa fa-th"></i> <span>طلبات التصدير</span>
                    </a>
                </li>
                

                <li @if(Request::segment(2) == 'export-cars') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/export-cars') }}">
                        <i class="fa fa-car"></i> <span>سيارات التصدير</span>
                    </a>
                </li>
                
                <li @if(Request::segment(2) == 'webexportcars') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/webexportcars') }}">
                        <i class="fa fa-th"></i> <span>سيارات التصدير الويب</span>
                    </a>
                </li>
                
                
                <li @if(Request::segment(2) == 'services') class="active" @endif >
                    <a href="{{ url(config('app.prefix','admin').'/services') }}">
                        <i class="fa fa-th"></i> <span>خدمات التصدير</span>
                    </a>
                </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>