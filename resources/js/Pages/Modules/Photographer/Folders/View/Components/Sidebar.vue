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
        <div class="card-body bg-white rounded-bottom border-bottom">
            <div class="d-flex mb-n2">
                <div class="flex-shrink-0 me-3">
                    <p class="mb-0 text-primary fs-12 fw-semibold">Viewers</p>
                </div>
                <div class="flex-grow-1 mt-n1">
                    <i @click="openViewer()" class="ri-add-circle-fill float-end text-muted fs-20" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>     
        <div class="card bg-white shadow-none mb-0" style="height: 150px; overflow: hidden;">
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-3">
                <li class="mt-2 ms-2" v-for="(list,index) in folder.viewers" v-bind:key="index">
                   {{list.viewer.email}}
                </li>
            </ul>
        </div>
        <!-- <div class="card-body bg-white rounded-bottom border-bottom border-top">
            <div class="d-flex mb-n2">
                <div class="flex-shrink-0 me-3">
                    <p class="mb-0 text-primary fs-12 fw-semibold">Tags</p>
                </div>
                <div class="flex-grow-1 mt-n1">
                    <i @click="openTag()" class="ri-add-circle-fill float-end text-muted fs-20" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
        <div class="card bg-white shadow-none mb-0" style="height: 160px; overflow: hidden;">
            <div class="d-flex flex-wrap gap-2 p-3 mb-n3">
                <span v-if="folder.tags.length > 0" class="badge bg-secondary" v-for="(list,index) in folder.tags" v-bind:key="index">{{ list.name }}</span>
                <span v-else class="badge bg-light text-dark">Add Tag now</span>
            </div>
            <hr class="text-muted"/>
                <div class="d-flex mb-n2 ms-3 me-3">
                    <div class="flex-shrink-0 me-3">
                        <p class="mb-0 text-primary fs-12 fw-semibold">Password Protected</p>
                    </div>
                    <div class="flex-grow-1 mt-n1" v-if="folder.owner.id == $page.props.user.data.id">
                        <i v-if="folder.is_protected" @click="viewPassword(folder.password)" class="ri-eye-fill float-end text-muted fs-20" style="cursor: pointer;"></i>
                        <i v-else @click="openPassword(folder.owner)" class="ri-add-circle-fill float-end text-muted fs-20" style="cursor: pointer;"></i>
                    </div>
                </div>
            <hr class="text-muted mb-1"/>
            <div class="ps-3 pe-3 pt-2 mt-1">
                <div v-if="folder.is_protected" class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-12" role="alert">
                    <i class="ri-lock-fill label-icon"></i>
                    This folder is password protected.
                </div>
                <div v-else class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-12" role="alert">
                    <i class="ri-information-line label-icon"></i>
                    This folder is not password protected.
                </div>
            </div>
        </div> -->
        <div class="card bg-white rounded-bottom shadow-none mb-0" style="height: calc(100vh - 545px); overflow: auto;">
            <hr class="text-muted"/>
                <div class="d-flex mb-n2 ms-3 me-3">
                    <div class="flex-shrink-0 me-3">
                        <p class="mb-0 text-primary fs-12 fw-semibold">Who has access</p>
                    </div>
                    <div class="flex-grow-1 mt-n1" v-if="folder.owner.id == $page.props.user.data.id">
                        <i @click="openAccess(folder.owner)" class="ri-add-circle-fill float-end text-muted fs-20" style="cursor: pointer;"></i>
                    </div>
                </div>
            <hr class="text-muted mb-1"/>
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-3">
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <img :src="folder.owner.avatar" alt="" class="avatar-xs rounded-circle">
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{folder.owner.name}} <span v-if="$page.props.user.data.name == folder.owner.name" class="text-muted fs-11">(you)</span></h6>
                            <p class="fs-11 mb-0 text-muted">{{ folder.owner.email }}</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="text-muted mt-2 me-2 fs-12">Owner</h6>
                        </div>
                    </div>
                </li>
                <li class="list-group-item px-0" v-for="(list,index) in folder.shares" v-bind:key="index">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <img :src="'/storage/'+list.avatar" alt="" class="avatar-xs rounded-circle">
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{list.name}}</h6>
                            <p class="fs-11 mb-0 text-muted">{{ list.email }}</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="text-muted mt-2 me-2 fs-12">{{ list.type.name }}</h6>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="mt-auto p-4">
                <h6 class="fs-11 text-muted text-uppercase mb-3">Storage Status</h6>
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fs-17" :class="progressIcon"></i>
                    </div>
                    <div class="flex-grow-1 ms-3 overflow-hidden">
                        <div class="progress mb-2 progress-sm">
                            <div class="progress-bar" :class="progressBarClass" role="progressbar" :style="{ width: percent + '%' }" :aria-valuenow="percent"  aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="text-muted fs-10 d-block text-truncate">
                            {{folder.size}} of <b>{{ used.size }}</b> {{ used.unit }} used in this folder ({{ percent }}%) out of <b>{{ plan.plan.storage_size }}</b> {{ plan.plan.storage_unit }} plan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Tag :folder_tags="folder.tags" ref="tag"/>
    <Password ref="password"/>
    <ViewPassword ref="view"/>
    <Viewer ref="viewer"/>
    <Access :types="types" :type="folder.type" :visibilities="visibilities" :shares="folder.shares" ref="access"/>
</template>
<script>
import Tag from '../Modals/Tag.vue';
import Viewer from '../Modals/Viewer.vue';
import Access from '../Modals/Access.vue';
import Password from '../Modals/Password.vue';
import ViewPassword from '../Modals/ViewPassword.vue';
export default {
    props:['folder','used','plan','percent','types','visibilities'],
    components: { Tag, Access, Password, ViewPassword, Viewer },
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