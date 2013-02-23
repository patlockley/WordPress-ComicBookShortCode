<?PHP

	function comicbookshortcode_shortcode( $atts ) {
	
		$wp_dir = wp_upload_dir();

		if(!file_exists($wp_dir['basedir'] . "/comic-book-shortcode/")){
		
			mkdir($wp_dir['basedir'] . "/comic-book-shortcode/");
			chmod($wp_dir['basedir'] . "/comic-book-shortcode/",0755);
			
		}
		
		if(!isset($atts['word'])){
		
			return "";
		
		}
		
		$word = $atts['word'];
		
		if(!isset($atts['size'])){
		
			$size = 30;
		
		}else{
		
			$size = (integer)$atts['size'];
			
		}
		
		if(!isset($atts['fill'])){
		
			$fill = "FFFF00";
		
		}else{
		
			$fill = $atts['fill'];
			
		}
		
		if(!isset($atts['outline'])){
		
			$outline = "000000";
		
		}else{
		
			$outline = $atts['outline'];
			
		}
		
		if(!isset($atts['wcolor'])){
		
			$wcolor = "000000";
		
		}else{
		
			$wcolor = $atts['wcolor'];
			
		}
	
		if(!file_exists($wp_dir['basedir'] . "/comic-book-shortcode/" . urlencode($word) . "_" . $size . ".png")){
	
			// Create a blank image and add some text

			$position = imagettfbbox ( $size+10 , 0.0 , plugin_dir_path(__FILE__) . "KOMIKAH_.ttf" , $word );

			$im = imagecreatetruecolor($position[2]+40, ($position[7]*-1)+50);
			$color = imagecolorallocate($im, hexdec(substr($wcolor,0,2)), hexdec(substr($wcolor,2,2)), hexdec(substr($wcolor,4,2)));
			$line = imagecolorallocate($im, hexdec(substr($outline,0,2)), hexdec(substr($outline,2,2)), hexdec(substr($outline,4,2)));
			$col = imagecolorallocatealpha($im,hexdec(substr($fill,0,2)), hexdec(substr($fill,2,2)), hexdec(substr($fill,4,2)),0);
			imagefill($im, 0, 0, $col);

			imagettftext ( $im, $size-1 , 0.0 , 40, ($position[7]*-1)+20 , $color , plugin_dir_path(__FILE__) . "KOMIKAH_.ttf" , $word );

			imagesetthickness ( $im , 3 );

			$start_x = 20;

			while($start_x<($position[2]-20)){

				$width = rand(30,$position[2]-$start_x);
				$height = rand(25,40);
				$left_angle = rand(0,30);

				imagearc ( $im, ($start_x+($width/2)) , 5 , $width , $height , 0 , 180 , $line );
				
				$add_x = 190 - $left_angle;
				
				$start_x+=$width;

			}

			imagearc ( $im, $start_x + ((($position[2] - $start_x)+20)/2) , 3 , ($position[2] - $start_x)+20 , 30 , 0 , 180 , $line );

			imagearc ( $im, $position[2]+30 , 12, 20 , (($position[7]*-1)+25) , 70 , 220 , $line );
			imagearc ( $im, $position[2]+30 , (($position[7]*-1)+38), 20 , (($position[7]*-1)+25) , 180 , 280 , $line );

			$start_x = $position[2]+20;

			while($start_x>100){

				$width = rand(30,$start_x-40);
				$height = rand(25,40);
				$left_angle = rand(0,30);

				imagearc ( $im, ($start_x-($width/2)) , ($position[7]*-1)+40 , $width , $height , 180 , 0 , $line );
				
				$start_x-=$width;

			}

			imagearc ( $im, $start_x - (($start_x - 30)/2), ($position[7]*-1)+40 , $start_x - 20 , 30 , 180 , 0 , $line );

			imagearc ( $im, 5 , 12, 40 , (($position[7]*-1)+25) , 358 , 100 , $line );
			imagearc ( $im, 5 , (($position[7]*-1)+38), 40 , (($position[7]*-1)+25) , 260, 	0 , $line );

			$trans = imagecolorallocatealpha($im, 255, 255, 255,127);

			imagefill($im, 1 , 1 , $trans);	

			imagealphablending($im, false);
			imagesavealpha($im, true);

			// Output the image
			imagepng($im, $wp_dir['basedir'] . "/comic-book-shortcode/" . urlencode($word) . "_" . $size . ".png");
			
		}
		
		$dir = wp_upload_dir();

		return '<img src="' . $dir['baseurl'] . '/comic-book-shortcode/' . urlencode($word)  . "_" . $size . '.png" />';
		
	}
	
	add_shortcode('comicbookshortcode', 'comicbookshortcode_shortcode' );
	
?>