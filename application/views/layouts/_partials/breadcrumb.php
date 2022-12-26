<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ol class="breadcrumb float-sm-right">
  <?php 
  foreach ($this->uri->segments as $segment):
		$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
		$is_active =  $url == $this->uri->uri_string;
	?>
  <li class="breadcrumb-item <?= $is_active ? 'active': '' ?>"><a href="#">
   <?php if($is_active): ?>
			<?php echo ucfirst($segment) ?>
		<?php else: ?>
			<a href="<?php echo base_url($url) ?>"><?php echo ucfirst($segment) ?></a>
		<?php endif; ?>
  </li>
  <?php endforeach; ?>
</ol>