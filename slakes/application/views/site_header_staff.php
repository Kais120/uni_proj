<?php echo doctype("html5"); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<link href="<?php echo base_url(); ?>/css/bootstrap.css" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url(); ?>/css/navbar.css" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url(); ?>/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var js_site_url = function( urlText ){
			var urlTmp = "<?php echo site_url('/site_staff/" + urlText + "'); ?>";
			return urlTmp;
		}
		var js_base_url = function( urlText ){
			var urlTmp = "<?php echo base_url('/site_staff/" + urlText  + "'); ?>";
			return urlTmp;
		}
	</script>
</head>