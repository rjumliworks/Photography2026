<template>
    <div class="email-chat-detail" id="emailchat-detailElem" v-show="isUploadManagerVisible">
        <BCard no-body class="mb-0">
            <BCardHeader class="align-items-center d-flex bg-primary text-white-50 pt-2 pb-2 pe-2">
                <div class="flex-grow-1">
                    <h5 class="fs-13 text-white mb-1 profile-username">Upload Manager</h5>
                    <p class="mb-0 fs-11 lh-1">{{ uploadMessage }}</p>
                </div>
                <div class="flex-shrink-0">
                    <div>
                        <BButton @click="isUploadManagerVisible = !isUploadManagerVisible" type="button" variant="link" class="text-white fs-16 text-decoration-none"
                            id="emailchat-btn-close"><i class="ri-close-fill"></i></BButton>
                    </div>
                </div>
            </BCardHeader>

            <BCardBody class="p-0">
                <div id="users-chat">
                    <div class="chat-conversation p-3" id="chat-conversation" data-simplebar="init" style="height: 250px; overflow: auto;">
                        
                         <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-0">
                            <li class="list-group-item px-0"v-for="upload in sortedUploads" :key="upload.clientId">
                                <div :class="['d-flex align-items-center', (upload.status === 'Processing' || upload.status === 'Queued') ? 'opacity-75' : 'opacity-100']">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <template v-if="upload.preview">
                                            <img :src="upload.preview" alt="" class="rounded-circle avatar-xs material-shadow">
                                        </template>
                                        <template v-else>
                                             <span class="avatar-title bg-light p-1 rounded-circle">
                                                <i class="ri-video-fill text-danger fs-17"></i>
                                            </span>
                                        </template>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0 fs-12" :class="{ 'text-danger': upload.status == 'Failed' }">{{upload.name}}</h6>
                                        <p class="fs-11 mb-0 text-muted" :class="{ 'text-danger': upload.status == 'Failed' }">{{ formatSize(upload.size) }}</p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <i v-if="upload.status == 'Queued'" class="ri-loader-4-fill fs-20 text-muted"></i>
                                        <i v-if="upload.status == 'Processing'" class="bx bx-loader-circle bx-spin fs-20 text-muted"></i>
                                        <i v-else-if="upload.status == 'Completed'" class="ri-checkbox-circle-fill fs-20 text-success"></i>
                                        <i v-else-if="upload.status == 'Failed'" class="ri-close-circle-fill fs-20 text-danger"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      
                    </div>
                </div>
            </BCardBody>
        </BCard>
        
    </div>
    <div class="customizer-setting d-none d-md-block">
        <div @click="toggleUploadManager" class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" id="mdi-cog">
            <i class="bx bx-cloud-upload fs-22"></i>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                uploads: [],
                isUploadManagerVisible: true
            }
        },
        computed: {
            uploadMessage() {
                if (this.uploads.length === 0) return "No files uploading";

                const allCompleted = this.uploads.every(u => u.status === "Completed");
                const allFailed = this.uploads.every(u => u.status === "Failed");
                const someFailed = this.uploads.some(u => u.status === "Failed");
                const someProcessing = this.uploads.some(u => u.status === "Processing" || u.status === "Queued");

                if (someProcessing) {
                    return `Uploading ${this.uploads.length} item${this.uploads.length > 1 ? 's' : ''}...`;
                } else if (allCompleted) {
                    return "All files have been uploaded successfully ✅";
                } else if (allFailed) {
                    return "All files failed to upload ❌";
                } else if (someFailed) {
                    return "Some files failed to upload ⚠️";
                }
                return "Upload complete";
            },
            sortedUploads() {
                return [...this.uploads].sort((a, b) => {
                    if (a.status === "Failed" && b.status !== "Failed") return -1;
                    if (a.status !== "Failed" && b.status === "Failed") return 1;
                    return 0; // keep original order otherwise
                });
            }
        },
        mounted() {
            window.addEventListener("new-upload", this.onNewUpload);
            window.addEventListener("upload-progress", this.onUploadProgress);
            window.addEventListener("upload-status", this.onUploadStatus);
        },
        methods: {
            onNewUpload(e) {
                const file = e.detail;
                this.uploads.push(file); 
                if (this.uploads.length > 0) {
                    const panel = document.getElementById("emailchat-detailElem");
                    if (panel) panel.style.display = "block";
                }
            },
            onUploadProgress(e) {
                const { clientId, progress } = e.detail;
                const upload = this.uploads.find(u => u.clientId === clientId);
                if(upload) upload.progress = progress;
            },
            onUploadStatus(e) {
                const { clientId, status, file } = e.detail;
                const upload = this.uploads.find(u => u.clientId === clientId);
                if(upload) {
                    upload.status = status;
                    if(file) Object.assign(upload, file); 
                }
            },
            clearCompleted() {
                this.uploads = this.uploads.filter(u => u.status !== "Completed")
            },
            formatSize(bytes) {
                if (bytes < 1024) return bytes + " B"
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + " KB"
                return (bytes / (1024 * 1024)).toFixed(1) + " MB"
            },
            toggleUploadManager() {
                const panel = document.getElementById("emailchat-detailElem")
                if (!panel) return
                panel.style.display = (panel.style.display === "none" || panel.style.display === "") ? "block" : "none"
            },
        }
    }
</script>
