<?php 

if (isset($errors)&&count($errors)!=0) {
				# code...echo '<div class="bg-danger">';
				echo '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				';
					foreach ($errors as $error) {
						# code...
						echo $error.'<br/>';
					}
				echo '</div>';
			}