<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Rename" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-2 mb-n4">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Name" :message="form.errors.name"/>
                    <TextInput id="name" v-model="form.name" type="text" class="form-control" placeholder="Please enter name" @input="handleInput('name')" :light="true"/>
                </BCol>
            </BRow>
        </form> 
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
                name: null,
                option: 'rename'
            }),
            selected: null,
            showModal: false
        }
    },
    methods: { 
        show(selected){
            this.form.reset();
            this.form.id = selected.id;
            this.form.name = selected.name;
            // const parts = selected.name.split('.');
            // const ext = parts.length > 1 ? '.' + parts.pop() : '';
            // this.form.name = parts.join('.');
            // this.selected = { ...selected, ext };
            this.selected = selected;
            this.showModal = true;
        },
        submit(){
            // const finalName = this.form.name + this.selected.ext; // re-append extension
            // this.form.name = finalName;
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