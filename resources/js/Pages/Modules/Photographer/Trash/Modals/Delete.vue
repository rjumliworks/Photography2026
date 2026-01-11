<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Delete Item" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div class="p-2 mb-n3" v-if="selected">
            
            <div v-if="selected.type == 'folder'" class="alert alert-primary alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-11" role="alert">
                <i class="ri-folder-fill label-icon"></i>This folder contains <b>{{ selected.count }}</b> files with a total size of <b>{{ selected.size }}</b>.
            </div>
            <div class="alert alert-danger alert-dismissible alert-additional fade show mb-xl-0 material-shadow" role="alert">
                <div class="alert-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-2">
                            <i class="ri-alert-line fs-14 align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="fs-12">Are you sure you want to delete this <b>{{ selected.name }}</b> <span v-if="selected.type == 'folder'">folder?</span><span v-else>file?</span></span>
                        </div>
                    </div>
                </div>
                <div class="alert-content">
                    <p class="mb-0 fs-10">By default, the file will be moved to <strong>Trash</strong>. You can restore it later from Trash.</p>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="danger" :disabled="form.processing" block>Delete</b-button>
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
                is_permanent: true,
                option: 'softdelete'
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