<?php
/**
 * Plugin Name: Custom Video Plugin 2
 * Description: A custom video plugin that encrypts the video url and streams the content of the video. With the ability to jump from video to video and jump to the last video time.
 * Version: 1.0
 * Author: Anonimus GOS
 */

class VideoController2 {
	private $dir = '';

	private static function encrypt_decrypt($action, $string) {
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

	// [custom_videos_plugin]
	public function viewTest() {

 		wp_enqueue_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'css/style.css');
 		wp_enqueue_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'video-js/video-js.css');
 		wp_register_script( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'video-js/video.js');

		$demo = array(
			"View Hockey Demo 1" => (object) array(
					'clip' => 'clip1',
					'loc' => array(
							'clip2/1143_Tiger_Arena_low_clip2.mp4',
							'clip2/1143_Tiger_Arena_left_clip2.mp4',
							'clip2/1143_Tiger_Arena_left-center_clip2.mp4',
							'clip2/1143_Tiger_Arena_right_clip2.mp4',
							'clip2/1143_Tiger_Arena_right-center_clip2.mp4'
						),
					'start_status' => 'active',
					'front_img' => 'img/video_img.png',
					'board_img' => 'img/play_board.png'
				),
			"View Hockey Demo 2" =>  (object) array(
					'clip' => 'clip2',
					'loc' => array(
							'clip1/1143_Tiger_Arena_low_clip1.mp4',
							'clip1/1143_Tiger_Arena_left_clip1.mp4',
							'clip1/1143_Tiger_Arena_left-center_clip1.mp4',
							'clip1/1143_Tiger_Arena_right_clip1.mp4',
							'clip1/1143_Tiger_Arena_right-center_clip1.mp4'
						),
					'start_status' => '',
					'front_img' => 'img/video_img.png',
					'board_img' => 'img/play_board.png'
				),
			"View Basketball Demo" =>  (object) array(
					'clip' => 'basket',
					'loc' => array(
							'basket/1237_ridley_Griffith_Gym_left-center_clip.mp4',
							'basket/1237_ridley_Griffith_Gym_low_clip.mp4',
							'basket/1237_ridley_Griffith_Gym_right-center_clip.mp4',
						),
					'start_status' => '',
					'front_img' => 'img/basket_video_img.png',
					'board_img' => 'img/basket_play_board.png'
				),
		);

		$videos = array();
		$dir = plugin_dir_path( __FILE__ ) . 'videos/';		
		ob_start();?>
		<script>
			jQuery(document).ready(function(){
				videojs.options.flash.swf = "<?= plugin_dir_url( __FILE__ ) ?>video-js/video-js.swf";
			});			  
		</script>
		<div class="row space_top">
			<div role="tabpanel">			
			  	<!-- Nav tabs -->
			  	<ul class="nav nav-tabs" role="tablist" id="myTab">
					<?php foreach ($demo as $name => $loc) {?>
				    	<li role="presentation" class="<?=$loc->start_status?>">
				    		<a href="#<?=$loc->clip?>" src="<?= plugin_dir_url( __FILE__ ) . $loc->front_img ?>" aria-controls="<?=$loc->clip?>" role="tab" data-toggle="tab"><?=$name?></a>
				    	</li>
					<?php }?>
			  	</ul>			  	
				<div class="col-lg-8">
					<div class="video-cont">
						<img src="<?= plugin_dir_url( __FILE__ ) . 'img/video_img.png' ?>">
					</div>
				</div>
		  		<div class="tab-content">
						<?php foreach ($demo as $name => $loc) {?>				
							<div role="tabpanel" class="tab-pane <?=$loc->start_status?>" id="<?=$loc->clip?>">	 
								<div class="col-lg-4 icon_controlers">
									<img src="<?= plugin_dir_url( __FILE__ ) . $loc->board_img?>">
									<?php foreach ($loc->loc as $video){ 
										$classes = 'icon_loc low';
										$classes = ( substr_count( $video, "left" ) > 0 )? 'icon_loc left':$classes;
										$classes = ( substr_count( $video, "right" ) > 0 )? 'icon_loc right':$classes;
										$classes .= ( substr_count( $video, "center" ) > 0 )? ' center':$classes;
										$video_label = '';
										$video_label = ( substr_count( $classes, "left" ) > 0 )? 'Left Net Cam':$video_label;
										$video_label = ( substr_count( $classes, "right" ) > 0 )? 'Right Net Cam':$video_label;
										$video_label = ( substr_count( $classes, "low" ) > 0 )? 'Tracking View':$video_label;
										$video_label = ( substr_count( $classes, "right center" ) > 0 )? 'Right Zone Cam':$video_label;
										$video_label = ( substr_count( $classes, "left center" ) > 0 )? 'Left Zone Cam':$video_label;
										?><i class="<?= $classes ?>" href="http://www.gameonstream.com/goscorp/view-video.php?video=<?= self::encrypt_decrypt('encrypt', $video) ?>" video_label="<?=$video_label?>"></i><?php 
									} ?>
								</div>
							</div>
						<?php }?>
	  			</div>
			</div>	
			<div style="width:1px;height:1px">
				<iframe></iframe>
			</div>
			<script type="text/javascript">
				jQuery('#myTab li a').on('shown.bs.tab', function (e) {					
					jQuery('.icon_controlers i.icon_loc.active').removeClass('active');
					$dis_img = jQuery('<img>').attr('src',jQuery(e.target).attr('src'));
					jQuery('.video-cont').html($dis_img);
				})
				jQuery('#myTab li a').click(function (e) {
				  	jQuery(this).tab('show');
				  	e.preventDefault();
				  	e.stopPropagation();
				})
				var myPlayer = null;
				var $video = jQuery('<iframe></iframe>');</script>
			<script type="text/javascript">jQuery('.icon_controlers i.icon_loc').click(function(){$video_clone=$video.clone();$parent = jQuery(this).closest('div.tab-pane[role="tabpanel"]');$parent.find('.icon_controlers i.icon_loc.active').removeClass('active');jQuery(this).addClass('active');jQuery('.video-cont').html($video_clone.attr('src',jQuery(this).attr('href')).attr('id','new_vid'));});</script>
		</div>
		<?php return ob_get_clean();
	}

}
add_shortcode( 'custom_videos_plugin2', array( 'VideoController2', 'viewTest' ) );
