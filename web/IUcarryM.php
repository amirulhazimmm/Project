<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
    include "../core/init.php";
    include "../core/helper.php";

    if(!$_SESSION['staffID']){
      header("Location: ../index.html");
    }

    if(isset($_POST['submit'])){
      $clID = $_POST['clID'];
      $cmkID = $_POST['cmkID'];
      $mLab = $_POST['mLab'];
      $mQuiz = $_POST['mQuiz'];
      $mT1 = $_POST['mT1'];
      $mT2 = $_POST['mT2'];
      $mPro = $_POST['mPro'];
      $mPre = $_POST['mPre'];
      $mRe = $_POST['mRe'];

      $sql = "UPDATE carrymark SET markLab = '$mLab', markQ_A = '$mQuiz', markTest1 = '$mT1', markTest2 = '$mT2', markProposal = '$mPro',
              markPresentation = '$mPre', markReport = '$mRe'  WHERE carryMarkID = '$cmkID'";
      $query = mysqli_query($db, $sql);

    }

    if(isset($_GET['clID'])){
      $clID = sanitize($_GET['clID']);
    }

    if(isset($_GET['cmk'])){
      $cmkID = sanitize($_GET['cmk']);
    }

    $id = $_SESSION['staffID'];

    $sql = "SELECT * FROM staff WHERE staffID = '$id'";

    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query);

    if(mysqli_num_rows($query) > 0){
      $img = $row['staffPic'];
    }

    $sql = "SELECT student.StudentName, student.StudentMatric, carrymark.* FROM subjecttook
            INNER JOIN student on subjecttook.studentID = student.StudentID
            RIGHT JOIN class on subjecttook.classID = class.ClassID
            LEFT JOIN carrymark on subjecttook.carryMarkID = carrymark.carryMarkID
            WHERE subjecttook.staffID = '$id' And carrymark.carryMarkID = '$cmkID'";
    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $sName = $row['StudentName'];
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Insert/Update Carry Mark</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Esteem Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<link href="css/component.css" rel="stylesheet" type="text/css" media="all" />
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
				    <!-- /inner_content_w3_agile_info-->

					<!-- breadcrumbs -->
						<div class="w3l_agileits_breadcrumbs">
							<div class="w3l_agileits_breadcrumbs_inner">
								<ul>
									<li><a href="main-page.php">Home</a><span>«</span></li>
                  <li><a href="insViewClass.php">View Class</a><span>«</span></li>
                  <li><a href="insCarryMark.php?clsID=<?=$clID;?>">View Carry Mark</a><span>«</span></li>
									<li>Student</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->

          <?php
            $sql = "SELECT student.StudentName, student.StudentMatric, carrymark.* FROM subjecttook
                    INNER JOIN student on subjecttook.studentID = student.StudentID
                    RIGHT JOIN class on subjecttook.classID = class.ClassID
                    LEFT JOIN carrymark on subjecttook.carryMarkID = carrymark.carryMarkID
                    WHERE subjecttook.staffID = '$id' And carrymark.carryMarkID = '$cmkID'";
            $query = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $mLab = $row['markLab'];
            $mA = $row['markQ_A'];
            $mT1 = $row['markTest1'];
            $mT2 = $row['markTest2'];
            $mPro = $row['markProposal'];
            $mPre = $row['markPresentation'];
            $mRe = $row['markReport'];
          ?>
					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle"><?=$sName;?></h2>
									<!-- tables -->
						<div class="agile-tables">
						  <div class="w3l-table-info agile_info_shadow">
                <form action="IUcarryM.php" method="post" onsubmit="return confirm('Are you sure?')">
                  <table class="table table-hover">
                      <input type="hidden" name="clID" value="<?=$clID;?>">
                      <input type="hidden" name="cmkID" value="<?=$cmkID;?>">
                    <tr><th>Matric No.</th>
                        <td>2017197403</td></tr>
                    <tr><th>Lab (10%)</th>
                        <td><input type="number" class="form-control" name="mLab" value="<?=$mLab;?>" max="10"></td></tr>
                    <tr><th>Quizzes (30%)</th>
                        <td><input type="number" class="form-control" name="mQuiz" value="<?=$mA;?>" max="30"></td></tr>
                    <tr><th>Test 1 (10%)</th>
                        <td><input type="number" class="form-control" name="mT1" value="<?=$mT1;?>" max="10"></td></tr>
                    <tr><th>Test 2 (10%)</th>
                        <td><input type="number" class="form-control" name="mT2" value="<?=$mT2;?>" max="10"></td></tr>
                    <tr><th>Proposal (10%)</th>
                        <td><input type="number" class="form-control" name="mPro" value="<?=$mPro;?>" max="10"></td></tr>
                    <tr><th>Presentation (10%)</th>
                        <td><input type="number" class="form-control" name="mPre" value="<?=$mPre;?>" max="10"></td></tr>
                    <tr><th>Report (20%)</th>
                        <td><input type="number" class="form-control" name="mRe" value="<?=$mRe;?>" max="20"></td></tr>
                    <tr><th></th><td>
                      <a href="insCarryMark.php?clsID=<?=$clID;?>" class="btn btn-hover btn-dark btn-block">Back</a>
                      <button type="submit" name="submit" class="btn btn-hover btn-dark btn-block">Insert / Update</button></td>
                    </tr>
                  </table>
                </form>
              </div>
						 </div>
						</div>
					<div class="clearfix"></div>

				</div>
<div class="copyrights">
	 <p>© 2017 Esteem. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>
<!--copy rights end here-->
<!-- js -->

          <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		  <script src="js/modernizr.custom.js"></script>

		   <script src="js/classie.js"></script>
		  <script src="js/gnmenu.js"></script>
		  <script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		 </script>
<!-- tables -->

<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
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
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>
