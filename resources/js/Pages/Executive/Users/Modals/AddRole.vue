
<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Add Role" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n1">
                <BCol lg="12" class="mt-0 mb-2">
                    <div class="alert fs-10 alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-xl-0 material-shadow" role="alert">
                        <i class="ri-error-warning-line label-icon"></i><strong>Notice</strong>
                        - Adding a new role will grant the user access to the corresponding role module.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </BCol>
                <BCol lg="12" class="mt-0 mb-2">
                    <InputLabel value="Role" :message="form.errors.role_id"/>
                     <Multiselect
                    v-model="form.role_id" :groups="true"
                    :options="filteredRoles"
                    label="name"
                    ref="multiselect2"
                    placeholder="Select Role"/>
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
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
export default {
    components: { Multiselect, InputLabel },
    props: ['roles'],
    data(){
        return {
            form: useForm({
                code: null,
                role_id: null,
                type: 'add',
                option: 'role'
            }),
            user: {},
            type: null,
            showModal: false,
        }
    },
    computed: {
        filteredRoles() {
            if (!this.roles || !this.user?.roles) return this.roles || [];

            // active role names of the user
            const activeUserRoles = this.user.roles
            .filter(r => r.is_active === 1)
            .map(r => r.name);

            return this.roles
            .map(group => {
                const filteredOptions = group.options.filter(
                role => !activeUserRoles.includes(role.name)
                );

                // remove empty groups
                if (filteredOptions.length === 0) return null;

                return {
                label: group.label,
                options: filteredOptions
                };
            })
            .filter(Boolean);
        }
    },
    methods: { 
        show(data){
            this.user = data;
            this.form.code = this.user.code,
            this.showModal = true;
        },
        submit(){
            this.form.put('/users/update', {
                preserveScroll: true,
                onSuccess: () => {
                    this.$emit('update',this.$page.props.flash.data.data);
                    this.hide();
                },
            });
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.user = {};
            this.form.reset();
            this.form.clearErrors();
            this.showModal = false;
        }
    }
}
</script>