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
                        <h5 class="mb-0 fw-semibold fs-14"><span class="text-danger">View Schedule</span></h5>
                        <p class="text-muted  fs-12">Stay updated and don’t miss out!</p>
                    </div>
                  
                </div>
            </b-container>
        </nav>
        <section class="section pb-0" style="margin-bottom: 60px; margin-top: 50px; overflow:hidden; height: 100%;" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
           
            <h4 class="fs-14 text-primary text-uppercase fw-bold mb-1 mt-2 text-center"> {{ selected.title }}</h4>
            <p class="fs-14 text-warning fw-semibold mb-1 text-center">{{ selected.event.name }}</p>
            <p class="fs-12 text-muted mb-0 text-center">{{ selected.detail.description }}</p>
            <!-- <p class="fs-13 text-muted">{{ participant.contact_no }}</p> -->
                
            <table class="table table-bordered mt-3">
                <tbody>
                    <tr>
                        <td style="border-right: none; border-left: none;"><span class="fw-semibold text-primary fs-12 ms-2">Session Information</span></td>
                    </tr>
                    <tr>
                        <td style="border-right: none; border-left: none;">
                            <div class="row ms-n2 mb-0">
                                
                                <div class="col-md-12">
                                    <div class="d-flex mt-0">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class=" ri-map-pin-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1 fs-12 text-muted">Venue :</p> 
                                            <h6 class="text-truncate mb-0 fs-12">{{selected.venue.name}}, {{ selected.venue.establishment }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="selected.is_limited">
                                    <div class="d-flex mt-3">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="ri-team-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1 fs-12 text-muted">Capacity :</p> 
                                            <h6 class="text-truncate mb-0 fs-12">{{selected.detail.capacity}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex mt-3">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="ri-calendar-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1 fs-12 text-muted">Date :</p> 
                                            <h6 class="text-truncate mb-0 fs-12">{{dateRangeText}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex mt-3">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i :class="(selected.managers.length > 1) ? 'ri-team-fill' : 'ri-user-3-fill'"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1 fs-12 text-muted">Session Manager :</p> 
                                            <h6 class="mb-0 fs-12">
                                                <div v-for="(manager, index) in selected.managers" :key="index">
                                                    {{ manager.user.profile.firstname }} {{ manager.user.profile.middlename[0] }}. {{ manager.user.profile.lastname }}
                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
             
                     <tr>
                        <td style="border-right: none; border-left: none;"><span class="fw-semibold text-primary fs-12 ms-2">Activities</span></td>
                    </tr>
                    <tr>
                        <td>
                            <template v-for="(activity,index) in selected.activities" v-bind:key="index">
                                <div class="card explore-box card-animate mb-1">
                                    <div class="card-footer border-top border-top-dashed">
                                        <h5 class="fs-12 mb-1 text-uppercase">{{activity.activity}}</h5>
                                        <div class="d-flex align-items-center text-muted">
                                            <div class="flex-grow-1 fs-11"><i class="ri-time-fill text-warning align-bottom me-1"></i> {{activity.start_time }} - {{activity.end_time }}</div>
                                            <span class="flex-shrink-0 fs-11">{{activity.speaker.name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!-- <b-list-group flush> 
                <template v-for="(activity,index) in selected.activities" v-bind:key="index">
                    <Link :href="`/schedule/${session.key}`">
                        <b-list-group-item  class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
                            <div class="blog-box mt-0 mb-2 mb-xl-0">
                                <div class="mt-0  fs-12">
                                    <h6 class="mb-0 text-center text-primary">{{activity.activity}}</h6>
                                    <p class="mb-n3 float-end"><i class="bx bx-calendar me-1"></i>{{activity.start_time }} - {{activity.end_time }}</p>
                                    <p class="text-muted">{{activity.speaker.name}}</p>
                                </div>
                            </div>
                        </b-list-group-item>
                    </Link>
                </template>
            </b-list-group> -->
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
<script>;
export default {
    props:['session'],
    layout: null,
    data(){
        return {
            selected : this.session.data
        }
    },
    methods: {
        topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
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
    },
    computed: {
        dateRangeText() {
            const schedules = this.selected?.schedules || [];

            if (schedules.length === 0) return 'No date';

            let start = schedules[0].date;
            let end = schedules[0].date;

            schedules.forEach(s => {
                if (s.date < start) start = s.date;
                if (s.date > end) end = s.date;
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