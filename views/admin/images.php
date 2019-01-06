<div class="container">
	<div class="page-header">
		<h1>Images</h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">

				<div id="images" class="tab-pane fade in active">
<?php
if(isset($message)){
	echo $message;
}
?>
					<table class="table">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php
listDir('images', '');
?>
						</tbody>
					</table>
					<a href="#add" data-toggle="pill" class="btn btn-primary">+ Ajouter une image</a>
				</div>
				<div id="add" class="tab-pane fade">
					<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="file">Fichier :</label>
							<input type="file" name="file" id="file">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="add" value="Ajouter">
						</div>
					</form>
				</div>
<?php
listDirDelete('images', '');
?>
			</div>
		</div>
	</div>
</div>