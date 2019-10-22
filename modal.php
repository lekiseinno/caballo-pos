


	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header modal-header-info">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="myModalLabel">Information</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6" style="padding-left: 15px; padding-right: 15px;">
							<div class="panel panel-default">
								<div class="panel-heading">Client</div>
								<div class="panel-body">
									<?
									if(!empty($_SERVER['HTTP_CLIENT_IP']))
									{
										$ips	=	$_SERVER['HTTP_CLIENT_IP'];
									}
									else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
									{
										$ips	=	$_SERVER['HTTP_X_FORWARDED_FOR'];
									}
									else
									{
										$ips	=	$_SERVER['REMOTE_ADDR'];
									}
									?>
									
									<?
									function getBrowser(){ 
										$u_agent=$_SERVER['HTTP_USER_AGENT'];$bname='Unknown';$platform='Unknown';$version="";
										if(preg_match('/linux/i',$u_agent)){$platform='Linux';}else if(preg_match('/macintosh|mac os x/i', $u_agent)){$platform = 'Mac';}else if(preg_match('/windows|win32/i', $u_agent)){$platform = 'Windows';}if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {$bname='Internet Explorer'; $ub="MSIE"; }elseif(preg_match('/Firefox/i',$u_agent)) { $bname='Mozilla Firefox'; $ub="Firefox"; } else if(preg_match('/Chrome/i',$u_agent)){$bname='Google Chrome'; $ub="Chrome";} else if(preg_match('/Safari/i',$u_agent)){$bname='Apple Safari'; $ub="Safari";} else if(preg_match('/Opera/i',$u_agent)){$bname='Opera'; $ub="Opera";} else if(preg_match('/Netscape/i',$u_agent)){$bname='Netscape'; $ub="Netscape";}$known=array('Version',$ub,'other');$pattern='#(?<browser>'.join('|',$known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';if(!preg_match_all($pattern, $u_agent, $matches)){}$i=count($matches['browser']);if ($i != 1) {if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){$version= $matches['version'][0];}else{$version= $matches['version'][1];}}else{$version= $matches['version'][0];}if ($version==null || $version=="") {$version="?";}return array('userAgent'=>$u_agent,'name'=>$bname,'version'=>$version,'platform'=>$platform,'pattern'=>$pattern);
									}
									$ua=getBrowser();
									$iPod=stripos($_SERVER['HTTP_USER_AGENT'],"iPod");$iPhone=stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");$iPad=stripos($_SERVER['HTTP_USER_AGENT'],"iPad");$Android=stripos($_SERVER['HTTP_USER_AGENT'],"Android");$win10=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 10");$win81=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.3");$win8=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.2");$win7=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.1");$winvista=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 6.0");$winserv2003x64=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.2");$winxpnt=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.1");$winxp=stripos($_SERVER['HTTP_USER_AGENT'],"windows xp");$win2000=stripos($_SERVER['HTTP_USER_AGENT'],"windows nt 5.0");$winme=stripos($_SERVER['HTTP_USER_AGENT'],"windows me");$win98=stripos($_SERVER['HTTP_USER_AGENT'],"win98");$win95=stripos($_SERVER['HTTP_USER_AGENT'],"win95");$win16=stripos($_SERVER['HTTP_USER_AGENT'],"win16");$macosx=stripos($_SERVER['HTTP_USER_AGENT'],"macintosh|mac os x");$macos9=stripos($_SERVER['HTTP_USER_AGENT'],"mac_powerpc");$linux=stripos($_SERVER['HTTP_USER_AGENT'],"linux");$ubuntu=stripos($_SERVER['HTTP_USER_AGENT'],"ubuntu");$blackberry =stripos($_SERVER['HTTP_USER_AGENT'],"blackberry");$webos=stripos($_SERVER['HTTP_USER_AGENT'],"webos");
									if($iPod){$devices='iPod';}elseif($iPhone){$devices='iPhone';}elseif($iPad){$devices='iPad';}elseif($Android){$devices='Android';}elseif($win10){$devices='Windows 10';}elseif($win81){$devices='Windows 8.1';}elseif($win8){$devices='Windows 8';}elseif($win7){$devices='Windows 7';}elseif($winvista){$devices='Windows Vista';}elseif($winserv2003x64){$devices='Windows Server2003 or Windows XP x64';}elseif($winxpnt){$devices='Windows (NT) XP';}elseif($winxp){$devices='Windows XP';}elseif($win2000){$devices='Windows 2000';}elseif($winme){$devices='Windows ME';}elseif($win98){$devices='Windows 98';}elseif($win95){$devices='Windows 95';}elseif($win16){$devices='Windows 3.11';}elseif($macosx){$devices='Mac OS X';}elseif($macos9){$devices='Mac OS 9';}elseif($linux){$devices='Linux';}elseif($ubuntu){$devices='Ubuntu';}elseif($blackberry){$devices='Blackberry';}elseif($webos){$devices='Webos';}else{$devices='Other';}


									?>
									<div class="row">
										<div class="col-md-4 text-right">
											<label>IP : </label>
										</div>
										<div class="col-md-8">
											<span style="padding-left: 2%;">
												<?=$ips;?>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 text-right">
											<label>platform : </label>
										</div>
										<div class="col-md-8">
											<span style="padding-left: 2%;">
												<?=$ua['platform'];?>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 text-right">
											<label>Devices : </label>
										</div>
										<div class="col-md-8">
											<span style="padding-left: 2%;">
												<?=$devices;?>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 text-right">
											<label>Name : </label>
										</div>
										<div class="col-md-8">
											<span style="padding-left: 2%;">
												<?=$ua['name'];?>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 text-right">
											<label>Version : </label>
										</div>
										<div class="col-md-8">
											<span style="padding-left: 2%;">
												<?=$ua['version'];?>
											</span>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											batchnow = <?=$_COOKIE['batchnow']?>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 col-xs-12 col-sm-12">
									<div id="content-wrapper">
										<ol class="breadcrumb">
											<li><a href="#">Home</a></li>
											<li><a href="#">Library</a></li>
											<li class="active">Data</li>
										</ol>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-3 col-md-offset-2">
									<a class="btn btn-default btn-lg" style="width: 100%;" href="index.php"> <i class="fa fa-undo"></i> กลับ  </a>
								</div>
								<div class="col-md-3 col-md-offset-1">
									<a class="btn btn-default btn-lg" style="width: 100%;" href="index.php?r=signout"> ออกจากระบบ <i class="fa fa-sign-out"></i> </a>
								</div>
							</div>
						</div>
						<div class="col-md-6" style="padding-left: 15px; padding-right: 15px;">
							<div class="panel panel-default">
								<div class="panel-heading">Server</div>
								<div class="panel-body panel-body-info-detail">
									<div class="info-detail-server" id="info-detail-server">
										<label>Team vivewer</label>
										<div>
											<?php //echo hexdec(substr(substr(shell_exec('reg query HKLM\Software\WOW6432Node\Teamviewer /v ClientID'),-9),0,7));?>
											<?php echo hexdec(substr(shell_exec('reg query HKLM\Software\WOW6432Node\Teamviewer /v ClientID'),-12)); ?>
										</div>
										<hr>
										<label>$_SESSION</label>
										<pre><?print_r($_SESSION);?></pre>
										<hr>
										<label>$_COOKIE</label>
										<pre><?print_r($_COOKIE);?></pre>
										<hr>
										<label>$_GET</label>
										<pre><?print_r($_GET);?></pre>
										<hr>
										<label>$_POST</label>
										<pre><?print_r($_POST);?></pre>
										<hr>
										<label>$_SERVER</label>
										<pre><?print_r($_SERVER);?></pre>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-10">
							<span class="versions">version : 0.1 [ Demo ]</span>
						</div>
						<div class="col-md-2 text-right">
							<span class="versions"><a>Send a report error !</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="dialog_cus_search" title="เลือกลูกค้า" style=" width: 50%; display: none;" >
		<div style="width: 100%;padding-right: 1px;padding-left: 1px;margin-right: auto;margin-left: auto;">
			<div class="row">
				<div class="col-md-10">
					<label style="display: block;">ค้นหา</label>
					<input type="text" class="form-control" id="cusid" name="cusid" placeholder="รหัส ชื่อ-สกุล เบอร์โทรศัพท์">
				</div>
				<div class="col-md-2">
					<label style="display: block;">&nbsp;</label>
					<button class="btn btn-primary" style="width: 100%;" onclick="search()">ค้นหา</button>
				</div>
			</div>
			<br>
			<script type="text/javascript">
				var	url	=	'resource/ajax/customer.php?q=';
				$.get(url,	function(data){
					$("#datax").html(data);
				});
				function search()
				{
					var	url	=	'resource/ajax/customer.php?q='+$("#cusid").val();
					console.log(url);
					$.get(url,	function(data){
						$("#datax").html(data);
					});
				}
			</script>
			<div id="datax"></div>
		</div>
	</div>