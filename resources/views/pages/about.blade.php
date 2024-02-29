@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container about-us">
        <div class="row top-img">
            <div class="col-sm-12 col-md-12 top-img-content">
                <img class="main-img" src="{{ asset('images/about-us/about-us.jpg') }}" alt="">
                <div class="bottom-imgs-container">
                    <div class="item-wrapper">
                        <div class="item">
                            <img src="{{ asset('images/about-us/about-us-icon-1.png') }}" alt="">
                            <!-- <p>研磨切斷砂輪片</p> -->
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/about-us/about-us-icon-2.png') }}" alt="">
                            <!-- <p>雷射焊接切割機</p> -->
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <img src="{{ asset('images/about-us/about-us-icon-3.png') }}" alt="">
                            <!-- <p>手持打包機</p> -->
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/about-us/about-us-icon-4.png') }}" alt="">
                            <!-- <p>特殊貴金屬</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row percent-section">
            <div class="col-sm-12 col-md-8 left-side">
                <div class="content-text">
                    從產品品質嚴密控管、完善售後服務，堅持消費者導向及質量本位之精神，保有誠懇、認真、負責的態度，解決客戶端的各種需求。客戶的滿意是我們最大的成就，稟此宗旨，致力於研磨材料相關產品及技術之研究開發及銷售服務，輔以嚴格的品質管制和完善的售後服務，量身訂製的解決方案，期使客戶有100%的滿意。
                </div>
                <div class="percent-items">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                100%
                            </div>
                            <div class="percent-text">
                                完成任務
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                100%
                            </div>
                            <div class="percent-text">
                                符合預算
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 percent-item">
                            <div class="percent-value">
                                100%
                            </div>
                            <div class="percent-text">
                                準時交貨
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 right-side">
                <div class="small-text mb-2">
                    關於 SHENGPLUS
                </div>
                    亞皇實業有限公司創立於1991年，長期致力於高精密工業及研磨產業供應鏈並提供製造、整合型、顧問服務，從高精密「研磨」、「切削」、「焊接」、「包裝」加工使用的研磨設備、五金零件、電動工具等商品的販售服務，「滿足您工業需求的一站式解決方案」便是我們致力完成的目標。
            </div>
        </div>


        <div class="row who-we-are-section">
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-1.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            認識我們
                        </h3>
                        <div class="right-side-text">
                            我們的專業工作團隊持續追求質量的突破，以滿足國內外市場的需求，並致力於提供最佳的產品和服務。我們期望得到舊雨新知的持續支持與鼓勵，以實現企業永續經營的目標。 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-2.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            跳出傳統式框架
                        </h3>
                        <div class="right-side-text">
                            我們的整合解決方案不僅僅止於單一的產品。我們明白每個製造環境都獨一無二，每個流程都各有特點。因此，我們為每位客戶、每個工廠、每個流程提供度身訂製的解決方案，以確保完美滿足其獨特需求。
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-3.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            作業流程優化
                        </h3>
                        <div class="right-side-text">
                            我們的成功來自於與客戶合作實現其特定應用的獨特能力。透過巧妙地將複雜的精加工問題與正確的解決方案相結合，我們的客戶能夠提升品質和效率，同時消除製程成本。
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-4.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            為什麼選擇我們
                        </h3>
                        <div class="right-side-text">
                            亞皇致力於為客戶提供獨一無二的表面處理、精加工、焊接/雷射加工機及拋光解決方案。我們憑藉數十年的流程優化、提高效率和克服製造挑戰的經驗，結合專業知識，致力解決客戶面臨的最棘手的問題。
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-5.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            全球專業知識和創新
                        </h3>
                        <div class="right-side-text">
                            選擇亞皇，即選擇業界最廣泛、經過驗證的設備機械和表面處理解決方案。我們不僅持續投資於研發，更重視確保最佳的創新思維，以滿足不斷發展的市場需求。憑藉我們的全球網路，我們能夠迅速且靈活地滿足您的各種需求。
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="item">
                    <div class="left-side">
                        <img src="{{ asset('images/about-us/about-us-icon-type-2-6.png') }}" alt="">
                    </div>
                    <div class="right-side">
                        <h3 class="right-side-title">
                            提供附加價值
                        </h3>
                        <div class="right-side-text">
                            亞皇透過推動創新的能力，為客戶的產品和流程設定了增值的標準。我們專注於提供優質產品，同時尊重員工和客戶的安全。我們擁有獨特的能力，在不犧牲服務或品質的情況下，發現成本節約的解決方案，從而創造價值。
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
