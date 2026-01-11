<template>
    <Head :title="folder.name" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="w-100 p-4 pb-0" ref="box">
            <BRow>
                <BCol lg="12">
                    <BCard no-body class="mt-n4 mx-n4">
                        <div class="bg-info-subtle">
                            <BCardBody class="pb-0 px-4">
                                <BRow class="mb-3">
                                    <BCol md>
                                        <BRow class="align-items-center g-3">
                                            <BCol md="auto">
                                                <div style="height: 3.5rem; width: 3.5rem;">
                                                    <div class="avatar-title bg-white rounded-circle">
                                                        <i class="ri-folder-2-fill text-primary fs-24"></i>
                                                    </div>
                                                </div>
                                            </BCol>
                                            <BCol md>
                                                <div class="ms-2">
                                                    <h4 class="fw-bold">{{ folder.name }}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div><i class="ri-qr-code-fill align-bottom me-1"></i>{{ folder.owner.name }}</div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Size :</span> <span class="fw-medium">{{folder_data.data.size}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Files :</span> <span class="fw-medium">{{folder_data.data.count}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Type : </span> 
                                                            {{ folder.type.name }}
                                                            <!-- <span v-if="folder.is_public" class="fw-medium">Public Folder</span>
                                                            <span v-else class="fw-medium">Private Folder</span> -->
                                                        </div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Date Created :</span> <span class="fw-medium">{{folder.created_at}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Last Modified :</span> <span class="fw-medium">{{folder_data.data.updated_at}}</span></div>
                                                    </div>
                                                </div>
                                            </BCol>
                                        </BRow>
                                    </BCol>
                                    <BCol md="auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button @click="back()" type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                        </div>
                                    </BCol>
                                </BRow>
                            </BCardBody>
                        </div>
                    </BCard>
                </BCol>
                <BCol lg="3">
                    <Sidebar :used="totalUsage" :visibilities="visibilities" :types="types" :percent="percentUsed" :plan="plan.data" :folder="folder_data.data" ref="sidebar"/>
                </BCol>
                <BCol lg="9">
                    <Main :folder="folder_data.data" :plan="plan.data" @size="updateSize" ref="main"/>
                </BCol>
            </BRow>
        </div>
    </div>
</template>
<script>
import Main from './Components/Main.vue';
import Sidebar from './Components/Sidebar.vue';
export default {
    components: { Sidebar, Main },
    props:['folder_data','used','plan','types','visibilities'],
    data(){
        return {
            currentUrl: window.location.origin,
            folder: this.folder_data.data,
            localUsed: { ...this.used }
        }
    },
    computed: {
        totalUsage() {
            return this.convertBytes(this.localUsed.total); 
        },
        percentUsed() {
            const limit = this.plan.data.plan.storage_limit
            if (!limit || limit <= 0) return 0
            return ((this.localUsed.total / limit) * 100).toFixed(2);
        },
    },
    methods: {
        updateSize(data){
            this.localUsed.total = Number(this.localUsed.total) + Number(data);
        },
        back(){
            this.$inertia.visit('/folders');
        },
        convertBytes(bytes) {
            if (!bytes || bytes == 0) return { size: 0, unit: 'B' };

            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return {
                size: parseFloat((bytes / Math.pow(k, i)).toFixed(2)),
                unit: sizes[i]
            };
        }
    }
}
</script>