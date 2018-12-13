<?php
	include "../core/helper.php";
	include "../core/init.php";

	if(!$_SESSION['staffID']){
		header("Location: ../index.html");
	}

	$sPic = "";
	$id = $_SESSION['staffID'];

  if(isset($_POST['submit'])){
		$sID = sanitize($_POST['sID']);
		$sIC = sanitize($_POST['sIC']);
		$sPic = sanitize($_POST['sPic1']);
		$sName = sanitize($_POST['sName']);
		$sMatric = sanitize($_POST['sMatric']);
		$sEmail = sanitize($_POST['sEmail']);
		$sPhone = sanitize($_POST['sPhone']);
		$sPic1 = sanitize($_POST['sPic1']);
		$upORin = sanitize($_POST['upORin']);

		//Checking the file
		if(!empty($_FILES['sPic']['name'])){
			$photo = $_FILES['sPic'];
			$tmpLoc = $photo['tmp_name'];
			$fileSize = $photo['size'];
			$uploadPath = 'images/' . basename($_FILES['sPic']['name']);

			if($fileSize < 15000000){
				if($upORin == "update"){
					$sql = "UPDATE student SET StudentName = '$sName', StudentMatric = '$sMatric', StudentIC = '$sIC', StudentEmail = '$sEmail',
									StudentPhone = '$sPhone', StudentPic = '$uploadPath' WHERE StudentID = '$sID'";
		      $query = mysqli_query($db, $sql);
				}else{
					$sql = "INSERT INTO student (StudentName, StudentMatric, StudentIC, StudentEmail, StudentPhone, StudentPic) VALUES
									('$sName', '$sMatric', '$sIC', '$sEmail', '$sPhone', '$uploadPath')";
			    $query = mysqli_query($db, $sql);
				}
				move_uploaded_file($tmpLoc, $uploadPath);
			}
		}else{
			if($upORin == "update"){
				$sql = "UPDATE student SET StudentName = '$sName', StudentMatric = '$sMatric', StudentIC = '$sIC', StudentEmail = '$sEmail',
								StudentPhone = '$sPhone', StudentPic = '$sPic1' WHERE StudentID = '$sID'";
		    $query = mysqli_query($db, $sql);

			}else{
				$sql = "INSERT INTO student (StudentName, StudentMatric, StudentIC, StudentEmail, StudentPhone, StudentPic) VALUES
								('$sName', '$sMatric', '$sIC', '$sEmail', '$sPhone', 'images/basicPic.jpg')";
				$query = mysqli_query($db, $sql);
			}
		}

	}

  if(isset($_GET['delete'])){
    $sID = sanitize($_GET['delete']);

		$sql = "SELECT carryMarkID from subjecttook where studentID = '$sID'";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$cID = $row['carryMarkID'];

		$sql = "DELETE FROM student WHERE StudentID = '$sID'";
		$query = mysqli_query($db, $sql);

	  $sql = "DELETE FROM subjecttook WHERE StudentID = '$sID'";
		$query = mysqli_query($db, $sql);

		$sql = "DELETE FROM carrymark WHERE carryMarkID = '$cID'";
		$query = mysqli_query($db, $sql);
  }

  if(isset($_GET['update'])){
    $sID = sanitize($_GET['update']);

    $sql = "SELECT * FROM student WHERE studentID = '$sID'";
    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query);

		$sIC = $row['StudentIC'];
    $sPic = $row['StudentPic'];
		$sName = $row['StudentName'];
		$sMatric = $row['StudentMatric'];
		$sEmail = $row['StudentEmail'];
		$sPhone = $row['StudentPhone'];
  }

	$sql = "SELECT * FROM staff ";
	$query = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($query);

	if(mysqli_num_rows($query) > 0){
		$img = $row['staffPic'];
	}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Student</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Esteem Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/component.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/flipclock.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/circles.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style_grid.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>
<?php
	require_once "includes/header.php";
