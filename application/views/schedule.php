<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url()?>img/logo/logo3.png" rel="icon">
  <title>THE ADELPHI COLLAGE</title>
  <link href="<?php echo base_url()?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>css/ruang-admin.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- datatables-responsive -->
  <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
  
  <link href="https://https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.bootstrap4.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="<?php echo base_url()?>vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
  <!-- ClockPicker -->
  <link href="<?php echo base_url()?>vendor/clock-picker/clockpicker.css" rel="stylesheet">
</head>
<style>
	#content-wrapper {
  /* The image used */
  background-image: url("img/logo/logo4.png");

  /* Full height */
  height: 100vh;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: 50vh;
	/* background-opacity: 50%; */
	/* background: fixed; */
}
</style>
<body id="page-top" onload="onload()">
  <div id="wrapper">
    <!-- Sidebar -->
		<?php  $this ->load->view('menu.php'); ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<!-- TopBar -->
			<?php  $this ->load->view('header.php'); ?>
			<!-- Topbar -->
			<!-- Container Fluid-->
			<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800"></h1>
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?=base_url()?>dashboard">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $this->uri->segment(1) ?></li>
				</ol>
			</div>

			<!-- Row -->
			<div class="row">
				<!-- Datatables -->
				<div class="col-md-12">
					<div class="card-header pl-0 d-flex flex-row align-items-center justify-content-start">
						<div class="container-fluid p-0 m-0">
						<div class="col-md-12">
							<!-- <form id="filter_form"> -->
							<div class="form-group row">
								<div class="col-lg-3 mb-3">
								<select class="form-control form-control-sm" id="filterType" name="filterType" style="width:100%;">
									<option disabled selected value="">-- Select type to filter --</option>
									<?php $accesslevel = $this->session->userdata('accesslevel'); 
									if($accesslevel == "1" || $accesslevel == "2" || $accesslevel == "3"){?>
									<option value="Course">Course</option>
									<?php }?>
									<option value="Faculty">Faculty</option>
									<?php $accesslevel = $this->session->userdata('accesslevel'); 
									if($accesslevel == "1" || $accesslevel == "2" || $accesslevel == "3"){?>
									<option value="Student">Student</option>
									<?php }?>
									<?php
										// foreach($sy as $row){
										// echo "<option value='".$row["id"]."'>".$row["sy_name"].$major."</option>";
										//echo $row["regDesc"];
										// }
									?>
								</select>
								<span class="text-danger" id="username_error"></span>
								</div>
								<div class="col-lg-3 mb-3" id="facultyType" style="display: none;">
								<select class="form-control form-control-sm" id="facultyTypeF" name="sy_name" style="width:100%;">
									<option selected value="">-- Select Faculty --</option>
									<?php
										foreach($faculty as $row){
										echo "<option value='".$row["id"]."'>".$row["suffix"].' '.$row["lname"].' '.$row["fname"].' '.$row["mname"]."</option>";
										// echo $row["regDesc"];
										}
									?>
								</select>
								<!-- <span class="text-danger" id="username_error"></span> -->
								</div>
								<div class="col-lg-3 mb-3" id="courseType" style="display: none;">
								<select class="form-control form-control-sm" id="courseTypeF" name="sy_name" style="width:100%;">
									<option disabled selected value="">-- Select Course --</option>
									<?php
										foreach($course as $row){
											if(!empty($row["crs_id"] && $row["crs_major"])){
												$major = " - ".$row["crs_major"];
											}else{$major ="";}
										echo "<option value='".$row["crs_id"]."'>".$row["crs_title"].$major."</option>";
										// echo $row["regDesc"];
										}
									?>
								</select>
								<!-- <span class="text-danger" id="username_error"></span> -->
								</div>
								<div class="col-lg-3 mb-3" id="studentType" style="display: none;">
								<select class="form-control form-control-sm" id="studentTypeF" name="sy_name" style="width:100%;">
									<option disabled selected value="">-- Select Student --</option>
									<?php
										foreach($student as $row){
										echo "<option value='".$row["id"]."'>".$row["lname"].' '.$row["fname"].' '.$row["mname"]."</option>";
										// echo $row["regDesc"];
										}
									?>
								</select>
								<!-- <span class="text-danger" id="username_error"></span> -->
								</div>
								<div class="col-lg-3 mb-3" id="syType" style="display: none;">
								<select class="form-control form-control-sm" id="syTypeF" name="sy_name" style="width:100%;">
									<option disabled selected value="">-- Select schoolyear --</option>
									<?php
										foreach($sy as $row){
										echo "<option value='".$row["id"]."'>".$row["sy_name"]."</option>";
										// echo $row["regDesc"];
										}
									?>
								</select>
								<!-- <span class="text-danger" id="username_error"></span> -->
								</div>
								<div class="col-lg-3 mb-3" id="semType" style="display: none;">
								<select class="form-control form-control-sm" id="semTypeF" name="sy_name" style="width:100%;">
									<option disabled selected value="">-- Select semester --</option>
									<?php
										foreach($sem as $row){
										echo "<option value='".$row["sem_id"]."'>".$row["sem_description"]."</option>";
										echo $row["regDesc"];
										}
									?>
								</select>
								<!-- <span class="text-danger" id="username_error"></span> -->
								</div>
								<!-- <div class="col-lg-3 mb-3" id="buttonType" style="display: none;">
								<button type="submit" class=" btn btn-sm btn-success "> Filter </button>
								</div> -->
							</div>
							<!-- </form> -->
						</div>
						<div class="col-md-12"></div>
						</div>
					</div>
				<div class="card mb-4">
					<?php $accesslevel = $this->session->userdata('accesslevel'); 
					if($accesslevel == "1" || $accesslevel == "2" || $accesslevel == "3"){?>
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" id="#myBtn"> Add New </button>
					</div>
					<?php }?>
					<div class="table-responsive p-3">
					<table class="table responsive display nowrap" id="listTable" style="width: 100%;">
						<thead class="thead-light">
							<tr>
								<th>Class Code</th>
								<th>Subject</th>
								<th>Prof</th>
								<th>Days</th>
								<th>Time</th>
								<th>Room</th>
								<th></th>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
				</div>
				<!-- DataTable with Hover -->
			</div>
			<!--Row-->
			<!-- Add modal vertically centered -->
			<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<form id="add_form">
					<input type="hidden" name="insert" id="ID" value="insert">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">School Year</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="sy_name" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($sy as $row){
									echo "<option value='".$row["id"]."'>".$row["sy_name"].$major."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="sy_name_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Semester</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="sem" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($sem as $row){
									echo "<option value='".$row["sem_id"]."'>".$row["sem_description"].$major."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="sem_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Course</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="course" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($course as $row){
										if(!empty($row["crs_id"] && $row["crs_major"])){
											$major = " - ".$row["crs_major"];
										}else{$major ="";}
									echo "<option value='".$row["crs_id"]."'>".$row["crs_title"].$major."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="course_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Faculty</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="faculty" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($faculty as $row){
									echo "<option value='".$row["id"]."'>".$row["lname"].",". $row["fname"]." ".$row["mname"]."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="faculty_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Subject</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="subject" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($subj as $row){
									echo "<option value='".$row["subj_id"]."'>".$row["subj_code"]." - ".$row["subj_name"]."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="subject_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-form-label">Days</label>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day1" name="day1" value="M">
											<label class="custom-control-label" for="day1">Monday</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day2" name="day2" value="T">
											<label class="custom-control-label" for="day2">Tuesday</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day3" name="day3" value="W">
											<label class="custom-control-label" for="day3">Wednesday</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day4" name="day4" value="TH">
											<label class="custom-control-label" for="day4">Thursday</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day5" name="day5" value="F">
											<label class="custom-control-label" for="day5">Friday</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="day6" name="day6" value="S">
											<label class="custom-control-label" for="day6">Saturday</label>
										</div>
									</div>
								</div>
								<span class="text-danger" id="checkbox_error"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Time</label>
							<div class="col-sm-9">
								<div class="row">
									<div class="col">
										<div class="input-group clockpicker" id="clockPicker2">
											<input type="text" class="form-control" id="" name="start_time" placeholder="Start Time">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-clock"></i></span>
											</div>                      
										</div>
										<span class="text-danger" id="start_time_error"></span>
									</div>
									<div class="col-md-1">
										<label class="pt-2">-</label>
									</div>
									<div class="col">
										<div class="input-group clockpicker" id="clockPicker3">
											<input type="text" class="form-control" id="" name="end_time" placeholder="End Time">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-clock"></i></span>
											</div>                      
										</div>
										<span class="text-danger" id="end_time_error"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">Room</label>
							<div class="col-sm-9">
							<select class="select2-single-placeholder form-control" id="" name="room" style="width:100%;">
								<option disabled selected value="">--Select an option--</option>
								<?php
									foreach($room as $row){
									echo "<option value='".$row["room_id"]."'>".$row["room_name"]."</option>";
									//echo $row["regDesc"];
									}
									?>
							</select>
							<span class="text-danger" id="room_error"></span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
					</div>
					</form>
				</div>
				</div>
			</div>
			<!-- Edit modal vertically centered -->
			<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
			aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
							<form id="edit_form">
							<input type="hidden" name="update" id="editID" value="update">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">School Year</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="sy_name" name="sy_name" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($sy as $row){
											echo "<option value='".$row["id"]."'>".$row["sy_name"].$major."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="sy_name_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Semester</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="sem" name="sem" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($sem as $row){
											echo "<option value='".$row["sem_id"]."'>".$row["sem_description"].$major."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="sem_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Course</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="course" name="course" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($course as $row){
												if(!empty($row["crs_id"] && $row["crs_major"])){
													$major = " - ".$row["crs_major"];
												}else{$major ="";}
											echo "<option value='".$row["crs_id"]."'>".$row["crs_title"].$major."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="course_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Faculty</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="faculty" name="faculty" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($faculty as $row){
											echo "<option value='".$row["id"]."'>".$row["lname"].",". $row["fname"]." ".$row["mname"]."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="faculty_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Subject</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="subject" name="subject" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($subj as $row){
											echo "<option value='".$row["subj_id"]."'>".$row["subj_code"]." - ".$row["subj_name"]."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="subject_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label">Days</label>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-6">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day1edit" name="day1" value="M">
													<label class="custom-control-label" for="day1edit">Monday</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day2edit" name="day2" value="T">
													<label class="custom-control-label" for="day2edit">Tuesday</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day3edit" name="day3" value="W">
													<label class="custom-control-label" for="day3edit">Wednesday</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day4edit" name="day4" value="TH">
													<label class="custom-control-label" for="day4edit">Thursday</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day5edit" name="day5" value="F">
													<label class="custom-control-label" for="day5edit">Friday</label>
												</div>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="day6edit" name="day6" value="S">
													<label class="custom-control-label" for="day6edit">Saturday</label>
												</div>
											</div>
										</div>
										<span class="text-danger" id="checkbox_error_edit"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Time</label>
									<div class="col-sm-9">
										<div class="row">
											<div class="col">
												<div class="input-group clockpicker" id="clockPicker2">
													<input type="text" class="form-control" id="start_time" name="start_time" placeholder="Start Time">
													<div class="input-group-append">
														<span class="input-group-text"><i class="fas fa-clock"></i></span>
													</div>                      
												</div>
												<span class="text-danger" id="start_time_error_edit"></span>
											</div>
											<div class="col-md-1">
												<label class="pt-2">-</label>
											</div>
											<div class="col">
												<div class="input-group clockpicker" id="clockPicker3">
													<input type="text" class="form-control" id="end_time" name="end_time" placeholder="End Time">
													<div class="input-group-append">
														<span class="input-group-text"><i class="fas fa-clock"></i></span>
													</div>                      
												</div>
												<span class="text-danger" id="end_time_error_edit"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="role" class="col-sm-3 col-form-label">Room</label>
									<div class="col-sm-9">
									<select class="select2-single-placeholder form-control" id="room" name="room" style="width:100%;">
										<option disabled selected value="">--Select an option--</option>
										<?php
											foreach($room as $row){
											echo "<option value='".$row["room_id"]."'>".$row["room_name"]."</option>";
											//echo $row["regDesc"];
											}
											?>
									</select>
									<span class="text-danger" id="room_error_edit"></span>
									</div>
								</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save</button>
							</div>
							</form>
					</div>
				</div>
			</div>
			<!-- Delete modal vertically centered -->
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<form id="delete_form">
						<div class="modal-header">
						<!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="delete" id="deleteID" value="delete">
							<p>Are you sure to delete?</p>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Delete</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Success modal vertically centered -->
			<div class="modal fade" id="alertcheckboxModal" tabindex="-1" role="dialog" aria-labelledby="alertcheckboxModal"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
						<p>Alert</p>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" onClick="window.location.reload()" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Success modal vertically centered -->
			<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
						<p>Success</p>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" onClick="window.location.reload()" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			</div>
			<!---Container Fluid-->
		</div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

	<script src="<?php echo base_url()?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url()?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url()?>vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?php echo base_url()?>js/ruang-admin.min.js"></script>
	<!-- Page level plugins -->
	<script src="<?php echo base_url()?>vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url()?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
		<!-- datatables-responsive -->
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script> -->
	<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>
	<!-- Select2 -->
	<script src="<?php echo base_url()?>vendor/select2/dist/js/select2.min.js"></script>
	<!-- ClockPicker -->
	<script src="<?php echo base_url()?>vendor/clock-picker/clockpicker.js"></script>
	

  <!-- Page level custom scripts -->
  <script>
	table = $('#listTable').DataTable({
          "responsive": true,
		//   "lengthChange": true, "autoWidth": false,"paging": true,"destroy": true,
        //     "processing": true, //Feature control the processing indicator.
        //     "serverSide": true, //Feature control DataTables' server-side processing mode.
        //     "order": [], //Initial no order.
					"ajax": {
						"url": "<?php echo base_url(); ?>schedule/fetch_alldata",
						// "type": "POST",
						"dataSrc": "",
						'data': function(data){
						data.searchfilterType = $('#filterType').val();
						data.searchcourseType = $('#courseTypeF').val();
						data.searchfacultyType = $('#facultyTypeF').val();
						data.searchstudentType = $('#studentTypeF').val();
						data.searchsyType = $('#syTypeF').val();
						data.searchsemType = $('#semTypeF').val();
						},
               			 "type": "POST"
					},
					dom: 'Bfrtip',
					buttons: [
						'excel',  'colvis',
						 {
							extend: 'pdfHtml5',
							exportOptions: {
								columns: [ 0, 1, 2,4, 5 ]
							}
           				 }
					],
					
				 //Set column definition initialisation properties.
				 "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],
			
		});
		$('#filterType,#facultyTypeF,#studentTypeF,#courseTypeF,#syTypeF,#semTypeF').change(function(){
          table.ajax.reload( null, false );
	   	});
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
			// Select2 Single  with Placeholder
		$('.select2-single-placeholder').select2({
			placeholder: "--select an option--",
			allowClear: true
		});

		$('#clockPicker1').clockpicker({
		donetext: 'Done'
		});

		$('#clockPicker2').clockpicker({
		autoclose: true
		});

		let input = $('#clockPicker3').clockpicker({
		autoclose: true,
		'default': 'now',
		placement: 'top',
		align: 'left',
		});

		$('#check-minutes').click(function(e){        
		e.stopPropagation();
		input.clockpicker('show').clockpicker('toggleView', 'minutes');
		});
      	$('#dataTable').DataTable(); // ID From dataTable 
      	$('#dataTableHover').DataTable(); // ID From dataTable with Hover
		
    });
		function edit(class_id){
				$.ajax({
					url: "<?php echo base_url('schedule/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:class_id},
					dataType:"json",
					success:function(response)
					{
						$('#editID').val(response.class_id);
						
						$('#sy_name').val(response.school_yr).select2();
						$('#sem').val(response.semester).select2();
						$('#course').val(response.course_id).select2();
						$('#faculty').val(response.faculty_id).select2();
						$('#subject').val(response.subj_code).select2();
						$('#start_time').val(response.time_start);
						$('#end_time').val(response.time_end);
						$('#room').val(response.room_id).select2();
						if (response.day1.trim()=='M'){
							$("#day1edit").attr('checked', true);
						}if (response.day2.trim()=='T'){
							$("#day2edit").prop('checked', true);
						}if (response.day3.trim()=='W'){
							$("#day3edit").prop('checked', true);
						}if (response.day4.trim()=='TH'){
							$("#day4edit").prop('checked', true);
						}if (response.day5.trim()=='F'){
							$("#day5edit").prop('checked', true);
						}if (response.day6.trim()=='S'){
							$("#day6edit").prop('checked', true);
						}
						$('#editModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
		function deleteBtn(class_id){
				$.ajax({
					url: "<?php echo base_url('schedule/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:class_id},
					dataType:"json",
					success:function(response)
					{
						$('#deleteID').val(response.class_id);
						$('#deleteModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
			function onload() {
				document.getElementById("filterType").onchange = function (e) {
				if (this.value == 'Course') {
				document.getElementById("courseType").style.display="";
				document.getElementById("facultyType").style.display="none";
				document.getElementById("studentType").style.display="none";
				document.getElementById("syType").style.display="";
				document.getElementById("semType").style.display="";
				// $('#facultyType').val('');
				// document.getElementById('#facultyTypeF').value="";
				// document.getElementById("buttonType").style.display="";
				var elements = document.getElementById('facultyTypeF').options;
				for(var i = 0; i < elements.length; i++){
				elements[i].selected = false;
				}
				}
				else if (this.value == 'Faculty') {
				document.getElementById("courseType").style.display="";
				document.getElementById("facultyType").style.display="";
				document.getElementById("studentType").style.display="none";
				document.getElementById("syType").style.display="";
				document.getElementById("semType").style.display="";
				// document.getElementById("buttonType").style.display="";
				}
				else if (this.value == 'Student') {
				document.getElementById("courseType").style.display="none";
				document.getElementById("facultyType").style.display="none";
				document.getElementById("studentType").style.display="";
				document.getElementById("syType").style.display="";
				document.getElementById("semType").style.display="";
				// document.getElementById("buttonType").style.display="";
				} 
				else {
				document.getElementById("courseType").style.display="none";
				document.getElementById("facultyType").style.display="none";
				document.getElementById("studentType").style.display="none";
				document.getElementById("syType").style.display="none";
				document.getElementById("semType").style.display="none";
				// document.getElementById("buttonType").style.display="none";
				}
				};
			}
  </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#add_form').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					url: "<?php echo base_url('schedule/add_data')?>",
					method: "post",
					data: $(this).serialize(),
					success: function(response) {
						rs = JSON.parse(response);
						if ( $('#day1').not(':checked') && $('#day2').not(':checked') && $('#day3').not(':checked') && $('#day4').not(':checked') && $('#day5').not(':checked') && $('#day6').not(':checked')){
							// $("#alertcheckboxModal").modal('show')
							$('#checkbox_error').html('Please select atleast one');
						}
						if(rs.error === true) {
							$('#sy_name_error').html(rs.sy_name_error);
							$('#sem_error').html(rs.sem_error);
							$('#course_error').html(rs.course_error);
							$('#faculty_error').html(rs.faculty_error);
							$('#subject_error').html(rs.subject_error);
							$('#start_time_error').html(rs.start_time_error);
							$('#end_time_error').html(rs.end_time_error);
							$('#room_error').html(rs.room_error);
						} else if(rs.error === false) {
							// window.location.href = "<?php echo base_url()?>main/dashboard";
							$("#addModal").modal('hide')
							$("#successModal").modal('show')
							// window.location.href = "<?php echo base_url()?>users";
						} else {
							$('#errors').html('An error has occured.');
						}
					}
				});
			});
			$('#edit_form').on('submit',function(e){
					e.preventDefault();
					$.ajax({
						url: "<?php echo base_url()?>schedule/add_data",
						method : "post",
						data : $(this).serialize(),
						success: function(response) {
							rs = JSON.parse(response);
							if ( $('#day1').not(':checked') && $('#day2').not(':checked') && $('#day3').not(':checked') && $('#day4').not(':checked') && $('#day5').not(':checked') && $('#day6').not(':checked')){
								// $("#alertcheckboxModal").modal('show')
								$('#checkbox_error_edit').html('Please select atleast one');
							}
							if(rs.error === true) {
							$('#sy_name_error_edit').html(rs.sy_name_error);
							$('#sem_error_edit').html(rs.sem_error);
							$('#course_error_edit').html(rs.course_error);
							$('#faculty_error_edit').html(rs.faculty_error);
							$('#subject_error_edit').html(rs.subject_error);
							$('#start_time_error_edit').html(rs.start_time_error);
							$('#end_time_error_edit').html(rs.end_time_error);
							$('#room_error_edit').html(rs.room_error);
							} else if(rs.error === false) {
							$("#editModal").modal('hide')
							$("#successModal").modal('show')
							} else {
								$('#errors').html('An error has occured.');
							}
						}
					});
					return false;
				});
			$('#delete_form').on('submit',function(e){
					e.preventDefault();
					$.ajax({
						url: "<?php echo base_url()?>schedule/delete_data",
						method : "post",
						data : $(this).serialize(),
						success: function(response) {
							$("#deleteModal").modal('hide')
							$("#successModal").modal('show')
						}
					});
					return false;
			});
			// $('#filter_form').on('submit', function(e) {
			// 	e.preventDefault();
			// 	$('#listTable').DataTable({
			// 	"responsive": true,
			// 				"ajax": {
			// 					"url": "<?php echo base_url(); ?>schedule/filter_alldata",
			// 					"type": "POST",
			// 					"dataSrc": ""
			// 				},
			// 				// dom: 'Bfrtip',
			// 				// buttons: [
			// 				// 	'csv', 'excel', 'pdf', 
			// 				// ],
			// 			//Set column definition initialisation properties.
			// 			"columnDefs": [
			// 		{ 
			// 			"targets": [ 0 ], //first column / numbering column
			// 			"orderable": false, //set not orderable
			// 		},
			// 		],
			// 	});
			// });
		});
	</script>

</body>

</html>
