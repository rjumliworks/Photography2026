<template>
<Head title="Trash"/>
<PageHeader title="Trash Management" pageTitle="List" />
    <BRow>
        <div class="col-md-12">
            <div class="card bg-light-subtle shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-delete-bin-line text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">My Trash</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">Deleted files and folders are stored here. You can restore them or permanently delete them from your account.</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                           <div class="list-grid-nav hstack gap-1">
                                <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button material-shadow-none"><i class="ri-grid-fill"></i></button>
                                <button type="button" id="list-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button material-shadow-none"><i class="ri-list-unordered"></i></button>
                                <button class="btn btn-danger"><i class="ri-delete-bin-fill me-1"></i> Empty Trash</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white border-bottom shadow-none">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fs-24" :class="progressIcon"></i>
                        </div>
                        
                        <div class="flex-grow-1 ms-3 overflow-hidden">
                            <div class="progress progress-xl">
                                <div class="progress-bar bg-danger"
                                    role="progressbar"
                                    :style="{ width: storage.deleted_percent + '%' }"
                                    :aria-valuenow="storage.deleted_percent">
                                </div>
                                <div class="progress-bar bg-secondary"
                                    role="progressbar"
                                    :style="{ width: storage.used_percent + '%' }"
                                    :aria-valuenow="storage.used_percent">
                                </div>
                                <div class="progress-bar bg-dark-subtle"
                                    role="progressbar"
                                    :style="{ width: storage.free_percent + '%' }"
                                    :aria-valuenow="storage.free_percent">
                                </div>
                            </div>
                            <span class="text-muted fs-12 d-block text-truncate mt-2">
                                <i class="ri-record-circle-fill text-danger me-1 fs-14"></i><b>{{ formatBytes(storage.deleted) }}</b> in Trash, 
                                <i class="ri-record-circle-fill text-secondary me-1 ms-1 fs-14"></i><b>{{ formatBytes(storage.used) }}</b> used, 
                                <i class="ri-record-circle-fill text-dark-subtle me-0 ms-1 fs-14"></i> <b>{{ formatBytes(storage.free) }}</b> free out of 
                                <b>{{ formatBytes(storage.plan) }}</b> plan.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card bg-white border-bottom shadow-none" no-body>
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <ul class="nav nav-tabs nav-tabs-custom nav-primary fs-12" role="tablist">
                                <li class="nav-item">
                                    <BLink @click="viewStatus(null,null)" class="nav-link py-3 active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-apps-2-line me-1 align-bottom"></i> All Items
                                    </BLink>
                                </li>
                                <li class="nav-item">
                                    <BLink @click="viewStatus(null,null)" class="nav-link py-3 " data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-folder-5-line me-1 align-bottom"></i> Folders Only
                                    </BLink>
                                </li>
                                <li class="nav-item">
                                    <BLink @click="viewStatus(null,null)" class="nav-link py-3 " data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-file-line me-1 align-bottom"></i> Files Only
                                    </BLink>
                                </li>
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2 mt-3">
                              
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body bg-white rounded-bottom">
                    <div class="table-responsive table-card" style="margin-top: -39px; height: calc(100vh - 499px); overflow: auto;"  v-if="data.length > 0">
                        <table class="table align-middle table-striped table-centered mb-0">
                            <thead class="table-light thead-fixed">
                                <tr class="fs-11">
                                    <th style="width: 3%;"></th>
                                    <th>Name</th>
                                    <th style="width: 6%;" class="text-center">Size</th>
                                    <th style="width: 14%;" class="text-center">Date Trashed</th>
                                    <th style="width: 3%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-white fs-12">
                                <tr v-for="(list,index) in data" v-bind:key="index" @click="selectRow(index)"
                                 :class="{ 'bg-info-subtle': selectedRow === index }">
                                    <td class="text-center">
                                        <i v-if="list.type == 'folder'" class="ri-folder-fill text-warning fs-20"></i>
                                        <i v-else-if="list.type == 'image'" class="ri-image-fill text-secondary fs-20"></i>
                                        <i v-else class="ri-movie-fill text-success fs-20"></i>
                                    </td>
                                    <td>
                                        <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.name }}</h5>
                                    </td>
                                    <td class="text-center">{{ list.size}}</td>
                                    <td class="text-center">{{ list.deleted_at }}</td>
                                    <td class="text-end">
                                          <BDropdown variant="link" class="float-end dropdown" toggle-class="btn btn-light btn-sm" no-caret data-bs-container="body" data-bs-display="static" menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }"> 
                                            <template #button-content> 
                                                <i class="ri-more-2-fill"></i>
                                            </template>
                                                <li>
                                                    <a :href="'/storage/' + list.path" class="glightbox dropdown-item d-flex align-items-center" role="button">
                                                        <i class="ri-eye-line me-2"></i> Preview
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a @click="openRestore(list,index)" class="dropdown-item d-flex align-items-center" href="#removeFileItemModal" data-id="1" data-bs-toggle="modal" role="button">
                                                        <i class="ri-history-fill me-2"></i> Restore
                                                    </a>
                                                </li>
                                                <li>
                                                    <a @click="openDelete(list,index)" class="dropdown-item d-flex align-items-center text-danger" href="#removeFileItemModal" data-id="1" data-bs-toggle="modal" role="button">
                                                        <i class="ri-delete-bin-6-line me-2"></i> Delete Permanently
                                                    </a>
                                                </li>
                                                </BDropdown>
                                                
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: -39px; height: calc(100vh - 515px); overflow: auto;" v-else class="flex-grow-1 d-flex justify-content-center align-items-center">
                        <div class="p-4 w-auto border rounded bg-light-subtle text-center">
                            <p class="mb-0 text-muted"><b>Trash is empty</b><br /> <span class="text-muted fs-12">You have not deleted any files or folders yet.</span></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-xl-0 material-shadow fs-12" role="alert">
                        <i class="ri-error-warning-line label-icon"></i>Items in the trash will be permanently deleted after 30 days and cannot be recovered.
                    </div>
                </div>
            </div>
        </div>
    </BRow>
    <Delete ref="delete"/>
    <Restore ref="restore"/>
</template>
<script>
import _ from 'lodash';
import Delete from './Modals/Delete.vue';
import Restore from './Modals/Restore.vue';
import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.min.css";
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    props: ['data','storage'],
    components: { PageHeader, Delete, Restore },
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null
            },
            index: null,
            selectedRow: null
        }
    },
    mounted() {
        GLightbox({
            selector: ".glightbox",
            touchNavigation: true,
            loop: true,
            zoomable: true,
        });
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
        selectRow(index) {
            this.selectedRow = index;
        },
        updateRow(data){
            this.lists[this.index] = data;
        },
        openRestore(data){
            this.$refs.restore.show(data);
        },
        openDelete(data){
            this.$refs.delete.show(data);
        },
        formatBytes(bytes) {
            if (bytes === 0) return "0 B";
            const k = 1024;
            const sizes = ["B", "KB", "MB", "GB", "TB"];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
        }
    }
}
</script>