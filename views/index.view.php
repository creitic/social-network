<?php $title="Accueill"; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
	<div class="container">
	<div class="jumbotron">
		<h1><?= WEBSITE_NAME;?></h1>
		<p class="lead"> <?=WEBSITE_NAME;?>
		<?=$long_text['accueil_intro'][$_SESSION['locale']]?>
		</p>
		<a href="register.php" class="btn btn-primary btn-lg"><?=$menu['creat_compt'][$_SESSION['locale']] ?></a>

	</div>
</div>
</div>



<?php
include('partials/_footer.php');
?>
