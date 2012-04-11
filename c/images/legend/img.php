<?php
	//JGD: Postprocessing
	//ob_start( 'ob_postprocess' );

	//JGD: Logging for testing
	$fd = fopen("/home/strateg3/public_html/careerpathways/cpt.log", "a");
	fwrite( $fd, "ids: " . $_GET['ids'] . "\n" );
	
	$checked = FALSE;
	if(substr($_GET['ids'], 0, 1) == 'c')
	{
		$checked = TRUE;
		$_GET['ids'] = substr($_GET['ids'], 1);
	}

	$largeMode = FALSE;
	if(substr($_GET['ids'], 0, 1) == 'b')
	{
		$largeMode = TRUE;
		$_GET['ids'] = substr($_GET['ids'], 1);
	}

	$ids = explode('-', $_GET['ids']);
	asort($ids);

	if(!is_array($ids) || count($ids) <= 0)
		exit();

	require_once('inc.php');

	header('Content-Type: image/png');

	$folder = $SITE->cache_path("legend");

	$finalPath = $folder . "/" . $_GET['ids'] . '.png';

	fwrite( $fd, "FinalPath: $finalPath\n" );

	//JGD: The only place I can find this being used is always in LargeMode, so I'm enabling caching of the icons.
	if(file_exists($finalPath) && !$checked ) //&& !$largeMode)
	{
		fwrite( $fd, "Using cached version of file\n" );
		//End output buffering
		//ob_end_flush();
		die(file_get_contents($finalPath));
	}

	// Gather the list of graphics requeste by the URL
	$sql = "SELECT `graphic` FROM `post_legend` WHERE";
	foreach($ids as $id)
		$sql .= " `id` = '" . $id . "' OR";
	$sql = substr($sql, 0, -3) . " ORDER BY `id` ASC";
	$icons = $DB->MultiQuery($sql);

	if($checked)
	{
		$width = $height = 20;
		$img = initializeImage($width, $height);

		$copy = imagecreatefrompng($icons[0]['graphic']);
		imagecopy($img, $copy, 4, 4, 0, 0, 12, 12);
		$copy = imagecreatefrompng('circle.png');
		imagecopy($img, $copy, 0, 0, 0, 0, 20, 20);

		// Output the generated image
		imagesavealpha($img, TRUE);
		imagepng($img);
		imagepng($img, $finalPath);
		fflush( $fd );
		fclose( $fd );
		//End output buffering
		//ob_end_flush();
		die();
	}
	elseif($largeMode)
	{
		$width = $height = 20;
		$img = initializeImage($width, $height);
		$copy = imagecreatefrompng($icons[0]['graphic']);
		imagecopy($img, $copy, 4, 4, 0, 0, 12, 12);
		// Output the generated image
		imagesavealpha($img, TRUE);
		imagepng($img);
		imagepng($img, $finalPath);
		fwrite( $fd, "largeMode\n" );
		fflush( $fd );
		fclose( $fd );
		//End output buffering
		//ob_end_flush();
		die();
	}

	// Precalculate our width and height
	$width = (12 * count($ids)) + (2 * (count($ids) - 1));
	$height = 12;
	$img = initializeImage($width, $height);

	$x = 0;
	foreach($icons as $icon)
	{
		// Copy in the graphic to the final image
		$copy = imagecreatefrompng($icon['graphic']);
		imagecopy($img, $copy, $x, 0, 0, 0, 12, 12);
		$x += 14;
	}//foreach

	imagesavealpha($img, TRUE);
	fwrite( $fd, "outputting image to $finalPath\n" );
	imagepng($img, $finalPath);
	fflush( $fd );
	fclose( $fd );
	//End output buffering
	//ob_end_flush();
	die(file_get_contents($finalPath));

	function initializeImage($width, $height)
	{
		// Create the final image
		$img = imagecreatetruecolor($width, $height);
		imagealphablending($img, FALSE);
		$blank = imagecolorallocatealpha($img, 255, 255, 255, 127);
		imagefilledrectangle($img, 0, 0, $width, $height, $blank);
		imagealphablending($img, TRUE);
		return $img;
	}

	//Our custom post processing function
	function ob_postprocess($buffer)
	{
		//$buffer = trim(preg_replace('/\s+/', ' ', $buffer));
	
		// check if the browser accepts gzip encoding. Most do, but just in case
		if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
		{
			$buffer = gzencode($buffer);
			header('Content-Encoding: gzip');
		}
	
		return $buffer;
	}
?>
