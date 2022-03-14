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
                        <h2 class="card-header"><?php echo $pagetitle; ?>:</h2>
                        <h4 class="pt-0 pb-0 p-2">{{formData.name}}</h4>
                        <div class="pt-0 p-2">
                            <!-- users edit Info form start -->
                            <validation-observer v-slot="{ handleSubmit }">
                                <form class="form-validate" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset">
                                    <div class="row mt-1">

                                        <ul class="unstyled-list list-inline ps-1 ">
                                            <star-rating v-model="formData.star" :increment="0.5" :star-size="20" @rating-selected="setRating" :show-rating="false"></star-rating>
                                        </ul>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea v-model="formData.text" id="text"
                                                    name="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Text</label>
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

<script src="https://unpkg.com/vue-star-rating/dist/VueStarRating.umd.min.js"></script>

<script type="module">
    import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        CommentService
    } from "@services/CommentService";

    Object.keys(Rules).forEach(rule => {
        extend(rule, Rules[rule]);
    });

    Vue.component('star-rating', VueStarRating.default);
    new Vue({
        el: "#app",
        components: {
            'validation-provider': ValidationProvider,
            'validation-observer': ValidationObserver,
        },
        data: {
            id: null,
            initData: {},
            formData: {
                id: null,
                star: 0,
                text: "",
                user_id: null,
                product_id: null,
                created_at: null,
                update_at: null,
                name: null,
            }
        },
        methods: {
            onSubmit() {
                if (!this.id) {
                    this.formData.user_id = __USER__.id;
                    //console.log(this.formData);
                    CommentService.create(this.formData)
                        .then(res => {
                            Utils.delayNavigate('/productDetail.php?id=' + this.formData.product_id)
                        });
                } else {
                    //console.log(this.formData)
                    CommentService.update(this.id, this.formData).then(res => {
                        // reload 
                        this.getFormData();
                        Utils.delayNavigate('/productDetail.php?id=' + this.formData.product_id)
                    });
                }
            },
            reset() {
                this.formData = {
                    ...this.initData
                }
            },
            getFormData() {
                CommentService.getOne(this.id).then(res => {
                    this.formData = {
                        ...res.data
                    }
                    console.log(this.formData)
                    this.initData = {
                        ...res.data
                    }
                })
            },
            setRating: function(rating) {
                this.rating = rating;
            }

        },
        mounted() {
            const params = new URLSearchParams(location.search);
            this.id = params.get("id");
            this.formData.product_id = params.get("product");
            if (this.id) {
                this.getFormData();
            }
        },
    });
</script>