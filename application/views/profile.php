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
  <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
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
            <!-- <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table responsive display nowrap" id="listTable" style="width: 100%;">
                    <thead class="thead-light">
										<tr>
											<th>Id</th>
											<th>Username</th>
											<th>Access Level</th>
											<th></th>
										</tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->
            <!-- DataTable with Hover -->
						<?php $accesslevel = $this->session->userdata('accesslevel');
						if($accesslevel == "3" || $accesslevel == "4"){?>
							<div class="col-md-6 ">
								<!-- Horizontal Form -->
								<div class="card mb-4">
									<div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
										<h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
									</div>
									<div class="card-body">
										<form id="add_form">
										<input type="hidden" name="insert" id="insert" value="insert">
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">ID no.</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="username" name="username" disabled value="<?=$faculty["faculty_id"]?>">
													<span class="text-danger" id="username_error"></span>
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-sm-3 col-form-label">Firstname</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="username" name="" disabled value="<?=$faculty["fname"]?>">
													<span class="text-danger" id="username_error"></span>
												</div>
											</div>
											<div class="form-group row">
												<label for="password" class="col-sm-3 col-form-label">Middlename</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="" name="" disabled value="<?=$faculty["mname"]?>">
													<span class="text-danger" id="password_error"></span>
												</div>
											</div>
											<div class="form-group row">
												<label for="confirmpassword" class="col-sm-3 col-form-label">Lastname</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="" name="" disabled value="<?=$faculty["lname"]?>">
													<span class="text-danger" id="confirmpassword_error"></span>
												</div>
											</div>
											<div class="form-group row">
												<label for="confirmpassword" class="col-sm-3 col-form-label">Specialization</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="confirmpassword" name="confirmpassword" disabled>
													<span class="text-danger" id="confirmpassword_error"></span>
												</div>
											</div>
											<div class=" d-flex flex-row align-items-center justify-content-end">
													<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#editModal">Edit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php }else{}?>
						<?php $accesslevel = $this->session->userdata('accesslevel');
						if($accesslevel == "3" || $accesslevel == "4"){?>
            <div class="col-md-6 ">
						<?php }else{ ?>
							<div class="col-md-12 ">
						<?php } ?>
							<!-- Horizontal Form -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                  <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
                </div>
                <div class="card-body">
                  <form id="add_form">
									<input type="hidden" name="insert" id="insert" value="insert">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo ucwords($this->session->userdata('username')) ?>" disabled>
												<span class="text-danger" id="username_error"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo ucwords($this->session->userdata('password')) ?>">
												<span class="text-danger" id="password_error"></span>
                      </div>
                    </div>
										<div class="form-group row">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="viewpass">
                        <label class="custom-control-label" for="viewpass">Show Password</label>
                      </div>
										</div>
                    <!-- <div class="form-group row">
                      <label for="confirmpassword" class="col-sm-3 col-form-label">Confirm Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"  placeholder="Re-enter Password">
												<span class="text-danger" id="confirmpassword_error"></span>
                      </div>
                    </div> -->
                    <div class=" d-flex flex-row align-items-center justify-content-end">
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#editModalAccount">Edit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
					<!-- Edit modal vertically centered -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
							<form id="edit_form">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
									<input type="hidden" name="update" id="ID" value="update">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username_edit" name="username" placeholder="username">
												<span class="text-danger" id="username_error_modal"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password_edit" name="password"  placeholder="Password">
												<span class="text-danger" id="password_error_modal"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="confirmpassword" class="col-sm-3 col-form-label">Confirm Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirmpassword_edit" name="confirmpassword"  placeholder="Re-enter Password">
												<span class="text-danger" id="confirmpassword_error_modal"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="role" class="col-sm-3 col-form-label">Role</label>
											<div class="col-sm-9">
                      <select class="form-control" id="role_edit" name="role">
                        <option disabled selected value="">--Select an option--</option>
                        <option value="1">Superadmin</option>
                        <option value="2">Admin</option>
                        <option value="3">Staff</option>
                      </select>
											<span class="text-danger" id="role_error_modal"></span>
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
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
							</form>
              </div>
            </div>
          </div>

					<!-- Success modal vertically centered -->
          <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
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
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

  <!-- Page level custom scripts -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
			$('#listTable').DataTable({
          "responsive": true,
					"ajax": {
						"url": "<?php echo base_url(); ?>users/fetch_alldata",
						"type": "POST",
						"dataSrc": ""
					},
					// dom: 'Bfrtip',
					// buttons: [
					// 	'csv', 'excel', 'pdf', 
					// ],
				
				});
    });
		function edit(id){
				$.ajax({
					url: "<?php echo base_url('users/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:id},
					dataType:"json",
					success:function(response)
					{
						$('#ID').val(response.id);
						$('#username_edit').val(response.username);
						$('#role_edit').val(response.role);
						$('#editModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
		function deleteBtn(id){
				$.ajax({
					url: "<?php echo base_url('users/fetch_singledata/'); ?>",
					method:"POST",
					data:{idd:id},
					dataType:"json",
					success:function(response)
					{
						$('#deleteID').val(response.id);
						$('#deleteModal').modal({
							backdrop:"static",
							keyboard:false
						});
						
					}
				})
			}
			document.getElementById("viewpass").addEventListener("click", function (){
    var x = document.getElementById("password");
      if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
      });
  </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#add_form').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					url: "<?php echo base_url()?>users/add_data",
					method: "post",
					data: $(this).serialize(),
					success: function(response) {
						rs = JSON.parse(response);
						if(rs.error === true) {
							$('#username_error').html(rs.username_error);
							$('#password_error').html(rs.password_error);
							$('#confirmpassword_error').html(rs.confirmpassword_error);
							$('#role_error').html(rs.role_error);
						} else if(rs.error === false) {
							// window.location.href = "<?php echo base_url()?>main/dashboard";
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
						url: "<?php echo base_url()?>users/add_data",
						method : "post",
						data : $(this).serialize(),
						success: function(response) {
							rs = JSON.parse(response);
							if(rs.error === true) {
							$('#username_error_modal').html(rs.username_error);
							$('#password_error_modal').html(rs.password_error);
							$('#confirmpassword_error_modal').html(rs.confirmpassword_error);
							$('#role_error_modal').html(rs.role_error);
							} else if(rs.error === false) {
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
						url: "<?php echo base_url()?>users/delete_data",
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
