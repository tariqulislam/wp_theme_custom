<?php
/**
 * Plugin Name: Custom Video Plugin
 * Description: A custom video plugin that encrypts the video url and streams the content of the video. With the ability to jump from video to video and jump to the last video time.
 * Version: 1.0
 * Author: Anonimus GOS
 */

class VideoController {
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
				$video = jQuery('<video class="video-js vjs-default-skin"><source type="video/mp4"></video>');
				jQuery('.icon_controlers i.icon_loc').click(function(){
					console.log(this);
					$label = jQuery(this).attr('video_label');
					$parent = jQuery(this).closest('div.tab-pane[role="tabpanel"]');
					$parent.find('.icon_controlers i.icon_loc.active').removeClass('active');
					jQuery(this).addClass('active');
					var $time = 0;
					if(myPlayer != null){
						$time = myPlayer.currentTime();
					};
					$new_video = $video.clone();
					$new_video.find('source').attr('src',jQuery(this).attr('href'));
					jQuery('.video-cont').html($new_video);
					myPlayer = videojs(
						$new_video[0], 
						{ 
							"controls": true, 
							"autoplay": true,
							"width": "100%",
							"height": "100%"
						}, 
						function() {}
					);
					myPlayer.volume(0.1);
					myPlayer.on('loadedmetadata', function() {
				  	// myPlayer.currentTime($time);
				  	jQuery('<label class="video_label">'+$label+'</label>').prependTo(jQuery('.video-js'));
					});
				});
			</script>
		</div>
		<?php return ob_get_clean();
	}
	//run_video
	public function postVideo($video = null) {
		//var_dump("expression");die;
 		if(isset($_GET['run_video'])) {
			// if( ! Auth::check() ){
			// 	echo "You do not have permision";
			// 	die;
			// }
			$file = self::encrypt_decrypt('decrypt',$_GET['run_video']);
			//var_dump($file);die;
			$fp = @fopen($file, 'rb');
			$size = filesize($file); // File size
			$length = $size; // Content length
			$start = 0; // Start byte
			$end = $size - 1; // End byte
			header('Content-type: video/mp4');
			//header("Accept-Ranges: 0-$length");
			header("Accept-Ranges: bytes");
			if (isset($_SERVER['HTTP_RANGE'])) {
				$c_start = $start;
				$c_end = $end;
				list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
				if (strpos($range, ',') !== false) {
					header('HTTP/1.1 416 Requested Range Not Satisfiable');
					header("Content-Range: bytes $start-$end/$size");
					exit;
				}
				if ($range == '-') {
					$c_start = $size - substr($range, 1);
				}else{
					$range = explode('-', $range);
					$c_start = $range[0];
					$c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
				}
				$c_end = ($c_end > $end) ? $end : $c_end;
				if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
					header('HTTP/1.1 416 Requested Range Not Satisfiable');
					header("Content-Range: bytes $start-$end/$size");
					die;
				}
				$start = $c_start;
				$end = $c_end;
				$length = $end - $start + 1;
				fseek($fp, $start);
				header('HTTP/1.1 206 Partial Content');
			}
			header("Content-Range: bytes $start-$end/$size");
			header("Content-Length: ".$length);
			$buffer = 1024 * 8;
			while(!feof($fp) && ($p = ftell($fp)) <= $end) {
				if ($p + $buffer > $end) {
					$buffer = $end - $p + 1;
				}
				set_time_limit(0);
				echo fread($fp, $buffer);
				flush();
			}
			fclose($fp);
			die;
		}
	}

}
add_shortcode( 'custom_videos_plugin', array( 'VideoController', 'viewTest' ) );

add_action('init', array( 'VideoController', 'postVideo' ) );