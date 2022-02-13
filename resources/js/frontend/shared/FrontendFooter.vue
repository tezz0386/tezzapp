<template>
    <div>
         <footer class="">
                <div class="my-footer">
                    <div class="container">
                        <section id="top-footer">
                            <div class="row">
                                <h5>
                                    <a href="index3.html" class="navbar-brand">
                                        <img :src="'/uploads/setting/thumbnail/'+this.setting.logo" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                                        <span class="brand-text font-weight-light"></span>
                                    </a>
                                </h5>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-12">
                                    <ul>
                                        <li>
                                            Tokha 8 Basundhara, Kathmandu, Nepal
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-phone-square-alt"></i> <span>{{this.setting.t_no}}</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-envelope"></i> <span>{{this.setting.p_email}}</span></a>
                                        </li>
                                        <div class="social-links mt-3">
                                            <a :href="this.setting.facebook_link" class="twitter"><i class="fab fa-facebook-square footer-icon"></i></a>
                                            <a :href="this.setting.linkedin_link" class="facebook"><i class="fab fa-linkedin footer-icon"></i></a>
                                            <a :href="this.setting.instagram_link" class="instagram"><i class="fab fa-instagram footer-icon"></i></a>
                                            <a :href="this.setting.twitter_link" class="instagram"><i class="fab fa-twitter-square footer-icon"></i></a>
                                            <!-- <a :href="this.setting.viber" class="instagram"><i class="fab fa-viber footer-icon"></i></a>
                                            <a :href="this.setting." class="instagram"><i class="fab fa-skype footer-icon"></i></a>
                                            <a :href="this.setting." class="instagram"><i class="fab fa-whatsapp-square footer-icon"></i></a> -->
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-lg-3 col-12">
                                    <h5><u>Usefull Links</u></h5>
                                    <ul>
                                        <li>
                                            <a href="#">Blog</a>
                                        </li>
                                        <li>
                                            <a href="#">Generate Your CV</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-lg-3 col-12">
                                    <h5><u>Services</u></h5>
                                    <ul>
                                        <li>
                                            <a href="#">Web App Development</a>
                                        </li>
                                        <li>
                                            <a href="#">Graphic Design</a>
                                        </li>
                                        <li>
                                            <a href="#">Support</a>
                                        </li>
                                        <li>
                                            <a href="#">Web App Maintanance</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 footer-newsletter">
                                    <h5><u>Our Newsletter</u></h5>
                                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                                    <form action="" method="post" _lpchecked="1">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <button class="input-group-text bg-primary">Subscribe</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div>
                    <section id="bottom-footer">
                        <div class="bottom-footer">
                            <center>
                                <p>
                                    Copyright &copy 2022 All Right Reserved Sehzade Tezz (Tejendra Dangaura)
                                </p>
                            </center>
                        </div>
                    </section>
                </div>
            </footer>
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