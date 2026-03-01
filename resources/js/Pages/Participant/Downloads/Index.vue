<template>
    <Head title="Downloads"/>
    <PageHeader title="Downloads" pageTitle="Menu" />
    <BRow>
        <div class="col-md-12"> 
                                       

                                        <div class="card bg-light-subtle shadow-none border">
                                            <div class="card-header bg-light-subtle">
                                                <div class="d-flex mb-n3">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div style="height:2rem; width:2rem;">
                                                            <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                                                <i class="ri-file-list-3-line text-primary fs-16"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-0 fs-12" style="margin-top: -3px;"><span class="text-body">List of Folders</span></h5>
                                                        <p class="text-muted fs-11">
                                                            Folders shared to you by photographers that are available to download
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body bg-white rounded-bottom">
                                                <div class="table-responsive table-card" ref="scrollabletable" style="overflow-y:auto; overflow-x:hidden;">
                                                    <table class="table table-nowrap align-middle mb-0">
                                                        <thead class="bg-light thead-fixed">
                                                            <tr class="fs-10">
                                                                <th style="width: 7%;" class="text-center">#</th>
                                                                <th>Name</th>
                                                                <th style="width: 18%;" class="text-center">Size</th>
                                                                <th style="width: 15%;" class="text-center">Files</th>
                                                                <th style="width: 10%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody v-if="viewer.folders">
                                                            <tr v-for="(list,index) in viewer.folders" :key="index">
                                                                <td class="text-center">{{ index + 1 }}</td>
                                                                <td class="text-primary fw-semibold">{{ list.folder.name }}</td>
                                                                <td class="text-center fs-12">{{ list.folder.size}}</td>
                                                                <td class="text-center fs-12">{{ list.folder.count}}</td>
                                                                <td>
                                                                    <button 
                                                                        @click="downloadFolder(list.folder.id)"
                                                                        type="button" 
                                                                        class="btn btn-primary btn-sm btn-label waves-effect waves-light rounded-pill fs-11">
                                                                        <i class="ri-download-cloud-fill label-icon align-middle rounded-pill fs-14 me-2"></i> Download &nbsp;
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody v-else>
                                                            <tr><td colspan="4" class="text-center text-muted fs-11">No folders found.</td></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
    </BRow>
    
</template>
<script>
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader },
    data() {
        return {
            viewer: this.$page.props.viewer,
            currentUrl: window.location.origin,
            lists: [],
        };
    },
   
    methods: {
        downloadFolder(folderId) {
            window.location.href = `/${folderId}/download`
        },
        async logout() {
            try {
                await axios.get('/logout')
                window.location.href = '/viewer/login' // redirect manually after logout
            } catch (error) {
                console.error('Logout failed:', error)
            }
        },
        fetch(page_url){
            page_url = page_url || '/attendance';
            return axios.get(page_url,{
                params : {
                    option: 'list',
                    count: 20,
                }
            })
            .then(response => {
                this.lists = response.data;       
            });
        },
    }
}
</script>
<style>
.table-responsive {
    min-height: 200px;
}
</style>