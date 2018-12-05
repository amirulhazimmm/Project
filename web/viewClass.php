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

    $id = $_SESSION['staffID'];

    $sql = "SELECT * FROM staff WHERE staffID = '$id'";

    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query);

    if(mysqli_num_rows($query) > 0){
      $img = $row['staffPic'];
    }
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
<title>View Class</title>
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

									<li>View Class</li>
								</ul>
							</div>
						</div>
					<!-- //breadcrumbs -->


					<div class="inner_content_w3_agile_info two_in">
					  <h2 class="w3_inner_tittle">List of Class</h2>
									<!-- tables -->
									<div class="agile-tables">
										<div class="w3l-table-info agile_info_shadow">
                      <table class="table table-hover">
                        <tr>
                          <th style="display:none;s"></th>
                          <th>#</th>
                          <th>Code</th>
                          <th>Program</th>
                          <th>Class</th>
                          <th>View</th>
                        </tr>
                        <?php
                          /*SELECT DISTINCT c.className, c.classID, s.subjectDesc, s.subjectName
                          FROM subjecttook stk
                          INNER JOIN staff st on stk.staffID = st.staffID
                          LEFT JOIN class c on c.classID = stk.classID
                          RIGHT JOIN subject s on s.subjectID = stk.subjectID
                          WHERE st.staffID = 3*/

                          $sql = "SELECT DISTINCT c.className, c.classID, s.subjectDesc, s.subjectName FROM subjecttook stk
                                  INNER JOIN staff st on stk.staffID = st.staffID LEFT JOIN class c on c.classID = stk.classID
                                  RIGHT JOIN subject s on s.subjectID = stk.subjectID WHERE st.staffID = $id";
                          $result = mysqli_query($db, $sql);
                          $no = 0;

                          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
                            $no = $no + 1;
                          ?>

                        <tr>
                          <td style="display:none;"><?=$row['classID'];?></td>
                          <td><?=$no;?></td>
                          <td><?=$row['subjectName'];?></td>
                          <td><?=$row['subjectDesc']?></td>
                          <td><?=$row['className'];?></td>
                          <td><a href="viewStudent.php?id=<?=$row['classID'];?>" class="btn btn-hover btn-dark btn-block">View Class</a></td>
                        </tr>
                      <?php endwhile;?>
                    </table>
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
