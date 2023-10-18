<?php $title="Edition de profil"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
		<div class="row">

<?php if(!empty($_GET['id'])&& $_GET['id']===get_session('user_id')): ?>
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<h3 class="panel-title">Completer mon profil</h3>
				
					</div>
					<div class="panel-body">
						<?php include('partials/_errors.php'); ?>
						<form data-parsley-validate method="post" autocomplete="off">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="_nom">Nom <span class="text-danger">*</span></label>
										<input type="text" id="_nom" name="nom" class="form-control"
								 		placeholder="john" value="<?=get_input('nom')?:e($user->name)?>" required="required"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="_city" >Ville <span class="text-danger">*</span></label>
										<input type="text" value="<?=get_input('city')?:e($user->city)?>"id="_city" name="city" 
										class="form-control" required="required"/>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="_avatar">Changer mon avatar <span class="text-danger">*</span></label>
										<input type="file" id="_avatar" name="avatar" class="form-control" required="required"/>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="_country" >Pays <span class="text-danger">*</span></label>
										<input type="text" value="<?=get_input('country')?:e($user->country)?>" id="_country" name="country" 
										class="form-control" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="_sex" >Sexe <span class="text-danger">*</span></label>
										<select id="_sex" required="required" name="sex" class="form-control">
											<option value="H" <?=$user->sex=="H"?"selected":""?>>
												Homme
											</option>
											<option value="F" <?=$user->sex=="F"?"selected":""?>>
												Femme
											</option>
										</select>
										
									</div>
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="_twitter" >Twitter </label>
										<input type="text" value="<?=get_input('twitter')?:e($user->twitter)?>" id="_twitter" name="twitter" class="form-control" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="_github" >Github </label>
										<input type="text" value="<?=get_input('github')?:e($user->github)?>" id="_github" name="github" 
										class="form-control"/>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="_available_for_hiring" >
											<input type="checkbox" id="_available_for_hiring"
										 	<?=$user->available_for_hiring?"checked":""?> name="available_for_hiring" />
											Disponible pour emploi?
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="_bio">Biographie </label>
										<textarea type="text" id="_bio" name="bio" cols="30" rows="10" class="form-control" placeholder="Je suis un amoureux de programmation.."><?=get_input('bio')?:e($user->bio)?></textarea>

									</div>
								</div>
							</div>
														
							<input type="submit" class="btn btn-primary" value="Valider" name="update"/>
						</form>
					</div>
			
				</div>
			</div>
		<?php endif;?>
		</div>
	</div>
</div>


						<!--SCRIPT-->
						

<!--<script src="//maxcdn.bootstrapcdn..com/bootsrap/3.2.0/js/Bootstrap.min.js"></script>-->
<script src="assets/js/jquery.min.js"></script>
<script src="libraries/uploadify/jquery.uploadify.min.js"></script>
<script src="libraries/alertifyjs/alertify.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="libraries/parsley/parsley.min.js"></script>
<script src="libraries/parsley/i18n/fr.js"></script>

<!-- SCRIPTS -->


	<script type="text/javascript">
		window.ParsleyValidator.setLocale('fr');
		<?php $timestamp =time();?>
		$(function(){
			$('#_avatar').uploadify({
				'fileObjName' : 'avatar' ,
				'fileTypeDesc' : 'Images Files',
				'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
				'buttonText' : 'Parcourir',
				'formData' : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'	: '<?php echo md5('unique_salt' . $timestamp);?>',
					'user_id' : "<?=e(get_session('user_id'))?>",
					'<?php echo session_name();?>' : '<?php echo session_id();?>'
				},
				'swf' : 'libraries/uploadify/uploadify.swf',
				'uploader' : 'libraries/uploadify/uploadify.php',
				'onUploadError' : function(file, errorCode, errorMsg, errorString){
					alertify.error("Erreur lors de l'upload du fichier. Veuillez Reessayer SVP");
				},
				'onUploadSuccess' : function(file, data, response){
					alertify.success('Votre avatar a été uploadé avec succés!');
					window.location='/profile.php';
				},
			});
		});
	</script>

</body>
</html>