<aside class="main-sidebar">
    <?php $segment = $this->uri->segment(2); ?>
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
        <?php if($segment=='dashboard') $activeclass = "active"; else $activeclass = ""; ?>
            <li class="<?php echo $activeclass; ?>">
                <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <?php if($segment=='page_contents') $activeclass = "active"; else $activeclass = ""; ?>
            <li class="treeview <?php echo $activeclass; ?>">
				<a href="<?php echo base_url('admin/page_contents'); ?>">
					<i class="fa fa-file-text"></i> <span>Page Contents</span>
				</a>
            </li>
            

            <?php if($segment=='services') $activeclass = "active"; else $activeclass = ""; ?>
            <li class="treeview <?php echo $activeclass; ?>">
				<a href="<?php echo base_url('admin/services'); ?>">
					<i class="fa fa-cog"></i> <span>Services</span>
				</a>
            </li>

            
            <?php if($segment=='change_password') $activeclass = "active"; else $activeclass = ""; ?>
			<li class="treeview <?php echo $activeclass; ?>">
				<a href="<?php echo base_url(); ?>admin/change_password">
					<i class="fa fa-lock"></i> <span>Change Password</span>
					<span class="pull-right-container"></span>
				</a>
            </li>
            
            <li>
                <a href="<?php echo base_url('admin/logout'); ?>">
                    <i class="fa fa-stop-circle"></i> <span>Logout</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>