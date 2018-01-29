@extends('admin.layouts.defalut')
@section('upImage')
<div class="main" id="the_title" data="upload">
	<div class="container container-main">
		<div class="uplods-div" style="padding: 20px;background-color: white;">
			<form role="form" method="post" action="{{url('admin/create/image')}}" enctype="multipart/form-data">
				<div class="form-group">
					<label for="inputfile">图片选择</label>
					<input type="file" name="file" multiple id="ssi-upload"/>
					<p class="help-block">只能上传图片(.png.gif.jpg一类的)</p>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#ssi-upload').ssi_uploader({
    url: "{{url('admin/create/image')}}",
    data:{'_token':'{{csrf_token()}}'},
    maxFileSize:10,
    onUpload:function(msg){
  		 console.log(msg);
		},
		});
</script>
@endsection