@extends('blog1.layouts.all')
@section('full')
	<div class="content-body">
		<div class="container">
			<div class="row">
				<main class="col-md-12">
				@foreach($articles as $article)
					<article class="post post-1">
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="{{url('/article',$article->id)}}" target="_blank">{{$article->title}}</a>
							</h1>
							<div class="entry-meta">
								<span class="post-category"><a href="#">Web Design</a></span>
								<span class="post-date"><a href="#"><time class="entry-date" datetime="2012-11-09T23:15:57+00:00">
								@if($article->updated_at)
									{{$article->updated_at}}
								@else
									{{$article->created_at}}
								@endif
								</time></a></span>
								<span class="post-author"><a href="#">Albert Einstein</a></span>
								<span class="post-author"><a href="#">{{$article->support}} 人觉得很赞</a></span>
								<span class="comments-link"><a href="">{!!mb_strlen($article->body)!!} 字</a></span>
							</div>
						</header>
						<div class="entry-content clearfix" id="article_{{$article->id}}">
						@php
							$the_body = $article->body;
							echo mb_substr(strip_tags($the_body),0,150)."<b>. . . . .<b>";
						@endphp
						<div class='read-more cl-effect-14'><a href="{{url('/article',$article->id)}}" class='more-link'>Continue reading <span class='meta-nav'>→</span></a></div>
						</div>
					</article>
				@endforeach
					<div style="display: flex;justify-content: center;">
						{{ $articles->links() }}
					</div>
				</main>

			</div>
			
		</div>
	</div>
@endsection