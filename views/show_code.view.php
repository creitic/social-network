<?php $title="Affichage de codes sources"; 
include('partials/_header.php'); ?>

<div id="main-content">
	<div id="main-content-share-code">
		<pre class="prettyprint linenums"><?= e($data->code);?></pre>

		<div class="btn-group nav-code">
			<a href="share_code.php?id=<?=$_GET['id']?>" class="btn btn-warning">Cloner</a>
			<a href="share_code.php" class="btn btn-primary">Nouveau </a>
		</div>

	</div>
	
</div>

<script src="assets/js/Bootstrap.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tabby.min.js"></script>
<script src="assets/js/google-code-pretiffy/prettify.js"></script>
<script>
	prettyprint();
</script>

</body>
</html>
