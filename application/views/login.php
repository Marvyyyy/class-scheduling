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

</head>
<style>
	.bg {
  /* The image used */
  background-image: url("img/school.jpeg");

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<body class="bg-gradient-login bg" >
  <!-- Login Content -->
  <div class="container-login" style="margin-top:12%;">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
									<div class="row">
                  <div class="text-center">
										<img src="<?="img/logo/logo3.png"?>" rel="icon" style="max-width:10%;min-width:10%">
										<h1 class="h4 text-gray-900 mb-4">THE ADELPHI COLLAGE SCHEDULING SYSTEM</h1>
                  </div>
									</div>
                  <div class="text-center">
                    <h1 class="h4  mb-4">Login</h1>
                  </div>
                  <form class=""  method="POST" id="frmLogin">
                    <div class="form-group">
										<div id="error_message" class="text-danger "></div>
                      <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                        placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
										<div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="viewpass">
                        <label class="custom-control-label" for="viewpass">Show Password</label>
                      </div>
										</div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="<?php echo base_url()?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url()?>js/ruang-admin.min.js"></script>
	<script>
  $(document).ready(function () {

      $("#frmLogin").submit(function (e) {
          e.preventDefault();
          var formData = $(this).serialize();
          $.ajax({
              url: "<?=base_url();?>login/check_user",
              type: "POST",
              dataType: "json",
              data: formData,
              success: function (data) {
                if(data.response=='admin'){
                  $("#password").val("");
                  window.location.href = '<?=base_url()?>dashboard';
                }else if(data.response=='event'){
                  $("#password").val("");
                  window.location.href = '<?=base_url()?>dashboard';
                }else{
                   $("#error_message").html('<div class="rounded-md flex items-center px-5 py-4 mb-2 "> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>'+data.response+'</div>');
                  $("#password").val("");
                }
                 
              },
              error: function (jXHR, textStatus, errorThrown) {
                  alert(errorThrown);
              }
          });
      });
  });
  
  document.getElementById("viewpass").addEventListener("click", function (){
    var x = document.getElementById("password");
      if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
      });
</script>
</body>

</html>
