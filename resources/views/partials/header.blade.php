<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container header-content">
            <div class=""></div>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
            </a>
            <div class="right-menu">
                <div class="dropdown right-menu-item">
                    <a class="dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe"></i>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        @foreach (config('app.supported_locales') as $locale)
                            <li>
                                <a class="dropdown-item" href="{{ route('language.switch', $locale) }}" data-locale="{{@$locale}}">
                                    {{ strtoupper($locale) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="cart-wrapper right-menu-item">
                    <i class="bi bi-cart4"></i>
                </div>
                <div class="list-wrapper right-menu-item" onclick="openMenu()">
                    <i class="bi bi-list"></i>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="popup-menu" id="popupMenu">
    <span class="close-btn" onclick="closeMenu()">&times;</span>
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.PNG') }}" alt="Logo">
    </a>
    <div class="menu-content">
        <div class="menu-line">
            <div class="left-side">
                <a href="{{ url('/about') }}" class="first-item">{{__('Know US')}}</a>
            </div>
            <div class="right-side"></div>
        </div>
        <div class="menu-line product-cates">
            <div class="left-side">
                <a href="{{ url('/') }}" class="first-item">{{__("Products")}}</a>
            </div>
            <div class="right-side">
                @foreach($product_cates as $record)
                    <div class="inner-line">
                        <a href="" class="first-item">{{@$record->name}}</a>
                        @if($record->subCates)
                            @foreach($record->subCates as $sub_record)
                                <a href="" class="main-item">{{@$sub_record->name}}</a>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="menu-line article-cates">
            <div class="left-side">
                <a href="{{ url('/article-list') }}" class="first-item">{{__("Latest News")}}</a>
            </div>
            <div class="right-side">
                @if($article_cates)
                    @foreach($article_cates as $record)
                        <a href="" class="main-item">{{@$record->name}}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="menu-line contact">
            <div class="left-side">
                <a href="{{ url('/contact-us') }}" class="first-item">{{__("Contact US")}}</a>
            </div>
            <div class="right-side">
                <a href="" class="first-item">{{__("Contact History")}}</a>
            </div>
        </div>
    </div>
    <div class="community-icons-wrapper">
        <i class="bi bi-line"></i>
    </div>
</div>
