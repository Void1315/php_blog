@extends('blog1.layouts.all')
@section('video')
	<div class="content-body">
		<div class="container">
			<video controls="controls" preload = "preload" width="1200">
				<source src="{{url($video->path)}}" type="video/mp4">
			</video>
		</div>
	</div>
@endsection