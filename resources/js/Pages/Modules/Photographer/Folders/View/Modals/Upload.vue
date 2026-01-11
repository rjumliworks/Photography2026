<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" title="Upload File" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-2 mb-n4">
                <BCol lg="12" class="mt-2">
                    <file-pond name="pdf" ref="pond" allow-multiple="true" accepted-file-types="image/jpeg, image/png, video/mp4"
                    label-idle='Drag & Drop your PDF or <span class="filepond--label-action">Browse</span>' 
                    :allow-process="false" @addfile="handleAddFile"/>
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
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
const FilePond = vueFilePond(FilePondPluginFileValidateType);
export default {
    components: { FilePond },
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                name: null,
                description: null,
                is_public: false,
                is_protected: false,
                option: 'update'
            }),
            showModal: false
        }
    },
    methods: { 
        show(){;
            this.form.reset();
            this.showModal = true;
        },
        handleAddFile(error, fileItem) {
            if (error) return console.error('FilePond error:', error);
            this.form.document = fileItem.file;
        },
        submit(){
            if(this.editable){
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
                this.form.post('/folders',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('success',true);
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