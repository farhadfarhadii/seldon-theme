<?php $re = '/.+HTTP\srequest\sfailed!\sHTTP\/\d(.\d)* \d+\s/';?>

<div class="alert alert-danger" role="alert">
  <span aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <?php echo preg_replace($re, '', $_SESSION['Error']); ?>
</div>