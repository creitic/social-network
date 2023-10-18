 <?php $title="Inscription"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
		<!-- <h1 class="text-center">Devenez dès à present membre: </h1>-->
		<h1 class="lead">Devenez dès à present membre: </h1>

		<?php 
		include('partials/_errors.php');

		 ?>

		<!-- <form method="post" class=" well col-md-6 col-md-offset-3">    -->
		<form data-parsley-validate method="post" class=" well col-md-6" autocomplete="off">

			<!-- Name field -->
			<div class="form-group">
				<label class="control-label"  for="name" >Nom :</label>
				<input type="text" class="form-control" id="name" name="nom" value="<?=get_input('nom')?>" required="required"/>
			</div>

			<!-- Pseudo field -->
			<div class="form-group">
				<label class="control-label"  for="_pseudo" >Pseudo :</label>
				<input type="text" class="form-control" id="_pseudo" name="pseudo"
				data-parsley-minlength="3" value="<?=get_input('pseudo')?>" required="required"/>
			</div>

			<!-- Email field -->
			<div class="form-group">
				<label class="control-label"  for="_email" >Adresse email :</label>
				<input type="text" class="form-control" id="_email" name="email" 
				data-parsley-trigger="change" value="<?=get_input('email')?>" required="required"/>
			</div>

			<!-- Password field -->
			<div class="form-group">
				<label class="control-label"  for="_password" >Mot de passe :</label>
				<input type="password" class="form-control" id="_password" name="password" required="required"/>
			</div>


			<!-- Password confirmation field -->
			<div class="form-group">
				<label class="control-label"  for="_password_confirm" >Confirmer votre mot de passe :</label>
				<input type="password" class="form-control" id="_password_confirm" name="password_confirm" required="required" data-parsley-equalto="#_password"/>
			</div>
			<input type="submit" class="btn btn-primary" value="Inscription" name="register"/>

		</form>
	</div>
</div>



<?php
include('partials/_footer.php');
?>
