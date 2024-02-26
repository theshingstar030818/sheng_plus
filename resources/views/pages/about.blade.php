@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container about-us">
        <div class="row top-img">
            <div class="col-sm-12 col-md-12 top-img-content">
                <img class="main-img" src="{{ asset('images/about-us.PNG') }}" alt="">
                <div class="bottom-imgs-container">
                    <div class="item-wrapper">
                        <div class="item">
                            <img src="{{ asset('images/about-us-icon-1.PNG') }}" alt="">
                            <p>Inverter inspection</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/about-us-icon-2.PNG') }}" alt="">
                            <p>Complete Diagnostics</p>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <img src="{{ asset('images/about-us-icon-3.PNG') }}" alt="">
                            <p>Expert Solar Panel Repair</p>
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/about-us-icon-4.PNG') }}" alt="">
                            <p>Updates & Monitoring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row percent-section">
            <div class="col-sm-12 col-md-8 left-side">
                <div class="content-text">
                    Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute irure dolor in reprehenderis in voluptate velit ess cillum
                </div>
                <div class="percent-items">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                33%
                            </div>
                            <div class="percent-text">
                                Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                74%
                            </div>
                            <div class="percent-text">
                                Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                99%
                            </div>
                            <div class="percent-text">
                                Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 right-side">
                Solar power is pollution-free and causes no greenhouse gases to be emitted after installation
            </div>
        </div>


        <div class="row who-we-are-section">
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-1.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            Who We are.
                        </h3>
                        <div class="right-side-text">
                        Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-2.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            Solving challenges by thinking outside the box.
                        </h3>
                        <div class="right-side-text">
                            Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-3.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            Process optimisation.
                        </h3>
                        <div class="right-side-text">
                            Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-4.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            What we do.
                        </h3>
                        <div class="right-side-text">
                            Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-5.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            Global expertise & innovation.
                        </h3>
                        <div class="right-side-text">
                            Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us-icon-type-2-6.PNG') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            Delivering value.
                        </h3>
                        <div class="right-side-text">
                            Duis aute irure dolor in reprehenderis in voluptate velit ess cillum Duis aute 
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
