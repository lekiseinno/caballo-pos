
<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php include_once 'right.php'; ?>
<?php include_once 'body-start.php'; ?>
<?php //include_once 'process/item_checksum.php'; ?>

<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>




<style type="text/css">
	#noclick{
		position: fixed;
		display: block;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0,0,0,0.5);
		cursor: wait;
	}
	#text{
		position: absolute;
		top: 50%;
		left: 45%;
		font-size: 50px;
		color: white;
		transform: translate(-50%,-50%);
		-ms-transform: translate(-50%,-50%);
	}
</style>



<script type="text/javascript" src="resource/js/addtocart.js"></script>


<pre>

<?php
	//$dir		=	"http://10.10.2.31:8081/api/caballo/products/get_img_all";
	$contents	=	file_get_contents($dir);
	
	
	$json_img	=	json_decode($contents,true);

	foreach ($json_img as $key => $value) {
		#echo "key = ".$key."<br>";
		//echo "value = ".$value."<br>";

		foreach ($value as $key2 => $value2) {
			//echo "key2 = ".$key2."<br>";
			#echo "value2 = ".$value2."<br>";
		}

	}


	/*
	foreach($json_img as $folder => $path)
	{
		//echo $folder."<br>";
		//print_r($path);
		foreach($path as $nameimg)
		{
			//echo $folder."/".$nameimg;
			print_r($nameimg);
		}

		/*
		foreach($path as $img => $imgs)
		{
			echo $folder."/".$img;
		}
		*/
	//}
	
	//echo $line2[14];

	/*
	foreach($lines as $line) {
		if($line[1] == "l") { // matches the <li> tag and skips 'Parent Directory'
			$line = preg_replace('/<[^<]+?>/', '', $line); // removes tags, curtousy of http://stackoverflow.com/users/154877/marcel
			echo trim($line) . "\n";
		}
	}
	*/
?>
</pre>











<div id="panel-item-list">
	<div class="row" style="margin: 0;">
		<div class="col-3 padding-l-0 padding-r-0">

			






		</div>
	</div>
</div>
<!-- 
<div id="noclick"></div>
<div id="text">เลือกลูกค้าก่อน</div> -->








<?php include_once 'body-end.php'; ?>

<?php include_once 'footer.php'; ?>


