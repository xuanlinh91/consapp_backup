<h3 class="custom-page-header">Manage Survey</h3>
<p class="custom-page-description">&nbsp;</p>

<div class="row-fluid">
	<!-- Information Boxes: Create Company Profile -->
	<a href="<?php echo site_url('survey/take_search'); ?>" title="Take Survey">
		<div class="span3 well infobox">
			<div class="pull-right text-right">
				<p>Take Survey</p>
			</div>
		</div>
	</a>
	<!-- / Information Boxes: Create Company Profile -->

	<?php 
	if(isset($userdata)) {

		if (is_admin_hp($userdata)) {
		?>

			<!-- Information Boxes: Create Company Profile -->

			<a href="<?php echo site_url('survey/update_search'); ?>" title="Update Survey Responses">

				<div class="span3 well infobox">

					<div class="pull-right text-right">

						<p>Update Survey Responses</p>

					</div>

				</div>

			</a>

			<!-- / Information Boxes: Create Company Profile -->

		<?php
		}
	}
	?>	

	
</div>