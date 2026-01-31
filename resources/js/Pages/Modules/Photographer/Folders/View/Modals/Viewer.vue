<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Add Viewer" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-0 mb-0 mt-0">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Name" :message="form.errors.name"/>
                    <TextInput id="name" v-model="form.name" type="text" class="form-control" placeholder="Please enter name" @input="handleInput('name')" :light="true"/>
                </BCol>
                <BCol lg="12" class="mt-0">
                    <InputLabel for="name" value="Email" :message="form.errors.email"/>
                    <TextInput id="name" v-model="form.email" type="text" class="form-control" placeholder="please enter email" @input="handleInput('email')" :light="true"/>
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
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                email: null,
                name: null,
                option: 'viewer'
            }),
            showModal: false
        }
    },
    methods: { 
        show(id){
            this.form.reset();
            this.form.id = id;
            this.showModal = true;
        },
        submit(){
            this.form.post('/folders',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('success',true);
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