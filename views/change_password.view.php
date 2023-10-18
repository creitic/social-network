<?php $title="Changement de mot de pass"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<h3 class="panel-title">Changer de mot de pass</h3>
				
					</div>
					<div class="panel-body">
						<?php include('partials/_errors.php'); ?>
						<form data-parsley-validate method="post" autocomplete="off">
							<div class="form-group">
								<label for="_password">Mot de passe actuel <span class="text-danger">*</span></label>
								<input type="password" id="_current_password" name="current_password" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label for="_new_password">Nouveau mot de passe<span class="text-danger">*</span></label>
								<input type="password" id="_new_password" name="new_password" class="form-control" required="required" data-parsley-minlength="6"/>
							</div>
							<div class="form-group">
								<label for="_new_password_confirmation">Confirmer votre mot de passe<span class="text-danger">*</span></label>
								<input type="password" id="_new_password_confirmation" name="new_password_confirmation" class="form-control" required="required" data-parsley-equalto="#_new_password" data-parsley-minlength="6"/>
							</div>
														
							<input type="submit" class="btn btn-primary" value="Valider" name="change_password"/>
						</form>
					</div>
			
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('partials/_footer.php');?>