?>
		<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		<!-- /inner_content-->
				<div class="inner_content">

          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li><a href="adminindex.php">Home</a><span>«</span></li>
                <li>Student</li>
              </ul>
            </div>
          </div>
				    <!-- /inner_content_w3_agile_info-->
            <div class="inner_content_w3_agile_info two_in" >
              <h2 class="w3_inner_tittle">Student</h2>
                    <!-- tables -->
                    <div class="agile-tables">
                      <div class="w3l-table-info agile_info_shadow">
                        <h3 class="w3_inner_title two"><?=((isset($_GET['update']))?'Update':'Insert')?> Student</h3><br>
                        <form action="adminStudent.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
                          <table class="table table-hover">
                            <input style="display:none" name="upORin" value="<?=((isset($_GET['update']))?'update':'insert')?>">
                            <input style="display:none" name="sID" value="<?=((isset($_GET['update']))?$sID:'')?>">
														<input style="display:none" name="sPic1" value="<?=$sPic;?>">
														<tr>
															<td rowspan="5" width="5%">
																<img src="<?=((isset($_GET['update']))?$sPic:'images/basicPic.jpg')?>" class="img-thumbnail" width="50%"><br><hr>
													    	<input type="file" name="sPic" id="sPic">
															</td>
															<td><label for="sName">Name: </label><input type="text" value="<?=((isset($_GET['update']))?$sName:'')?>" class="form-control" name="sName" minlength="10" maxlength="50" required></td>
														</tr>
														<tr>
															<td><label for="sIC">Identification No.: </label><input type="text" value="<?=((isset($_GET['update']))?$sIC:'')?>" class="form-control" name="sIC" minlength="12" maxlength="12" required></td>
														</tr>
														<tr>
															<td><label for="sMatric">Matric No.: </label><input type="text" value="<?=((isset($_GET['update']))?$sMatric:'')?>" class="form-control" name="sMatric" minlength="10" maxlength="10" required></td>
														</tr>
														<tr>
															<td><label for="sEmail">Email: </label><input type="email" value="<?=((isset($_GET['update']))?$sEmail:'')?>" class="form-control" name="sEmail" minlength="10" maxlength="50" required></td>
														</tr>
														<tr>
															<td><label for="sPhone">Phone No.: </label><input type="text" value="<?=((isset($_GET['update']))?$sPhone:'')?>" class="form-control" name="sPhone" minlength="10" maxlength="11" required></td>
														</tr>
														<tr>
														  <td colspan="2"><input type="submit" class="btn btn-primary pull-right" name="submit" value="<?=((isset($_GET['update']))?'Update':'Insert')?> Student"></td>
														</tr>
                          </table>
                        </form>
                    </div>
                  </div>

                  <div class="inner_content_w3_agile_info two_in">
        					  <h2 class="w3_inner_tittle">List of Student</h2>
        									<!-- tables -->
        									<div class="agile-tables">
        										<div class="w3l-table-info agile_info_shadow">
                              <table class="table table-hover">
                                <tr>
                                  <td style="display:none;"></td>
                                  <td>#</td>
																	<td>Picture</td>
                                  <td>Name</td>
																	<td>Matric No.</td>
																	<td>Identification No.</td>
                                  <td>Email</td>
																	<td>Phone No.</td>
																	<td>Update</td>
																	<td>Delete</td>
                                </tr>
                                <?php
                                  $sql = "SELECT * FROM student";
                                  $query = mysqli_query($db, $sql);
                                  $no = 0;

                                  while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)):
                                    $no = $no + 1;
                                ?>

                                <tr>
                                  <td style="display:none;"><?=$row['StudentID']?></td>
                                  <td><?=$no;?></td>
																	<td width="10%"><img src="<?=$row['StudentPic'];?>" width="100%"></td>
																	<td><?=$row['StudentName'];?></td>
																	<td><?=$row['StudentMatric'];?></td>
																	<td><?=$row['StudentIC'];?></td>
																	<td><?=$row['StudentEmail'];?></td>
																	<td><?=$row['StudentPhone']?></td>
                                  <td><a href="adminStudent?update=<?=$row['StudentID'];?>" onclick="return confirm('Are you sure?')"><span class="fa fa-cog"></span></a></td>
                                  <td><a href="adminStudent?delete=<?=$row['StudentID'];?>" onclick="return confirm('Are you sure?')"><span class="fa fa-times"></span></a></td>
                                </tr>
                              <?php endwhile;?>
                            </table>
                          </div>
        								</div>
        						</div>
              </div>
				</div>
<!-- banner -->
<!--copy rights start here-->
<div class="copyrights">
	 <p>Copyright &copy; 2018 Peninsula College</a> </p>
