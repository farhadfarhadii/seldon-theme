<?php 
$intro = get_field('intro_block');
$title = $intro['title'];
$text = $intro['text'];

if ($title || $text) :
?>
	<div class="row">
		<div id="PageIntro" class="col-xs-12 maxout z-2">
			<div class="row">
				<?php if ($title) : ?>
					<div class="col-sm-5 col-md-4 col-sm-offset-1">
					 	<h2 class="mt-0 pr-30"><?php echo $title; ?></h2>
					</div>
				<?php endif; ?>					

				<?php if ($text): ?>
					<div class="text <?php echo $title ? "col-sm-5" : "col-sm-11" ?>">
						<?php echo $text; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
