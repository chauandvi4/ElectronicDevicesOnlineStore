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
                            Products
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached content-right">
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
                                    <div class="search-results">{{totalRecords}} results found</div>
                                </div>
                                <div class="view-options d-flex">
                                    <div class="btn-group dropdown-sort">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle me-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="active-sorting">Featured</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Featured</a>
                                            <a class="dropdown-item" href="#">Lowest</a>
                                            <a class="dropdown-item" href="#">Highest</a>
                                        </div>
                                    </div>
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
                <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control search-product"
                                    @input="debounceSearch"
                                    id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- E-commerce Search Bar Ends -->

                <!-- E-commerce Products Starts -->
                <section id="ecommerce-products" class="grid-view">

                    <div class="card ecommerce-card" v-for="item in productList" :key="`${item.id}-${wishlist.length}`">
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
                                    v-bind:class="{'text-danger': checkWishlistProduct(item.id),'text-secondary': !checkWishlistProduct(item.id)}"></i>
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
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <!-- Ecommerce Sidebar Starts -->
                <div class="sidebar-shop">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Price Filter starts -->
                            <div class="multi-range-price">
                                <h6 class="filter-title mt-0">Multi Range</h6>
                                <ul class="list-unstyled price-range" id="price-range">
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(0, Number.MAX_SAFE_INTEGER)">
                                            <input type="radio" id="priceAll" name="price-range" class="form-check-input" :checked="filter.priceFrom == 0 && filter.priceTo == Number.MAX_SAFE_INTEGER" />
                                            <label class="form-check-label" for="priceAll">All</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(0, 10000000)">
                                            <input type="radio" id="priceRange1" name="price-range" class="form-check-input" />
                                            <label class="form-check-label" for="priceRange1">&lt;={{formatNumberPrice(10000000)}}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(10000000,20000000)">
                                            <input type="radio" id="priceRange2" name="price-range" class="form-check-input" />
                                            <label class="form-check-label" for="priceRange2">{{formatNumberPrice(10000000)}} - {{formatNumberPrice(20000000)}}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(20000000,30000000)">
                                            <input type="radio" id="priceARange3" name="price-range" class="form-check-input" />
                                            <label class="form-check-label" for="priceARange3">{{formatNumberPrice(20000000)}} - {{formatNumberPrice(30000000)}}</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(30000000,Number.MAX_SAFE_INTEGER )">
                                            <input type="radio" id="priceRange4" name="price-range" class="form-check-input" />
                                            <label class="form-check-label" for="priceRange4">&gt;= {{formatNumberPrice(30000000)}}</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Price Filter ends -->

                            <!-- Categories Starts -->
                            <div id="product-categories">
                                <h6 class="filter-title">Categories</h6>
                                <ul class="list-unstyled categories-list" id="category">
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null , 'All')">
                                            <input type="radio" id="categoryAll" name="category-filter" class="form-check-input" :checked="filter.category == 'All'" />
                                            <label class="form-check-label" for="categoryAll">All</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null , 'iPhone')">
                                            <input type="radio" id="iPhone" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='iPhone'}" />
                                            <label class="form-check-label" for="iPhone">iPhone</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null, 'Mac')">
                                            <input type="radio" id="Mac" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='Mac'}" />
                                            <label class="form-check-label" for="Mac">Mac</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null, 'iPad')">
                                            <input type="radio" id="iPad" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='iPad'}" />
                                            <label class="form-check-label" for="iPad">iPad</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null, 'Watch')">
                                            <input type="radio" id="Watch" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='Watch'}" />
                                            <label class="form-check-label" for="Watch">Watch</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null , 'iPod')">
                                            <input type="radio" id="iPod" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='iPod'}" />
                                            <label class="form-check-label" for="iPod">iPod</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check" v-on:click.stop="productFilter(null,null , 'Accessories')">
                                            <input type="radio" id="Accessories" name="category-filter" class="form-check-input"
                                                v-bind:class="{checked: filter.category=='Accessories'}" />
                                            <label class="form-check-label" for="Accessories">Accessories</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Categories Ends -->

                            <!-- Clear Filters Starts -->
                            <div id="clear-filters">
                                <button type="button" class="btn w-100 btn-primary" v-on:click.stop="clearFilter()">
                                    Clear All Filters
                                </button>
                            </div>
                            <!-- Clear Filters Ends -->
                        </div>
                    </div>
                </div>
                <!-- Ecommerce Sidebar Ends -->
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

    document.vueProductList = new Vue({
        el: "#app",
        data: {
            productList: [],
            totalRecords: 0,
            page: 1,
            limit: 5,
            totalPage: 1,
            filter: {
                priceFrom: 0,
                priceTo: Number.MAX_SAFE_INTEGER,
                category: "All",
            },
            wishlist: [],
            debounce: null,
            search: ""
        },
        methods: {
            onPageChange(params) {
                this.page = params;
                this.getFilter(this.page, this.limit, this.search);
            },
            getFilter(page, limit, search, priceFrom, priceTo, category) {
                ProductService.getListFilter(page, limit, search, priceFrom, priceTo, category)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.productList = rows;
                        this.totalRecords = totalRecords;
                        this.totalPage = Math.ceil(totalRecords / this.limit)
                    });
            },
            addProductToCart(productId) {
                CartService.addToCart(productId);
            },
            formatNumberPrice(num) {
                return Utils.formatPrice(num);
            },
            productFilter(priceFrom, priceTo, category) {
                this.page = 1
                if (priceFrom) {
                    this.filter.priceFrom = priceFrom;
                }
                if (priceTo) {
                    this.filter.priceTo = priceTo;
                }
                if (category) {
                    this.filter.category = category;
                }
                if (this.filter.category == "All") {
                    this.getFilter(this.page, this.limit, this.search, this.filter.priceFrom, this.filter.priceTo, undefined);
                } else {
                    this.getFilter(this.page, this.limit, this.search, this.filter.priceFrom, this.filter.priceTo, this.filter.category);
                }
            },
            clearFilter() {
                this.page = 1,
                    this.filter.priceFrom = 0;
                this.filter.priceTo = Number.MAX_SAFE_INTEGER;
                this.filter.category = "All";
                this.getFilter(this.page, this.limit, this.search);
            },
            getWishlistProduct() {
                WishlistService.getAll().then(({
                    rows,
                }) => {
                    this.wishlist = rows
                })
            },
            addProductToWishlist(productId) {
                WishlistService.addToWishlist(productId).then(() => {
                    this.getWishlistProduct();
                });
            },
            checkWishlistProduct(productId) {
                return this.wishlist.some((item) => {
                    if (item.product_id == productId) {
                        return true
                    }

                    return false;
                })
            },
            debounceSearch(event) {
                clearTimeout(this.debounce)
                this.debounce = setTimeout(() => {
                    console.log(event.target.value);
                    this.search = event.target.value,
                        this.getFilter(this.page, this.limit, this.search);
                }, 600)
            }
        },
        mounted() {
            this.getFilter(this.page, this.limit, this.search);
            this.getWishlistProduct()
        },
    });
</script>