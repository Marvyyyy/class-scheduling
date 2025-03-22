
    <!-- Sidebar -->
		<?php 
		$accesslevel = $this->session->userdata('accesslevel');
		if($accesslevel == "2" || $accesslevel == "3" || $accesslevel == "4"){
			$style = "style='display:none'";
			if($accesslevel == "2"){
				$admin = "";
				$dean = "";
				$staff = "";
		}else if($accesslevel == "3"){
			$admin = "style='display:none'";
			$dean = "";
			$staff = "";
		}else if($accesslevel == "4"){
			$admin = "style='display:none'";
			$dean = "style='display:none'";
			$staff = "";
		}
		}else{
			
			$style = "";
			$admin = "";
			$dean = "";
			$staff = "";
		}
		?>

    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url()?>dashboard"  style="background-color:#3abaf4;">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo3.png">
        </div>
        <div class="sidebar-brand-text mx-3">THE ADELPHI COLLAGE</div>
      </a>
      <hr class="sidebar-divider my-0">
      <hr class="sidebar-divider">
      <!-- <div class="version" id="version-ruangadmin"></div> -->
			<?php  if($this->uri->segment(1) =="dashboard"){?>
			<li class="nav-item active" style="background-color: #eaecf4;" <?=$staff?>>
			<?php }else{ ?>
			<li class="nav-item"<?=$staff?>>
			<?php } ?> 
        <a class="nav-link" href="<?=base_url()?>dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
			<?php  if($this->uri->segment(1) =="schedule"){?>
			<li class="nav-item active" style="background-color: #eaecf4;" <?=$dean?>>
			<?php }else{ ?>
			<li class="nav-item"<?=$staff?>>
			<?php } ?> 
        <a class="nav-link" href="<?=base_url()?>schedule">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Schedule</span>
        </a>
      </li>
			<?php  if($this->uri->segment(1) =="faculty"){?>
			<li class="nav-item active" style="background-color: #eaecf4;" <?=$admin?>>
			<?php }else{ ?>
			<li class="nav-item"<?=$admin?>>
			<?php } ?> 
        <a class="nav-link" href="<?=base_url()?>faculty">
          <i class="fas fa-fw fa-user"></i>
          <span>Faculty</span>
        </a>
      </li>
			<?php  if($this->uri->segment(1) =="students"){?>
			<li class="nav-item active" style="background-color: #eaecf4;" <?=$dean?>>
			<?php }else{ ?>
			<li class="nav-item"<?=$dean?>>
			<?php } ?> 
        <a class="nav-link" href="<?=base_url()?>students">
          <i class="fas fa-fw fa-users"></i>
          <span>Students</span>
        </a>
      </li>
      <li class="nav-item" <?=$admin?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu1" aria-expanded="true"
          aria-controls="collapsePage">
          <i class="fas fa-fw fa-columns"></i>
          <span>Entry</span>
        </a>
				<?php  if($this->uri->segment(1) =="course" || $this->uri->segment(1) =="subjects" || $this->uri->segment(1) =="specialization" || $this->uri->segment(1) =="schoolyear"){?>
        <div id="menu1" class="collapse show" aria-labelledby="headingPage" data-parent="#accordionSidebar"  style="background-color: #eaecf4;" >
				<?php }else{ ?>
        <div id="menu1" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
				<?php } ?>
          <div class="bg-white py-2 collapse-inner rounded">
			<?php  if($this->uri->segment(1) =="course"){$active = 'class="collapse-item active" style="background-color: #eaecf4;"';}else{$active = 'class="collapse-item"';}?>
            <a <?= $active?> href="<?=base_url()?>course">Courses</a>
			<?php  if($this->uri->segment(1) =="subjects"){$active = 'class="collapse-item active" style="background-color: #eaecf4;"';}else{$active = 'class="collapse-item"';}?>
            <a <?= $active?> href="<?=base_url()?>subjects">Subjects</a>
			<?php  if($this->uri->segment(1) =="schoolyear"){$active = 'class="collapse-item active" style="background-color: #eaecf4;"';}else{$active = 'class="collapse-item"';}?>
            <a <?= $active?> href="<?=base_url()?>schoolyear">School Year</a>
			<?php  if($this->uri->segment(1) =="rooms"){$active = 'class="collapse-item active" style="background-color: #eaecf4;"';}else{$active = 'class="collapse-item"';}?>
            <a <?= $active?> href="<?=base_url()?>rooms">Rooms</a>
          </div>
        </div>
      </li>
			<?php  if($this->uri->segment(1) =="users"){?>
			<li class="nav-item active" style="background-color: #eaecf4;" <?=$style?>>
			<?php }else{ ?>
			<li class="nav-item"<?=$style?>>
			<?php } ?> 
        <a class="nav-link" href="<?=base_url()?>users">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->
