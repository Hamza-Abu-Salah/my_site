<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ asset('/').optional(App\Models\About::where('status' , 'ACTIVE')->first())->first_photo }}">
                        <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{ Auth::user()->name ?? ""}}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email ?? ""}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('home') }}">
                    <img class="side-menu__icon"
                        src="{{url('https://img.icons8.com/fluency/48/000000/dashboard-layout.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Home</span>
                </a>
            </li>
            <li class="side-item side-item-category">General</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('about.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/info.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">About</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('service.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/1A6DFF/C822FF/service.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Service</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('category.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/medium-priority.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Category</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('business.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/stock-share.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Business</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('education.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/student-female.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Education</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('experience.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/customer-insight.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Experience</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('skill.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/development-skill.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Skill</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('testimonial.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/1A6DFF/C822FF/good-quality.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Testimonial</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('blog.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/1A6DFF/C822FF/google-blog-search.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Blog</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('contact.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/1A6DFF/C822FF/email.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Contact</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ route('setting.index') }}">
                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/256/1A6DFF/C822FF/settings.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">Setting</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
