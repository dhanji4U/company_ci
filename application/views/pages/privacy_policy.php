<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?php echo base_url().LOGO_NAME; ?>" type="image/x-icon">
	
	<title><?php echo PROJECT_NAME; ?> - Privacy Policy</title>
	<meta name="generator" content="LibreOffice 4.2.7.2 (Linux)">
	<meta name="created" content="20151002;175753429182121">
	<meta name="changed" content="20151002;175818374856723">
	<style type="text/css">
		@page {
			margin: 2cm
		}

		p {
			margin-bottom: 0.25cm;
			line-height: 200%
		}
	</style>
</head>

<body lang="en-IN" dir="ltr">
	<?php

	if ($language == 'en') {
		if (isset($result['content_en']) && !empty($result['content_en'])) {
			echo $result['content_en'];
		}
	}

	if ($language == 'fr') {
		if (isset($result['content_fr']) && !empty($result['content_fr'])) {
			echo $result['content_fr'];
		}
	}
	?>
</body>

</html>