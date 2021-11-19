<div class="sidebar">
<?php
	if (is_woocommerce()) 
	{
		dynamic_sidebar('sidebar');
	}
	else
	{
		dynamic_sidebar('default-sidebar');
	}
?>
</div>