<template>
<div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-image-line text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Media Files</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">A list of all your uploaded images and videos.</p>
                </div>
                <div class="flex-shrink-0 text-end">
                    <div class="list-grid-nav hstack gap-1">
                     
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-white rounded-bottom  shadow-none" >
            <div class="d-flex">
                <div class="flex-grow-1">
                    <ul class="nav nav-tabs nav-tabs-custom nav-primary fs-12" style="margin-top: 2px;" role="tablist">
                        <li class="nav-item">
                            <BLink @click="show('null')" class="nav-link py-3" data-bs-toggle="tab" role="tab" aria-selected="false">
                                 <i class="ri-heart-fill me-1 align-bottom"></i> All Images & Videos
                            </BLink>
                        </li>
                         <li class="nav-item">
                            <BLink @click="show('image')" class="nav-link py-3" data-bs-toggle="tab" role="tab" aria-selected="false">
                                 <i class="ri-image-fill me-1 align-bottom"></i> Images
                            </BLink>
                        </li>
                         <li class="nav-item">
                            <BLink @click="show('video')" class="nav-link py-3" data-bs-toggle="tab" role="tab" aria-selected="false">
                                 <i class="ri-movie-fill me-1 align-bottom"></i> Videos
                            </BLink>
                        </li>
                        <li class="nav-item">
                            <BLink @click="show('liked')" class="nav-link py-3" data-bs-toggle="tab" role="tab" aria-selected="false">
                                 <i class="ri-heart-fill me-1 align-bottom"></i> Favorites <span class="ms-1 text-muted fw-normal">(For Printing)</span>
                            </BLink>
                        </li>
                    </ul>
                </div>
                <div class="flex-shrink-0">
                    <!-- <p class="text-primary fs-12 fw-semibold">Images & Videos</p> -->
                </div>
            </div>
        </div>
        <div class="card bg-light-subtle rounded-bottom shadow-none mb-0" style="height: calc(100vh - 415px); overflow-x: hidden;">
            <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 p-3 mt-2">
                <div class="col list-element" v-for="(list,index) in filteredFiles" v-bind:key="index">
                    <div class="card explore-box card-animate">
                        <a class="glightbox" :href="list.meta?.preview ? '/storage/' + list.meta.preview : '#'">
                            <div class="explore-place-bid-img overflow-hidden rounded"> 
                                <img :src="list.meta?.thumbnails?.['250x250'] 
                                ? '/storage/' + list.meta.thumbnails['250x250'] 
                                : '/images/avatars/avatar.jpg'"  alt="" 
                                class="card-img-top explore-img">
                                <div class="bg-overlay"></div>
                            </div>
                        </a>
                        <div class="bookmark-icon position-absolute top-0 end-0 p-2"> 
                            <BButton variant="link" class="btn-icon" @click="toggleLike(list)" 
                            :class="(list.likes || []).some(like => like.liker_id === $page.props.viewer.id) ? 'active' : ''"
                            data-bs-toggle="button" aria-pressed="true">
                                <i class="mdi mdi-cards-heart fs-16"></i>
                            </BButton>
                        </div>
                        <div class="card-body">
                            <BDropdown variant="link" class="float-end dropdown" toggle-class="btn btn-light btn-sm" no-caret data-bs-container="body" data-bs-display="static" menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }"> 
                                <template #button-content> 
                                    <i class="ri-more-2-fill"></i>
                                </template>
                                <li>
                                    <a :href="'/storage/' + list.meta.preview" class="glightbox dropdown-item d-flex align-items-center" role="button">
                                        <i class="ri-eye-line me-2"></i> Preview
                                    </a>
                                </li>
                                <li>
                                    <a @click="openDetail(list,index)" class="dropdown-item d-flex align-items-center" role="button">
                                        <i class="ri-information-line me-2"></i> Details
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a :href="`/files?id=${list.id}&option=download`" target="_blank" class="dropdown-item d-flex align-items-center" role="button">
                                        <i class="ri-download-2-line me-2"></i> Download
                                    </a>
                                </li>
                            </BDropdown>
                            
                            <h5 class="mb-0 mt-0 fs-12 text-truncate text-primary">{{ list.name }}</h5>
                            <p class="text-muted fs-10 mb-n2">{{ list.size }}</p>
                        </div>
                         <div class="card-footer border-top border-top-dashed mb-n2 fs-12" style="cursor: pointer;" @click="openView(list)">
                            <p class="fw-medium mb-0 mt-n1 float-end"><i class="ri-message-3-fill text-primary align-middle"></i>   {{ (list.comments || []).length }} </p>
                            <p class="fw-medium mb-0 mt-n1"><i class="mdi mdi-heart text-danger align-middle"></i> {{ (list.likes || []).length }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <View ref="view"/>
    <Detail ref="detail"/>
</template>
<script>
import GLightbox from "glightbox";
import View from '../Modals/View.vue';
import Detail from '../Modals/Detail.vue';
import "glightbox/dist/css/glightbox.min.css";
import { useForm } from '@inertiajs/vue3';
export default {
    components: { Detail, View },
    props:['folder'],
    data(){
        return {
            activeView: 'grid',
            form: useForm({
                id: this.folder.id,
                file: null,
                option: null
            }),
            filterKind: null,
            index: null
        }
    },
    mounted() {
        GLightbox({
            selector: ".glightbox",
            touchNavigation: true,
            loop: true,
            zoomable: true,
        });
    },
    computed: {
        filteredFiles() {
            if (!this.filterKind) {
                return this.folder.files; // All Images & Videos
            }

            if (this.filterKind === 'liked') {
                return this.folder.files.filter(file =>
                    (file.likes || []).some(
                        like => like.liker_id === this.$page.props.viewer.id
                    )
                );
            }

            return this.folder.files.filter(file => file.kind === this.filterKind);
        }
    },
    methods: { 
        show(kind) {
            this.filterKind = kind === 'null' ? null : kind;
        },
        openDetail(list,index){
            this.$refs.detail.show(list);
            this.index = index;
        },
        openView(list){
            this.$refs.view.show(list);
        },
        toggleLike(item) {
            if (!item.likes) item.likes = [];

            const alreadyLiked = item.likes.find(like => like.liker_id === this.$page.props.viewer.id);

            if (alreadyLiked) {
                item.likes = item.likes.filter(like => like.liker_id !== this.$page.props.viewer.id);
                this.form.option = 'unlike';
                this.form.id = alreadyLiked.id;
                this.form.put('/files/update', { preserveScroll: true });
            } else {
                this.form.id = item.id;
                this.form.option = 'like';
                this.form.put('/files/update', { preserveScroll: true });
                item.likes.push({ user_id: this.$page.props.viewer.id }); 
            }
        },
    }
}
</script>
<style>
.toggle-switch {
  display: inline-flex;
  border: .1px solid var(--vz-primary);
  border-radius: 30px;
  padding: 3px;
  background: #fff;
  gap: 3px;
}

/* Buttons inside the switch */
.toggle-btn {
  border: none;
  background: transparent;
  padding: 8px 14px;
  border-radius: 25px;
  cursor: pointer;
  color: var(--vz-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.25s ease;
  font-size: 10px;
}

/* Active (selected side) */
.toggle-btn.active {
  background: var(--vz-primary);
  color: #fff;
  box-shadow: 0 0 8px rgba(0,0,0,0.15);
}</style>