<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" title="Access" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-2 mb-n4">
                <BCol lg="12">
                    <ul class="list-group l mt-0">
                        <li class="list-group-item p-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                       <i class="ri-lock-2-fill" :class="type.color"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fs-12">{{type.name}} <span class="text-muted fs-11">({{ type.type }})</span></h6>
                                    <p class="fs-11 mb-0 text-muted">{{ type.others }}</p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <div class="dropdown" style="margin-top: 2px;">
                                        <button class="btn btn-soft-primary btn-sm material-shadow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i :class="icons[count]" class="me-1"></i><span> {{ selected.name }}<i class="mdi mdi-chevron-down align-middle ms-1"></i></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item" href="#" v-for="(list,index) in visibilities" v-bind:key="index"  @click.prevent="selectType(list, index)">
                                               <i :class="icons[index]" class="me-1 text-muted"></i> 
                                               <span class="fs-12">{{ list.name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </BCol>
                <BCol lg="12" class="mt-2 mb-3">
                    <Search :types="types" :id="id" @add="updateList"/>
                </BCol>
                <BCol lg="12" class="mb-4 mt-1" v-if="owner">
                    <h5 class="fs-14 mb-3">People with Access</h5>
                    <ul class="list-group" style="max-height: 200px; overflow: auto;">
                        <li class="list-group-item p-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img :src="owner.avatar" alt="" class="avatar-xs rounded-circle">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fs-12">{{owner.name}} <span v-if="$page.props.user.data.name == owner.name" class="text-muted fs-11">(you)</span></h6>
                                    <p class="fs-11 mb-0 text-muted">{{ owner.email }}</p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="text-muted mt-2 me-2 fs-12">Owner</h6>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-3" v-if="share">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img :src="'/storage/'+share.avatar" alt="" class="avatar-xs rounded-circle">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fs-12">{{share.name}} <span v-if="$page.props.user.data.name == share.name" class="text-muted fs-11">(you)</span></h6>
                                    <p class="fs-11 mb-0 text-muted">{{ share.email }}</p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="text-muted mt-2 me-2 fs-12">Viewer</h6>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item p-3" v-for="(list,index) in shares">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xs">
                                    <span class="avatar-title bg-light p-1 rounded-circle">
                                        <img :src="'/storage/'+list.avatar" alt="" class="avatar-xs rounded-circle">
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fs-12">{{list.name}}</h6>
                                    <p class="fs-11 mb-0 text-muted">{{ list.email }}</p>
                                </div>
                                <div class="flex-shrink-0 text-end">
                                    <h6 class="text-muted mt-2 me-2 fs-12">{{ list.type.name }}</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- <h5 class="fs-14 mt-4 mb-3">General Access</h5> -->
                    
                </BCol>
            </BRow>
        </form> 
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Close</b-button>
        </template>
    </b-modal>
</template>
<script>
import _ from 'lodash';
import Search from './Search.vue';
import { useForm } from '@inertiajs/vue3';
export default {
    props: ['types','shares', 'type','visibilities'],
    components: { Search },
    data(){
        return {
            currentUrl: window.location.origin,
            owner: null,
            share: null,
            id: null,
            icons: ['ri-lock-fill','ri-folder-user-fill','ri-earth-fill'],
            selected: this.type,
            count: null,
            form: useForm({
                id: null,
                type_id: null,
                option: 'visibility'
            }),
            showModal: false
        }
    },
    methods: { 
        show(id,owner){
            this.id = id;
            this.form.id = id;
            this.owner = owner;
            this.showModal = true;

            const index = this.visibilities.findIndex(v => v.name === this.type.name);
            this.count = index !== -1 ? index : 0;
        },
        selectType(list, index) {
            this.selected = list;
            this.count = index;
            this.form.type_id = list.value;
            this.form.put('/folders/update', {
                preserveScroll: true,
                onSuccess: (response) => {
                },
            });
        },
        updateList(data){
            this.share = data;
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>