<template>
    <Head title="Date Time Record"/>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer style="width: 800px;">

                <BRow class="justify-content-center">
                    <div class="col-lg-12">
                  
                        <div class="card border bg-white">
                            <div class="card-header bg-primary">
                                <div class="d-flex mb-n2">
                                    <div class="flex-shrink-0 me-3">
                                        <div style="height:2.5rem;width:2.5rem;">
                                        <img src="@assets/images/logo-sm.png" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 mt-2 fs-14 fw-semibold text-uppercase text-white" style="font-size: 10.7px"> TasweerHub</h5>
                                        <p class="text-white fs-11"><span class="fw-semibold">Please <span class="text-info">Login</span> to continue</span></p>
                                    </div>
                                    <div class="flex-shrink-0 ms-auto text-end">
                                     <button @click="logout" class="btn btn-primary"><i class="ri-add-fill me-1 align-bottom"></i>Upload</button>
                                        <!-- <h5 class="mb-0 mt-2 fs-14 fw-semibold text-uppercase text-white" style="font-size: 10.7px">{{ currentTime }}</h5>
                                        <p class="text-white fs-11">{{ currentDate}}</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 mb-n3">
                                    

                                    <div class="col-md-12"> 
                                        <div class="d-flex w-100 justify-content-center align-items-center mb-2">
                                            <div class="p-4 w-100 border rounded bg-dark-subtle text-center">
                                                <p class="mb-0 text-dark fs-12"> Please face the camera to begin.</p>
                                                <p class="mb-0 text-muted fs-11"> Make sure your face is clearly visible for accurate recognition.</p>
                                            </div>
                                        </div>

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
                                                                <th style="width: 18%;" class="text-center">Type</th>
                                                                <th style="width: 15%;" class="text-center">Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody v-if="lists.length">
                                                            <tr v-for="(list,index) in lists"
                                                                :key="index"
                                                                :class="['fs-10',{ 'bg-success-subtle': list.subtype === 'in',
                                                                    'bg-danger-subtle': list.subtype === 'out'
                                                                    }]">
                                                                <td class="text-center">
                                                                    <img :src="list.avatar" alt="user-img" class="avatar-xxs rounded-circle">
                                                                </td>
                                                                <td>{{ list.name }}</td>
                                                                <td class="text-center">{{ list.type }}</td>
                                                                <td class="text-center">{{ list.time }}</td>
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
                                </div>
                            </div>
                        </div>

                    </div>
                </BRow>

            </BContainer>
        </div>
    </div>
    
</template>
<script>
export default {
    layout: null,
    data() {
        return {
            viewer: this.$page.props.viewer,
            currentUrl: window.location.origin,
            lists: [],
        };
    },
   
    methods: {
         async logout() {
            try {
                await axios.get('/viewer/logout')
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