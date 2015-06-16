<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Generating Report graphic</title>
	<script src="<?php echo base_url('assets/chart/js/jquery-1.8.2.min.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/highcharts.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/highcharts-more.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/modules/exporting.js')?>"></script>
<style type="text/css">
	.accordion h3 + div {
		height: 0;
		overflow: hidden;
		-webkit-transition: height 0.3s ease-in;
		-moz-transition: height 0.3s ease-in;
		-o-transition: height 0.3s ease-in;
		-ms-transition: height 0.3s ease-in;
		transition: height 0.3s ease-in;
	}

	.accordion :target h3 + div {
		height: 100px;
	}

	.accordion .section.large:target h3 + div {
		overflow: auto;
	}

	body{
		font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
	}
	p, h1, form, button{border:0; margin:0; padding:0;}
	.spacer{clear:both; height:1px;}
	/* ----------- My Form ----------- */
	.myform{
		margin:0 auto;
		width:400px;
		padding:14px;
	}

	/* ----------- stylized ----------- */
	#stylized{
		border:solid 2px #b7ddf2;
		background:#ebf4fb;
	}
	#stylized h1 {
		font-size:14px;
		font-weight:bold;
		margin-bottom:8px;
	}
	#stylized p{
		font-size:11px;
		color:#666666;
		margin-bottom:20px;
		border-bottom:solid 1px #b7ddf2;
		padding-bottom:10px;
	}
	#stylized label{
		display:block;
		font-weight:bold;
		text-align:right;
		width:140px;
		float:left;
	}
	#stylized .small{
		color:#666666;
		display:block;
		font-size:11px;
		font-weight:normal;
		text-align:right;
		width:140px;
	}
	#stylized input{
		float:left;
		font-size:12px;
		padding:4px 2px;
		border:solid 1px #aacfe4;
		width:200px;
		margin:2px 0 20px 10px;
	}
	#stylized button{
		clear:both;
		margin-left:150px;
		width:125px;
		height:31px;
		background:#666666 url(img/button.png) no-repeat;
		text-align:center;
		line-height:31px;
		color:#FFFFFF;
		font-size:11px;
		font-weight:bold;
	}
</style>
<script type="text/javascript">
	$(function () {

		$('#container').highcharts({

			chart: {
				polar: true,
				type: 'line',
			},

			title: {
				text: 'Overall HR Maturity',
				x: 0
			},

			pane: {
				size: '80%'
			},

			plotOptions: {
				series: {
					marker: {
						enabled: false
					}
				}
			},

			xAxis: {
				
				categories: ["<?php echo($LIST[0]['NM_CATEGORY']);?>","<?php echo($LIST[1]['NM_CATEGORY']);?>","<?php echo($LIST[2]['NM_CATEGORY']);?>","<?php echo($LIST[3]['NM_CATEGORY']);?>", "<?php echo($LIST[4]['NM_CATEGORY']);?>","<?php echo($LIST[5]['NM_CATEGORY']);?>", "<?php echo($LIST[6]['NM_CATEGORY']);?>","<?php echo($LIST[7]['NM_CATEGORY']);?>", "<?php echo($LIST[8]['NM_CATEGORY']);?>", "<?php echo($LIST[9]['NM_CATEGORY']);?>", "<?php echo($LIST[10]['NM_CATEGORY']);?>"],
				
				labels: {
					style: {
						fontSize: '12px',
						fontFamily: 'Verdana, sans-serif',
						width: '170px',
					},
					formatter: function ()
					{
						if ('<?php echo($LIST[5]["NM_CATEGORY"]);?>' === this.value)
						{
							return 'C & B';
						}
						else if('<?php echo($LIST[6]["NM_CATEGORY"]);?>' === this.value)
						{
							return '<br />TALENT <br /> MANAGEMENT';
						}
						else
						{
							return this.value;
						}
					}
				},
				tickmarkPlacement: 'on',
				lineWidth: 0
			},

			yAxis: {
				gridLineInterpolation: 'polygon',
				min: 0,
				tickPositions: [0, 1, 2, 3, 4]
			},

			tooltip: {
				shared: true,
				pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
			},

			legend: {
				align: 'center',
				verticalAlign: 'bottom',
	        // y: 70,
	        layout: 'horizontal'
	    },
	    
	    series: [{
	    	name: '<?php if(isset($NAME)){ echo($NAME); } ?>',
	    	data: [<?php echo($BLUE['INT_CAT1']); ?>, <?php echo($BLUE['INT_CAT2']); ?>, <?php echo($BLUE['INT_CAT3']); ?>, <?php echo($BLUE['INT_CAT4']); ?>, <?php echo($BLUE['INT_CAT5']); ?>, <?php echo($BLUE['INT_CAT6']); ?>, <?php echo($BLUE['INT_CAT7']); ?>, <?php echo($BLUE['INT_CAT8']); ?>, <?php echo($BLUE['INT_CAT9']); ?>, <?php echo($BLUE['INT_CAT10']); ?>,<?php if (!$is_overseas) : ?><?php echo($BLUE['INT_CAT11']); ?> <?php else : ?><?php echo 0; ?><?php endif; ?>],
	    	pointPlacement: 'on'
	    }, {
	    	name: 'Ideal',
	    	color: '#C60B2E',
	    	data: [<?php echo($RED['INT_CAT1']); ?>, <?php echo($RED['INT_CAT2']); ?>, <?php echo($RED['INT_CAT3']); ?>, <?php echo($RED['INT_CAT4']); ?>, <?php echo($RED['INT_CAT5']); ?>, <?php echo($RED['INT_CAT6']); ?>, <?php echo($RED['INT_CAT7']); ?>, <?php echo($RED['INT_CAT8']); ?>, <?php echo($RED['INT_CAT9']); ?>, <?php echo($RED['INT_CAT10']); ?>, <?php if (!$is_overseas) : ?> <?php echo($RED['INT_CAT11']); ?> <?php else : ?><?php echo 0; ?><?php endif; ?>],
	    	pointPlacement: 'on'
	    }]

	});
});
</script>
<style type="text/css">
	#text_report
	{
		font-size:  3em;
		text-align: center;
		padding : 10%;
		color:#ffffff;
	}

	#text_report_des
	{
		font-size:  1.5em;
		text-align: center;
		padding : 5%;
		color:#ffffff;
	}

	#progressbar {
		background-color: black;
		border-radius: 13px; /* (height of inner div) / 2 + padding */
		padding: 3px;
	}

	#progressbar > div {
		background-color: orange;
		width: 100%; /* Adjust with JavaScript */
		height: 20px;
		border-radius: 10px;
	}
</style>
</head>
<body>
	<div id="float_view" style="width: 80%; margin: 0 auto; height: auto; display: block; color: #fff;">
		<p id="text_report">Generate report step 1</p>
		<div style="margin: 0 auto; width: 128px;">
			<img src="<?php echo base_url('/img/processing.gif'); ?>" alt="Loading" width="128" height="128">
		</div>
		<p id="text_report_des">Please waiting a few minute<br>The window will automatically close when the process of generating report has finishing</p>
	</div>	
	<div id="container" style="width: 100%; height:100%; display: none; "></div>
</body>
</html>