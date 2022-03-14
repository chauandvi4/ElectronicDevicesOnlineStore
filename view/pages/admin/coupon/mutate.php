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
                                                <span class="align-middle">Coupon Information</span>
                                            </h4>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input
                                                        v-model="formData.name"
                                                        id="name"
                                                        name="name"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Ex: Coupon" />
                                                    <span class="text-danger">{{ errors[0]?.replace("name", "name") }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="discount_amount">Discount Amount</label>
                                                    <input
                                                        v-model="formData.discount_amount"
                                                        id="discount_amount"
                                                        name="discount_amount"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Ex: 10" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="d-block form-label mb-1">Status</label>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            v-model="formData.status"
                                                            name="status"
                                                            type="radio"
                                                            id="enable"
                                                            value="enable"
                                                            class="form-check-input"
                                                            checked />
                                                        <label class="form-check-label" for="enable">Enable</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            v-model="formData.status"
                                                            name="status"
                                                            type="radio"
                                                            id="disable"
                                                            value="disable"
                                                            class="form-check-input" />
                                                        <label class="form-check-label" for="disable">Disable</label>
                                                    </div>
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1" id="flatpickr">
                                                <validation-provider v-slot="{ errors }">
                                                    <label class="form-label" for="expiry_date">Expiry Date</label>
                                                    <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                                    <!-- <input
                                                        v-model="formData.expiry_date"
                                                        id="expiry_date"
                                                        name="expiry_date"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Ex: 10" /> -->
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                                <!-- <validation-provider :rules="'required'" v-slot="{errors}" slim> -->
                                        <!-- <div class="col-lg-4 col-md-6">
                                            <div class="mb-1" >
                                                    <v-menu
                                                        ref="wc_menu"
                                                        :close-on-content-click="false"
                                                        :return-value.sync="formData.expiry_date"
                                                        transition="scale-transition"
                                                        min-width="290px">o
                                                        <template v-slot:activator="{ on }">
                                                            <v-text-field
                                                                label="Policy Expiry Date"
                                                                name="formData.expiry_date"
                                                                v-model="formData.expiry_date"
                                                                readonly
                                                                :error-messages="'aa'"
                                                                v-on="on"></v-text-field>
                                                        </template>
                                                        <v-date-picker v-model="formData.expiry_date" no-title scrollable>
                                                            <v-spacer></v-spacer>
                                                            <v-btn text color="primary" @click="wc_menu = false">Cancel</v-btn>
                                                            <v-btn text color="primary" @click="$refs.wc_menu.save(formData.expiry_date)">OK</v-btn>
                                                        </v-date-picker>
                                                    </v-menu>
                                            </div>
                                        </div> -->
                                                <!-- </validation-provider> -->
                                                                <!-- :error-messages="errors[0]" -->
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric" v-slot="{ errors }">
                                                    <label class="form-label" for="usage_times">Usage Times</label>
                                                    <input
                                                        v-model="formData.usage_times"
                                                        id="usage_times"
                                                        name="usage_times"
                                                        type="text"
                                                        class="form-control" />
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
    // import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        CouponService
    } from '@services/CouponService';


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
            // 'v-menu': Menus
        },
        data: {
            wc_menu: false,

            id: null,
            initData: {
                status: "enable",
            },
            formData: {
                name: "",
                discount_amount: "",
                expiry_date: null,
                usage_times: 0,
                status: "enable",
            }
        },
        methods: {
            onSubmit() {
                if (!this.id) {
                    CouponService.create(this.formData)
                        .then(res => {
                            console.log(res);
                            // Utils.delayNavigate('/admin/coupon/')
                        });
                } else {
                    CouponService.update(this.id, this.formData).then(res => {
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
                CouponService.getOne(this.id).then(res => {
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