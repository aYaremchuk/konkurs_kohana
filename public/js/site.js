Date.prototype.toEndOfMonth = function() {
    c_date = new Date();
    date_sec_now = (c_date.getDate() - 1)*86400 + c_date.getHours()*3600 + c_date.getMinutes()*60 + c_date.getSeconds();
    date_sec_month = (33 - new Date(this.getFullYear(), this.getMonth(), 33).getDate())*86400;
    return date_sec_month - date_sec_now;
};

$(document).ready(function() {
C3Counter("counter", {
				startTime: new Date().toEndOfMonth(),
				digitWidth: 71,
				digitHeight: 119,
				digitImageHeight : 1309,
				digitAnimationHeight : 119, 				
				digitWidth2: 28,
				digitHeight2: 47,
				digitImageHeight2 : 517,
				digitAnimationHeight2: 47
			}); /* 1day - 86400seconds */	

$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.60, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		counter_separator_label: 'z', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		autoplay: true, /* Automatically start videos: True/False */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		deeplinking: false,
		markup: '<div class="pp_pic_holder"> \
					<div class="ppt">&nbsp;</div> \
					<div class="pp_top"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
					<div class="pp_content_container"> \
						<div class="pp_left"> \
						<div class="pp_right"> \
							<div class="pp_content"> \
								<a class="pp_close" href="#">Close</a> \
								<div class="pp_loaderIcon"></div> \
								<div class="pp_fade"> \
									<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
									<div class="pp_hoverContainer"> \
										<a class="pp_next" href="#">next</a> \
										<a class="pp_previous" href="#">previous</a> \
									</div> \
									<div id="pp_full_res"></div> \
									<div class="pp_details"> \
										<div class="pp_nav"> \
											<a href="#" class="pp_arrow_previous">Previous</a> \
											<a href="#" class="pp_play">Play</a> \
											<a href="#" class="pp_arrow_next">Next</a> \
										</div>\
										<p class="pp_description"></p><p class="currentTextHolder">0/0</p> \
										<div class="clear"></div> \
										{pp_social} \
									</div> \
								</div> \
							</div> \
						</div> \
						</div> \
					</div> \
					<div class="pp_bottom"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
				</div> \
				<div class="pp_overlay"></div>',			
		ie6_fallback: true,
		gallery_markup: '',			
		social_tools:false
	});

});
	
	

	
	
	