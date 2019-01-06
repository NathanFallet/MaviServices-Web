<div class="container">
	<div class="page-header">
		<h1><?php echo $page_data['name']; ?></h1>
	</div>
	<?php echo str_replace("\\\"", "\"", str_replace("\\'", "'", $page_data['content'])); ?>
</div>