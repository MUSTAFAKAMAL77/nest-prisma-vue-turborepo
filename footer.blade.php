<div class="foot-portion">
    <div class="foot_wrap_bg" style="">
        <div class="footer_top">
            <div class="foot_top_inner">
                <div class="footer_logo">
                    <a href="/">
                        @if (get_setting('footer_logo') != null)
                        <img height="76" src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}">
                        @else
                        <img height="44px" class="footerlogo img-fluid lazyload"
                            src="{{ asset('frontend/img/placeholder.jpg') }}"
                            data-src="{{ asset('frontend/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                    @endif
                    </a>
                </div>
                <div class="footer_apps">
                    <div class="app_links">
                        <a target="_blank" href="javascript:"> <img height="40" src="//cdn.ittefaq.com/contents/themes/public/style/images/appstore.png" alt="app store"></a>&nbsp;
                        <a target="_blank" href="#">
                            <img height="40" src="//cdn.ittefaq.com/contents/themes/public/style/images/googleplay.png" alt="google play">
                           
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="foot-middle-container">
            <div class="row">
                
                <div class="col col35">
                    <div class="col_in">
                        <div class="footer_middle_menu footer_menu">
                            <ul>
                                <li class="menu_page_id_54 menu_color_red"><a class="static archive" href="{{ $domain_url}}search">অনুসন্ধান</a></li>
                                <li class="menu_page_id_96 menu_color_"><a class="static" href="{{ $domain_url}}archive">আর্কাইভ</a></li>
                                <li class="menu_page_id_1099 menu_color_"><a class="dynamic" href="{{ $domain_url}}photo">ছবি</a></li>
                                <li class="menu_page_id_1106 menu_color_"><a class="static" href="{{ $domain_url}}unicode-to-bijoy-converter">বাংলা কনভার্টার</a></li>
                                <li class="menu_page_id_1105 menu_color_"><a class="dynamic" href="{{ $domain_url}}video">ভিডিও</a></li>
                                <li class="menu_page_id_1121 menu_color_"><a class="static" href="{{ $domain_url}}environment">পরিবেশ</a></li>
   
                       
                               
                                <!--<li class="menu_page_id_ menu_color_"><a class=" " href="{{ $domain_url}}topic/মুক্তিযুদ্ধের-স্মারক">মুক্তিযুদ্ধের স্মারক</a></li>-->
                                <!--<li class="menu_page_id_ menu_color_"><a class=" " href="{{ $domain_url}}topic/বাংলাদেশ-৫০">বাংলাদেশ ৫০</a></li>-->
                                <!--<li class="menu_page_id_ menu_color_"><a class=" " href="{{ $domain_url}}topic/মুজিববর্ষ">মুজিববর্ষ</a></li>-->
                            </ul>
                        </div>
                        <br><br> <br><br>
    <span style="color: red;"> গণপ্রজাতন্ত্রী বাংলাদেশ সরকারের নিয়ম মেনে তথ্য মন্ত্রণালয়ের অধীনে নিবন্ধনের জন্য আবেদিত। কোড নং  :- ৩৪৬১ </span>                    </div>
                </div>
                <div class="col col6">
                    <div class="col_in">
                        <div class="footer_other_menu footer_menu">
                            <ul>
                                <li class="menu_page_id_1139 menu_color_"><a class="static" href="{{ $domain_url}}advertisement">বিজ্ঞাপন</a></li>
                                <li class="menu_page_id_1140 menu_color_"><a class="static" href="{{ $domain_url}}contact">যোগাযোগ</a></li>
                                <li class="menu_page_id_1144 menu_color_"><a class="static" href="{{ route('privacyPolicy') }}" target="_blank">গোপনীয়তা নীতি</a></li>
                                <li class="menu_page_id_ menu_color_"><a class=" " href="{{ route('terms') }}">শর্তাবলী</a></li>
                                <li class="menu_page_id_ menu_color_"><a class="text-white" href="{{ route('aboutUs') }}"> {{ translate('About Us') }} </a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            
                <div class="col col4">
                    <div class="col_in">
                        <div
                        class="text-white footer-address d-flex justify-content-center flex-column align-items-center mt-5 border-md-right">
                        {!! get_setting('about_us_description', null, App::getLocale()) !!}
                        @if (get_setting('app_store_link') != null)
                            <a href="{{ get_setting('app_store_link') }}" target="_blank" class="d-inline-block">
                                <img src="{{ asset('backend/img/app.png') }}" height="50px" width="100%">
                            </a>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
         <hr>
            <div class="foot-bottom text-center"> <div style="text-align:center"><a target="_blank" rel="noopener" href="https://bdithost.com">Developed by: <span style="color: red;"> BD IT HOST</span></a></div></div>
     
        </div>
       
       
    </div>
</div>
