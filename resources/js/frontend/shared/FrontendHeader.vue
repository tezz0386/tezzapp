<template>
    <div>
        <nav class="navbar navbar-expand bg-top-nav">
            <div class="container-fluid">
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav nav-menu ml-2">
                        <li class="nav-item">
                            <a href="#" class="d-none d-sm-none d-md-block d-lg-block">{{this.setting.name}}</a>
                            <a href="#" class="d-block d-sm-block d-md-none d-lg-none">TD</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav nav-menu ml-auto mr-2">
                        <li class="nav-item social-link d-none d-sm-none d-md-block d-lg-block">
                            <a href="#">
                                <i class="fas fa-phone-square-alt"></i> <span>{{this.setting.t_no}}</span>
                            </a> <span>|</span>
                        </li>
                        <li class="nav-item social-link d-block d-sm-block d-md-none d-lg-none">
                            <a href="#">
                                <i class="fas fa-phone-square-alt"></i>
                            </a> <span>|</span>
                        </li>

                        <li class="nav-item social-link d-none d-sm-none d-md-block d-lg-block">
                            <a href="#">
                                <i class="fas fa-envelope"></i> <span>{{this.setting.p_email}}</span>
                            </a> <span>|</span>
                        </li>
                        <li class="nav-item social-link d-block d-sm-block d-md-none d-lg-none">
                            <a href="#">
                                <i class="fas fa-envelope"></i>
                            </a> <span>|</span>
                        </li>


                        <li class="nav-item social-link">
                            <a :href="this.setting.facebook_link" target="_blank"><i class="fab fa-facebook-square facebook-icon"></i></a>
                            <a :href="this.setting.linkedin_link" target="_blank"><i class="fab fa-linkedin linkedin-icon"></i></a>
                            <a :href="this.setting.instagram_link" target="_blank"><i class="fab fa-instagram instagram-icon"></i></a>
                            <a :href="this.setting.twitter_link" target="_blank"><i class="fab fa-twitter-square twitter-icon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
          <nav class="navbar navbar-expand-md bg-nav sticky-top">
            <div class="container">
                <a href="index3.html" class="navbar-brand">
                    <img src="/dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style=" height: auto; width: 34px; opacity: .8">
                    <span class="brand-text font-weight-light"></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars" aria-hidden="true" style="color: aliceblue;"></i>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav nav-menu ml-auto">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <form class="form-inline ml-auto ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                            <div class="input-group-append">
                                <button class="btn btn-navbar search-btn-navbar" type="submit" style="background-color: aliceblue;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Blog</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data(){
        return{
            setting:null,
        };
    },
    created(){
        this.setting=window.Laravel.setting;
    }
}
</script>