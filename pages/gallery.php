<style type="text/css">

#magazine{
	width:950px;
	height:752px;       
}
#magazine .turn-page{
	background-color:#ccc;
	background-size:100% 100%;
}
</style>
<script type="text/javascript">

	$(window).ready(function() {
		$('#magazine').turn({
							display: 'double',
							acceleration: true,
							gradients: !$.isTouch,
							elevation:50,
							when: {
								turned: function(e, page) {
									/*console.log('Current view: ', $(this).turn('view'));*/
								}
							}
						});
	});
	
	
	$(window).bind('keydown', function(e){
		
		if (e.keyCode==37)
			$('#magazine').turn('previous');
		else if (e.keyCode==39)
			$('#magazine').turn('next');
			
	});

</script>
<div id="magazine">
	<div style="background-image:url(magazine/pages/img1.PNG);"></div>
	<div style="background-image:url(magazine/pages/img2.PNG);"></div>
	<div style="background-image:url(magazine/pages/img3.PNG);"></div>
	<div style="background-image:url(magazine/pages/img4.PNG);"></div>
	<div style="background-image:url(magazine/pages/img5.PNG);"></div>
	<div style="background-image:url(magazine/pages/img6.PNG);"></div>
	<div style="background-image:url(magazine/pages/img7.PNG);"></div>
	<div style="background-image:url(magazine/pages/img8.PNG);"></div>
	<div style="background-image:url(magazine/pages/img9.PNG);"></div>
	<div style="background-image:url(magazine/pages/img10.PNG);"></div>
	<div style="background-image:url(magazine/pages/img11.PNG);"></div>
	<div style="background-image:url(magazine/pages/img12.PNG);"></div>
</div>

