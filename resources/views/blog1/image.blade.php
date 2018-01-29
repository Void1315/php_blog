 @extends('blog1.layouts.all')
 @section('image')
 	<div class="content-body">

		<div class="container">
			<div id="myCarousel" class="carousel slide">
			    <!-- 轮播（Carousel）指标 -->
			    <ol class="carousel-indicators">
			    @for($i = 0; $i < count($images);$i++)
				    @if($i==0)
			        	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			        @else
			        	<li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
			        @endif
		        @endfor
			    </ol>   
			    <!-- 轮播（Carousel）项目 -->
			    <div class="carousel-inner">
				    @foreach($images as $image)
					    @if($loop->first)
					        <div class="item active">
					            <img src="{{url($image->path)}}" alt="First slide">
					        </div>
				        @else
					        <div class="item">
					            <img src="{{url($image->path)}}" alt="First slide">
					        </div>
					    @endif
				    @endforeach
			     </div>
			    <!-- 轮播（Carousel）导航 -->
			    <a class="carousel-control left" href="#myCarousel" 
			        data-slide="prev">&lsaquo;
			    </a>
			    <a class="carousel-control right" href="#myCarousel" 
			        data-slide="next">&rsaquo;
			    </a>
			</div>
		</div>

	</div>
 @endsection