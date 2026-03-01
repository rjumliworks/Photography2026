<template>
<div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-information-line text-primary fs-20"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Folder Overview</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">Quick summary of your folders and their contents.</p>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom bg-white">
            <p class="mb-0 text-primary fs-12 fw-semibold">Folder Information </p>
        </div>
        <div class="card bg-white border-bottom shadow-none mb-0" style="height: calc(100vh - 390px); overflow-x: hidden;">
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-3">
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-folder-2-fill text-warning fs-17"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">Folder Size</h6>
                            <p class="fs-11 mb-0 text-muted">You can create up to folders with your plan</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mt-2 me-2 fs-12">{{ folder.size }}</h6>
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
                <div class="col-md-12">
                    <div class="d-flex border border-dashed rounded p-2">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-2">
                            <div class="avatar-title bg-light rounded-circle fs-14 text-primary"><i class="ri-calendar-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-0 text-muted fs-10">Date Created :</p>
                            <h6 class="text-truncate fw-semibold fs-11 mb-0">{{ folder.created_at  }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex border border-dashed rounded p-2">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-2">
                            <div class="avatar-title bg-light rounded-circle fs-14 text-primary"><i class="ri-calendar-line"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-0 text-muted fs-10">Last Modified :</p>
                            <h6 class="text-truncate fw-semibold fs-11 mb-0">{{ folder.created_at }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['folder','used'],
    data(){
        return {
            currentUrl: window.location.origin,
        }
    },
    computed: {
        progressBarClass() {
            if (this.percent >= 90) {
                return 'bg-danger';
            } else if (this.percent >= 70) {
                return 'bg-warning';
            }
                return 'bg-success';
        },
        progressIcon() {
            if (this.percent >= 90) {
                return 'ri-alert-fill text-danger';
            } else if (this.percent >= 70) {
                return 'ri-error-warning-fill text-warning';
            }
                return 'ri-database-2-line';
        }
    },
    methods: {
        openTag(){
            (this.folder.tags.length > 0) ? this.$refs.tag.edit(this.folder.id) : this.$refs.tag.show(this.folder.id);
        },
        openViewer(){
            this.$refs.viewer.show(this.folder.id);
        },
        openAccess(owner){
            this.$refs.access.show(this.folder.id,owner);
        },
        openPassword(){
            this.$refs.password.show(this.folder.id);
        },
        viewPassword(data){
            console.log(data);
            this.$refs.view.show(data);
        }
    }
}
</script>