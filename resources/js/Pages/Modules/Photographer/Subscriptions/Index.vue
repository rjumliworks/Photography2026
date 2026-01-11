<template>
<Head title="Subscription"/>
<PageHeader title="Subscription Management" pageTitle="List" />
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
                    <!-- <div class="d-flex align-items-center">
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
                    </div> -->
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
                                    <th style="width: 7%;"></th>
                                </tr>
                            </thead>
                            <!-- <tbody class="table-white fs-12">
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
                                    <td>
                                        <div class="d-flex gap-3 justify-content-center"> 
                                            <button type="button" class="btn btn-ghost-primary btn-icon btn-sm material-shadow-none favourite-btn"> 
                                                <i class="ri-download-cloud-fill fs-24 align-bottom"></i> 
                                            </button>
                                            <div class="dropdown"> 
                                                <button class="btn btn-light btn-icon btn-sm dropdown material-shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill align-bottom"></i> </button>
                                                <ul class="dropdown-menu dropdownmenu-primary dropdown-menu-end">
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
                                                </ul>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody> -->
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
</template>
<script>
import _ from 'lodash';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader },
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
    created(){
        this.fetch();
    },
    methods: { 
        fetch(page_url){
            page_url = page_url || '/subscriptions';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
                    count: 10, 
                    option: 'list'
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;          
                }
            })
            .catch(err => console.log(err));
        },
    }
}
</script>