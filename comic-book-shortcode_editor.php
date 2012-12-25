<?PHP

add_action("admin_menu", "comicbookshortcode_editor_make");

add_action( 'admin_enqueue_scripts', 'comicbookshortcode_editor_javascript' );

function comicbookshortcode_editor_javascript($hook) {

	global $post;
	
	if( 'post.php' != $hook )
			return;
		
	wp_enqueue_script( 'comicbookshortcode_editor', plugins_url('/js/jscolor.js', __FILE__));
	wp_enqueue_script( 'comicbookshortcode_add', plugins_url('/js/add_word.js', __FILE__));
	
}

function comicbookshortcode_editor_make(){

	add_meta_box("comicbookshortcode_editor", "Comic Book Short code", "comicbookshortcode_editor", "post");
	
}

function comicbookshortcode_editor(){

	global $post;
	
	$wp_dir = wp_upload_dir();
	
	?>
	<p>
		Word <input type="text" value="Enter a word here" id="word" />
		Size <input type="text" value="Enter a size here" id="size" />
	</p>
	<p>
		Font Color<input class="color" type="text" value="#000000" id="wcolor" />
		Background color<input class="color" type="text" value="#FFFF00" id="main" />
		Shape Outline<input class="color" type="text" value="#FFFF00" id="outline" />
	</p>
	<p><span style="border:1px solid black; cursor:pointer; cursor:hand; background:#dedede; padding:10px; margin-top:5px;" onclick="javascript:add_word()">Add to post</span></p><?PHP
	
}

?>
	