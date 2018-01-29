@extends('blog1.layouts.all')
@section('video')
	<div class="content-body">
		<div class="container">
			<div class="row">
				<main class="col-md-12">
				<div class="video-item-box">
				@foreach($videos as $video)
					<div class="video-item">
						<a href="{{url('/video',$video->id)}}" target="_blank">
							<div class="video-pic">
								<img src="{{asset('/img/profile-bg.png')}}">
								<span class="video-type">搞一个大新闻</span>
							</div>
							<p class="t">{{$video->name}}</p>
						</a>
					</div>
				@endforeach
				</div>
				</main>
			</div>
		</div>
	</div>
@endsection