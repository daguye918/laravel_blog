@extends('home.layouts.main')
@section('title', $title)
@section('keywords', $article->keywords)
@section('content')
    <main>
        <div class="infosbox">
            <div class="newsview">
                <h3 class="news_title">{{ $article->title }}</h3>
                <div class="bloginfo">
                    <ul>
                        <li class="author">作者：<a href="/">{{ $article->author }}</a></li>
                        <li class="timer">时间：{{ $article->created_at->toDateString() }}</li>
                        <li class="view">阅读量：{{ $article->visit_count }}</li>
                    </ul>
                </div>
                <div class="tags">
                    @foreach($article->tag as $tag)
                        <a href="{{ route('tag', ['id' => $tag->tag_id]) }}">{{ $tag->name }}</a> &nbsp;
                    @endforeach
                </div>
                <div class="news_con">
                     {!! $article->content !!}
                </div>
            </div>
            <div class="share">
                <p class="diggit">
                    <span id="praise">
                        很赞哦！
                    </span>
                    (<b id="praise_count">{{ $article->praise_count }}</b>)
                </p>
            </div>
            <div class="nextinfo">

                <p>上一篇：
                    @if(is_null($article_near['previous']))
                        <a href="/">没有了</a>
                    @else
                        <a href="{{ route('article', ['id' => $article_near['previous']->id]) }}">{{ $article_near['previous']->title }}</a>
                    @endif
                </p>
                <p>下一篇：
                    @if(is_null($article_near['next']))
                        <a href="/">没有了</a>
                    @else
                        <a href="{{ route('article', ['id' => $article_near['next']->id]) }}">{{ $article_near['next']->title }}</a>
                    @endif
                </p>
            </div>
            <div class="news_pl">
                <h2>文章评论</h2>
                <div class="gbko">
                    <div class="fb">
                        {{-- 一级评论 --}}
                        @foreach($article->articleComment as $comment)
                        <ul>
                            <p class="fbtime"><span>{{ $comment->created_at }}</span>{{ $comment->user->name }}</p>
                            <p class="fbinfo">{{ $comment->content }}</p>
                            <a href="###">回复</a>
                            {{-- 子级评论 --}}
                            @if(!is_null($comment->child))
                                <ul>
                                    <li>
                                        <p class="fbtime"><span>{{ $comment->created_at }}</span></p>
                                        <p class="fbinfo"></p>
                                        <div class="ecomment"><span class="ecommentauthor">{{ $comment->child->user->name }}</span>
                                            <p class="ecommenttext">{{ $comment->child->content }}</p>
                                            <a href="###">回复</a>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        </ul>
                        @endforeach
                    </div>
                    <form action="" method="post" name="saypl" id="saypl" onsubmit="return CheckPl(document.saypl)">
                        <div id="plpost">
<<<<<<< HEAD
                            <p class="saying"><span><a href="">共有<script type="text/javascript" src=""></script>2条评论</a></span>来说两句吧...</p>
=======
                            <p class="saying"><span><a href="">共有<script type="text/javascript" src=""></script>{{ $article->comment_count }}条评论</a></span>来说两句吧...</p>
>>>>>>> 1437bf8c14ebf3775fa5178eae40dabc608b0681
                            <input name="nomember" type="hidden" id="nomember" value="1" checked="checked">
                            <textarea name="saytext" rows="6" id="saytext"></textarea>
                            <input name="imageField" type="submit" value="提交">
                            <input name="id" type="hidden" id="id" value="106">
                            <input name="classid" type="hidden" id="classid" value="77">
                            <input name="enews" type="hidden" id="enews" value="AddPl">
                            <input name="repid" type="hidden" id="repid" value="0">
                            <input type="hidden" name="ecmsfrom" value="/joke/talk/2018-07-23/106.html">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ asset('layer/layer.js') }}"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':" {{ csrf_token() }}"
                }
            });

            // 新增页面按钮提交 post形式
            $("#praise").click(function () {
                var url = "{{ route('praise', ['id'=> 20]) }}";
                var user_id = "{{ Auth::id() }}";
                var data = {user_id: user_id};
                $.ajax({
                    url : url,
                    type : 'POST',
                    data : data,
                    dataType : 'json',
                    success : function (res) {
                        if (res.status === false){
                            layer.alert(res.message, {icon:2})
                        } else {
                            var count = parseInt($("#praise_count").text() + 1);
                            $("#praise_count").text(count)
                            layer.msg(res.message)
                        }
                    }
                });
            });

        });
    </script>
@endsection