<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 700px;" header-class="p-3 bg-light" title="Create Plan" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 p-2">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Name" :message="form.errors.name"/>
                    <TextInput id="name" v-model="form.name" type="text" class="form-control" placeholder="Please enter name" @input="handleInput('name')" :light="true"/>
                </BCol>
                <BCol lg="12" class="mt-0">
                    <InputLabel for="name" value="Description" :message="form.errors.name"/>
                    <TextInput id="name" v-model="form.description" type="text" class="form-control" placeholder="Please enter description" @input="handleInput('description')" :light="true"/>
                </BCol>
                <BCol lg="6" class="mt-0">
                    <InputLabel for="category_id" value="Storage Size" :message="form.errors.storage_size"/>
                    <div class="input-group mb-1">
                        <input type="text" v-model="form.storage_size" placeholder="Size" class="form-control" style="height: 39px; width: 50%; background-color: #f5f6f7;"  @input="handleInput('reorder')">
                        <select v-model="form.storage_unit" class="form-select" id="inputGroupSelect02" style="height: 39px; width: 50%; background-color: #f5f6f7;">
                            <option :value="null" selected>Select</option>
                            <option :value="list" v-for="list in units" v-bind:key="value">{{list}}</option>
                        </select>
                    </div>
                </BCol>
                <BCol lg="3" class="mt-0">
                    <InputLabel for="name" value="Folders Limit" :message="form.errors.folders_limit"/>
                    <TextInput id="name" v-model="form.folders_limit" type="text" class="form-control" placeholder="Please enter number" @input="handleInput('folders_limit')" :light="true"/>
                </BCol>
                <BCol lg="3" class="mt-0">
                    <InputLabel for="name" value="Icon" :message="form.errors.folders_limit"/>
                    <TextInput id="name" v-model="form.icon" type="text" class="form-control" placeholder="Please enter icon" @input="handleInput('icon')" :light="true"/>
                </BCol>
                <BCol lg="12" class="mt-1 mb-3">
                    <hr class="text-muted mt-2 mb-0"/>
                    <h3 class="fs-12 text-primary p-2 mb-n2">List of Features</h3>
                    <hr class="text-muted mt-2 mb-0"/>
                </BCol>
                <BCol lg="4" class="mt-0 mb-1" v-for="feature in form.features" :key="feature.value">
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            :id="feature.value" 
                            :value="feature.value"
                            v-model="feature.active"
                        >
                        <label class="form-check-label" :for="feature.value">
                            <span class="text-muted fs-12">{{ feature.label }}</span>
                        </label>
                    </div>
                </BCol>
                <BCol lg="12" class="mt-1">
                    <hr class="text-muted mt-2 mb-0"/>
                    <h3 class="fs-12 text-primary p-2 mb-n2">List of Pricing</h3>
                    <hr class="text-muted mt-2 mb-0"/>
                </BCol>
                <BCol lg="12" class="mb-n3" v-for="(pricing, index) in form.pricings" :key="index">
                    <div class="input-group mb-1">
                        <!-- cycle label -->
                        <span class="input-group-text" style="height: 39px; width: 20%;">
                        {{ pricing.billing_cycle }}
                        </span>

                        <!-- amount -->
                        <input 
                        type="text" 
                        v-model="pricing.amount" 
                        placeholder="Amount" 
                        class="form-control" 
                        style="height: 39px; width: 40%; background-color: #f5f6f7;" 
                        >

                        <!-- currency -->
                        <select 
                        v-model="pricing.currency_id" 
                        class="form-select" 
                        style="height: 39px; width: 40%; background-color: #f5f6f7;"
                        >
                        <option :value="null" disabled>Select</option>
                        <option v-for="list in currencies" :key="list.value" :value="list.value">
                            {{ list.name }}
                        </option>
                        </select>
                    </div>
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
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: { Multiselect, InputLabel, TextInput },
    props: ['currencies'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                name: null,
                icon: null,
                description: null,
                storage_size: null,
                storage_unit: null,
                storage_limit: null,
                folders_limit: null,
                features: [
                    { "label": "Watermark removal", "value": "watermark_removal", "active": false },
                    { "label": "Custom branding", "value": "custom_branding", "active": false },
                    { "label": "Priority support", "value": "priority_support", "active": false }
                ],
                pricings: [
                    { billing_cycle: "Monthly", amount: null, currency_id: null },
                    { billing_cycle: "Yearly", amount: null, currency_id: null }
                ]
            }),
            units: ['MB','GB','TB'],
            showModal: false
        }
    },
    watch: {
        "form.storage_size"(newSize) {
            this.updateStorageLimit(newSize, this.form.storage_unit);
        },
        "form.storage_unit"(newUnit) {
            this.updateStorageLimit(this.form.storage_size, newUnit);
        },
        "form.folders_limit"(newVal){
            if (newVal) {
                this.addOrUpdateFeature(
                    'folders_limit',
                    `${this.form.folders_limit} Folders Limit`,
                    true
                );
            }
        }
    },
    methods: { 
        show(){
            this.showModal = true;
        },
        submit(){
            this.form.post('/plans',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.form.clearErrors();
                    this.form.reset();
                    this.hide();
                },
            });
        },
        addOrUpdateFeature(value, label, active = true) {
            const idx = this.form.features.findIndex(f => f.value === value);
            if (idx !== -1) {
                this.form.features[idx].label = label;
                this.form.features[idx].active = active;
            } else {
                this.form.features.unshift({ label, value, active });
            }
        },
        updateStorageLimit(size, unit) {
            const unitMultiplier = {
                MB: 1024 * 1024,
                GB: 1024 * 1024 * 1024,
                TB: 1024 * 1024 * 1024 * 1024
            };
            this.form.storage_limit = size ? size * unitMultiplier[unit] : null;
            if (this.form.storage_size && this.form.storage_unit) {
                this.addOrUpdateFeature(
                    'storage_limit',
                    `${this.form.storage_size} ${this.form.storage_unit} Storage`,
                    true
                );
            }
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