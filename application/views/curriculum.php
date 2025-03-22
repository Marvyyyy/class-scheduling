<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url()?>img/logo/logo.png" rel="icon">
  <title>RuangAdmin - DataTables</title>
  <link href="<?php echo base_url()?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>css/ruang-admin.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- datatables-responsive -->
  <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="<?php echo base_url()?>vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
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
<body id="page-top">
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
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                    id="#myBtn">
                    Add New
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table responsive display nowrap" id="listTable" style="width: 100%;">
                    <thead class="thead-light">
						<!-- <tr>
							<th>Id</th>
							<th>Subject Name</th>
							<th>Specialization</th>
							<th></th>
						</tr> -->
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
            <div class="modal-dialog modal-dialog-centered d-flex flex-row" role="document" style="max-width: 50%;">
              <div class="modal-content">
							<form id="add_form">
							<input type="hidden" name="insert" id="ID" value="insert">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
					<!-- <div class="form-group row">
						<label for="inputEmail3" class="col-md-3 col-form-label">Subject Name</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="" name="subject" placeholder="Enter subject name">
							<span class="text-danger" id="subject_error"></span>
						</div>
					</div> -->
					<div class="form-group row">
						<label for="role" class="col-sm-3 col-form-label">Course</label>
						<div class="col-sm-9">
						<select class="select2-single-placeholder form-control" id="" name="subject" style="width:100%;">
							<option disabled selected value="">--Select an option--</option>
							<?php
								foreach($course as $row){
									if($row["crs_id"]!= '' && $row["crs_major"]!= ''){
										$major = "(".$row["crs_major"].")";
									}else{$major ="";}
								echo "<option value='".$row["crs_id"]."'>".$row["crs_title"].$major."</option>";
								//echo $row["regDesc"];
								}
								?>
						</select>
						<span class="text-danger" id="spec_error"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-3 col-form-label">Semester</label>
						<div class="col-sm-9">
						<select class="select2-single-placeholder form-control" id="" name="subject" style="width:100%;">
							<option disabled selected value="">--Select an option--</option>
							<?php
								foreach($sem as $row){
								echo "<option value='".$row["sem_id"]."'>".$row["sem_description"]."</option>";
								//echo $row["regDesc"];
								}
								?>
						</select>
						<span class="text-danger" id="spec_error"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-3 col-form-label">Subject</label>
						<div class="col-sm-9">
						<select class="select2-single-placeholder form-control" id="" name="subject" style="width:100%;">
							<option disabled selected value="">--Select an option--</option>
							<?php
								foreach($subj as $row){
								echo "<option value='".$row["subj_id"]."'>".$row["subj_name"]."</option>";
								//echo $row["regDesc"];
								}
								?>
						</select>
						<span class="text-danger" id="spec_error"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-3 col-form-label">Class</label>
						<div class="col-sm-9">
						<select class="select2-single-placeholder form-control" id="" name="subject" style="width:100%;">
							<option disabled selected value="">--Select an option--</option>
							<?php
								foreach($class as $row){
								echo "<option value='".$row["class_id"]."'>".$row["class_id"]." - ". $row["subj_name"]." - ".$row["suffix"]." ".$row["lname"].", ".$row["fname"]." ".$row["mname"]." - ".$row["time_start"]." - ".$row["time_end"]."</option>";
								//echo $row["regDesc"];
								}
								?>
						</select>
						<span class="text-danger" id="spec_error"></span>
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
                  <!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
									<div class="form-group row">
										<label for="inputEmail3" class="col-md-3 col-form-label">Subject Name</label>
										<div class="col-md-9">
											<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject name">
											<span class="text-danger" id="subject_error_edit"></span>
										</div>
									</div>
									<div class="form-group row">
                      <label for="role" class="col-sm-3 col-form-label">Role</label>
											<div class="col-sm-9">
                      <select class="select2-single-placeholder form-control" id="spec" name="spec" style="width:100%;">
                        <option disabled selected value="">--Select an option--</option>
                        <?php
													foreach($spec as $row){
													echo "<option value='".$row["specialization_id"]."'>".$row["specialization_title"]."</option>";
													//echo $row["regDesc"];
													}
													?>
                      </select>
											<span class="text-danger" id="spec_error_edit"></span>
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
  <!-- Select2 -->
  <script src="vendor/select2/dist/js/select2.min.js"></script>
	

  <!-- Page level custom scripts -->
  <script type="text/javascript">
    $(document).ready(function () {
			// Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "--select an option--",
        allowClear: true
      }); 
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
		// $('#listTable').DataTable({
        //   "responsive": true,
		// 			"ajax": {
		// 				"url": "<?php echo base_url(); ?>schedule/fetch_alldata",
		// 				"type": "POST",
		// 				"dataSrc": ""
		// 			},
		// 			// dom: 'Bfrtip',
		// 			// buttons: [
		// 			// 	'csv', 'excel', 'pdf', 
		// 			// ],
		// 		 //Set column definition initialisation properties.
		// 		 "columnDefs": [
        //     { 
        //         "targets": [ 0 ], //first column / numbering column
        //         "orderable": false, //set not orderable
        //     },
        //     ],
		// 		});
    });
		function edit(subj_id){
				$.ajax({
					url: "<?php echo base_url('subjects/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:subj_id},
					dataType:"json",
					success:function(response)
					{
						$('#editID').val(response.subj_id);
						$('#subject').val(response.subj_name);
						$('#spec').val(response.spec_code).select2();
						$('#editModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
		function deleteBtn(subj_id){
				$.ajax({
					url: "<?php echo base_url('subjects/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:subj_id},
					dataType:"json",
					success:function(response)
					{
						$('#deleteID').val(response.subj_id);
						$('#deleteModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
  </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#add_form').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					url: "<?php echo base_url()?>",
					method: "post",
					data: $(this).serialize(),
					success: function(response) {
						rs = JSON.parse(response);
						if(rs.error === true) {
							$('#subject_error').html(rs.subject_error);
							$('#spec_error').html(rs.spec_error);
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
						url: "<?php echo base_url()?>subjects/add_data",
						method : "post",
						data : $(this).serialize(),
						success: function(response) {
							rs = JSON.parse(response);
							if(rs.error === true) {
							$('#subject_error_edit').html(rs.subject_error);
							$('#spec_error_edit').html(rs.spec_error);
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
						url: "<?php echo base_url()?>subjects/delete_data",
						method : "post",
						data : $(this).serialize(),
						success: function(response) {
							$("#deleteModal").modal('hide')
							$("#successModal").modal('show')
						}
					});
					return false;
				});
		});
	</script>

</body>

</html>
