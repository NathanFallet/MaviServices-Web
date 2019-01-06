<div class="container">
	<div class="page-header">
		<h1>Boutique</h1>
	</div>
	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<?php displayCats(0, '', $bdd); ?>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="tab-content">
				<?php
				$add = ' in active';
				if(isset($_GET['id'])){
					$add = '';
				}
				?>
				<div id="home" class="tab-pane fade<?php echo $add; ?>">
					<p>Selectionnez une catégorie à gauche pour commencer.</p>
				</div>
				<?php displayItems($bdd, $url); ?>
			</div>
		</div>
	</div>
</div>
