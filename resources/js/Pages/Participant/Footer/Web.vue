<template>
    <footer class="custom-footer bg-dark py-5 position-relative">
        <b-container>
            <b-row>
                <b-col lg="7" class="mt-4">
                    <div>
                        <div>
                            <img src="images/logo-light.png" alt="logo light" height="25">
                        </div>
                        <div class="mt-4 fs-13">
                            <p>Science & Technology Scholarship Information Management System</p>
                            <p class="ff-secondary">STSIMS (Science & Technology Scholarship Information Management System) envisions to optimize the conduct of scholarship functions, that which in turn will ensure satisfaction among customers both internal and external.</p>
                        </div>
                    </div>
                </b-col>

                <b-col lg="5" class="ms-lg-auto">
                    <b-row>
                        <b-col sm="12" class="mt-4 text-end">
                            <h4 class="text-white mb-0">Contact Details</h4>
                            <div class="text-muted mt-4 fs-13">
                                <ul class="list-unstyled ff-secondary footer-list">
                                    <li>
                                        Department of Science and Technology Regional Office No. IX
                                    </li>
                                    <li>
                                        Pettit Barracks, Barangay Zone IV, Zamboanga City
                                    </li>
                                    <li>
                                        Tel.: (062) 991-1024
                                    </li>
                                    <li>
                                        Fax: (062) 992-1114
                                    </li>
                                </ul>
                            </div>
                        </b-col>
                        
                        
                    </b-row>
                </b-col>
            </b-row>

            <b-row class="text-center text-sm-start align-items-center mt-5">
                <b-col sm="6">

                    <div>
                        <p class="copy-rights mb-0 currentyear">{{ new Date().getFullYear() }} © DOST-IX
                        </p>
                    </div>
                </b-col>
                <b-col sm="6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <b-link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </b-link>
                            </li>
                            <li class="list-inline-item">
                                <b-link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-github-fill"></i>
                                    </div>
                                </b-link>
                            </li>
                            <li class="list-inline-item">
                                <b-link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-linkedin-fill"></i>
                                    </div>
                                </b-link>
                            </li>
                            <li class="list-inline-item">
                                <b-link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-google-fill"></i>
                                    </div>
                                </b-link>
                            </li>
                            <li class="list-inline-item">
                                <b-link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-dribbble-line"></i>
                                    </div>
                                </b-link>
                            </li>
                        </ul>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </footer>
</template>
<script>
export default {
    
}
</script>