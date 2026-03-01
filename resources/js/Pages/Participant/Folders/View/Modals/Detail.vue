<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" title="File Details" hide-footer class="v-modal-custom"
        modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform" v-if="selected">
            <div class="row ms-n2 mb-3">
                <div class="col-md-12 mt-2">
                    <div class="p-1 border border-dashed rounded">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-2">
                                <div class="avatar-title rounded bg-transparent text-primary fs-20">
                                    <i class="ri-newspaper-fill"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-0 fs-12">File name :</p>
                                <h5 class="mb-0 fs-12">{{ selected.name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-n3">
                    <hr class="text-muted"/>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-image-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Type :</p>
                            <h6 class="mb-0 fs-12">
                                <div>{{ selected.mime_type }}</div>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-calendar-2-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Date Modified :</p>
                            <h6 class="text-truncate mb-0 fs-12">{{ selected.updated_at }}</h6>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-file-text-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Size :</p>
                            <h6 class="text-truncate mb-0 fs-12">{{ formatSize(selected.size) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-calendar-check-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Date Created :</p>
                            <h6 class="text-truncate mb-0 fs-12">{{ selected.created_at }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-ruler-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Dimensions :</p>
                            <h6 class="text-truncate mb-0 fs-12">{{ selected.meta.width }} x {{ selected.meta.height }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mt-3">
                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i
                                    class="ri-user-line"></i></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1 fs-12 text-muted">Owner :</p>
                            <h6 v-if="$page.props.user.data.id != selected.user.id" class="text-truncate mb-0 fs-12">{{ selected.user.profile.firstname }} {{ selected.user.profile.lastname }}</h6>
                            <h6 class="text-truncate mb-0 fs-12">me</h6>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
    export default {
        data() {
            return {
                selected: null,
                showModal: false
            }
        },
        methods: {
            show(selected) {
                this.selected = selected;
                this.showModal = true;
            },
            formatSize(bytes) {
                if (bytes < 1024) return bytes + " B"
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + " KB"
                return (bytes / (1024 * 1024)).toFixed(1) + " MB"
            },
            hide() {
                this.showModal = false;
            }
        }
    }

</script>
