<template>
    <!-- style="--vz-modal-width: 800px;" -->
    <b-modal v-model="showModal" style="--vz-modal-width: 1000px;" header-class="p-3 bg-light" title="View File"
        hide-footer class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div class="row p-2" v-if="selected">
            <div class="col-md-4">
                <!-- :src="'/storage/'+ selected.path" -->
                  <div class="bookmark-icon position-absolute  p-4"> 
                            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true">
                                <i class="mdi mdi-heart text-danger fs-20"></i>
                            </button> 
                        </div>
                <img :src="'/storage/'+ selected.meta.thumbnails['250x250']" class="img-thumbnail img-fluid rounded"
                    alt="Responsive image">
            </div>
            <div class="col-md-8 mb-n3">
                <div class="card bg-light-subtle shadow-none border">
                    <div class="card-header bg-light-subtle">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4 class="text-secondary fs-12">{{ selected.name }}</h4>
                                <div class="hstack gap-3 flex-wrap fs-11 mt-n1">
                                    <div class="text-muted">Type : <span class="text-body fw-medium">{{ selected.mime_type}}</span></div>
                                    <div class="vr"></div>
                                    <div class="text-muted">Size : <span class="text-body fw-medium">{{ formatSize(selected.size)}}</span></div>
                                    <div class="vr"></div>
                                    <div class="text-muted">Dimensions : <span class="text-body fw-medium">{{ selected.meta.width }} x {{ selected.meta.height }}</span></div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">

                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white rounded-bottom" style="height: calc(-790px + 100vh); overflow: auto;">
                       <!-- <div class="d-flex mb-4" v-for="(list,index) in selected.comments" v-bind:key="index">
                            <div class="flex-shrink-0">
                                <img src="/assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle" />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fs-12 mb-0">{{list.user.profile.firstname}} {{list.user.profile.lastname}}
                                    <small class="text-muted ms-2">{{list.created_at}}</small>
                                </h5>
                                <p class="text-muted">{{list.comment}}</p>
                            </div>
                        </div> -->
                        <b-list-group flush class="mt-n3" style="margin-left: -16px; margin-right: -16px;">
                            <b-list-group-item v-for="(list,index) in selected.comments" v-bind:key="index" class="d-flex justify-content-between align-items-center ribbon-box right mt-1" style="cursor: pointer;" >
                                <div class="d-flex mb-n3">
                                    <div class="flex-shrink-0">
                                       <img src="/assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle" />
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 v-if="$page.props.user.data.id != selected.user.id" class="fs-11 mb-1">{{list.user.profile.firstname}} {{list.user.profile.lastname}}<small class="text-muted ms-2">({{timeAgo(list.created_at)}})</small></h5>
                                        <h5 v-else class="fs-11 mb-1">You<small class="text-muted ms-2">({{timeAgo(list.created_at)}})</small></h5>
                                        <p class="text-muted fs-10">{{ list.comment }}</p>
                                    </div>
                                </div>
                            </b-list-group-item>
                        </b-list-group>
                    </div>

                    <div class="card-footer">
                        <form @submit.prevent="sendMessage">
                            <BRow class="g-0 align-items-center">
                                <BCol>
                                    <input type="text" v-model="form.comment" class="form-control chat-input bg-light border-light" placeholder="Add Comment..">
                                </BCol>
                                <BCol cols="auto">
                                    <div class="chat-input-links ms-2">
                                        <div class="links-list-item">
                                            <BButton variant="success" type="submit" class="chat-send">
                                                <i class="ri-send-plane-2-fill align-bottom"></i>
                                            </BButton>
                                        </div>
                                    </div>
                                </BCol>
                            </BRow>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>
<script>
    import { useForm } from '@inertiajs/vue3';
    import dayjs from "dayjs";
    import relativeTime from "dayjs/plugin/relativeTime";
    dayjs.extend(relativeTime);
    export default {
        data() {
            return {
                form: useForm({
                    id: null,
                    comment: null,
                    option: 'comment'
                }),
                now: dayjs(),
                selected: null,
                showModal: false
            }
        },
        mounted() {
            this.interval = setInterval(() => {
                this.now = dayjs(); 
            }, 60000);
        },
        beforeUnmount() {
            clearInterval(this.interval);
        },
        methods: {
            show(selected) {
                this.form.reset();
                this.form.id = selected.id;
                this.selected = selected;
                this.showModal = true;
            },
            sendMessage() {
                this.form.put('/files/update', {
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.selected.comments.unshift(this.$page.props.flash.data)
                        this.form.comment = null;
                    },
                });
            },
            formatSize(bytes) {
                if (bytes < 1024) return bytes + " B"
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + " KB"
                return (bytes / (1024 * 1024)).toFixed(1) + " MB"
            },
            timeAgo(date) {
                return dayjs(date).from(this.now);
            },
            hide() {
                this.showModal = false;
            }
        }
    }

</script>
