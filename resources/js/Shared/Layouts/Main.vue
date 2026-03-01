<script>
import { layoutComputed } from "@/Shared/State/helpers";
import { mapActions } from "vuex";

import Vertical from "./Vertical.vue";
import Horizontal from "./Horizontal.vue";
import TwoColumns from "./Twocolumn.vue";

export default {
    components: {
        Vertical,
        Horizontal,
        TwoColumns
    },

    data() {
        return {
            showModal: false
        };
    },

    computed: {
        ...layoutComputed,

        viewer() {
            return this.$page.props.viewer;
        },

        flash() {
            return this.$page.props.flash;
        }
    },
    mounted() {
        this.resolveLayout();
    },
    watch: {
        // Auto-switch layout when viewer exists
        viewer: {
        immediate: true,
        handler() {
            this.resolveLayout();
        }
    },

        // Control modal visibility properly
        flash: {
            immediate: true,
            deep: true,
            handler(val) {
                this.showModal = !!val?.message;
            }
        }
    },

    methods: {
        ...mapActions("layout", ["changeLayoutType","changeTopbar"]),

    resolveLayout() {
        const user = this.$page.props.user;
        const viewer = this.$page.props.viewer;

        // Priority: Web > Viewer

        if (user) {
            this.changeLayoutType({ layoutType: "vertical" });
            this.changeTopbar({ topbar: "light" });
        } 
        else if (viewer) {
            this.changeLayoutType({ layoutType: "horizontal" });
            this.changeTopbar({ topbar: "dark" });
        }
    },

        closeModal() {
            this.showModal = false;
        }
    }
};
</script>

<template>
    <div>
        <!-- Vertical Layout -->
        <Vertical
            v-if="layoutType === 'vertical' || layoutType === 'semibox'"
            :layout="layoutType"
        >
            <slot />
        </Vertical>

        <!-- Horizontal Layout -->
        <Horizontal
            v-if="layoutType === 'horizontal'"
            :layout="layoutType"
        >
            <slot />
        </Horizontal>

        <!-- Two Columns Layout -->
        <TwoColumns
            v-if="layoutType === 'twocolumn'"
            :layout="layoutType"
        >
            <slot />
        </TwoColumns>
    </div>

    <!-- Flash Modal -->
    <b-modal
        v-model="showModal"
        hide-footer
        class="v-modal-custom"
        modal-class="zoomIn"
        body-class="p-0"
        centered
        hide-header-close
        style="z-index: 5000;"
    >
        <div class="text-end me-4">
            <button
                type="button"
                class="btn-close text-end"
                @click="closeModal"
            ></button>
        </div>

        <div class="text-center px-5 pt-2">
            <div class="mt-2">
                <div class="avatar-md mx-auto">
                    <div class="avatar-title rounded-circle bg-light">
                        <i
                            v-if="flash.status"
                            class="ri-checkbox-circle-fill text-success h1 mb-0"
                        ></i>
                        <i
                            v-else
                            class="ri-close-circle-fill text-danger h1 mb-0"
                        ></i>
                    </div>
                </div>

                <h5 class="mb-1 mt-4 fs-14">
                    {{ flash.message }}
                </h5>

                <p
                    v-if="flash.info"
                    class="text-muted fs-12"
                >
                    {{ flash.info }}
                </p>
            </div>
        </div>

        <div class="modal-footer bg-light p-3 mt-5 justify-content-center">
            <p class="mb-0 text-muted fs-10">
                Any suggestions please contact
                <b-link
                    href="https://fb.com/rjumli.gov"
                    target="_blank"
                    class="link-secondary fw-semibold"
                >
                    Administrator
                </b-link>
            </p>
        </div>
    </b-modal>
</template>