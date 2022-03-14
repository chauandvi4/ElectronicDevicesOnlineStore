<div id="app" v-cloak>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Account Settings</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <!-- general -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-pill-general" data-bs-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i data-feather="user" class="font-medium-3 me-1"></i>
                                        <span class="fw-bold">General</span>
                                    </a>
                                </li>
                                <!-- change password -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-bs-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i data-feather="lock" class="font-medium-3 me-1"></i>
                                        <span class="fw-bold">Change Password</span>
                                    </a>
                                </li>
                                <!-- notification -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-notifications" data-bs-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                        <i data-feather="bell" class="font-medium-3 me-1"></i>
                                        <span class="fw-bold">Notifications</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/ left menu section -->

                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <!-- header section -->
                                            <div class="d-flex">
                                                <a href="#" class="me-25">
                                                    <img src="theme-assets/images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="rounded me-50" alt="profile image" height="80" width="80" />
                                                </a>
                                                <!-- upload and reset button -->
                                                <div class="mt-75 ms-1">
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                                    <input type="file" id="account-upload" hidden accept="image/*" />
                                                    <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                    <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div>
                                            <!--/ header section -->
                                            <validation-observer v-slot="{ handleSubmit }">
                                                <!-- form -->
                                                <form class="validate-form mt-2" @submit.prevent="handleSubmit(onSubmit)">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="mb-1">
                                                                <validation-provider rules="required" v-slot="{ errors }">
                                                                    <label class="form-label" for="full_name">Full name</label>
                                                                    <input
                                                                        v-model="formData.full_name"
                                                                        id="full_name"
                                                                        name="full_name"
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Ex: John Smith" />
                                                                    <span class="text-danger">{{ errors[0]?.replace("full_name", "full name") }}</span>
                                                                </validation-provider>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="mb-1">
                                                                <validation-provider rules="required|email" v-slot="{ errors }">
                                                                    <label class="form-label" for="email">Email</label>
                                                                    <input
                                                                        v-model="formData.email"
                                                                        id="email"
                                                                        name="email"
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Ex: JohnSmith@gmail.com" />
                                                                    <span class="text-danger">{{ errors[0]?.replace("email", "email") }}</span>
                                                                </validation-provider>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <validation-provider v-slot="{ errors }">
                                                                <label class="form-label" for="address">Address</label>
                                                                <input
                                                                    v-model="formData.address"
                                                                    id="address"
                                                                    name="address"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Ex: 268 Ly Thuong Kiet P14 Q10 HCM" />
                                                                <span class="text-danger">{{ errors[0]?.replace("address", "address") }}</span>
                                                            </validation-provider>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="mb-1">
                                                                <validation-provider v-slot="{ errors }">
                                                                    <label class="form-label" for="phone">Phone</label>
                                                                    <input
                                                                        v-model="formData.phone"
                                                                        id="phone"
                                                                        name="phone"
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Ex: 0938647256" />
                                                                    <span class="text-danger">{{ errors[0]?.replace("phone", "phone") }}</span>
                                                                </validation-provider>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-primary mt-2 me-1">Save changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!--/ form -->
                                            </validation-observer>
                                        </div>
                                        <!--/ general tab -->

                                        <!-- change password -->
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <validation-observer v-slot="{ handleSubmit }">

                                                <form class="validate-form" @submit.prevent="handleSubmit(onSubmitResetPass)">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="mb-1">
                                                                <validation-provider rules="required" v-slot="{ errors }">
                                                                    <label class="form-label" for="new_password">New Password</label>
                                                                    <input
                                                                        v-model="formData.new_password"
                                                                        id="new_password"
                                                                        name="new_password"
                                                                        type="password"
                                                                        class="form-control form-control-merge"
                                                                        placeholder="**********" />
                                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                                    <span v-if="errorPass" class="text-danger">Password must have atleast 6 characters.</span>
                                                                </validation-provider>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                                        </div>
                                                    </div>

                                                </form>
                                                <!--/ form -->
                                            </validation-observer>

                                        </div>
                                        <!--/ change password -->

                                        <!-- notifications -->
                                        <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                            <div class="row">
                                                <h6 class="section-label mb-2">Activity</h6>
                                                <div class="col-12 mb-2">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" checked id="accountSwitch1" />
                                                        <label class="form-check-label" for="accountSwitch1">
                                                            Email me when someone comments onmy article
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" checked id="accountSwitch2" />
                                                        <label class="form-check-label" for="accountSwitch2">
                                                            Email me when someone answers on my form
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" id="accountSwitch3" />
                                                        <label class="form-check-label" for="accountSwitch3">Email me hen someone follows me</label>
                                                    </div>
                                                </div>
                                                <h6 class="section-label mt-2">Application</h6>
                                                <div class="col-12 mt-1 mb-2">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" checked id="accountSwitch4" />
                                                        <label class="form-check-label" for="accountSwitch4">News and announcements</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" checked id="accountSwitch6" />
                                                        <label class="form-check-label" for="accountSwitch6">Weekly product updates</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-75">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" id="accountSwitch5" />
                                                        <label class="form-check-label" for="accountSwitch5">Weekly blog digest</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 me-1">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ notifications -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
</div>

<script type="module">
    import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        UserService
    } from "@services/UserService";

    Object.keys(Rules).forEach(rule => {
        extend(rule, Rules[rule]);
    });


    new Vue({
        el: "#app",
        components: {
            'validation-provider': ValidationProvider,
            'validation-observer': ValidationObserver,
        },
        data: {
            jwt: null,
            initData: {},
            formData: {
                id: "",
                email: "",
                full_name: "",
                address: "",
                phone: "",
                image_url: "",
                status: "",
                new_password: ""
            },
            errorPass: false
        },
        methods: {
            onSubmit() {
                UserService.meUpdate(this.formData.id, this.formData).then(res => {})
            },
            onSubmitResetPass() {
                if (this.formData.new_password.length < 6) {
                    this.errorPass = true;
                    return;
                }
                UserService.resetPass({
                    password: this.formData.new_password
                }).then(res => {})
            },
            reset() {
                this.formData = {
                    ...this.initData
                }
            },
            getFormData() {
                UserService.me().then(res => {
                    this.formData = {
                        ...res.data
                    }
                })
            }
        },
        mounted() {
            if (__USER__) {
                this.getFormData();
            }
        },
    });
</script>