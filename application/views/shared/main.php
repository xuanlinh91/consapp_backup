<?php $this->load->view("shared/header"); ?>
<div id="wrapper" class="main-wrapper">
    <div class="container">
        <div id="page-wrapper">
            <?php echo $content; ?>
        </div>
    </div>
</div>

<div id="footer">
	<ul>
		<li>
			<a style="margin-left: 15px;" href="http://www.haygroup.com/sg" title="haygroup" target="_blank">www.haygroup.com/sg</a>
		</li>
		<li>
			<span style="margin-left: 15px; color:#fff;">© <?php echo date('Y');?> Hay Group. All rights Reserved.</span>
		</li>
		<li>
			<span style="margin-left: 15px; color:#fff;">Version 1.0</span>
		</li>
	</ul>
	<div class="logo img-responsive">
		<img src="<?php echo base_url('img/logo.png'); ?>" class="img-responsive" alt="Consapp" />
	</div>
</div>
<?php $this->load->view("shared/footer"); ?>