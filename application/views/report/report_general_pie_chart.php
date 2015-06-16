<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<script src="<?php echo base_url('assets/chart/js/jquery-1.8.2.min.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/highcharts_new.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/highcharts-more.js')?>"></script>
	<script src="<?php echo base_url('assets/chart/js/hightcharts-3d.js')?>"></script>

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
background:#666666 url('img/button.png') no-repeat;
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
            type: 'pie',
            options3d: {
				enabled: true,
                alpha: 60,
                beta: 0
            }
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '',
            data:   [
                        <?php
                            // PIE 1
                            if(isset($ALL))
                            {
                        ?>

                                {
                                    name: '',
                                    y: <?php if(isset($DATA_1) ){ echo $DATA_1; } ?>,
                                    sliced: true,
                                    selected: true,
                                    color:  '<?php if(isset($COLOR_1)){ echo $COLOR_1;} ?>'
                                }

                        <?php
                            }
                        ?>

                        <?php
                            // PIE 2
                            if(isset($ALL))
                            {
                                echo ',';

                        ?>

                                {
                                    name: '',
                                    y: <?php if(isset($DATA_2) ){ echo $DATA_2; } ?>,
                                    sliced: true,
                                    selected: true,
                                    color:  '<?php if(isset($COLOR_2)){ echo $COLOR_2;} ?>'
                                }

                        <?php
                            }
                        ?>


                        <?php
                            // PIE 3
                            if(isset($ALL))
                            {
                                echo ',';
                        ?>

                                {
                                    name: '',
                                    y: <?php if(isset($DATA_3) ){ echo $DATA_3; } ?>,
                                    sliced: true,
                                    selected: true,
                                    color:  '<?php if(isset($COLOR_3)){ echo $COLOR_3;} ?>'
                                }

                        <?php
                            }
                        ?>


                        <?php
                            // PIE 4
                            if(isset($ALL))
                            {
                                echo ',';
                        ?>

                                {
                                    name: '',
                                    y: <?php if(isset($DATA_4) ){ echo $DATA_4; } ?>,
                                    sliced: true,
                                    selected: true,
                                    color:  '<?php if(isset($COLOR_4)){ echo $COLOR_4;} ?>'
                                }

                        <?php
                            }
                        ?>


                    ]
        }]
    });
});
</script>
<style type="text/css">
body {
    overflow:hidden;
}
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

body{
    background: url("<?php echo base_url('/themes/default/images/bg_bg.jpg'); ?>") no-repeat fixed center top / cover #000000;
}

</style>
</head>
<body>

    
<div id="float_view" style="width: 80%; margin: 0 auto; height: auto; display: block; color: #fff;">
    <p id="text_report">Generate report step 2</p>
    <div style="margin: 0 auto;width:128px;">
        <img src="<?php echo base_url('/img/processing.gif'); ?>" alt="Loading" width="128" height="128">
    </div>
<p id="text_report_des">Please waiting a few minute<br />The window will automatically close when the process of generating report has finishing</p>

</div>  
<div id="container" style="width: 100%; height:100%; display: none; "></div>
</body>
</html>