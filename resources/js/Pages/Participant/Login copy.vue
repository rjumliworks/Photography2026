<template>
    <Head title="Log in"/>
     <div>
        <div class="modal-body login-modal p-5">
            <div class="col-lg-12">
                <div class="text-center mt-n3 mb-n3 p-0">                          
                    <img src="@assets/images/logo-sm.png" alt="" class="mb-3" style="width: 80px; height: 80px;">
                    <h1 class="mb-0 ff-secondary fw-semibold text-capitalize lh-base fs-13"><span class="text-white">DEPARTMENT OF SCIENCE AND TECHNOLOGY</span></h1>
                    <p class="text-muted mb-2 fs-12">Regional Office No. IX</p>
                </div>
            </div>
        </div>
       
        <div class="modal-body p-5">
            <form class="customform">
                <BRow class="g-3" style="margin-top: -35px;"> 
                    <div class="p-2 mt-4" v-if="!sent">
                        <div class="text-muted text-center mb-4 mx-lg-3">
                            <h4 class="">Hello, Welcome</h4>
                            <p>Login with your <span class="fw-semibold">Email Address</span></p>
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-12 mt-2 mb-2">
                                    <TextInput id="name" v-model="form.email" type="text" class="form-control form-control-lg" placeholder="Please enter email" @input="handleInput('email')" style="text-transform: lowercase; background-color: white;" :light="true"/>
                                </div>
                            </div>
                        </form>
                        <div class="mt-4">
                            <BButton variant="primary" class="w-100 mt-2" type="button"  @click="send" :disabled="next">
                                <span v-if="!next">Next</span>
                                <span v-else>Sending..</span>
                            </BButton>
                            <BButton variant="white" class="w-100 mt-2 bg-primary-subtle" type="button">Cancel</BButton>
                        </div>
                    </div>
                    <div class="p-2 mt-4" v-else>
                        <div class="text-muted text-center mb-4 mx-lg-3">
                            <h4 class="">Enter One-Time Password</h4>
                            <p>Please enter the one-time Password (OTP) that we sent to <span class="fw-semibold">kradj****@gmail.com</span></p>
                        </div>
                        <form>
                            <div class="d-flex gap-2">
                            <input
                                v-for="(digit, index) in digits"
                                :key="index"
                                ref="otpInputs"
                                type="text"
                                class="form-control form-control-lg text-center flex-fill"
                                maxlength="1"
                                :value="digits[index]"
                                @input="onInput($event, index)"
                                @keydown="onKeydown($event, index)"
                                @paste="onPaste($event, index)"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                autocomplete="one-time-code"
                            />
                        </div>
                        <!-- <p class="text-muted">Code valid for : <span v-if="timeLeft.total > 0"> {{ timeLeft.minutes }}m {{ timeLeft.seconds }}s remaining
                        </span></p>  -->
                        </form>
                        <div class="mt-4">
                            <BButton variant="primary" class="w-100 mt-2" type="submit" :disabled="form.processing" @click="submit">Submit</BButton>
                            <BButton variant="white" class="w-100 mt-2 bg-primary-subtle" @click="sent = false" type="button">Back</BButton>
                        </div>
                    </div>
                </BRow>
            </form>
        </div>
    </div>
</template>
<script >
import { nextTick } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    layout: null,
    components: { TextInput },
    data() {
        return {
            form: useForm({
                email: null,
                code: null
            }),
            timeLeft: {
                minutes: 0,
                seconds: 0
            },
            timer: null,
            digits: Array.from({ length: 6 }, () => ''),
            sent: false,
            next: false,
            showModal: false
        }
    },
    // mounted() {
    //     this.updateCountdown()
    //     this.timer = setInterval(this.updateCountdown, 1000)
    // },
    // beforeUnmount() {
    //     clearInterval(this.timer)
    // },
    computed: {
        code() {
            return this.digits.join("");
        },
    },
    methods: {
        send(){
            this.next = true;
            axios.post('/mail', this.form).then(res => {
                if (res.data.success) {
                    this.next = false;
                    this.sent = true
                }else{
                    this.next = false;
                }
            })
        },
        submit(){
            this.form.code = this.code;
            this.form.post('/verify',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.form.clearErrors();
                    this.form.reset();
                },
            });
        },
        focusInput(idx) {
            const inputs = this.$refs.otpInputs;
            if (!inputs) return;
            const el = Array.isArray(inputs) ? inputs[idx] : inputs;
            if (el && el.focus) {
                el.focus();
                try { el.setSelectionRange(0, 1); } catch (err) {}
            }
        },
        onInput(e, index) {
            const raw = e.target.value || '';
            const cleaned = raw.replace(/\D/g, '');
            if (!cleaned) {
                this.digits[index] = '';
                this.updateCode();
                return;
            }

            const chars = cleaned.split('');
            for (let i = 0; i < chars.length && index + i < this.digits.length; i++) {
                this.digits[index + i] = chars[i];
            }

            const focusTo = Math.min(index + chars.length, this.digits.length - 1);
            nextTick(() => this.focusInput(focusTo));

            this.updateCode();
        },
        onKeydown(e, index) {
            const key = e.key;
            const target = e.target;

            if (key === 'Backspace') {
                if ((target.value || '') === '' && index > 0) {
                e.preventDefault();
                this.digits[index - 1] = '';
                nextTick(() => this.focusInput(index - 1));
                this.updateCode();
                } else {
                setTimeout(() => {
                    const v = (this.$refs.otpInputs[index] && this.$refs.otpInputs[index].value || '')
                            .replace(/\D/g, '').slice(0, 1);
                    this.digits[index] = v || '';
                    this.updateCode();
                }, 0);
                }
            } else if (key === 'ArrowLeft') {
                e.preventDefault();
                if (index > 0) this.focusInput(index - 1);
            } else if (key === 'ArrowRight') {
                e.preventDefault();
                if (index < this.digits.length - 1) this.focusInput(index + 1);
            }
        },
        onPaste(e, index) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text') || '';
            const chars = paste.replace(/\D/g, '').split('');
            if (chars.length === 0) return;
            for (let i = 0; i < chars.length && index + i < this.digits.length; i++) {
                this.digits[index + i] = chars[i];
            }
            const focusTo = Math.min(index + chars.length, this.digits.length - 1);
            nextTick(() => this.focusInput(focusTo));
            this.updateCode();
        },
        updateCountdown() {
            // const now = new Date().getTime()
            // const endTime = new Date(this.plan.data.end).getTime() // 👈 use plan.end here
            // const diff = endTime - now

            // if (diff <= 0) {
            //     this.timeLeft = { total: 0, days: 0, hours: 0, minutes: 0, seconds: 0 }
            //     clearInterval(this.timer)
            //     return
            // }

            // this.timeLeft = {
            //     minutes: Math.floor((diff / (1000 * 60)) % 60),
            //     seconds: Math.floor((diff / 1000) % 60)
            // }
        },
        updateCode() {
            this.form.code = this.code;
            this.$emit('update', this.code);
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.showModal = false;
        },
    }
}
</script>
<style scoped>
.auth-page-wrapper {
    background-color: hsl(201, 80%, 82%);
}
</style>
