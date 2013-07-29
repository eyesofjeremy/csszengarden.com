<?php

	// shorthand alias for `htmlspecialchars` with the needed settings
	function hsc($string) {
		// avoid using `ENT_HTML5` for PHP 5.3 support
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}

	// generate the list of designs in the site navigation
	function getDesignList($start, $count, $list, $i18nBy) {

		global $legacyMode;

		// flush return value
		$return = "";

		// begin at the already-established start of the list and loop down
		for ($i = $start - 1; $i >= ($start - $count); $i--) {

			$id = $list[$i][0];
			$designURL = "/$id/";
			$designName = hsc($list[$i][1]);
			$designerName = hsc($list[$i][2]);
			$designerURL = hsc($list[$i][3]);

			// kick in output buffering
			ob_start();

			// pull in the correct partial template for design listings
			if (isset($legacyMode)) {
				include($SERVER_ROOT . "tmpl-design-link-legacy.php");
			} else {
				include($SERVER_ROOT . "tmpl-design-link.php");
			}

			// dump and close buffering
			$buffer = ob_get_contents();
			ob_end_clean();

			// add the buffer to return string if we're still within range
			if ($i >= 0) {
				$return .= $buffer;
			}

		}

		// send back the generated design list
		return($return);
	}






	// set defaults
	$numDesigns = 8; // number of designs to show in the nav


	// check the query string to see if:
	//	 - a specific design has been requested with cssfile
	//	 - a specific page value been assigned for the navigation
	if (!$loadCSS) {
		$loadCSS = $_GET["css"];
	}
	$thisPage = intval($_GET["pg"]);


<<<<<<< HEAD
	// if $_GET['css'] is not empty, assign it as the design to load
	// if it is, assign 001
=======
	// if cssfile is not empty, assign it as the design to load
>>>>>>> 9eb2fea995c86e43f23c70118c3e18b35959c818
	if ($loadCSS) {

		// allowing a no-CSS view of the site
		if ($loadCSS == "none") {
			$currentDesign = null;
		} else {
			$currentDesign = $loadCSS;
		}

	// if it is empty, assign 214
	} else {
		$currentDesign = "001";
		$currentDesign = "/214/214.css";
	}

    // Prep Stylesheet URL
    $currentStyleSheet = "/$currentDesign/$currentDesign.css";



	// determine where in the paging we should be
	if ($thisPage) {

		// if an explicit page is set, offset the design list starting point accordingly
		$listStart = (count($designList) - ($thisPage * $numDesigns));

		// set our lower bounds
		if ($listStart < 0) $listStart = 0;

	} else {

		// if no page is specified, set a default start point for the design list
		$listStart = count($designList);

	}



	// set default language to English if not otherwise specified
	if (!isset($lang)) {
		$lang = "en";
	}


?>