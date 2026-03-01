<script>
import { layoutComputed } from "@/Shared/State/helpers";
import Horizontal from "./Horizontal.vue";
export default {
    components: {
        Horizontal
    },
    computed: {
        ...layoutComputed,
        message() {
            return (this.$page.props.flash.message) ?  true : false;
        }
    },
    methods: { ...layoutMethods,

  updateLayout() {
    // Call the action to change the layoutType
    this.changeLayoutType('horizontal'); // or 'vertical', etc.
  },
        check(){
            this.$page.props.flash = {};
            this.message = false;
        },
    }
};
</script>

<template>
    <div>
        <Horizontal :layout="layoutType">
            <slot />
        </Horizontal>
    </div>
    <b-modal v-model="message" hide-footer class="v-modal-custom" modal-class="zoomIn" body-class="p-0" centered hide-header-close style="z-index: 5000;">
        <div class="text-end me-4">
            <button type="button" class="btn-close text-end" @click="check()"></button>
        </div>
        <div class="text-center px-5 pt-2">
            <div class="mt-2">
                 <div class="avatar-md mx-auto">
                    <div class="avatar-title rounded-circle bg-light">
                        <i v-if="$page.props.flash.status" class="ri-checkbox-circle-fill text-success h1 mb-0"></i>
                        <i v-else class="ri-close-circle-fill text-danger h1 mb-0"></i>
                    </div>
                </div>
                <h5 class="mb-1 mt-4 fs-14">{{$page.props.flash.message }}</h5>
                <p v-if="$page.props.flash.info" class="text-muted fs-12">{{$page.props.flash.info }}</p>
            </div>
        </div>
        <div class="modal-footer bg-light p-3 mt-5 justify-content-center">
            <p class="mb-0 text-muted fs-10">Any suggestions please contact
                <b-link href="fb.com/rjumli.gov" target="_blank" class="link-secondary fw-semibold">Administrator</b-link>
            </p>
        </div>
    </b-modal>
</template>
