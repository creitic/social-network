<?php $title="Partage de codes sources"; 
include('partials/_header.php'); ?>

<div id="main-content">
	<div id="main-content-share-code">
		<form  autocomplete="off" method="post">
			<textarea name="code" id="_code" placeholder="Entrer votre code ici..." required="required"><?=e($code);?></textarea>
			<div class="btn-group nav-code">
			<input type="reset" class="btn  btn-danger" value="Tout effacer">
			<input type="submit" name="save" class="btn btn-success" value="Enrengistrer">	
			</div>
			
		</form>
	</div>
	
</div>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/tabby.min.js"></script>
<script>
	$("_code").tabby();
	$("_code").height($(window).height()-50);

</script>
</body>
</html>
