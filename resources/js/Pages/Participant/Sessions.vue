<template>
<Head title="DOSTIX" />
    <div class="layout-wrapper landing">
        <nav  class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar" style="border-bottom: .1rem solid; border-color: #e4e2e2;">
           <b-container>
                <div class="d-flex pt-3">
                    <div class="flex-shrink-0 me-3">
                        <div style="height:2.5rem;width:2.5rem;">
                            <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                <i class="ri-calendar-todo-fill text-primary fs-24"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-0 fw-semibold fs-14"><span class="text-danger">Exhibitors</span></h5>
                        <p class="text-muted  fs-12">Stay updated and don’t miss out!</p>
                    </div>
                  
                </div>
            </b-container>
        </nav>
        <section class="section pb-0" style="margin-bottom: 60px; margin-top: 50px;" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <b-list-group flush>
                <template v-for="(session,index) in exhibitors.data" v-bind:key="index">
                    
                        <b-list-group-item  class="d-flex justify-content-between align-items-center" style="cursor: pointer;" >
                            <!-- <div class="blog-box mt-2 mb-4 mb-xl-0" >
                                <div class="mt-0  fs-12">
                                    <h6 class="mb-1 fw-semibold text-primary">{{session.title}}</h6>
                                    <p class="text-muted">{{session.area }}</p>
                                    <p class="mb-n3"><i class="ri-team-fill text-primary me-1"></i>{{session.institution }}</p> 
                                </div>
                                <div class="flex-shrink-0 avatar-xs"><div class="avatar-title bg-light rounded-circle"><i class="ri-trophy-fill text-primary"></i></div></div>
                            </div> -->
                            <div class="flex-grow-1">
                                <div class="blog-box mt-2 mb-4 mb-xl-0" >
                                    <div class="mt-0  fs-12">
                                        <h6 class="mb-1 fw-semibold text-primary">{{session.title}}</h6>
                                        <p class="text-muted">{{session.area }}</p>
                                        <p class="mb-n3"><i class="ri-team-fill text-primary me-1"></i>{{session.institution }}</p> 
                                    </div>
                                    <!-- <div class="flex-shrink-0 avatar-xs">
                                        <div class="avatar-title bg-light rounded-circle"><i class="ri-trophy-fill text-primary"></i></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="flex-shrink-0 avatar-sm">
                                <div v-if="index == 1" class="avatar-title bg-warning-subtle rounded-circle"><i class="fs-20 ri-trophy-fill text-warning"></i></div>
                                <div v-else class="avatar-title bg-light rounded-circle"><i class="fs-20 ri-trophy-fill text-primary"></i></div>
                            </div>
                        </b-list-group-item>
                </template>
            </b-list-group>
        </section>
        <footer class="footer p-2" >
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
                        <button class="btn btn-primary btn-md position-relative p-0 avatar-md rounded-circle" style="margin-top: -55px;" type="button">
                            <div class="btn-content">
                                <span class="avatar-title bg-transparent text-reset">
                                    <i class='fs-24 ri-qr-code-line'></i>
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
                        <i class='fs-20 ri-settings-4-fill'></i>
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
export default {
    props:['exhibitors'],
    layout: null,
    data(){
        return {
            participant: this.$page.props.participant.data,
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
        hasParticipant(participants) {
            return participants.some(p => p.participant_id === this.$page.props.participant.data.id);
        },
        topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        dateRange(schedules) {
            if (!schedules || schedules.length === 0) return 'No date';

            let start = schedules[0].date;
            let end = schedules[0].date;

            schedules.forEach(item => {
                if (item.date < start) start = item.date;
                if (item.date > end) end = item.date;
            });

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            };

            return start === end
                ? formatDate(start)
                : `${formatDate(start)} - ${formatDate(end)}`;
        }
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
    }
}
</script>
<style scoped>
    .footer {
        left: 0;
        position: fixed;
        border-top: .1rem solid;
        border-color: #e4e2e2;
    }
</style>