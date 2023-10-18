

<?php if(relation_link_to_display($_GET['id'])==CANCEL_RELATION_LINK):?>
	<p>Demande d'amitié déjà envoyée.. </p>
	<a class="btn btn-primary pull-right" href="delete_friend.php?id=<?=$_GET['id']?>">Annuler la demande</a>

	<?php elseif(relation_link_to_display($_GET['id'])==ACCEPT_REJECT_RELATION_LINK):?>
		<a class="btn btn-primary pull-right" href="accept_friend_request.php?id=<?=$_GET['id']?>">Accepter</a>
		<a class="btn btn-danger pull-right" href="delete_friend.php?id=<?=$_GET['id']?>">Decliner</a>

		<?php elseif(relation_link_to_display($_GET['id'])==DELETE_RELATION_LINK):?>
			<p>Vous etes deja amis.. </p>
			<a class="btn btn-danger pull-right" href="delete_friend.php?id=<?=$_GET['id']?>">Retirer de ma liste d'amis</a>

			<?php elseif (relation_link_to_display($_GET['id'])==ADD_RELATION_LINK):?>
				<a href="add_friend.php?id=<?=$_GET['id']?>" class="btn btn-primary pull-right">
					<i class="fa fa-plus"></i> Ajouter comme ami</a>
<?php endif;?>