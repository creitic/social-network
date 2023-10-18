<?php $title="Connexion"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
		<!-- <h1 class="text-center">Devenez dès à present membre: </h1>-->
		<h1 class="lead">Connexion: </h1>

		<?php 
		include('partials/_errors.php');

		 ?>



		<!-- <form method="post" class=" well col-md-6 col-md-offset-3">    -->
		<form data-parsley-validate method="post" class=" well col-md-6" autocomplete="off">

			<!-- Identifiant field -->
			<div class="form-group">
				<label class="control-label"  for="_identifiant" >Pseudo ou Adresse electronique :</label>
				<input type="text" class="form-control" id="_identifiant" name="identifiant" value="<?=get_input('identifiant')?>" required="required"/>
			</div>

			

			<!-- Password field -->
			<div class="form-group">
				<label class="control-label"  for="_password" >Mot de passe :</label>
				<input type="password" class="form-control" id="_password" name="password" required="required"/>
			</div>

			<!-- Remember me fieldremember_me-->
			<div class="form-group">
				<label class="control-label"  for="_remember_me" >
					<input type="checkbox" id="_remember_me" name="remember_me"/>
					Garder ma session active
				</label>
			</div>


			<input type="submit" class="btn btn-primary" value="Connexion" name="login"/>

		</form>
	</div>
</div>



<?php
include('partials/_footer.php');
?>
