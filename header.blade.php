<div class="more_main_menu_wrap" id="nav_menu_wrapper">
    <span class="close_more_main"></span>
    <div class="more_main_menu_outer">
        <div class="more_main_menu_inner">
            <div class="more_main_inside">
                <div class="big_menu_left">
                    <h4 class="all_menu_section_title">সেকশন</h4>
                    <div class="big_menu_all">
                        <ul>
                            <li class="menu_page_id_37 menu_color_"><a class="static" href="/">হোম</a></li>
                            <li class="menu_page_id_1141 menu_color_"><a class="static" href="{{$domain_url}}latest-news">আজকের সর্বশেষ খবর</a></li>
                            <li class="menu_page_id_ menu_color_"><a class=" " href="{{ config('app.url') }}topic/special-news">বিশেষ সংবাদ</a></li>

                            @foreach ($globalCategories as $category) @if ($category->childrenCategories->isEmpty())
     
                         <li class="menu_page_id_1108 menu_color_"><a class="static" href="{{ route('posts.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a></li>
                         @endif                      @endforeach
                            <li class="menu_page_id_1099 menu_color_"><a class="dynamic" href="{{$domain_url}}photo">ছবি</a></li>
                            <li class="menu_page_id_1105 menu_color_"><a class="dynamic" href="{{$domain_url}}video">ভিডিও</a></li>
                            <li class="menu_page_id_ menu_color_"><a class=" " href="{{ $epaper_link }}">ই-পেপার</a></li>
                            <li class="menu_page_id_ menu_color_"><a class=" " href="{{ $english_site }}" target="_blank">English</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="whole_wrapper">
    <div class="whole_inner">
        <div class="header_outer">
            <div class="header_top_wrap">
                <div class="header_top" height="80px">
                    <div class="header_top_logo" height="70px">
                        <h1 class="site_logo_top">
                            <a href="{{ route('home') }}">
                                @if (get_setting('header_logo') != null)
                                <img height="82px" width="200px" src="{{ uploaded_asset(get_setting('header_logo')) }}" alt="{{ env('APP_NAME') }}" />

                                @else
                                <img height="82px" width="200px" src="{{ asset('frontend/img/logo.png') }}" alt="{{ env('APP_NAME') }}" />
                                @endif
                            </a>
                        </h1>
                    </div>
                    <div class="header_left_top">
                        <div class="header_left_top_top">
                            <span id="nav_toggler" class="more_main_menu" onclick="side_navigation_toggler()"></span>

                            <div class="header_search_wrap">
                                <span class="search_toggle click-free-pop" data-pop=".header_seach_form"></span>
                              
                                <div class="header_seach_form">
                                    <button class="search_close"></button>
                                    <form id="jadewits_search_form_1223" action="/search">
                                        <button class="search_button" type="submit"><span>অনুসন্ধান</span></button>
                                        <div class="search_input_holder">
                                            <input class="search_input jadewits_keyboard" name="q" data-keyboardfixedpos="32" type="text" value="" placeholder="কী খুঁজতে চান?" />
                                        </div>
                                    </form>
                             
                                    <script type="text/javascript">
                                        $("#jadewits_search_form_1223").submit(function () {
                                            var search_text = $.trim($("[name=q]", this).val());
                                            if (search_text == "কী খুঁজতে চান?" || !search_text) {
                                                alert("Please type something to search");
                                                return false;
                                            }
                                            return true;
                                        });
                                    </script>
                                </div>
                                <script type="text/javascript">
                                    $(".search_toggle").click(function () {
                                        $(".header_seach_form .search_input").focus();
                                    });

                                    $(".header_seach_form  .search_close").click(function () {
                                        $(".header_seach_form").toggle();
                                    });
                                </script>
                            </div>
                            
                        </div>
                        
                        <div class="todays_time">{{ bn_date_convert_now() }}</div>
                    </div>
                    <div class="header_right_top">
                        <div class="header_right_top_inner">
                            <div class="header_social_wrap">
                                <div class="big_social_right social_links">
                                    @if (get_setting('show_social_links'))
                                    <ul class="d-flex">
                                        @if (get_setting('facebook_link') != null)
                                            <li class="mx-1 rounded-circle d-flex align-items-center facebook justify-content-center">
                                                <a href="https://www.facebook.com/dmcnews24bd/"><i
                                                        class="fab fa-facebook-f text-white"></i></a>
                                            </li>
                                        @endif
                                        @if (get_setting('youtube_link') != null)
                                            <li class="mx-1 rounded-circle d-flex align-items-center youtube justify-content-center">
                                                <a href="https://www.youtube.com/@Dailymanusersangram"><i
                                                        class="fab fa-youtube text-white"></i></a>
                                            </li>
                                        @endif
                                        @if (get_setting('twitter_link') != null)
                                            <li class="mx-1 rounded-circle d-flex align-items-center twitter justify-content-center">
                                                <a href="{{ get_setting('twitter_link') }}"><i
                                                        class="fab fa-twitter text-white"></i></a>
                                            </li>
                                        @endif
                                        @if (get_setting('instagram_link') != null)
                                            <li class="mx-1 rounded-circle d-flex align-items-center instagram justify-content-center">
                                                <a href="{{ get_setting('instagram_link') }}"><i
                                                        class="fab fa-instagram text-white"></i></a>
                                            </li>
                                        @endif
                                        @if (get_setting('linkedin_link') != null)
                                            <li class="mx-1 rounded-circle d-flex align-items-center linkedin justify-content-center">
                                                <a href="{{ get_setting('linkedin_link') }}"><i
                                                        class="fab fa-linkedin text-white"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="header_right_top_menu">
                            <ul>
                                <li class="menu_page_id_ menu_color_"><a class=" " href="{{ route('bangla_converter')}}">বাংলা কনভার্টার</a></li>
                                <li class="menu_page_id_ menu_color_"><a class=" " href="{{ $epaper_link }}">ই-পেপার</a></li>
                                <li class="menu_page_id_96 menu_color_"><a class="static" href="{{ $domain_url }}archive">আর্কাইভ</a></li>
                                <!--<li class="menu_page_id_ menu_color_"><a class=" " href="{{ $english_site }}" target="_blank">English</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_wrap">
                <div class="header">
                    <span class="more_main_menu" id="nav_toggler" onclick="side_navigation_toggler()"></span>
                    <div class="logo_small">
                        <a href="/">
                            @if (get_setting('header_logo') != null)
                            <img src="{{ uploaded_asset(get_setting('short_logo')) }}" alt="{{ env('APP_NAME') }}" />

                            @else
                            <img src="{{ asset('frontend/img/logo.png') }}" alt="{{ env('APP_NAME') }}" />
                            @endif
                        </a>
                    </div>
                    <div class="header_right_part">
                        <div class="header_right_inner">
                            <div class="header_menu_container">
                                <div class="header_menu_wrap">
                                    <span class="main_menu_toggle" onclick="side_navigation_toggler()"></span>
                                    <div id="main_menu" class="main_menu">
                                      
                                        <ul>
                                            <li class="menu_page_id_ menu_color_">
                                                <a href="{{ config('app.url') }}topic/special-news" >বিশেষ সংবাদ</a>
                                            </li>
                                            @foreach ($globalCategories as $category) @if ($category->childrenCategories->isEmpty())
                                            <li class="menu_color_"><a class="dynamic" href="{{ route('posts.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a></li>
                                            @endif @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('frontend.inc.breking_news')

        <script type="text/javascript">
            var condcheck = 0;
            function side_navigation_toggler() {
                if (condcheck == 0) {
                    document.getElementsByTagName("body")[0].classList.add("mega-menu-open");
                    document.getElementById("nav_toggler").classList.add("opened");
                    document.getElementById("nav_menu_wrapper").classList.add("opened");

                    condcheck = 1;
                } else {
                    document.getElementsByTagName("body")[0].classList.remove("mega-menu-open");
                    document.getElementById("nav_toggler").classList.remove("opened");
                    document.getElementById("nav_menu_wrapper").classList.remove("opened");
                    condcheck = 0;
                }
            }
            var jw_element_pos = $(".header_top").height();
            var jw_change_me_now = true;
            var sticky_menu_interactive = function () {
                if ($(window).scrollTop() > jw_element_pos) {
                    if (jw_change_me_now) {
                        $("body").addClass("sticky_menu");
                        jw_change_me_now = false;
                    }
                } else {
                    if (!jw_change_me_now) {
                        $("body").removeClass("sticky_menu");
                        jw_change_me_now = true;
                    }
                }
            };
            $(window).scroll(sticky_menu_interactive).resize(sticky_menu_interactive);
        </script>
    </div>
</div>

<style>
.envv{
    display:none;
}
@media(max-width:767px){
    .envv {
        display:block;
    position: absolute;
    right: 10px;
    top: 47px;
}
}

</style>

