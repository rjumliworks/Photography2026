<template>
    <div class="card shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-folder-2-fill text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Quick Access</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">
                        <span>
                           View featured folders, normal folders, and your most recently added files.
                        </span>
                    </p>
                </div>
                <div class="flex-shrink-0"></div>
            </div>
        </div>

        <div class="card-body border-bottom bg-white">
            <div class="d-flex mb-0">
                <div class="flex-shrink-0 me-3">
                    <p class="mb-0 text-primary fs-12 fw-semibold">My Folders ({{ folders.length }})</p>
                </div>
                <div class="flex-grow-1"></div>
                <div class="flex-shrink-0">
                    <button v-if="plan.data.status.name != 'Expired'" @click="openCreate()"
                        class="btn btn-sm btn-primary float-end" :disabled="folders.length >= plan.data.plan.folders_limit"
                        style="margin-top: -5px; margin-bottom: -5px;">
                        <i class="ri-add-circle-fill align-bottom"></i> New Folder
                    </button>
                    <button v-else class="btn btn-sm btn-primary float-end" disabled style="margin-top: -5px; margin-bottom: -5px;">
                        <i class="ri-add-circle-fill align-bottom"></i> New Folder
                    </button>
                </div>
            </div>
        </div>

        <!-- Folder list card -->
        <div class="card bg-white shadow-none mb-n4 d-flex" :style="(folders.length > 0) ? 'min-height: 200px;' : 'min-height: 223px;'">

            <div class="p-4 mb-n3 flex-grow-1 d-flex flex-column">
                <!-- Alert -->
                <div class="fs-12 alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mt-n1 material-shadow" 
                    v-if="folders.length >= plan.data.plan.folders_limit" role="alert">
                    <i class="ri-error-warning-line label-icon"></i>
                    <strong>Folder creation limit reached</strong>
                    - Please remove or manage existing folders before creating new ones.
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>

                <!-- Folder list -->
                <div class="row flex-grow-1" id="folderlist-data" v-if="folders.length > 0">
                    <div class="col-xxl-2 col-3 folder-card" v-for="(list,index) in folders" :key="index">
                        <div class="card bg-light shadow-none">
                            <div class="card-body">
                                <div class="d-flex mb-n2">
                                    <div class="form-check form-check-danger mb-3 fs-15 flex-grow-1">
                                        <input class="form-check-input" type="checkbox" :id="`folderlistCheckbox_${index}`">
                                        <label class="form-check-label" :for="`folderlistCheckbox_${index}`"></label>
                                    </div>
                                    <div class="dropdown">
                                        <BDropdown variant="link" toggle-class="btn btn-light btn-sm dropdown" no-caret menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }"> 
                                            <template #button-content> 
                                                <i class="ri-more-2-fill"></i>
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
                                                <a class="dropdown-item d-flex align-items-center text-danger" href="#removeFileItemModal" data-id="1" data-bs-toggle="modal" role="button">
                                                    <i class="ri-delete-bin-6-fill me-2"></i> Move to trash
                                                </a>
                                            </li>
                                        </BDropdown>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="mb-0">
                                        <i class="ri-folder-2-fill align-bottom text-warning display-6"></i>
                                    </div>
                                    <h6 class="fs-12 text-truncate folder-name">{{ list.name }}</h6>
                                </div>
                                <div class="hstack mt-4 text-muted fs-12">
                                    <span class="me-auto"><b>{{ list.count }}</b> Files</span>
                                    <span><b>{{ list.size }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>               
                </div>

                <!-- Empty state -->
                <div v-else class="flex-grow-1 d-flex justify-content-center align-items-center">
                    <div class="p-4 w-auto border rounded bg-light-subtle text-center">
                        <p class="mb-0 text-muted fw-semibold">Looks like your folder list is empty. Create one to get started!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent uploads -->
        <div class="card bg-white border-bottom shadow-none mb-0" :style="{ height: `calc(100vh - ${cardHeight})`, overflow: 'hidden' }">
            <hr class="text-muted"/>
            <div class="d-flex mb-0 ms-3 me-3">
                <div class="flex-shrink-0 me-3">
                    <p class="mb-0 text-primary fs-12 fw-semibold">Recent Uploads</p>
                </div>
                <div class="flex-grow-1"></div>
                <div class="flex-shrink-0"></div>
            </div>
            <hr class="text-muted mb-3"/>
            <div class="table-responsive table-card">
                <table class="table table-nowrap align-middle m-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th style="width: 6%;" class="text-center">#</th>
                            <th>Name</th>
                            <th style="width: 10%;" class="text-center">File Size</th>
                            <th style="width: 15%;" class="text-center">Folder</th>
                            <th style="width: 18%;" class="text-center">Date Created</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody class="table-white fs-12" v-if="files.length > 0">
                        <tr v-for="(list,index) in files" :key="index" @click="selectRow(index)" :class="{ 'bg-info-subtle': selectedRow === index }">
                            <td class="text-center">{{ index + 1 }}.</td>
                            <td>
                                <h5 class="fs-12 mb-0 fw-semibold text-primary">{{ list.name }}</h5>
                                <p class="fs-11 text-muted mb-0">{{ list.path }}</p>
                            </td>
                            <td class="text-center">{{ list.size }}</td>
                            <td class="text-center">{{ list.folder.name }}</td>
                            <td class="text-center">{{ list.created_at }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-center">
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
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="table-white fs-12" v-else>
                        <tr>
                            <td colspan="6" class="text-muted text-center">No files found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <Create ref="create"/>
    <Rename ref="rename"/>
    <Delete ref="delete"/>
    <Detail ref="detail"/>
</template>

<script>
import Create from '../../Folders/Modals/Create.vue';
import Delete from '../../Folders/View/Modals/Delete.vue';
import Rename from '../../Folders/View/Modals/Rename.vue';
import Detail from '../../Folders/View/Modals/Detail.vue';
export default {
    props: ['folders','plan','files'],
    components: { Create, Delete, Rename, Detail },
    data(){
        return {
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
