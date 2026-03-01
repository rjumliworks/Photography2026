<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Share Folder" class="v-modal-custom"
        modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-0 mb-0 mt-0">
                <BCol lg="12" class="mt-2">
                    <ul class="list-group">
                        <li class="list-group-item p-3" v-if="share">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img :src="'/storage/'+share.avatar" alt="" class="avatar-xs rounded-circle">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fs-12">{{share.name}} <span
                                            v-if="$page.props.user.data.name == share.name"
                                            class="text-muted fs-11">(you)</span></h6>
                                    <p class="fs-11 mb-0 text-muted">{{ share.email }}</p>
                                </div>
                                <div class="flex-shrink-0 text-end mt-2">
                                    <b-dropdown
                                        right
                                        variant="link"
                                        toggle-class="text-muted p-0"
                                        no-caret
                                    >
                                        <template #button-content>
                                            {{ currentPermissionText }}
                                        </template>
                                        
                                        <b-dropdown-item
                                            v-for="opt in types"
                                            :key="opt.value"
                                            @click="form.type_id = opt.value"
                                        >
                                            {{ opt.name }}
                                        </b-dropdown-item>
                                    </b-dropdown>
                                </div>
                            </div>
                        </li>
                    </ul>
                </BCol>
                <BCol lg="12" class="mb-n3">
                    <div class="alert alert-secondary alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-11" role="alert">
                        <i class="ri-question-fill label-icon"></i><strong>Confirm Share</strong> - Are you sure you want to share this folder?
                    </div>
                </BCol>
            </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
    export default {
        props: ['types'],
        data() {
            return {
                currentUrl: window.location.origin,
                form: useForm({
                    type_id: null,
                    user_id: null,
                    id: null,
                    option: 'share'
                }),
                share: null,
                showModal: false
            }
        },
        computed: {
            currentPermissionText() {
                let found = this.types.find(opt => opt.value === this.form.type_id)
                if (!found) {
                    found = this.types.find(opt => opt.name === 'Viewer')
                    if (found) {
                        this.form.type_id = found.value
                    }
                }
                return found ? found.name : 'Viewer'
            }
        },
        methods: {
            show(share,id) {
                this.form.reset();
                this.form.id = id;
                this.form.user_id = share.id;
                this.share = share;
                this.showModal = true;
            },
            submit() {
                this.form.put('/folders/update', {
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update', this.$page.props.flash.data.data);
                        this.form.clearErrors();
                        this.form.reset();
                        this.hide();
                    },
                });
            },
            hide() {
                this.showModal = false;
            }
        }
    }

</script>
