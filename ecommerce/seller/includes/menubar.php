<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($seller['photo'])) ? '../images/'.$seller['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $seller['firstname'].' '.$seller['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Seller</a> 
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <li><a href="home.php"><i class="fa fa-circle-o"> </i> DashBoard </a></li>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="products.php"><i class="fa fa-circle-o"></i> Product List</a></li>
          <li><a href="category.php"><i class="fa fa-circle-o"></i> Category</a></li>
        </ul>
      </li>
    </ul>
    <li><a href="bidreq.php"><i class="fa fa-circle-o"> </i>  BID REQUEST</a></li>
  </section>
  <!-- /.sidebar -->
</aside>