<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/extensions/toastr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/horizontal-menu.css" />
<link rel="stylesheet" type="text/css" href="/theme-assets/css/plugins/extensions/ext-component-sliders.css" />
<link rel="stylesheet" type="text/css" href="/theme-assets/css/pages/app-ecommerce.css" />
<link rel="stylesheet" type="text/css" href="/theme-assets/css/plugins/extensions/ext-component-toastr.css" />
<!-- END: Page CSS-->

<!-- BEGIN: Content-->
<div class="app-content content ecommerce-application" id="app" v-cloak>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Product Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="/">product</a>
                                <li class="breadcrumb-item active">Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- app e-commerce details start -->
            <section class="app-ecommerce-details">
                <div class="card">
                    <!-- Product Details starts -->
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img :src="product.image_url" class="img-fluid product-img" alt="product image" />
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <h4>{{product.name}}</h4>
                                <span class="card-text item-company">By <a href="#" class="company-name">Apple</a></span>
                                <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                    <h4 class="item-price me-1">{{formatNumberPrice(product.price)}}</h4>
                                    <ul class="unstyled-list list-inline ps-1 border-start" v-if="product.rate">
                                        <li class="ratings-list-item" v-for="index in product.rate">
                                            <i class="fas fa-solid fa-star filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item" v-for="index in 5 - product.rate">
                                            <i class="fas fa-solid fa-star unfilled-star"></i>
                                        </li>
                                        <a v-bind:href="'comment.php?product='+this.id" class="card-link">Add Review</a>
                                    </ul>
                                </div>
                                <p class="card-text" v-if="product.status == 'In Stock'">Available - <span class="text-success">In stock</span></p>
                                <p class="card-text" v-if="product.status != 'In Stock'"><span class="text-secondary">{{product.status}}</span></p>
                                <p class="card-text">
                                    {{product.description}}
                                </p>
                                <ul class="product-features list-unstyled text-primary" v-if="product.freeShip">
                                    <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
                                </ul>
                                <div class="d-flex flex-column flex-sm-row pt-1">
                                    <a href="#" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                                        <i class="fas fa-regular fa-shopping-cart" class="me-50"></i>
                                        <span class="add-to-cart">Add to cart</span>
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                                        <i data-feather="heart" class="me-50"></i>
                                        <span>Wishlist</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details ends -->

                    <!-- Item features starts -->
                    <div class="item-features mb-2">
                        <div class="row text-center">
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <i class="fas fa-award fa-3x  text-primary"></i>
                                    <h4 class="mt-2 mb-1">100% Original</h4>
                                    <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <i class="fas fa-regular fa-clock fa-3x text-primary"></i>
                                    <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                                    <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <div class="w-75 mx-auto">
                                    <!-- <i class="fas fa-light fa-shield-blank fa-3x"></i> -->
                                    <i class="fas fa-regular fa-shield-alt fa-3x  text-primary"></i>
                                    <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                                    <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Item features ends -->

                    <!-- Related Products starts -->
                    <div class="card-body" v-if="relatedProductList.length != 0">
                        <div class="mt-4 mb-2 text-center">
                            <h4>Related Products</h4>
                            <p class="card-text">People also search for this items</p>
                            <v-carousel :show-arrows="false" class="my-3">
                                <template v-for="(item, index) in relatedProductList">
                                    <v-carousel-item v-if="(index + 1) % columns === 1 || columns === 1"
                                        :key="index">
                                        <v-row class="flex-nowrap" style="height:100%">
                                            <template v-for="(n,i) in columns">
                                                <template v-if="(+index + i) < relatedProductList.length">
                                                    <v-col :key="i">
                                                        <div class="swiper-slide py-2" v-if="(+index + i) < relatedProductList.length" style="background-color: #f8f8f8;">
                                                            <a v-bind:href="'productDetail.php?id='+relatedProductList[+index + i]['id']">
                                                                <div class="item-heading">
                                                                    <h5 class="text-truncate mb-0">{{relatedProductList[+index + i]['name']}}</h5>
                                                                    <small class="text-body">by Apple</small>
                                                                </div>
                                                                <div class="img-container w-25 mx-auto py-75">
                                                                    <img :src="relatedProductList[+index + i]['image_url']" class="img-fluid" alt="image" />
                                                                </div>
                                                                <div class="item-meta">
                                                                    <ul class="unstyled-list list-inline mb-25">
                                                                        <li class="ratings-list-item" v-for="index in relatedProductList[+index + i]['rate']">
                                                                            <i class="fas fa-solid fa-star filled-star"></i>
                                                                        </li>
                                                                        <li class="ratings-list-item" v-for="index in 5 - relatedProductList[+index + i]['rate']">
                                                                            <i class="fas fa-solid fa-star unfilled-star"></i>
                                                                        </li>
                                                                    </ul>
                                                                    <p class="card-text text-primary mb-0">{{formatNumberPrice(relatedProductList[+index + i]['price'])}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </v-col>
                                                </template>
                                            </template>
                                        </v-row>
                                    </v-carousel-item>
                                </template>
                            </v-carousel>
                        </div>
                    </div>
                </div>
                <!-- Related Products ends -->
        </div>



        <div v-for="item in comments" class="card mb-4">
            <div class="card-body">
                <div class="d-flex flex-wrap mt-1">
                    <h4 class="card-title">{{item.full_name}}</h4>
                    <ul class="unstyled-list list-inline ps-1 ">
                        <!-- <li v-for="n in item.star" class="ratings-list-item">
                            <i data-feather="star" class="filled-star"></i>
                        </li>
                        <li v-for="n in (5- item.star)" class="ratings-list-item">
                            <i data-feather="star" class="unfilled-star"></i>
                        </li> @rating-selected="setRating" -->
                        <star-rating v-model="item.star" :increment="0.5" :star-size="20" read-only :show-rating="false"></star-rating>
                    </ul>
                </div>
                <div class="card-subtitle text-muted mb-1">{{item.updated_at}}</div>
                <p class="card-text">
                    {{item.text}}
                </p>

                <a v-if="item.user_id == __USER__.id" v-bind:href="'comment.php?id='+item.id" class="card-link">Edit</a>

                <a v-if="item.user_id == __USER__.id" href="#" class="card-link" v-on:click="handleDelete(item.id)">Delete</a>
            </div>
        </div>
        </section>
        <!-- app e-commerce details end -->

    </div>
</div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="/theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/theme-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="/theme-assets/vendors/js/extensions/wNumb.min.js"></script>
<script src="/theme-assets/vendors/js/extensions/nouislider.min.js"></script>
<script src="/theme-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="/theme-assets/js/scripts/pages/app-ecommerce.js"></script>
<!-- END: Page JS-->
<script src="https://unpkg.com/vue-star-rating/dist/VueStarRating.umd.min.js"></script>
<script type="module">
    // import Vue from "vue";
    import {
        ProductService
    } from '@services/ProductService';
    import {
        CommentService
    } from '@services/CommentService';
    Vue.component('star-rating', VueStarRating.default);
    Vue.use(Vuetify);
    new Vue({
        el: "#app",
        vuetify: new Vuetify(),
        data: {
            slider: [
                "red",
                "green",
                "orange",
                "blue",
                "pink",
                "purple",
                "indigo",
                "cyan",
                "deep-purple",
                "light-green",
                "deep-orange",
                "blue-grey"
            ],
            id: null,
            product: {},
            relatedProductList: [],
            comments: [],
            rating: 3
        },
        computed: {
            columns() {
                if (this.$vuetify.breakpoint.xl) {
                    return 4;
                }

                if (this.$vuetify.breakpoint.lg) {
                    return 3;
                }

                if (this.$vuetify.breakpoint.md) {
                    return 2;
                }

                return 1;
            }
        },
        methods: {
            getFilter(category) {
                ProductService.getListFilter(1, 5, "", 0, Number.MAX_SAFE_INTEGER, category)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.relatedProductList = rows.filter((data) => data.id != this.id);
                        console.log("Row", rows.filter((data) => data.id != this.id));
                    });
            },
            getProduct() {
                ProductService.getOne(this.id)
                    .then(res => {
                        console.log(res)
                        this.product = res.data
                        if (res.data) {
                            this.getFilter(this.product.category);
                        }
                    });
            },
            formatNumberPrice(num) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(num)
            },
            getComments() {
                CommentService.getComments(this.id)
                    .then(res => {
                        console.log(res.data)
                        this.comments = res.data
                    });
            },
            setRating: function(rating) {
                this.rating = rating;
                console.log(this.rating);
            },
            handleDelete: function(id) {
                CommentService.delete(id).then(res => {
                    this.getComments()
                });
            },
        },
        mounted() {
            const params = new URLSearchParams(location.search)
            this.id = params.get("id");

            if (this.id) {
                this.getProduct()
                this.getComments()
            }
        },
    });
</script>