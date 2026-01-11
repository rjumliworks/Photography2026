<template>
<Head title="Folders"/>
<PageHeader title="Folder Management" pageTitle="List" />
    <BRow>
        <div class="col-md-12">
            <div class="card bg-light-subtle shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-file-line text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">My Files</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">Keep track of your personal and shared folders, organized for quick access and easy management.</p>
                        </div>
                        <div class="flex-shrink-0" style="width: 45%;">
                           
                        </div>
                    </div>
                </div>
                <div class="car-body bg-white border-bottom shadow-none">
                    <b-row class="mb-2 ms-1 me-1" style="margin-top: 12px;">
                        <b-col lg>
                            <div class="input-group mb-1">
                                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                                <input type="text" v-model="filter.keyword" placeholder="Search Folder" class="form-control" style="width: 20%;">
                                <!-- <Multiselect v-if="filter.division" class="white" style="width: 11%;" :options="units" v-model="filter.unit" label="short" :searchable="true" placeholder="Select Unit" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.divisions" v-model="filter.division" label="others" :searchable="true" placeholder="Select Division" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.stations" v-model="filter.station" label="others" :searchable="true" placeholder="Select Stations" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.statuses" v-model="filter.status" label="name" :searchable="true" placeholder="Select Status" /> -->
                                <span @click="refresh()" class="input-group-text" v-b-tooltip.hover title="Refresh" style="cursor: pointer;"> 
                                    <i class="bx bx-refresh search-icon"></i>
                                </span>
                                <b-button type="button" variant="primary" @click="openCreate">
                                    <i class="ri-add-circle-fill align-bottom me-1"></i> New Folder
                                </b-button>
                            </div>
                        </b-col>
                    </b-row>
                </div>
                <div class="card bg-white border-bottom shadow-none" no-body>
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <ul class="nav nav-tabs nav-tabs-custom nav-primary fs-12" role="tablist">
                                <li class="nav-item">
                                    <BLink @click="selectView('all')" class="nav-link py-3 active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-apps-2-line me-1 align-bottom"></i> All Files
                                    </BLink>
                                </li>
                                <!-- <li class="nav-item" v-for="(list,index) in counts" v-bind:key="index">
                                    <BLink @click="viewStatus(index,list.value)" class="nav-link py-3" :class="(this.index == index) ? 'text-primary active' : ''" data-bs-toggle="tab" role="tab" aria-selected="false">
                                        <i :class="list.icon" class="me-1 align-bottom"></i>
                                        {{ list.name }} 
                                        <BBadge v-if="list.count > 0" :class="(this.index == index) ? 'bg-primary text-white' : 'text-dark bg-primary-subtle'" class="align-middle ms-1">{{list.count}}</BBadge>
                                    </BLink>
                                </li> -->
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2 mt-3">
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="table-responsive table-card" style="margin-top: -39px; height: calc(100vh - 465px); overflow: auto;">
                        <table class="table align-middle table-striped table-centered mb-0">
                            <thead class="table-light thead-fixed">
                                <tr class="fs-11">
                                    <th style="width: 3%;"></th>
                                    <th>Name</th>
                                    <th style="width: 6%;" class="text-center">File size</th>
                                    <th style="width: 12%;" class="text-center">Last Opened</th>
                                    <th style="width: 12%;" class="text-center">Date Created</th>
                                    <th style="width: 7%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-white fs-12">
                                <tr v-for="(list,index) in lists" v-bind:key="index" @click="selectRow(index)"
                                 :class="{ 'bg-info-subtle': selectedRow === index }">
                                    <td class="text-center">{{ (meta.current_page - 1) * meta.per_page + index + 1 }}.</td>
                                    <td>
                                        <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.name }}</h5>
                                        <p class="fs-12 text-muted mb-0">{{list.folder.name}}</p>
                                    </td>
                                    <td class="text-center">{{ list.size}}</td>
                                    <td class="text-center">{{ (list.opened_at) ? list.opened_at : '-' }}</td>
                                    <td class="text-center">{{ list.created_at }}</td>
                                    <td class="text-end">
                                        <BDropdown
                                        variant="link"
                                        toggle-class="btn btn-light btn-sm dropdown"
                                        no-caret
                                        boundary="viewport"
                                        menu-class="dropdown-menu-end dropdown-front"
                                        :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }"
                                    >
                                        <template #button-content> 
                                            <i class="ri-more-fill"></i>
                                        </template>
                                        <li>
                                            <a :href="'/storage/' + list.path" class="glightbox dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-eye-line me-2"></i> Preview
                                            </a>
                                        </li>
                                        <li>
                                            <a @click="openDetail(list,index)" class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-information-line me-2"></i> Details
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                            <li>
                                            <a @click="openRename(list,index)" class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-edit-2-line me-2"></i> Rename
                                            </a>
                                        </li>
                                        <li>
                                            <a :href="`/files?id=${list.id}&option=download`" target="_blank" class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-download-2-line me-2"></i> Download
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a @click="openDelete(list,index)" class="dropdown-item d-flex align-items-center text-danger" href="#removeFileItemModal" data-id="1" data-bs-toggle="modal" role="button">
                                                <i class="ri-delete-bin-6-line me-2"></i> Move to trash
                                            </a>
                                        </li>
                                        </BDropdown>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <Pagination class="ms-2 me-2 mt-n1" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
                </div>
            </div>
        </div>
    </BRow>
    <Rename ref="rename"/>
    <Delete ref="delete"/>
    <Detail ref="detail"/>
</template>
<script>
import _ from 'lodash';
import Rename from '../Folders/View/Modals/Rename.vue';
import Detail from '../Folders/View/Modals/Detail.vue';
import Delete from '../Folders/View/Modals/Delete.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination },
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null
            },
            type: null,
            index: null,
            selectedRow: null
        }
    },
    watch: {
        "type"(newVal) {
            if(newVal){
                if(newVal != 'all'){
                    this.type = newVal;
                }else{
                    this.type = null;
                }
                this.fetch();
            }
        },
    },
    created(){
        this.fetch();
    },
    methods: { 
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url){
            page_url = page_url || '/files';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
                    type: this.type,
                    count: 10, 
                    option: 'lists'
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
        openCreate(){
            this.$refs.create.show();
        },
        openUpdate(data,index){
            this.index = index;
            this.$refs.create.edit(data);
        },
        openRename(list,index){
            this.$refs.rename.show(list);
            this.index = index;
        },
        openDelete(list,index){
            this.$refs.delete.show(list);
            this.index = index;
        },
        openDetail(list,index){
            this.$refs.detail.show(list);
            this.index = index;
        },
        selectView(data){
            this.type = data;
        },
        selectRow(index) {
            this.selectedRow = index;
        },
        updateRow(data){
            this.lists[this.index] = data;
        }
    }
}
</script>