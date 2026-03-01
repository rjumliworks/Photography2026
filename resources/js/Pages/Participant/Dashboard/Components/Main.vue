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
                    <p class="mb-0 text-primary fs-12 fw-semibold">Shared Folders ({{ folders.length }})</p>
                </div>
                <div class="flex-grow-1"></div>
                <div class="flex-shrink-0">
                   
                </div>
            </div>
        </div>
        <div class="card bg-white mb-n4 d-flex" style="height: calc(100vh - 400px);">

            <div class="p-4 mb-n3 flex-grow-1 d-flex flex-column">
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
                                                <a @click="openDetail(list,index)" class="dropdown-item d-flex align-items-center" role="button">
                                                    <i class="ri-information-fill me-2"></i> Details
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a @click="downloadFolder(list.id)" class="dropdown-item d-flex align-items-center" role="button">
                                                    <i class="ri-download-2-fill me-2"></i> Download
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

    </div>
    <Detail ref="detail"/>   
</template>

<script>
import Detail from './Modals/Main/Detail.vue';
export default {
    components: { Detail },
    props: ['folders'],
    data(){
        return {
            selectedRow: null,
            index: null
        }
    },
    methods: { 
        openDetail(list,index){
            this.$refs.detail.show(list);
            this.index = index;
        },
        downloadFolder(folderId) {
            window.location.href = `/${folderId}/download`
        },
    }
}
</script>
<style>
    .dropdown-front {
    z-index: 9999;
}
</style>
