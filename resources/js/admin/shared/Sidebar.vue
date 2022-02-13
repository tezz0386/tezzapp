<template>
  <!-- Main Sidebar Container -->
  <aside
    class="main-sidebar sidebar-dark-primary elevation-4"
    style="position: fixed;"
  >
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="dist/img/user2-160x160.jpg"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a href="#" class="d-block">{{name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon nav-sm class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link to="/admin/home" class="nav-link" :class="{ active: activePage=='dashboard'}">
              <i class="nav-icon nav-sm fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/setting" class="nav-link" :class="{active: activePage=='setting'}">
              <i class="nav-icon nav-sm fas fa-cog"></i>
              <p>
                Setting
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview" :class="{ 'menu-open' : page=='banner'}">
            <a href="#" class="nav-link" :class="{ active : page=='banner'}">
              <i class="nav-icon nav-sm fas fa-copy"></i>
              <p>
                Banners
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/banner/create" class="nav-link" :class="{active: activePage=='banner_create'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Create New</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/banner"  class="nav-link" :class="{active: activePage=='banner_list'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Banner List</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" :class="{ 'menu-open' : page=='skill'}">
            <a href="#" class="nav-link" :class="{ active : page=='skill'}">
              <i class="nav-icon nav-sm fas fa-chart-pie"></i>
              <p>
                Skill
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/skill/create" class="nav-link" :class="{active: activePage=='skill_create'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Add Skill</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/skill" class="nav-link" :class="{active: activePage=='skill_list'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Skill List</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" :class="{ 'menu-open' : page=='service'}">
            <a href="#" class="nav-link" :class="{ active : page=='service'}">
              <i class="nav-icon nav-sm fas fa-table"></i>
              <p>
                Service
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/service/create" class="nav-link" :class="{active: activePage=='service_create'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Add Service</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/service" class="nav-link" :class="{active: activePage=='service_list'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Service List</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview" :class="{ 'menu-open' : page=='portfolio'}">
            <a href="#" class="nav-link" :class="{ active : page=='portfolio'}">
              <i class="nav-icon nav-sm fas fa-tree"></i>
              <p>
                Portfolio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/portfolio/create" class="nav-link" :class="{active: activePage=='portfolio_create'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Add Portfolio</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/portfolio" class="nav-link" :class="{active: activePage=='portfolio_list'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Portfolio List</p>
                </router-link>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview" :class="{ 'menu-open' : page=='blog'}">
            <a href="#" class="nav-link" :class="{ active : page=='blog'}">
              <i class="nav-icon nav-sm fas fa-edit"></i>
              <p>
                Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/admin/blog/create" class="nav-link" :class="{active: activePage=='blog_create'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Add Blog</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/blog" class="nav-link" :class="{active: activePage=='blog_list'}">
                  <i class="far fa-circle nav-icon nav-sm"></i>
                  <p>Blog List</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<style scoped>
a{
  font-size: 10px;
}
.nav-sm{
  font-size: 13px !important;
}
</style>
<script>
export default {
  props:{
    activePage:'',
    page:'',
    name:null,
  },
};
</script>