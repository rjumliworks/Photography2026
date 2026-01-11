<template>
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <BContainer fluid class="custom-container">
                <Link class="navbar-brand" href="/">
                    <img src="/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="30">
                    <img src="/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">
                </Link>
                <BButton class="navbar-toggler py-0 fs-20 text-body" type="button" v-b-toggle.navbarSupportedContent>
                    <i class="mdi mdi-menu"></i>
                </BButton>

                <BCollapse class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#hero" @click.prevent="scrollToSection('hero')">Home</BLink>
                        </li>
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#process" @click.prevent="scrollToSection('process')">Process</BLink>
                        </li>
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#plans" @click.prevent="scrollToSection('plans')">Plans</BLink>
                        </li>
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#findJob" @click.prevent="scrollToSection('photographers')">Photograhers</BLink>
                        </li>
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#candidates" @click.prevent="scrollToSection('albums')">Featured Albums</BLink>
                        </li>
                        <li class="nav-item">
                            <BLink class="nav-link fs-13" href="#blog" @click.prevent="scrollToSection('contacts')">Contacts</BLink>
                        </li>
                    </ul>

                    <div class="">
                        <Link href="/login" class="btn btn-soft-primary"><i
                                class="ri-user-3-line align-bottom me-1"></i> Login & Register</Link>
                    </div>
                </BCollapse>

            </BContainer>
        </nav>

        <section class="section job-hero-section bg-light pb-0 mt-n5" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <BContainer>
                <BRow class="justify-content-between align-items-center">
                    <BCol lg="6">
                        <div>
                            <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Capture. Share. Amaze </h1>
                            <p class="lead text-muted lh-base mb-4">Upload and share photos or videos, manage client access, and let them download albums in stunning PDF form — all in one place.</p>
                            
                            <div class="d-flex gap-2 mt-4">
                                <button @click="openRegister()" class="btn btn-primary">Free Trial <i class="ri-arrow-right-line align-middle ms-1"></i></button>
                                <BLink class="nav-link" href="#plans" @click.prevent="scrollToSection('plans')"><a href="pages-pricing.html" class="btn btn-danger">View Plans <i class="ri-eye-line align-middle ms-1"></i></a></BLink>
                            </div>

                            <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">
                                <li class="list-inline-item text-danger fw-semibold"><i
                                        class="mdi mdi-tag-multiple-outline align-middle"></i> Trending Keywords:</li>
                                <li class="list-inline-item">
                                    <BLink href="#">Photography,</BLink>
                                </li>
                                <li class="list-inline-item">
                                    <BLink href="#">Videography,</BLink>
                                </li>
                                <li class="list-inline-item">
                                    <BLink href="#">Portfolio,</BLink>
                                </li>
                                <li class="list-inline-item">
                                    <BLink href="#">Album</BLink>
                                </li>
                            </ul>
                        </div>
                    </BCol>
                    <BCol lg="6">
                        <div class="position-relative home-img text-center mt-5 mt-lg-0">
                            <img src="/images/job-profile2.png" alt="" class="user-img">
                        </div>
                    </BCol>
                </BRow>
            </BContainer>
        </section>

        <section class="section mb-n4" id="process">
            <BContainer>
                <BRow class="justify-content-center mt-n4">
                    <BCol lg="8">
                        <div class="text-center mb-5">
                            <h4 class="mb-2 ff-secondary fw-semibold lh-base">
                                How <span class="text-primary">it works</span> — share your visuals in minutes
                            </h4>
                            <p class="text-muted fs-13">
                                From uploading your first photo to delivering a polished PDF album, our platform makes it easy for photographers to showcase, share, and impress.
                            </p>
                        </div>
                    </BCol>
                </BRow>

                <BRow class="text-center">
                    <BCol lg="3">
                        <div class="process-card mt-4">
                            <div class="process-arrow-img d-none d-lg-block">
                                <img src="@assets/images/landing/process-arrow-img.png" alt="" class="img-fluid">
                            </div>
                            <div class="avatar-sm icon-effect mx-auto mb-4">
                                <div class="avatar-title bg-transparent text-success rounded-circle h1">
                                    <i class="ri-user-add-line"></i>
                                </div>
                            </div>

                            <h5 class="fs-14">Create Your Account</h5>
                            <p class="text-muted fs-12">Sign up and set up your space to start showcasing your work.</p>
                        </div>
                    </BCol>

                    <BCol lg="3">
                        <div class="process-card mt-4">
                            <div class="process-arrow-img d-none d-lg-block">
                                <img src="@assets/images/landing/process-arrow-img.png" alt="" class="img-fluid">
                            </div>
                            <div class="avatar-sm icon-effect mx-auto mb-4">
                                <div class="avatar-title bg-transparent text-success rounded-circle h1">
                                    <i class="ri-image-add-line"></i>
                                </div>
                            </div>

                            <h5 class="fs-14">Upload Photos & Videos</h5>
                            <p class="text-muted fs-12">Add your content in high quality, ready to be shared with clients.</p>
                        </div>
                    </BCol>

                    <BCol lg="3">
                        <div class="process-card mt-4">
                            <div class="process-arrow-img d-none d-lg-block">
                                <img src="@assets/images/landing/process-arrow-img.png" alt="" class="img-fluid">
                            </div>
                            <div class="avatar-sm icon-effect mx-auto mb-4">
                                <div class="avatar-title bg-transparent text-success rounded-circle h1">
                                    <i class="ri-share-forward-line"></i>
                                </div>
                            </div>

                            <h5 class="fs-14">Share with Clients</h5>
                            <p class="text-muted fs-12">Control access and let clients view and enjoy your work seamlessly.</p>
                        </div>
                    </BCol>

                    <BCol lg="3">
                        <div class="process-card mt-4">
                            <div class="avatar-sm icon-effect mx-auto mb-4">
                                <div class="avatar-title bg-transparent text-success rounded-circle h1">
                                    <i class="ri-file-pdf-2-line"></i>
                                </div>
                            </div>

                            <h5 class="fs-14">Deliver Albums</h5>
                            <p class="text-muted fs-12">Allow clients to download their collections in beautifully designed PDF albums.</p>
                        </div>
                    </BCol>
                </BRow>

            </BContainer>
        </section>


        

        <section class="section bg-light" id="plans">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <BContainer>
                <BRow class="justify-content-center mt-n4">
                    <BCol lg="8">
                        <div class="text-center mb-5">
                            <h4 class="mb-2 fw-semibold">Choose the plan that's right for you</h4>
                            <p class="text-muted mb-4 fs-13">Simple pricing. No hidden fees. Plans designed for photographers, studios, and creative teams.</p>

                            <div class="d-flex justify-content-center align-items-center">
                                <div>
                                    <h5 class="fs-14 mb-0">Monthly</h5>
                                </div>
                                <div class="form-check form-switch fs-20 ms-3 ">
                                    <input class="form-check-input" type="checkbox" id="plan-switch">
                                    <label class="form-check-label" for="plan-switch"></label>
                                </div>
                                <div>
                                    <h5 class="fs-14 mb-0">Annual <BBadge variant="success-subtle"
                                            class="bg-success-subtle text-success">Save 20%</BBadge>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </BCol>
                </BRow>

                <BRow class="gy-4">
                    <!-- Starter Plan -->
                    <BCol lg="4" v-for="(list,index) in dropdowns.plans" v-bind:key="index">
                        <BCard no-body class="plan-box mb-0">
                            <BCardBody class="p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fs-15 fw-semibold">{{ list.name }}</h5>
                                        <p class="text-muted fs-13 mb-0">{{ list.description }}</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i :class="list.icon" class="fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month">  
                                        {{ list.pricings.find(p => p.billing_cycle === 'Yearly')?.currency.symbol }}{{
                                            list.pricings.find(p => p.billing_cycle === 'Monthly')?.amount 
                                                ? list.pricings.find(p => p.billing_cycle === 'Monthly').amount 
                                                : '-'
                                        }} <span class="fs-13 text-muted">/Month</span>
                                    </h1>
                                    <h1 class="annual"> 
                                        {{ list.pricings.find(p => p.billing_cycle === 'Yearly')?.currency.symbol }}{{
                                            list.pricings.find(p => p.billing_cycle === 'Yearly')?.amount
                                            ? list.pricings.find(p => p.billing_cycle === 'Yearly').amount 
                                            : '-'
                                        }}
                                        <span class="fs-13 text-muted">/Year</span>
                                    </h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 fs-13 ff-secondary">
                                        <li v-for="(l,index2) in list.features" v-bind:key="index2">
                                            <i v-if="l.active" class="ri-checkbox-circle-fill text-success me-1"></i> 
                                            <i v-else class="ri-close-circle-fill text-danger me-1"></i>
                                            <b>{{ l.label }}</b>
                                        </li>
                                    </ul>
                                    <div class="mt-4">
                                        <Link href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</Link>
                                    </div>
                                </div>
                            </BCardBody>
                        </BCard>
                    </BCol>

                    <!-- <BCol lg="4">
                        <BCard no-body class="plan-box mb-0 ribbon-box right">
                            <BCardBody class="p-4 m-2">
                                <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fs-15 fw-semibold">Pro Plan</h5>
                                        <p class="text-muted fs-13 mb-0">For growing studios</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-medal-fill fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">29</span> <span
                                            class="fs-13 text-muted">/Month</span></h1>
                                    <h1 class="annual"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">261</span>
                                        <span class="fs-13 text-muted">/Year</span>
                                    </h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 fs-13 ff-secondary">
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> <b>500 GB</b> (~25,000 photos or 100 videos)</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> <b>50</b> client galleries</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Advanced PDF albums</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Watermark removal</li>
                                        <li><i class="ri-close-circle-fill text-danger me-1"></i> Custom branding</li>
                                        <li><i class="ri-close-circle-fill text-danger me-1"></i> Priority support</li>
                                    </ul>
                                    <div class="mt-4">
                                        <Link href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</Link>
                                    </div>
                                </div>
                            </BCardBody>
                        </BCard>
                    </BCol>
                    <BCol lg="4">
                        <BCard no-body class="plan-box mb-0">
                            <BCardBody class="p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fs-15 fw-semibold">Studio Plan</h5>
                                        <p class="text-muted fs-13 mb-0">For agencies & enterprises</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-stack-fill fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">39</span> <span
                                            class="fs-13 text-muted">/Month</span></h1>
                                    <h1 class="annual"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">351</span>
                                        <span class="fs-13 text-muted">/Year</span>
                                    </h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 fs-13 ff-secondary">
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> <b>2 TB</b> (~100,000 photos or 400+ videos)</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> <b>Unlimited</b> client galleries</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Premium PDF albums</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Watermark removal</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Custom branding</li>
                                        <li><i class="ri-checkbox-circle-fill text-success me-1"></i> Priority support</li>
                                    </ul>
                                    <div class="mt-4">
                                        <Link href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</Link>
                                    </div>
                                </div>
                            </BCardBody>
                        </BCard>
                    </BCol> -->
                </BRow>

            </BContainer>
        </section>
       



        <section class="py-5 bg-primary position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <BContainer>
                <BRow class="align-items-center gy-4">
                    <BCol sm="">
                        <div>
                            <h4 class="text-white fs-18 fw-semibold">Capture. Share. Amaze </h4>
                            <p class="text-white fs-12 text-opacity-75 mb-0">Upload and share photos or videos, manage client access, and let them download albums in stunning PDF form — all in one place.</p>
                        </div>
                    </BCol>

                    <BCol sm="auto">
                        <BButton @click="openRegister()"  type="button" variant="danger">Subscribe Now <i
                                class="ri-arrow-right-line align-bottom"></i></BButton>
                    </BCol>

                </BRow>
            </BContainer>
        </section>

        <footer class="custom-footer bg-dark py-5 position-relative">
            <BContainer>
                <BRow>
                    <BCol lg="4" class="mt-4">
                        <div>
                            <div>
                                <img src="/images/logo-light.png" alt="logo light" height="30" />
                            </div>
                            <div class="mt-4 fs-13">
                                <p>Premium Media Sharing & Client Showcase Platform</p>
                                <p>Easily upload, organize, and share photos or videos, manage client access, and deliver albums in stunning PDF format — all in one place.</p>
                                <ul class="list-inline mb-0 footer-social-link">
                                    <li class="list-inline-item">
                                        <BLink href="#" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-facebook-fill"></i>
                                            </div>
                                        </BLink>
                                    </li>
                                    <li class="list-inline-item">
                                        <BLink href="#" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-github-fill"></i>
                                            </div>
                                        </BLink>
                                    </li>
                                    <li class="list-inline-item">
                                        <BLink href="#" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-linkedin-fill"></i>
                                            </div>
                                        </BLink>
                                    </li>
                                    <li class="list-inline-item">
                                        <BLink href="#" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-google-fill"></i>
                                            </div>
                                        </BLink>
                                    </li>
                                    <li class="list-inline-item">
                                        <BLink href="#" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-dribbble-line"></i>
                                            </div>
                                        </BLink>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </BCol>

                    <BCol lg="7" class="ms-lg-auto">
                        <BRow>
                            <BCol sm="4" class="mt-4">
                                <h5 class="text-white mb-0">Company</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li>
                                            <Link href="/pages/profile">About Us</Link>
                                        </li>
                                        <li>
                                            <Link href="#">Gallery</Link>
                                        </li>
                                        <li>
                                            <Link href="/pages/team">Team</Link>
                                        </li>
                                        <li>
                                            <Link href="/pages/pricing">Pricing</Link>
                                        </li>
                                        <li>
                                            <Link href="/pages/timeline">Timeline</Link>
                                        </li>
                                    </ul>
                                </div>
                            </BCol>
                            <BCol sm="4" class="mt-4">
                                <h5 class="text-white mb-0">For Jobs</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li>
                                            <Link href="/jobs/lists">Job List</Link>
                                        </li>
                                        <li>
                                            <Link href="/jobs/application">application</Link>
                                        </li>
                                        <li>
                                            <Link href="/jobs/new">New Job</Link>
                                        </li>
                                        <li>
                                            <Link href="/jobs/companies-list">Company List</Link>
                                        </li>
                                    </ul>
                                </div>
                            </BCol>
                            <BCol sm="4" class="mt-4">
                                <h5 class="text-white mb-0">Support</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li>
                                            <Link href="/pages/faqs">FAQ</Link>
                                        </li>
                                        <li>
                                            <Link href="/pages/faqs">Contact</Link>
                                        </li>
                                    </ul>
                                </div>
                            </BCol>
                        </BRow>
                    </BCol>

                </BRow>

                <BRow class="text-center text-sm-start align-items-center mt-5">
                    <BCol sm="6">
                        <div>
                            <p class="copy-rights mb-0">
                                {{ new Date().getFullYear() }} © KradWorks
                            </p>
                        </div>
                    </BCol>
                    <BCol sm="6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-list gap-4 fs-13">
                                <li class="list-inline-item">
                                    <Link href="/pages/privacy-policy">Privacy Policy</Link>
                                </li>
                                <li class="list-inline-item">
                                    <Link href="/pages/term-conditions">Terms & Conditions</Link>
                                </li>
                                <li class="list-inline-item">
                                    <Link href="/pages/privacy-policy">Security</Link>
                                </li>
                            </ul>
                        </div>
                    </BCol>
                </BRow>
            </BContainer>
        </footer>
        <BButton variant="info" @click="topFunction" class="btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </BButton>
    </div>
    <BModal v-model="showModal" style="--vz-modal-width: 700px;" hide-footer body-class="p-0" header-class="p-0"
        class="v-modal-custom" content-class="border-0 overflow-hidden" centered hide-header-close>
        <div class="modal-body login-modal p-5">
           <h5 class="text-white fs-16 mb-1 mt-n4">Photographer Registration</h5>
            <p class="text-white-50 fs-11 mb-4">Join our platform and showcase your photography skills. Please provide accurate details for your profile.</p>
            <div class="vstack gap-2 justify-content-center">
               <form class="customform mb-n5" style="color: white;">
                    <BRow class="g-3 mb-4"> 
                        <BCol lg="12" class="mt-n2 mb-0">
                            <hr class="text-muted"/>
                        </BCol>
                        <BCol lg="12" class="mt-n2">
                            <InputLabel for="name" value="Full Name" :message="form.errors.fullname"/>
                            <b-row class="g-3 mb-2 mt-n3">
                                <b-col lg>
                                    <div class="input-group mb-0">
                                        <input type="text" v-model="form.firstname" placeholder="First name" class="form-control" style="width: 28%; min-height: 38.4px !important; background-color: #f5f6f7;">
                                        <input type="text" v-model="form.middlename" placeholder="Middle name" class="form-control" style="width: 28%; min-height: 38.4px !important; background-color: #f5f6f7;">
                                        <input type="text" v-model="form.lastname" placeholder="Last name" class="form-control" style="width: 28%; min-height: 38.4px !important; background-color: #f5f6f7;">
                                        <!-- <input type="text" v-model="form.suffix" placeholder="Suffix" class="form-control" style="width: 16%; min-height: 38.4px !important; background-color: #f5f6f7;"> -->
                                        <select v-model="form.suffix_id" class="form-select" style="width: 16%; height: 39px;">
                                             <option :value="null" selected>Select suffix</option>
                                            <option v-for="(list,index) in dropdowns.suffixes" v-bind:key="index" :value="list.value">{{list.name}}</option>
                                        </select>
                                    </div>
                                </b-col>
                            </b-row>
                        </BCol>
                        <BCol lg="6" class="mt-n1">
                            <InputLabel for="region" value="Sex" :message="form.errors.sex"/>
                            <Multiselect :options="dropdowns.sexes" :searchable="true" label="name" v-model="form.sex_id" placeholder="Select Sex" @input="handleInput('sex_id')" :light="true" style="color: black;"/>
                        </BCol>
                        <BCol lg="6" class="mt-n1">
                            <InputLabel for="region" value="Country" :message="form.errors.country_id"/>
                            <Multiselect 
                            :options="dropdowns.countries" 
                            :groups="true" :searchable="true"
                            label="name" v-model="form.country_id" 
                            placeholder="Select Country" 
                            @input="handleInput('country_id')" 
                            style="color: black;"/>
                        </BCol>
                    </BRow>
               </form>
            </div>
        </div>
       
        <div class="modal-body p-5">
            <form class="customform">
                <BRow class="g-3" style="margin-top: -35px;"> 
                    <BCol lg="6" class="mt-1">
                        <InputLabel for="name" value="Email Address" :message="form.errors.email"/>
                        <TextInput id="name" v-model="form.email" type="text" class="form-control" placeholder="Please enter email" @input="handleInput('email')" :light="true"/>
                    </BCol>
                    <BCol lg="6" class="mt-1">
                        <InputLabel for="name" value="Contact no." :message="form.errors.mobile"/>
                        <TextInput id="name" v-model="form.mobile" type="text" class="form-control" placeholder="Please enter contact no." @input="handleInput('contact_no')" :light="true"/>
                    </BCol>
                    <BCol lg="12">
                        <div class="alert alert-info alert-border-left alert-dismissible fade show material-shadow fs-11" role="alert">
                            <span class="fs-10" style="line-height: 1.2; display: inline-block;"> <strong>Notice:</strong> A temporary password has been sent to your registered email address. Please check your inbox and follow the instructions to continue.</span>
                        </div>
                    </BCol>
                    <!-- <BCol lg="6" class="mt-0">
                        <InputLabel for="region" value="Studio" :message="form.errors.studio_id"/>
                        <Multiselect 
                        :options="studios" 
                        :searchable="true"
                        label="name" v-model="form.studio_id" 
                        placeholder="Select Studio" 
                        @input="handleInput('studio_id')" 
                        style="color: black;"/>
                    </BCol>
                    <BCol lg="6" class="mt-0">
                        <InputLabel for="name" value="Years of Experience" :message="form.errors.experience"/>
                        <TextInput id="name" v-model="form.experience" type="text" class="form-control" placeholder="Please enter experience" @input="handleInput('experience')" :light="true"/>
                    </BCol>
                    <BCol lg="12" class="mt-0">
                        <InputLabel for="name" value="Biography" :message="form.errors.information"/>
                        <Textarea id="name" v-model="form.information" type="text" class="form-control" placeholder="Photographer Biography" @input="handleInput('information')" :light="true"/>
                    </BCol> -->
                    <!-- <BCol lg="12" class="mt-0"><hr class="text-muted"/></BCol>
                    <BCol lg="6" class="mt-n2">
                        <InputLabel for="password" value="Password" :message="form.errors.password"/>
                        <TextInput id="password" 
                            v-model="form.password" 
                            type="password" 
                            class="form-control" 
                            placeholder="Enter password" 
                            @input="handleInput('password')" 
                            :light="true"/>
                    </BCol>
                    <BCol lg="6" class="mt-n2">
                        <InputLabel for="password_confirmation" value="Confirm Password" :message="form.errors.password_confirmation"/>
                        <TextInput id="password_confirmation" 
                            v-model="form.password_confirmation" 
                            type="password" 
                            class="form-control" 
                            placeholder="Confirm password" 
                            @input="handleInput('password_confirmation')" 
                            :light="true"/>
                    </BCol> -->
                    <BCol lg="12">
                        <div class="mt-n1 form-check">
                            <input type="checkbox" v-model="form.check" class="form-check-input" id="checkTerms">
                            <label class="form-check-label" for="checkTerms"><i>I agree to the</i> <span class="fw-semibold text-primary" @click="tos = true">Terms of Service</span> <i>and Privacy Policy</i></label>
                        </div>
                    </BCol>
                    
                </BRow>
                <div class="text-end mt-n3">
                    <button @click="submit('ok')" class="btn btn-primary btn-md" type="button" :disabled="!form.check">
                        <div class="btn-content">Submit Now</div>
                    </button>
                </div>
            </form>
        </div>
    </BModal>
