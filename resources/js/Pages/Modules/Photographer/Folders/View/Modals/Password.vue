<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Protect Folder" class="v-modal-custom"
        modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-0 mb-0 mt-0">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Password" :message="form.errors.password"/>
                    <TextInput id="name" v-model="form.password" type="password" class="form-control" placeholder="Please enter password" @input="handleInput('password')" :light="true"/>
                </BCol>
                <BCol lg="12" class="mt-0">
                    <InputLabel for="name" value="Confirm Password" :message="form.errors.name"/>
                    <TextInput id="name" v-model="form.password_confirmation" type="password" class="form-control" placeholder="Cornfirm password" @input="handleInput('confirm_password')" :light="true"/>
                </BCol>
                <BCol lg="12" class="mt-0 mb-n3">
                    <hr class="text-muted"/>
                </BCol>
                <BCol lg="12" class="mb-n3">
                    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-11" role="alert">
                        <i class="ri-folder-shield-2-fill label-icon"></i><strong>Folder Protection</strong> - Add password to protect this folder.
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
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
    export default {
        components: { InputLabel, TextInput },
        data() {
            return {
                currentUrl: window.location.origin,
                form: useForm({
                    id: null,
                    password: null,
                    password_confirmation: null,
                    option: 'password'
                }),
                showModal: false
            }
        },
        methods: {
            show(id) {
                this.form.reset();
                this.form.id = id;
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
            handleInput(field) {
                this.form.errors[field] = false;
            },
            hide() {
                this.showModal = false;
            }
        }
    }

</script>
