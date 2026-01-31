<template>
    <Head title="Log in"/>
    <div id="layout-wrapper" class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>

                <BRow class="justify-content-center">
                    <BCol md="9" lg="7" xl="5">
                        <div class="card bg-light-subtle shadow-none border">
                            <div class="card-header bg-primary">
                                <div class="d-flex mb-n2">
                                    <div class="flex-shrink-0 me-3">
                                        <div style="height:2.5rem;width:2.5rem;">
                                        <img src="@assets/images/logo-sm.png" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 mt-2 fs-14"><span class="text-white fw-semibold text-uppercase fs-13">TasweerHub</span></h5>
                                        <p class="text-white fs-11">Premium Media Sharing & Client Showcase Platform</p>
                                    </div>
                                </div>
                            </div>
                            <div class="car-body bg-white shadow-none" style="padding: 33px;">
                                <form class="customform" @submit.prevent="submit">
                                    <div class="alert alert-warning alert-border-left alert-dismissible fade show material-shadow fs-11" role="alert">
                                        <span class="fs-10" style="line-height: 1.2; display: inline-block;"> <strong>Security Notice :</strong> This system is restricted to authorized photograpers only. Unauthorized access is prohibited.</span>
                                    </div>
                                    <div class="mb-2">
                                        <label><i class="ri-profile-line"></i> Email Address</label>
                                        <div class="form-icon">
                                            <input type="text" v-model="form.email" 
                                            class="form-control form-control-icon" 
                                            id="iconInput" placeholder="Please enter email" 
                                            :class="['form-control', form.errors.email && 'is-invalid']" 
                                            @input="handleInput('email')"
                                            style="background-color: #f5f6f7;">
                                            <i class="ri-user-2-fill text-muted" :class="(form.errors.email) ? 'mt-n3' : ''"></i>
                                            <InputError :message="form.errors.email" />
                                        </div>
                                       
                                    </div>
                                    <div class="mb-3">
                                        <label><i class="ri-key-2-fill"></i> Secure Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <div class="form-icon">
                                                <input :type="togglePassword ? 'text' : 'password'" 
                                                v-model="form.password" class="form-control form-control-icon" 
                                                id="password-input" placeholder="Please enter password" 
                                                :class="['form-control', form.errors.password && 'is-invalid']"  
                                                @input="handleInput('password')"
                                                style="background-color: #f5f6f7;">
                                                <i class="ri-lock-2-fill text-muted"></i>
                                                <InputError :message="form.errors.password" />
                                            </div>
                                            <BButton v-if="!form.errors.password" variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" @click="togglePassword = !togglePassword">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </BButton>
                                        </div>
                                    </div>
                                    <div class="form-check mt-n1">
                                        <Checkbox v-model:checked="form.remember" name="remember" class="form-check-input" id="auth-remember-check" />
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>
                                    <div class="mt-3 mb-">
                                        <BButton variant="primary" class="w-100" type="submit" :class="['some-class', form.processing && 'opacity-25']" :disabled="form.processing">Sign In</BButton>
                                    </div>
                                    <!-- <div class="mt-3 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-10 mb-4 title text-muted">Sign In with</h5>
                                        </div>
                                        <div class="mt-n2">
                                            <button type="button" class="btn btn-light btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                            <div class="card-footer bg-light-subtle">
                                 <div class="text-center p-1">
                                    <p class="mb-0 fs-11">Forgot your password? 
                                        <Link href="/forgot-password" class="fw-semibold text-primary text-decoration-underline"> Click here</Link>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </BCol>
                </BRow>
            </BContainer>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import Checkbox from '@/Shared/Components/Forms/Checkbox.vue';
import InputError from '@/Shared/Components/Forms/InputError.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
defineProps({
    canResetPassword: Boolean,
    status: String
});
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const handleInput = (field) => {
    form.errors[field] = null; // or false
};
const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post('/login', {
         onError: (errors) => {
        console.log('Validation Errors:', errors);
    },
        onFinish: () => form.reset('password'),
    });
};
</script>
<script>
export default {
    layout: null,
    data() {
        return {
            togglePassword: false
        }
    },
    methods: {
        handleInput(field) {
            this.form.errors[field] = false;
        },
    }
}
</script>