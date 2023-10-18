
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar-collapse">
					<span class="sr-only">Toogle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					
				</button>
				<!-- <span><img src="img/logo.jpg" width="50" height="50" class="img-circle"></span> -->
				<a class="navbar-header" href="index.php"><span><img src="img/logo.jpg" width="50" class="img-circle"></span></a>
				<a class="navbar-brand" href="index.php"><?=WEBSITE_NAME;?></a>
				
			</div>
			<div class="collapse navbar-collapse">
				
				<ul class="nav navbar-nav">
					<li><a href="list_users.php">Liste des utilisateurs</a></li>
					<?php if(is_logged_in()) :?>
					<li>
						<input type="search" class="form-control" id="searchbox" placeholder="Rechercher un utilisater">
						<div id="display-results">&nbsp;<i class="fa fa-spinner fa-spin" style="display: none;" id="spinner"></i>
							
						</div>
					</li>
					<?php endif?>
				</ul>
				

				<ul class="nav navbar-nav navbar-right">

					

					<?php if(is_logged_in()) :?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="<?=get_session('avatar')? get_avatar_url('avatar') : get_avatar_url(get_session('user_email'))?>" alt="<?=get_session('user_pseudo')?>" class="avatar-xs"><span class="caret"></span></a>

							<ul class="dropdown-menu" role="menu">
								<li class="<?=set_active('profile')?>">
								<a href="profile.php?id=<?=get_session('user_id')?>"><?=$menu['mon_profil'][$_SESSION['locale']] ?></a></li>
								<li class="<?=set_active('change_password')?>">
								<a href="change_password.php"><?=$menu['change_password'][$_SESSION['locale']] ?></a></li>
								<li class="<?=set_active('edit_user')?>">
								<a href="edit_user.php?id=<?=get_session('user_id')?>"><?=$menu['editer_profil'][$_SESSION['locale']] ?></a></li>
								<li class="<?=set_active('share_code')?>"><a href="share_code.php"><?=$menu['share_code'][$_SESSION['locale']] ?></a></li>
								<li class="divider"></li>
								<li><a href="logout.php"><?=$menu['deconnexion'][$_SESSION['locale']] ?></a></li>
								
							</ul>
						</li>
						<li class="<?= $notifications_count > 0 ? 'have_notifs' : '' ?>"> 
							<a href="notifications.php"><i class="fa fa-bell"></i> 
								<?= $notifications_count > 0 ? "($notifications_count)" : '(Aucune notification)'; ?> 
							</a> 
						</li>
					<?php else :?>
							<li class="<?=set_active('login')?>"><a href="login.php"><?=$menu['connexion'][$_SESSION['locale']] ?></a></li>
							<li class="<?=set_active('register')?>"><a href="register.php"><?=$menu['inscription'][$_SESSION['locale']] ?></a></li>
					<?php endif?>
					
					
				</ul>
				
			</div>
			<!--/ .nav-collapse -->
			
		</div>
		
	</div>