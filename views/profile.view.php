<?php $title="Page de profil"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<h3 class="panel-title">Profil de <?=e($user->name)?>
							
							(<?=friends_count($_GET['id']);?> ami<?=friends_count($_GET['id'])<=1?'':'s';?>)</h3>
							
					</div>
					<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<img src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email,100)?>" alt="image de profile de
							 <?=e($user->pseudo)?>" class="avatar-md">
						</div>
						<div class="col-md-7">
							<?php if(!empty($_GET['id'])&& $_GET['id']!==get_session('user_id')):?>
								<?php include('partials/_relation_links.php');?>				
							<?php endif;?>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-6">
							<strong><?=e($user->pseudo)?></strong></br>
							<a href="mailto:<?=e($user->email)?>"><?=e($user->email)?></a></br>
							<?=
							$user->city && $user->country 
							?'<i class="fa fa-location-arrow"></i>&nbsp;'.e($user->city).' - '.e($user->country).'</br>': '';
							?>
							<a href="https://www.google.com/maps?q=<?=e($user->city).' '.e($user->country)?>" target="_blank">Voir sur Google Maps</a>

						</div>
						<div class="col-sm-6">
							<?=
							$user->twitter?'<i class="fa fa-twitter"></i>&nbsp;<a href="//twitter.com/'.e($user->twitter).'">@'.e($user->twitter).'</a></br>': '';
							?>
							<?=
							$user->github?'<i class="fa fa-github"></i>&nbsp;<a href="//github.com/'.e($user->github).'">@'.e($user->github).'</a></br>': '';
							?>
							
							<?=
							$user->sex=='H'?'<i class="fa fa-male"></i>': '<i class="fa fa-female"></i>';
							?>

							<?=
							$user->available_for_hiring?'Disponible pour emploi': 'Non disponible pour emploi';
							?>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12 well">
							<h5>Petite bibliographie de <?=e($user->name)?></h5>
							<p>
								<?=
								$user->bio?nl2br(e($user->bio)):"Aucune biographie pour le moment...";
								?>
							</p>
							
						</div>
						
					</div>
					</div>
			
				</div>
			</div>

			<div class="col-md-6">
				<?php if(!empty($_GET['id'])&& $_GET['id']===get_session('user_id')): ?>
				<div class="status-post">
					<form action="microposts.php" method="post" data-parsley-validate>
						<div class="form-group">
							<label for="_content" class="sr-only">Statut :</label>
							<textarea name="content" id="_content" rows="3" class="form-control" placeholder="Alors quoi de neuf?" required="required" data-parsley-minlength="2" data-parsley-maxlength="200"></textarea>
						</div>
						<div class="form-group status-post-submit">
						<input type="submit" name="publish" value="Publier" class="btn btn-default btn-xs">
						</div>

					</form>
				</div>
				
			<?php endif;?>
				<?php if(current_user_is_friend_with($_GET['id'])):?>
					<?php if (count($microposts)!=0):?>
						<?php foreach ($microposts as $micropost):?>
							<?php include('partials/_micropost.php');?>
						<?php endforeach ?>
					<?php else:?>
					<p>Cet utilisateur n'a rien encore poste pour le moment..</p>
				<?php endif;?>
			<?php endif;?>

			</div>
			
		</div>
		
	</div>
</div>

						<!--SCRIPT-->

<script src="assets/js/jquery.min.js"></script>
<script src="libraries/sweetalert/sweetalert.min.js"></script> 
<script src="assets/js/main.js"></script>
<script src="assets/js/Bootstrap.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script src="libraries/parsley/parsley.min.js"></script>
<script src="libraries/parsley/i18n/fr.js"></script>
<!-- SCRIPTS -->


	<script type="text/javascript">
		window.ParsleyValidator.setLocale('fr');
		$(document).ready(function(){
			$(".timeago").timeago();

			$("a.like").on("click",function(e){
				///Autre methode
				/*// si href=unlike_micropost.php?id=1
				e.preventDefault();
				var href=$(this).attr("href");
				var parts =href.split("=");//--> parts={unlike_micropost.php?id,1}
				var id=parts[1];//-->id
				var action=parts[0].split('_')[0];//unlike_micropost-->unlike
				console.log(action)//affichage console*/
 
				e.preventDefault();
				var id=$(this).attr("id");
				var url='ajax/micropost_like.php';
				var action=$(this).attr("data-action");//or $(this).data("action");
				var micropost_id=id.split("like")[1];
				//var micropostId=$(this).data("micropost-id");
				//var data='micropost_id='+micropostId + '&action='+action;ou

				//permet d'effectuer requete ajax asynchrone
				$.ajax({
					type:'POST',
					url:url,
					data:{
						micropost_id:micropost_id,
						action:action
					},
					success:function(likers){
						$("#likers_"+micropost_id).html(likers);

						if (action=='like') {
							$("#" + id).html("Je n'aime plus").data('action','unlike');
						}else{
							$("#" + id).html("J'aime").data('action','unlike');
						}
					}

				});

				
			})

		});
		
	</script>

</body>
</html>
