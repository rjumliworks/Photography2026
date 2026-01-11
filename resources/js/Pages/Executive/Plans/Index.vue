<template>
<Head title="Plans"/>
<PageHeader title="Plan Management" pageTitle="List" />
    <BRow>
        <div class="col-md-12">
            <div class="card bg-light-subtle shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-price-tag-3-line text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">List of Plans</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">A complete masterlist of subscription plans created by the administrator, including details and configurations.</p>
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
                                <input type="text" v-model="filter.keyword" placeholder="Search Plan" class="form-control" style="width: 20%;">
                                <!-- <Multiselect v-if="filter.division" class="white" style="width: 11%;" :options="units" v-model="filter.unit" label="short" :searchable="true" placeholder="Select Unit" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.divisions" v-model="filter.division" label="others" :searchable="true" placeholder="Select Division" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.stations" v-model="filter.station" label="others" :searchable="true" placeholder="Select Stations" />
                                <Multiselect class="white" style="width: 13%;" :options="dropdowns.statuses" v-model="filter.status" label="name" :searchable="true" placeholder="Select Status" /> -->
                                <span @click="refresh()" class="input-group-text" v-b-tooltip.hover title="Refresh" style="cursor: pointer;"> 
                                    <i class="bx bx-refresh search-icon"></i>
                                </span>
                                <b-button type="button" variant="primary" @click="openCreate">
                                    <i class="ri-add-circle-fill align-bottom me-1"></i> Create
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
                                    <BLink @click="viewStatus(null,null)" class="nav-link py-3 active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-apps-2-line me-1 align-bottom"></i> All Plans
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
                                    <th style="width: 10%;" class="text-center">Storage Size</th>
                                    <th style="width: 10%;" class="text-center">Folders Limit</th>
                                    <th style="width: 10%;" class="text-center">Monthly</th>
                                    <th style="width: 10%;" class="text-center">Yearly</th>
                                    <th style="width: 10%;" class="text-center">Status</th>
                                    <th style="width: 6%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-white fs-12">
                                <tr v-for="(list,index) in lists" v-bind:key="index" @click="selectRow(index)"
                                 :class="filter.status === null ? {
                                    'bg-info-subtle': selectedRow === index,
                                    'bg-danger-subtle': list.organization.status.name === 'Retired',
                                } : ''">
                                    <td class="text-center">{{ (meta.current_page - 1) * meta.per_page + index + 1 }}.</td>
                                    <td>
                                        <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.name }}</h5>
                                        <p class="fs-12 text-muted mb-0">{{list.description}}</p>
                                    </td>
                                    <td class="text-center">{{ list.storage_size }} {{ list.storage_unit }}</td>
                                     <td class="text-center">{{ list.folders_limit }}</td>
                                    <td class="text-center">
                                        {{ list.pricings.find(p => p.billing_cycle === 'Yearly')?.currency.symbol }}{{
                                            list.pricings.find(p => p.billing_cycle === 'Monthly')?.amount 
                                                ? list.pricings.find(p => p.billing_cycle === 'Monthly').amount 
                                                : '-'
                                        }}
                                    </td>

                                    <!-- Yearly -->
                                    <td class="text-center">
                                       {{ list.pricings.find(p => p.billing_cycle === 'Yearly')?.currency.symbol }}{{
                                            list.pricings.find(p => p.billing_cycle === 'Yearly')?.amount
                                            ? list.pricings.find(p => p.billing_cycle === 'Yearly').amount 
                                            : '-'
                                        }}
                                    </td>

                                    <td class="text-center">
                                        <span v-if="list.is_active" class="badge bg-success">Active</span>
                                        <span v-else class="badge bg-secondary">Inactive</span>
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary">Edit</button>
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
    <Create :currencies="currencies" ref="create"/>
</template>
<script>
import _ from 'lodash';
import Create from './Modals/Create.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create },
    props: ['currencies'],
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
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url){
            page_url = page_url || '/plans';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
                    expense: this.filter.expense,
                    status: this.filter.status,
                    mode: this.filter.mode,
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
        }
    }
}
</script>