</div>
<!--copy rights end here-->
<!-- js -->

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- /amcharts -->
				<script src="js/amcharts.js"></script>
		       <script src="js/serial.js"></script>
				<script src="js/export.js"></script>
				<script src="js/light.js"></script>
				<!-- Chart code -->
	 <script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "startDuration": 2,
    "dataProvider": [{
        "country": "USA",
        "visits": 4025,
        "color": "#FF0F00"
    }, {
        "country": "China",
        "visits": 1882,
        "color": "#FF6600"
    }, {
        "country": "Japan",
        "visits": 1809,
        "color": "#FF9E01"
    }, {
        "country": "Germany",
        "visits": 1322,
        "color": "#FCD202"
    }, {
        "country": "UK",
        "visits": 1122,
        "color": "#F8FF01"
    }, {
        "country": "France",
        "visits": 1114,
        "color": "#B0DE09"
    }, {
        "country": "India",
        "visits": 984,
        "color": "#04D215"
    }, {
        "country": "Spain",
        "visits": 711,
        "color": "#0D8ECF"
    }, {
        "country": "Netherlands",
        "visits": 665,
        "color": "#0D52D1"
    }, {
        "country": "Russia",
        "visits": 580,
        "color": "#2A0CD0"
    }, {
        "country": "South Korea",
        "visits": 443,
        "color": "#8A0CCF"
    }, {
        "country": "Canada",
        "visits": 441,
        "color": "#CD0D74"
    }, {
        "country": "Brazil",
        "visits": 395,
        "color": "#754DEB"
    }, {
        "country": "Italy",
        "visits": 386,
        "color": "#DDDDDD"
    }, {
        "country": "Taiwan",
        "visits": 338,
        "color": "#333333"
    }],
    "valueAxes": [{
        "position": "left",
        "axisAlpha":0,
        "gridAlpha":0
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "depth3D": 40,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha":0,
        "gridAlpha":0

    },
    "export": {
    	"enabled": true
     }

}, 0);
</script>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv1", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": [{
        "year": 2017,
        "europe": 2.5,
        "namerica": 2.5,
        "asia": 2.1,
        "lamerica": 0.3,
        "meast": 0.2,
        "africa": 0.1
    }, {
        "year": 2016,
        "europe": 2.6,
        "namerica": 2.7,
        "asia": 2.2,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }, {
        "year": 2015,
        "europe": 2.8,
        "namerica": 2.9,
        "asia": 2.4,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }],
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.5,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Europe",
        "type": "column",
		"color": "#000000",
        "valueField": "europe"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "North America",
        "type": "column",
		"color": "#000000",
        "valueField": "namerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Asia-Pacific",
        "type": "column",
		"color": "#000000",
        "valueField": "asia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Latin America",
        "type": "column",
		"color": "#000000",
        "valueField": "lamerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Middle-East",
        "type": "column",
		"color": "#000000",
        "valueField": "meast"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Africa",
        "type": "column",
		"color": "#000000",
        "valueField": "africa"
    }],
    "rotate": true,
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }
});
</script>

	<!-- //amcharts -->
		<script src="js/chart1.js"></script>
				<script src="js/Chart.min.js"></script>
		<script src="js/modernizr.custom.js"></script>

		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
			<!-- script-for-menu -->

<!-- /circle-->
	 <script type="text/javascript" src="js/circles.js"></script>
					         <script>
								var colors = [
										['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
									];
								for (var i = 1; i <= 7; i++) {
									var child = document.getElementById('circles-' + i),
										percentage = 30 + (i * 10);

									Circles.create({
										id:         child.id,
										percentage: percentage,
										radius:     80,
										width:      10,
										number:   	percentage / 1,
										text:       '%',
										colors:     colors[i - 1]
									});
								}

				</script>
	<!-- //circle -->
	<!--skycons-icons-->
<script src="js/skycons.js"></script>
<script>
									 var icons = new Skycons({"color": "#fcb216"}),
										  list  = [
											"partly-cloudy-day"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
								<script>
									 var icons = new Skycons({"color": "#fff"}),
										  list  = [
											"clear-night","partly-cloudy-night", "cloudy", "clear-day", "sleet", "snow", "wind","fog"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
<!--//skycons-icons-->
<!-- //js -->
<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}



			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
		});
		</script>
		<script src="js/flipclock.js"></script>

	<script type="text/javascript">
		var clock;

		$(document).ready(function() {

			clock = $('.clock').FlipClock({
		        clockFace: 'HourlyCounter'
		    });
		});
	</script>
<script src="js/bars.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>
