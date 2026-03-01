<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" :title="(!editable) ? 'Add Tag' : 'Update Tag'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-0 mb-0 mt-0">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Tag" :message="form.errors.name"/>
                    <Multiselect
                        v-model="form.tags"
                        :options="tags"
                        mode="tags"
                        @search-change="checkSearchStr"
                        :multiple="true"
                        :searchable="true"
                        :loading="isLoading"
                        label="name"
                        :preserve-search="true"
                        :filter-results="false"
                        placeholder="Select Tag"
                        ref="multiselect2"
                        />
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
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
export default {
    props: ['folder_tags'],
    components: { Multiselect, InputLabel },
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                tags: null,
                option: 'tags'
            }),
            tags: [],
            showModal: false
        }
    },
    methods: { 
        show(id){
            this.editable = false;
            this.form.reset();
            this.form.id = id;
            this.showModal = true;
        },
        edit(id){
            this.form.id = id;
            this.form.tags = this.folder_tags.map(tag => tag.id);
            this.tags = this.folder_tags.map(tag => ({ value: tag.id, name: tag.name }));
            this.editable = true;
            this.showModal = true;
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
        checkSearchStr: _.debounce(function(string) {
            (string) ? this.searchUser(string) : '';
        }, 300),
        searchUser(string){
            axios.get('/search',{
                params: {
                    option: 'tags',
                    keyword: string
                }
            })
            .then(response => {
                this.tags = response.data;
            })
            .catch(err => console.log(err));
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