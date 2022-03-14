<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/theme-assets/css/pages/app-ecommerce.css" />
<!-- END: Page CSS-->

<div class="app-content content ecommerce-application" id="app" v-cloak>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <!-- <h2 id="page-title" class="content-header-title float-start mb-0">Products</h2> -->
                        <h2 id="page-title" class="content-header-title float-start mb-0">
                            Wishlist
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached ">
            <div class="content-body">
                <!-- E-commerce Content Section Starts -->
                <section id="ecommerce-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ecommerce-header-items">
                                <div class="result-toggler">
                                    <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                                        <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                    </button>
                                    <div class="search-results">{{totalWishlist}} results found</div>
                                </div>
                                <div class="view-options d-flex">
                                    <div class="btn-group dropdown-sort">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                                            <label class="
                btn btn-icon btn-outline-primary
                view-btn
                grid-view-btn
                " for="radio_option1"><i class="fas fa-regular fa-th   text-primary" class="font-medium-3"></i></label>
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                                            <label class="
                btn btn-icon btn-outline-primary
                view-btn
                list-view-btn
                " for="radio_option2"><i class="fas fa-regular fa-list   text-primary" class="font-medium-3"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
                <!-- E-commerce Content Section Starts -->

                <!-- background Overlay when sidebar is shown  starts-->
                <div class="body-content-overlay"></div>
                <!-- background Overlay when sidebar is shown  ends-->

                <!-- E-commerce Search Bar Starts -->
                <!-- <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control search-product" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                </section> -->
                <!-- E-commerce Search Bar Ends -->

                <!-- E-commerce Products Starts -->
                <section id="ecommerce-products" class="grid-view">

                    <div class="card ecommerce-card" v-for="item in productList" :key="item.id">
                        <div class="align-items-center item-img justify-content-center text-center">
                            <a v-bind:href="'productDetail.php?id='+item.id">
                                <img class="img-fluid card-img-top" :src="item.image_url" alt="img-placeholder" style="width:180px"></a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item" v-for="index in item.rate">
                                            <i class="fas fa-solid fa-star filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item" v-for="index in 5 - item.rate">
                                            <i class="fas fa-solid fa-star unfilled-star"></i>
                                        </li>

                                    </ul>
                                </div>
                                <div>
                                    <h6 class="item-price">{{formatNumberPrice(item.price)}}</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" v-bind:href="'productDetail.php?id='+item.id">{{item.name}}</a>
                                <span class="card-text item-company">By <a href="#" class="company-name">Apple</a></span>
                            </h6>
                            <p class="card-text item-description">
                                {{item.description}}
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">{{formatNumberPrice(item.price)}}</h4>
                                </div>
                            </div>
                            <a class="btn btn-light btn-wishlist" v-on:click="addProductToWishlist(item.id)">
                                <i class="fas fa-regular fa-heart"
                                    v-bind:class="{'text-danger': !!checkWishlistProduct(item.id)}"
                                    v-bind:class="{'text-secondary': !checkWishlistProduct(item.id)}"></i>
                                <span>Wishlist</span>
                            </a>
                            <a class="btn btn-primary btn-cart" v-on:click="addProductToCart(item.id)">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                </section>
                <!-- E-commerce Products Ends -->

                <!-- E-commerce Pagination Starts -->
                <section id="ecommerce-pagination">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-2">
                                    <li class="page-item prev-item" v-on:click.stop="onPageChange(1)">
                                        <a class="page-link" href="#"></a>
                                    </li>

                                    <li class="page-item" v-bind:class="{active: page==index}" v-for="index in totalPage" v-on:click.stop="onPageChange(index)">
                                        <a class="page-link" href="#">{{index}}</a>
                                    </li>
                                    <li class="page-item next-item" v-on:click.stop="onPageChange(totalPage)">
                                        <a class="page-link" href="#"></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </section>
                <!-- E-commerce Pagination Ends -->
            </div>
        </div>
    </div>
</div>

<!-- BEGIN: Page Vendor JS-->
<script src="/theme-assets/vendors/js/extensions/wNumb.min.js"></script>
<script src="/theme-assets/vendors/js/extensions/nouislider.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="/theme-assets/js/scripts/pages/app-ecommerce.js"></script>
<!-- END: Page JS-->

<script type="module">
    import Vue from "vue";
    import {
        ProductService
    } from '@services/ProductService';
    import {
        CartService
    } from '@services/CartService';
    import {
        WishlistService
    } from '@services/WishlistService';

    document.vueWishlist = new Vue({
        el: "#app",
        data: {
            totalWishlist: 0,
            productList: [],
            totalRecords: 0,
            page: 1,
            limit: 5,
            totalPage: 1,
            wishlist: []
        },
        methods: {

            getTotalWishlistItems() {
                WishlistService.getAllCount().then((res) => this.totalWishlist = res.data)
            },

            getWishlistProduct(page, limit) {
                WishlistService.getWishlistProduct(page, limit).then((res) => {
                    this.productList = res.data
                })
            },

            getWishlist(page, limit) {
                WishlistService.getAll(page, limit).then(({
                    rows,
                    totalRecords
                }) => {
                    this.wishlist = rows
                })
            },

            onPageChange(params) {
                this.page = params;
            },
            addProductToCart(productId) {
                CartService.addToCart(productId);
            },
            formatNumberPrice(num) {
                return Utils.formatPrice(num);
            },
            addProductToWishlist(productId) {
                WishlistService.addToWishlist(productId);
            },
            checkWishlistProduct(productId) {
                let isWishlist = false;
                console.log(this.wishlist);
                this.wishlist.forEach(item => {
                    if (item.product_id == productId) {
                        isWishlist = true
                    }
                })
                return isWishlist;
            }
        },
        mounted() {
            this.getTotalWishlistItems()
            this.getWishlistProduct(this.page, this.limit)
            this.getWishlist(this.page, this.limit);


            this.$on('refetch_wishlist', function(data) {
                 this.getWishlist(this.page, this.limit);
                this.getWishlistProduct(this.page, this.limit);
                this.getTotalWishlistItems()
            })
        },
    });
</script>