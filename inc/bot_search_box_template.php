<?php
if ( ! defined( 'ABSPATH' ) ) exit;

wp_enqueue_script('custom-search-box');
wp_enqueue_script('custom-from-to');
wp_enqueue_script('all-route');
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">			
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/smoothness/jquery-ui-1.10.4.custom.css'); ?>">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>">			
		<?php include_once(plugin_dir_path(__FILE__) . 'combine.php'); ?>

		<script type="text/javascript">
			var BOTSize_Filter = <?php echo wp_json_encode($sizeValue); ?>;
			var BOTDefault_Type = <?php echo wp_json_encode($typeValue); ?>;
			var BOTDefault_From = <?php echo wp_json_encode($fromValue); ?>;
			var BOTDefault_To = <?php echo wp_json_encode($toValue); ?>;
			var BOTReferer_Id = <?php echo wp_json_encode($partnerId); ?>;
		</script>
	</head>
	<body>
		<div id="divSearch_Box">
			<script type="text/javascript">
				botsearch_box();
			</script>
		</div>
	</body>
</html>
