@extends('blog1.layouts.all')
@section('index')
<div class="content-body">
	<div class="container">
		<div class="row">
			<main class="col-md-8">
			@foreach($articles as $article)
				<article class="post post-1">
					<header class="entry-header">
						<h1 class="entry-title">
							<a href="#">{{$article->title}}</a>
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
							<span class="post-author"><a href="#">{{$article->support}} 人觉得很赞</a></span>
							<span class="comments-link"><a href="#">{!!mb_strlen($article->body)!!} 字</a></span>
						</div>
					</header>
					<div class="entry-content clearfix" id="article_{{$article->id}}" data="{{$article->id}}">
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
			<aside class="col-md-4">
				<div class="widget widget-recent-posts">		
					<h3 class="widget-title">Recent Posts</h3>		
					<ul>
						<li>
							<a href="#">Adaptive Vs. Responsive Layouts And Optimal Text Readability</a>
						</li>
						<li>
							<a href="#">Web Design is 95% Typography</a>
						</li>
						<li>
							<a href="#">Paper by FiftyThree</a>
						</li>
					</ul>
				</div>
				<div class="widget widget-archives">		
					<h3 class="widget-title">Archives</h3>		
					<ul>
						<li>
							<a href="#">November 2014</a>
						</li>
						<li>
							<a href="#">September 2014</a>
						</li>
						<li>
							<a href="#">January 2013</a>
						</li>
					</ul>
				</div>

				<div class="widget widget-category">		
					<h3 class="widget-title">Category</h3>		
					<ul>
						<li>
							<a href="#">Web Design</a>
						</li>
						<li>
							<a href="#">Web Development</a>
						</li>
						<li>
							<a href="#">SEO</a>
						</li>
					</ul>
				</div>
			</aside>
		</div>
	</div>
</div>
@endsection