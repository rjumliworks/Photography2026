<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Delete File" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div class="p-2">
            <div class="alert alert-danger alert-dismissible alert-additional fade show mb-xl-0 material-shadow" role="alert">
                <div class="alert-body">
                    <div class="d-flex mt-n1 mb-n2">
                        <div class="flex-shrink-0 me-2">
                            <i class="ri-alert-line fs-14 align-middle"></i>
                        </div>
                        <div class="flex-grow-1 mt-1">
                            <h5 class="fs-13 alert-heading">Are you sure you want to delete this file?</h5>
                        </div>
                    </div>
                </div>
                <div class="alert-content">
                    <p class="mb-0 fs-10">By default, the file will be moved to <strong>Trash</strong>. You can restore it later from Trash.</p>
                </div>
            </div>
            <div class="form-check mt-3">
                <input 
                    type="checkbox" 
                    class="form-check-input" 
                    id="permanentDelete" 
                    v-model="permanentDelete"
                />
                <label class="form-check-label fs-11 text-muted" for="permanentDelete">
                    Permanently delete this file (cannot be undone)
                </label>
            </div>
        </div>
        <!-- <div class="p-3">
        <p class="mb-3">
            Are you sure you want to delete this file?
        </p>
        <ul class="list-unstyled mb-3">
            <li>
                <i class="ri-information-line text-warning me-1"></i>
                By default, the file will be moved to <strong>Trash</strong>.
            </li>
            <li v-if="!permanentDelete">
                You can restore it later from Trash.
            </li>
        </ul>
        <div class="form-check">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="permanentDelete" 
                v-model="permanentDelete"
            />
            <label class="form-check-label" for="permanentDelete">
                Permanently delete this file (cannot be undone)
            </label>
        </div>
    </div> -->
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
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
            this.form.put('/files/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('update',this.$page.props.flash.data.data);
                    this.form.clearErrors();
                    this.form.reset();
                    this.hide();
                },
            });
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