</template>
<script>
import { Link, Head } from '@inertiajs/vue3';
import { Autoplay } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/autoplay";
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
import Textarea from '@/Shared/Components/Forms/Textarea.vue';
export default {
    layout: null,
    props: ['dropdowns'],
    data() {
        return {
            Autoplay,
            form: useForm({
                firstname: null,
                lastname: null,
                middlename: null,
                suffix_id: null,
                mobile: null,
                email: null,
                sex_id: null,
                // information: null,
                // experience: null,
                // country_id: null,
                // studio_id: null,
                check: false,
                // password: null,
                // avatar: 'avatar.jpg',
                // password_confirmation: null,
                // role: 'Photographer'
            }),
            tos: false,
            agree: false,
            showModal: false
        };
    },
    components: {
        Swiper, SwiperSlide,Link,
        Head,
        Multiselect, InputLabel, TextInput, Textarea
    },
    computed: {
        message() {
            return (this.$page.props.flash.message) ?  true : false;
        }
    },
    methods: {
        submit(){
            this.form.post('/',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.form.clearErrors();
                    this.form.reset();
                    this.showModal = false;
                },
            });
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        openRegister(){
            this.showModal = true;
        },
        scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        },
        monthly() {
            const highlightedItems = document.querySelectorAll(".month");

            highlightedItems.forEach(function (userItem) {
                userItem.style.display = "block";
            });
            const highlightedItems2 = document.querySelectorAll(".annual");

            highlightedItems2.forEach(function (userItem) {
                userItem.style.display = "none";
            });
        },
        anually() {
            const highlightedItems = document.querySelectorAll(".month");

            highlightedItems.forEach(function (userItem) {
                userItem.style.display = "none";
            });
            const highlightedItems2 = document.querySelectorAll(".annual");

            highlightedItems2.forEach(function (userItem) {
                userItem.style.display = "block";
            });
        }
    },
    mounted() {

        let backtoTop = document.getElementById("back-to-top");

        if (backtoTop) {
            backtoTop = document.getElementById("back-to-top");
            window.onscroll = function () {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    backtoTop.style.display = "block";
                } else {
                    backtoTop.style.display = "none";
                }
            };
        }
        this.monthly();
        document.getElementById("plan-switch").addEventListener('change', () => {
            if (document.getElementById("plan-switch").checked == true) {
                this.anually();
            } else if (document.getElementById("plan-switch").checked == false) {
                this.monthly();
            }
        });

        window.addEventListener('scroll', function (ev) {
            ev.preventDefault();
            var navbar = document.getElementById("navbar");
            if (navbar) {
                if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
                    navbar.classList.add("is-sticky");
                } else {
                    navbar.classList.remove("is-sticky");
                }
            }
        });
    },
};
</script>

