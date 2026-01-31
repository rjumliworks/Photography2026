<template>
<Head title="DOSTIX" />
    <div class="layout-wrapper landing">
        <nav v-if="!isMobile" class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <b-container>
                <b-link class="navbar-brand" href="/">
                    <img src="images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark"
                        height="25">
                    <img src="images/logo-light.png" class="card-logo card-logo-light" alt="logo light"
                        height="17">
                </b-link>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" v-b-toggle.navbarSupportedContent>
                    <i class="mdi mdi-menu"></i>
                </button>

                <b-collapse class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <Link href="/" class="nav-link active">Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link href="/search/schools" class="nav-link">Schools</Link>
                        </li>
                         <li class="nav-item">
                            <Link href="/search/courses" class="nav-link">Courses</Link>
                        </li>
                        <li class="nav-item">
                            <b-link class="nav-link" href="#contact">Contact</b-link>
                        </li>
                    </ul>

                    <div class="">
                        <span class="d-flex align-items-center"><img class="rounded-circle header-profile-user" src="images/avatars/avatar.jpg" alt="administrator">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{$page.props.participant.data.firstname}} {{ $page.props.participant.data.lastname }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Administrator</span>
                            </span>
                        </span>
                    </div>
                </b-collapse>
            </b-container>
        </nav>
        <section class="section pb-0 " id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <b-container v-if="isMobile">
                <div class="profile-wrapper">
                    <div class="row g-2">
                        <div class="col-auto">
                            <div class="avatar-sm"><img src="/images/avatars/avatar.jpg" alt="user-img" class="img-thumbnail rounded-circle"></div>
                        </div>
                        <div class="col">
                            <div class="p-2">
                                <h4 class="fs-14 text-primary text-uppercase fw-semibold mb-0">{{participant.firstname}} {{ participant.lastname }}</h4>
                                <p class="fs-12 text-muted">{{participant.contact_no}}</p>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </b-container>
        </section>

        
        <section class="py-5 hero-section position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <b-container>
               
            </b-container>
        </section>

        <Mobile v-if="isMobile" />
        <Web v-else />
        <b-button variant="danger" @click="topFunction" class="btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </b-button>
  </div>
</template>
<script>
import Mobile from './Footer/Mobile.vue';
import Web from './Footer/Web.vue';
export default {
    components: { Mobile, Web },
    layout: null,
    data(){
        return {
            participant: this.$page.props.participant.data,
            isMobile: false,
        }
    },
    methods: {
        async logout() {
            try {
                await axios.get('/participant/logout')
                window.location.href = '/participant/login' // redirect manually after logout
            } catch (error) {
                console.error('Logout failed:', error)
            }
        },
        topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        checkDevice() {
            this.isMobile = window.innerWidth <= 768;
        },
    },
    mounted() {

        let backtoTop = document.getElementById("back-to-top");

        if (backtoTop) {
            backtoTop = document.getElementById("back-to-top");
            window.onscroll = function () {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    backtoTop.style.display = "block";
                } else {
                    backtoTop.style.display = "none";
                }
            };
        }

        window.addEventListener('scroll', function (ev) {
            ev.preventDefault();
            var navbar = document.getElementById("navbar");
            if (navbar) {
                if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
                    navbar.classList.add("is-sticky");
                } else {
                    navbar.classList.remove("is-sticky");
                }
            }
        });

        this.checkDevice();
        window.addEventListener('resize', this.checkDevice);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.checkDevice);
    },
}
</script>
<style>
    .footer {
        left: 0;
        position: fixed;
        border-top: .1rem solid;
        border-color: #e4e2e2;
    }
</style>