<template>
    <Head title="DOSTIX" />
    <div class="layout-wrapper landing">
        <section class="section pb-0 position-relative d-flex align-items-center justify-content-center" id="hero">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <b-container v-if="isMobile" class="position-relative text-center" style="z-index: 2;">
                <div class="d-flex flex-column align-items-center pt-0 pb-2" style="min-height: 80vh;">
                    <div class="avatar-border-wrapper mb-2">
                        <img :src="'/images/avatars/'+participant.avatar" alt="user-img" class="img-thumbnail rounded-circle avatar-lg" style="width: 100px; height: 100px; object-fit: cover; z-index: 3;" />
                    </div>
                    <div class="p-2">
                        <h4 class="fs-16 text-primary text-uppercase fw-bold mb-2"> {{ participant.firstname }} {{ participant.middlename }} {{ participant.lastname }}</h4>
                        <p class="fs-13 text-muted mb-0">{{ participant.email }}</p>
                        <p class="fs-13 text-muted">{{ participant.contact_no }}</p>
                    </div>
                    <img :src="participant.qr" class="img-fluid mt-2" style="width: 250px;" alt="QR Code" v-if="!showScanner" />

                    <!-- Switch Button -->
                    <b-form-group class="mt-3">
                        <b-form-checkbox switch v-model="showScanner">
                            {{ showScanner ? 'Switch to My QR Code' : 'Switch to Scanner' }}
                        </b-form-checkbox>
                    </b-form-group>

                    <!-- QR Scanner (if enabled) -->
                    <div v-if="showScanner" style="width: 250px; height: 250px;" class="mt-2">
                        <div id="qr-reader" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </b-container>
        </section>

        <footer class="footer p-2">
            <ul class="nav nav-pills nav-justified card-footer-tabs">
                <li class="nav-item">
                    <Link href="/participant" class="nav-link">
                    <i class="fs-20 ri-home-3-fill"></i>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link href="/exhibits" class="nav-link">
                    <i class="fs-20 ri-file-text-fill"></i>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link href="/qrcode" class="nav-link">
                    <button class="btn btn-primary btn-md position-relative p-0 avatar-md rounded-circle"
                        style="margin-top: -55px;" type="button">
                        <div class="btn-content">
                            <span class="avatar-title bg-transparent text-reset">
                                <i class="fs-24 ri-qr-code-line"></i>
                            </span>
                        </div>
                    </button>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link href="/schedules" class="nav-link">
                    <i class="fs-20 ri-calendar-fill"></i>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link href="/settings" class="nav-link">
                    <i class="fs-20 ri-settings-4-fill"></i>
                    </Link>
                </li>
            </ul>
        </footer>

        <b-button variant="danger" @click="topFunction" class="btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </b-button>
    </div>
</template>

<script>
    import Mobile from './Footer/Mobile.vue';
    import Web from './Footer/Web.vue';
    import { Html5Qrcode } from "html5-qrcode";
    export default {
        components: {
            Mobile,
            Web
        },
        layout: null,
        data() {
            return {
                participant: this.$page.props.participant.data,
                isMobile: false,
                showScanner: false,
                qrScanner: null,
            };
        },
        watch: {
            showScanner(newVal) {
                if (newVal) {
                    this.startScanner();
                } else {
                    this.stopScanner();
                }
            }
        },
        methods: {
            async logout() {
                try {
                    await axios.get('/participant/logout');
                    window.location.href = '/participant/login';
                } catch (error) {
                    console.error('Logout failed:', error);
                }
            },
            topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            },
            checkDevice() {
                this.isMobile = window.innerWidth <= 768;
            },
            async startScanner() {
                await this.$nextTick();
                const config = { fps: 10, qrbox: { width: 200, height: 200 } };
                this.qrScanner = new Html5Qrcode("qr-reader");
                try {
                    await this.qrScanner.start(
                        { facingMode: "environment" },
                        config,
                        (decodedText) => {
                            alert("Scanned QR: " + decodedText);
                            // You can redirect, emit event, or store this
                            this.stopScanner();
                            this.showScanner = false;
                        },
                        (errorMessage) => {
                            console.warn("QR Scan Error", errorMessage);
                        }
                    );
                } catch (err) {
                    console.error("Failed to start scanner", err);
                }
            },
            stopScanner() {
                if (this.qrScanner) {
                    this.qrScanner.stop().then(() => {
                        this.qrScanner.clear();
                        this.qrScanner = null;
                    }).catch(err => {
                        console.error("Failed to stop scanner", err);
                    });
                }
            },
        },
        mounted() {
            let backtoTop = document.getElementById('back-to-top');
            if (backtoTop) {
                window.onscroll = function () {
                    backtoTop.style.display =
                        document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 ?
                        'block' :
                        'none';
                };
            }

            window.addEventListener('scroll', function (ev) {
                ev.preventDefault();
                var navbar = document.getElementById('navbar');
                if (navbar) {
                    if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
                        navbar.classList.add('is-sticky');
                    } else {
                        navbar.classList.remove('is-sticky');
                    }
                }
            });

            this.checkDevice();
            window.addEventListener('resize', this.checkDevice);
        },
        beforeDestroy() {
            this.stopScanner();
            window.removeEventListener('resize', this.checkDevice);
        },
    };

</script>

<style scoped>
    #hero {
        min-height: calc(100vh - 60px);
    }
    #qr-reader {
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
    }
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 60px;
        border-top: 0.1rem solid #e4e2e2;
        background-color: #fff;
        z-index: 10;
    }
    .avatar-border-wrapper {
        position: relative;
        display: inline-block;
        padding: 8px;
        border-radius: 50%;
        background: conic-gradient(yellow 0deg 90deg,
                red 90deg 180deg,
                blue 180deg 270deg,
                green 270deg 360deg);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }
    .avatar-border-wrapper::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(120deg,
                rgba(255, 255, 255, 0.2) 0%,
                rgba(255, 255, 255, 0.6) 50%,
                rgba(255, 255, 255, 0.2) 100%);
        animation: shine 2s infinite;
        transform: rotate(25deg);
    }
    @keyframes shine {
        0% {
            transform: translateX(-100%) rotate(25deg);
        }

        100% {
            transform: translateX(100%) rotate(25deg);
        }
    }
    .avatar-border-wrapper img {
        display: block;
        border-radius: 50%;
        width: 100%;
        position: relative;
        z-index: 1;
    }
</style>
