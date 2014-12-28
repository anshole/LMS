@extends('layout.main')

@section('content')
<script type="text/javascript" src="imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<script type="text/javascript" src="video.js"></script>
<script type="text/javascript" src="bigvideo.js"></script>
<link rel="stylesheet" type="text/css" href="bigvideo.css">
<link rel="stylesheet" type="text/css" href="video-js.css">
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<script>
	$(function() {
    	var BV = new $.BigVideo();
    	BV.init();
    	BV.show('http://33.media.tumblr.com/tumblr_m0c3ugP0Xl1qguquao1_500.gif');
	});
</script>
@stop