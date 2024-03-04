<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 left-side">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
                <div class="address">
                    <i class="bi bi-geo-alt"></i>
                    No.78-1, Chenggong Rd., Renwu Dist., Kaohsiung CIty 81459, Taiwan
                </div>
                <div class="copy-right">
                    &copy; Copyright {{ date('Y') }} Shengplus. All rights reserved.
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 right-side">
                <img src="{{ asset('images/world-map.png') }}" alt="" class="world-map">
                <img src="{{ asset('images/qr-code.png') }}" alt="" class="qr-code">
            </div>
        </div>
    </div>
</footer>
