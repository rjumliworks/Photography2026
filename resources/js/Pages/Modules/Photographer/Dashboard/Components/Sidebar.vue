<template>
    <div class="card shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i :class="[plan.data.plan.icon, 'fs-24', plan.data.status.name === 'Expired' ? 'text-danger' : 'text-primary']"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span :class="[plan.data.status.name === 'Expired' ? 'text-danger' : '']">{{ plan.data.plan.name }}</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">
                        <span v-if="timeLeft.total > 0">
                            {{ timeLeft.days }}d {{ timeLeft.hours }}h {{ timeLeft.minutes }}m {{ timeLeft.seconds }}s remaining
                        </span>
                        <span v-else>
                            Expired
                        </span>
                    </p>
                </div>
                <div class="flex-shrink-0"></div>
            </div>
        </div>
        <div class="card-body border-bottom bg-white">
            <p class="mb-0 text-primary fs-12 fw-semibold">Storage Status : </p>
        </div>
        <div class="card bg-white border-bottom shadow-none mb-0" style="height: calc(100vh - 300px); overflow-x: hidden;">
            <div class="p-4 mb-n4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0"><i :class="progressIcon" class="fs-17"></i></div>
                    <div class="flex-grow-1 ms-3 overflow-hidden">
                        <div class="progress mb-2 progress-sm">
                            <div class="progress-bar" :class="progressBarClass" role="progressbar" :style="{ width: percentUsed + '%' }" :aria-valuenow="percentUsed"  aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="text-muted fs-12 d-block text-truncate"><b>{{ used.total.size }}</b> {{ used.total.unit }} of <b>{{ plan.data.plan.storage_size }}</b> {{ plan.data.plan.storage_unit }} used ({{ percentUsed }}%)</span>
                    </div>
                </div>
            </div>
            <hr class="text-muted"/>
                <p class="ms-3 mb-0 text-primary fs-12 fw-semibold">Storage Overview</p>
            <hr class="text-muted mb-2"/>
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-3">
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-folder-2-fill text-warning fs-17"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">Folder Capacity</h6>
                            <p class="fs-11 mb-0 text-muted">You can create up to {{ plan.data.plan.folders_limit }} folders with your plan</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mt-2 me-2 fs-12">{{ folder_count }} of {{ plan.data.plan.folders_limit }}</h6>
                        </div>
                    </div>
                </li>
                <li class="list-group-item px-0" v-for="(list,index) in used.types" v-bind:key="index">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i :class="list.icon+' '+list.color" class="fs-17"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{list.label}}</h6>
                            <p class="fs-11 mb-0 text-muted">{{ list.count }} {{ list.description }}</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mt-2 me-2 fs-12">{{list.data.size}} {{list.data.unit}}</h6>
                        </div>
                    </div>
                </li>
            </ul>
            <hr class="text-muted"/>
                <p class="ms-3 mb-0 text-primary fs-12 fw-semibold">Subscription Overview</p>
            <hr class="text-muted mb-2"/>
            <div class="row g-2 pe-3 ps-3 pt-2">
                <div class="col-md-6">
                    <div class="d-flex border border-dashed rounded p-2">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-2">
                            <div class="avatar-title bg-light rounded-circle fs-14 text-primary"><i class="ri-calendar-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-0 text-muted fs-10">{{ (plan.data.plan.name == '7-Day Free Trial') ? 'Trial Start' : 'Subscription Start'}} :</p>
                            <h6 class="text-truncate fw-semibold fs-11 mb-0">{{ plan.data.start }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex border border-dashed rounded p-2">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-2">
                            <div class="avatar-title bg-light rounded-circle fs-14 text-primary"><i class="ri-calendar-line"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-0 text-muted fs-10">{{ (plan.data.plan.name == '7-Day Free Trial') ? 'Trial Ends' : 'Subscription End'}} :</p>
                            <h6 class="text-truncate fw-semibold fs-11 mb-0">{{ plan.data.end }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3 mt-auto" v-if="plan.data.plan.name == '7-Day Free Trial'">
                <div class="alert alert-danger d-flex align-items-center mb-0">
                    <div class="flex-shrink-0">
                        <i class="ri-cloud-line text-danger align-bottom display-6"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="text-danger fs-13 mb-0">Upgrade to Pro</h5>
                        <p class="text-muted mb-0 fs-11">Get more space for your...</p>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <button class="btn btn-sm btn-danger float-end"><i class="ri-upload-cloud-line align-bottom"></i> Upgrade Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['plan','used','folder_count'],
    data() {
        return {
            timeLeft: {
                total: 0,
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0
            },
            timer: null
        }
    },
    computed: {
        percentUsed() {
            const limit = this.plan.data.plan.storage_limit
            if (!limit || limit <= 0) return 0
            return Math.round((this.used.total.bytes / limit) * 100)
        },
        progressBarClass() {
            if (this.percentUsed >= 90) {
                return 'bg-danger';
            } else if (this.percentUsed >= 70) {
                return 'bg-warning';
            }
                return 'bg-success';
        },
        progressIcon() {
            if (this.percentUsed >= 90) {
                return 'ri-alert-fill text-danger';
            } else if (this.percentUsed >= 70) {
                return 'ri-error-warning-fill text-warning';
            }
                return 'ri-database-2-line';
        }
    },
    mounted() {
        this.updateCountdown()
        this.timer = setInterval(this.updateCountdown, 1000)
    },
    beforeUnmount() {
        clearInterval(this.timer)
    },
    methods: {
        updateCountdown() {
            const now = new Date().getTime()
            const endTime = new Date(this.plan.data.end).getTime() // 👈 use plan.end here
            const diff = endTime - now

            if (diff <= 0) {
                this.timeLeft = { total: 0, days: 0, hours: 0, minutes: 0, seconds: 0 }
                clearInterval(this.timer)
                return
            }

            this.timeLeft = {
                total: diff,
                days: Math.floor(diff / (1000 * 60 * 60 * 24)),
                hours: Math.floor((diff / (1000 * 60 * 60)) % 24),
                minutes: Math.floor((diff / (1000 * 60)) % 60),
                seconds: Math.floor((diff / 1000) % 60)
            }
        }
    }
}
</script>
