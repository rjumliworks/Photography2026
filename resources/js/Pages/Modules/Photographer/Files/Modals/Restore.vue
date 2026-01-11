<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Restore Item" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div class="p-2 mb-n3" v-if="selected">
            <div class="alert alert-secondary alert-dismissible alert-additional fade show mb-xl-0 material-shadow" role="alert">
                <div class="alert-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-2">
                            <i class="ri-alert-line fs-14 align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span v-if="selected.type == 'folder'" class="fs-12">Do you want to restore this folder back to your storage?</span>
                            <span v-else class="fs-12">Do you want to restore this file back to its original folder?</span>
                        </div>
                    </div>
                </div>
                <div class="alert-content">
                    <p v-if="selected.type == 'folder'" class="mb-0 fs-10">All files inside will also be restored.</p>
                    <p v-else class="mb-0 fs-10">After restoring, the file will be accessible again in your folders.</p>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="secondary" :disabled="form.processing" block>Restore</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: {InputLabel, TextInput },
    data(){
        return {
            form: useForm({
                id: null,
                option: 'restore'
            }),
            selected: null,
            showModal: false
        }
    },
    methods: { 
        show(selected){
            this.form.reset();
            this.form.id = selected.id;
            this.selected = selected;
            this.showModal = true;
        },
        submit(){
            if(this.selected.type == 'folder'){
                this.form.put('/folders/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',this.$page.props.flash.data.data);
                        this.form.clearErrors();
                        this.form.reset();
                        this.hide();
                    },
                });
            }else{
                this.form.put('/files/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',this.$page.props.flash.data.data);
                        this.form.clearErrors();
                        this.form.reset();
                        this.hide();
                    },
                });
            }
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>