<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="../../../theme-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/editors/quill/katex.min.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/editors/quill/monokai-sublime.min.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/editors/quill/quill.snow.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/plugins/forms/form-quill-editor.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/css/pages/page-blog.css">
<!-- END: Page CSS-->

<div id="app" v-cloak>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- Blog Edit -->
                <!-- products list start -->
                <section class="app-list">

                    <div class="col-12">
                        <div class="card">
                            <h2 class="card-header"><?php echo $pagetitle; ?></h2>
                            <div class="pt-0 p-2">
                                <!-- Form -->
                                <validation-observer v-slot="{ handleSubmit }">
                                    <form class="form-validate" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset">
                                        <div class="row">
                                            <div class=" col-12">
                                                <div class="mb-2">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input
                                                            type="text"
                                                            id="name"
                                                            class="form-control"
                                                            v-model="formData.name" />
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="status">Status</label>
                                                        <select class="form-select" id="status" v-model="formData.status">
                                                            <option disabled value="">Please select one</option>
                                                            <option value="Published">Published</option>
                                                            <option value="Draft">Draft</option>
                                                        </select>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>

                                                </div>
                                            </div> -->


                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="description">Description</label>
                                                        <textarea
                                                            v-model="formData.description"
                                                            id="description"
                                                            name="description"
                                                            type="text"
                                                            rows="6"
                                                            class="form-control"></textarea>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary me-1">Save Changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ Form -->
                                </validation-observer>
                            </div>
                        </div>
                    </div>

                </section>
                <!--/ Blog Edit -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<!-- BEGIN: Vendor JS-->
<script src="/theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/theme-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="/theme-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="/theme-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="/theme-assets/vendors/js/editors/quill/quill.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/theme-assets/js/core/app-menu.js"></script>
<script src="/theme-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/theme-assets/js/scripts/pages/page-blog-edit.js"></script>
<!-- END: Page JS-->

<script type="module">
    import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        BlogService
    } from "@services/BlogService";

    Object.keys(Rules).forEach(rule => {
        extend(rule, Rules[rule]);
    });

    Vue.use(Vuetify);

    new Vue({
        el: "#app",
        vuetify: new Vuetify(),
        components: {
            'validation-provider': ValidationProvider,
            'validation-observer': ValidationObserver,
        },
        data: {
            id: null,
            initData: {},
            formData: {
                name: "",
                description: "",
            }
        },
        methods: {
            onSubmit() {
                if (!this.id) {
                    BlogService.createTopic(this.formData)
                        .then(res => {
                            Utils.delayNavigate('/admin/blog/index_topic.php')
                        });
                } else {
                    BlogService.updateTopic(this.id, this.formData).then(res => {
                        // reload 
                        console.log(this.formData);
                        console.log("edit data");
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
                BlogService.getOneTopic(this.id).then(res => {
                    this.formData = {
                        ...res.data
                    }
                    this.initData = {
                        ...res.data
                    }
                })
            },
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


<!-- END: Body-->