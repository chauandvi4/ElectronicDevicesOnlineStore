<div id="app" v-cloak>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">
                    <!-- list section start -->
                    <div class="card">
                        <h2 class="card-header"><?php echo $pagetitle; ?></h2>
                        <div class="pt-0 p-2">
                            <!-- users edit Info form start -->
                            <validation-observer v-slot="{ handleSubmit }">
                                <form class="form-validate" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset">
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <h4 class="mb-1">
                                                <i data-feather="user" class="font-medium-4 me-25"></i>
                                                <span class="align-middle">Personal Information</span>
                                            </h4>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
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
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|email" v-slot="{ errors }">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input
                                                        v-model="formData.email"
                                                        id="email"
                                                        name="email"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Ex: exapmle@gmail.com" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input
                                                        v-model="formData.password"
                                                        id="password"
                                                        name="password"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="**********" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex gap-1 flex-sm-row flex-column mt-2 justify-content-end">
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                            <!-- users edit Info form ends -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
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
            id: null,
            initData: {
                status: "active",
            },
            formData: {
                email: "",
                password: "",
                full_name: "",
            }
        },
        methods: {
            onSubmit() {
                if (!this.id) {
                    UserService.register(this.formData)
                        .then(res => {
                            Utils.delayNavigate('/admin/user/')
                        });
                } else {
                    UserService.update(this.id, this.formData).then(res => {
                        // reload 
                        this.getFormData();
                    });
                }
            },
            reset() {
                this.formData = {
                    ...this.initData
                }
            },
            getFormData() {
                UserService.getOne(this.id).then(res => {
                    this.formData = {
                        ...res.data
                    }
                    this.initData = {
                        ...res.data
                    }
                })
            }
        },
        mounted() {
            const params = new URLSearchParams(location.search);
            this.id = params.get("id");

            if (this.id) {
                this.getFormData();
            }
        },
    });
</script>