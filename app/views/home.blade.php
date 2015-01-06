@extends('layout.main')

@section('content')
<script type="text/javascript" src="Scripts/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="Scripts/jquery-ui.js"></script>
<script type="text/javascript" src="Scripts/video.js"></script>
<script type="text/javascript" src="Scripts/bigvideo.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/bigvideo.css">
<link rel="stylesheet" type="text/css" href="CSS/video-js.css">
<link rel="stylesheet" type="text/css" href="CSS/jquery-ui.css">
<script>
	$(function() {
    	var BV = new $.BigVideo();
    	BV.init();
    	BV.show('http://33.media.tumblr.com/tumblr_m0c3ugP0Xl1qguquao1_500.gif');
	});
</script>
@stop