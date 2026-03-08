<template>
    <div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-folder-2-line text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Subscription History</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">Keep track of your personal and shared folders, organized for quick access and easy management.</p>
                </div>
                <div class="flex-shrink-0" style="width: 45%;">
                    
                </div>
            </div>
        </div>
        
       
        <div class="card-body bg-white rounded-bottom">
            <div class="table-responsive table-card" style="height: calc(100vh - 305px); overflow: auto;">
                <table class="table align-middle table-striped table-centered mb-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th style="width: 3%;"></th>
                            <th>Plane Name</th>
                            <th style="width: 15%;" class="text-center">Start Date</th>
                            <th style="width: 15%;" class="text-center">End Date</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                            <th style="width: 7%;"></th>
                        </tr>
                    </thead>
                    <tbody class="table-white fs-12">
                        <tr v-for="(list,index) in lists" v-bind:key="index" @click="selectRow(index)"
                            :class="{ 'bg-info-subtle': selectedRow === index }">
                            <td class="text-center">{{ (meta.current_page - 1) * meta.per_page + index + 1 }}.</td>
                            <td>
                                <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.name }}</h5>
                                <p class="fs-12 text-muted mb-0">{{list.description}}</p>
                            </td>
                            <td class="text-center">{{ list.size}}</td>
                            <td class="text-center">{{ list.count}}</td>
                            <td class="text-center">{{ list.updated_at }}</td>
                            <td class="text-center">
                                <i class="fs-18" :class="list.type.icon+' '+list.type.color"></i>
                            </td>
                            <td class="text-center">
                                <i v-if="list.is_protected" class="ri-rotate-lock-fill text-primary fs-18"></i>
                                <i v-else class="ri-lock-unlock-line fs-18"></i>
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <BDropdown variant="link" toggle-class="btn btn-light btn-sm " no-caret menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }"> 
                                        <template #button-content> 
                                            <i class="ri-more-fill fs-12 align-bottom"></i>
                                        </template>
                                        <li>
                                            <Link :href="`/folders/${list.code}`" class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-eye-fill me-2"></i> View
                                            </Link>
                                        </li>
                                        <li>
                                            <a @click="openUpdate(list,index)" class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-edit-2-fill me-2"></i> Update
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" role="button">
                                                <i class="ri-download-2-fill me-2"></i> Download
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a @click="openDelete(list,index)" class="dropdown-item d-flex align-items-center text-danger" href="#removeFileItemModal" data-id="1" data-bs-toggle="modal" role="button">
                                                <i class="ri-delete-bin-6-fill me-2"></i> Move to trash
                                            </a>
                                        </li>
                                    </BDropdown>
                                </div>
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
</template>

<script>
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    props: ['folders','plan','files'],
    components: { Pagination },
    data(){
        return {
            lists: [],
            meta: {},
            links: {},
            selectedRow: null,
            index: null
        }
    },
    computed: {
  cardHeight() {
    return this.folders.length >= this.plan.data.plan.folders_limit
      ? '554px'
      : '498px';
  }
},
    methods: { 
        openCreate(){
            this.$refs.create.show();
        },
        openUpdate(list, index){
            console.log('update folder', list, index);
        },
        selectRow(index){
            this.selectedRow = index;
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
    }
}
</script>
<style>
    .dropdown-front {
    z-index: 9999;
}
</style>
