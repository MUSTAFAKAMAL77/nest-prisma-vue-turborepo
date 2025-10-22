      <!-- braking news section -->
      <div class="breaking-news">
        <div class="container">
            <div class="mark_news border-bottom">
                <span class="mark_news_wrap_title">{{translate('Breaking News')}}</span>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                    <ul class="mark_ul">
                        @foreach ($breaking_news_posts as $breakingNews)
                        <li class="mx-3"><a class="text-decoration-none" href="{{ route('post.details', [$breakingNews->category->slug, $breakingNews->id]) }}">
                             <span class="str"></span> &nbsp;&nbsp;{{$breakingNews->getTranslation('title')}} &nbsp;&nbsp;</a></li><br>
                        @endforeach
                    </ul>
                </marquee>
            </div>
{{-- 
            <div class="mark_news notice">
                <span class="mark_news_wrap_title">{{translate('নোটিশ')}}</span>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                    <ul class="mark_ul ">
                        <li class="mx-3"><a class="text-decoration-none">
                            <span class="str"></span> &nbsp;&nbsp;{!! $notice->notice !!} &nbsp;&nbsp;</a></li>
                    </ul>
                </marquee>
            </div> --}}

        </div>
    </div> 
