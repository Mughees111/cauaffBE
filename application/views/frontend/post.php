<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Hello, world!</title>

	<?php

		
		$post = $this->db->where("id",$id)->get("posts")->result_object()[0];
		$owner = $this->db->where("id",$post->user_id)->get("users")->result_object()[0];

		
	?>
	
</head>
<body>
<div style="display: flex;width: 100%; justify-content: center;">
	<div style="max-width: 500px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div style="margin-top: 20px; display: flex; flex-direction: row; align-items: center;">
						<img style="width: 50px; height: 50px; border-radius: 100%;" src="<?php echo withUrl($owner->profile_pic); ?>">
						<span style="font-weight: bold; font-size: 12px; margin-left: 10px;"><?php echo $owner->name!=""?$owner->name:$owner->username; ?></span>
					</div>
				</div>
				<div class="col-md-12" style="margin-top: 15px;">
					<?php

					
						?>

						<img src="<?php echo withUrl($post->image); ?>" style="width: 100%; height: 300px; margin-bottom: 10px;">

						<p style="padding:10px;">
							<?php echo $post->title; ?>
						</p>
						<a href="<?php echo $_GET["url"]; ?>" class="btn btn-primary">
							Open in Cream App
						</a>
					<?php
					?>

					
					<p style="margin-top: 20px;"><?php echo $post->text; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
