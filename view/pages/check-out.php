<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require_once $path . "/inc/config.php";
?>

<link rel="stylesheet" type="text/css" href="theme-assets/vendors/css/forms/wizard/bs-stepper.min.css">

<link rel="stylesheet" type="text/css" href="theme-assets/css/pages/app-ecommerce.css">
<link rel="stylesheet" type="text/css" href="theme-assets/css/plugins/forms/pickers/form-pickadate.css">
<link rel="stylesheet" type="text/css" href="theme-assets/css/plugins/forms/form-wizard.css">
<link rel="stylesheet" type="text/css" href="theme-assets/css/plugins/extensions/ext-component-toastr.css">
<link rel="stylesheet" type="text/css" href="theme-assets/css/plugins/forms/form-number-input.css">

<!-- BEGIN: Content-->
<div id="app" v-cloak class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="float-start mb-0">Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="bs-stepper checkout-tab-steps">
                <!-- Wizard starts -->
                <div class="bs-stepper-header">
                    <div class="step" data-target="#step-cart" role="tab" id="step-cart-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Cart</span>
                                <span class="bs-stepper-subtitle">Your Cart Items</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#step-address" role="tab" id="step-address-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="fas fa-home"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Address</span>
                                <span class="bs-stepper-subtitle">Enter Your Address</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#step-payment" role="tab" id="step-payment-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="far fa-credit-card"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Payment</span>
                                <span class="bs-stepper-subtitle">Select Payment Method</span>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- Wizard ends -->

                <div class="bs-stepper-content">
                    <!-- Checkout Place order starts -->
                    <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                        <div id="place-order" class="list-view product-checkout">
                            <!-- Checkout Place Order Left starts -->
                            <div class="checkout-items">
                                <div class="card ecommerce-card" v-for="item in cartItems" :key="`${item.id}-${wishlist.length}`">
                                    <div class=" item-img">
                                        <a href="app-ecommerce-details.html">
                                            <img :src="item.image_url" alt="img-placeholder" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="item-name">
                                            <h6 class="mb-0"><a href="app-ecommerce-details.html" class="text-body">{{item.name}}</a></h6>
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
                                        </div>
                                        <span class="text-success mb-1">In Stock</span>
                                        <div class="item-quantity">
                                            <span class="quantity-title">Qty:</span>
                                            <div class="cart-item-qty">
                                                <div class="input-group bootstrap-touchspin">
                                                    <span class="input-group-btn bootstrap-touchspin-injected">
                                                        <button class="btn btn-primary bootstrap-touchspin-down" type="button"
                                                            v-on:click.stop="removeFromCart(item.id)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <input class="touchspin-cart form-control" type="number" :value="item.quantity">
                                                    <span class="input-group-btn bootstrap-touchspin-injected">
                                                        <button class="btn btn-primary bootstrap-touchspin-up" type="button"
                                                            v-on:click.stop="addToCart(item.id)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-options text-center">
                                        <div class="item-wrapper">
                                            <div class="item-cost">
                                                <h4 class="item-price">{{formatPrice(item.price * item.quantity)}}</h4>
                                                <p v-if="item.freeShip" class="card-text shipping">
                                                    <span class="badge rounded-pill badge-light-success">Free Shipping</span>
                                                </p>
                                            </div>
                                        </div>
                                        <button @click="removeFromCart(item.id, item.quantity)" type="button" class="btn btn-light mt-1 remove-wishlist">
                                            <i class="far fa-trash-alt me-1"></i>
                                            <span>Remove</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-cart move-cart" v-on:click="addProductToWishlist(item.id)">
                                            <i class="fas fa-regular fa-heart"
                                                v-bind:class="{'text-danger': checkWishlistProduct(item.id)}"></i>
                                            <span class="text-truncate">Wishlist</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Place Order Left ends -->

                            <!-- Checkout Place Order Right starts -->
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="section-label form-label mb-1">Options</label>
                                        <div class="coupons input-group input-group-merge">
                                            <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />
                                            <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>
                                        </div>
                                        <hr />
                                        <div class="price-details">
                                            <h6 class="price-title">Price Details</h6>
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title">Total MRP</div>
                                                    <div class="detail-amt">{{formatPrice(getTotalAmount())}}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Tax (10%)</div>
                                                    <div class="detail-amt">{{formatPrice(getTaxAmount())}}</div>
                                                </li>
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title detail-total">Total</div>
                                                    <div class="detail-amt fw-bolder">{{formatPrice(getTotalAmount() + getTaxAmount())}}</div>
                                                </li>
                                            </ul>
                                            <button type="button" class="btn btn-primary w-100 btn-next place-order">Fill Shipping Address</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Place Order Right ends -->
                            </div>
                        </div>
                        <!-- Checkout Place order Ends -->
                    </div>
                    <!-- Checkout Customer Address Starts -->
                    <div id="step-address" class="content" role="tabpanel" aria-labelledby="step-address-trigger">
                        <form id="checkout-address" class="list-view product-checkout">
                            <!-- Checkout Customer Address Left starts -->
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Add New Address</h4>
                                    <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-name">Full Name:</label>
                                                <input type="text" v-model="addressData.full_name" id="checkout-name" class="form-control" name="fname" placeholder="John Doe" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-phone">Phone:</label>
                                                <input type="text" v-model="addressData.phone" id="checkout-phone" class="form-control" name="phone" placeholder="0944304771" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-province">Province</label>
                                                <select v-model="addressData.province" id="checkout-province" class="form-control" name="province" placeholder="Hồ Chí Minh">
                                                    <option value="" disabled selected>Select you province</option>
                                                    <option v-for="province in provinces" :value="province">{{province.ProvinceName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-district">District</label>
                                                <select v-model="addressData.district" id="checkout-district" :disabled="!addressData.province" class="form-control" name="district" placeholder="Quận 1">
                                                    <option value="" disabled selected>Select you district</option>
                                                    <option v-for="district in districts" :value="district">{{district.DistrictName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-ward">Ward</label>
                                                <select v-model="addressData.ward" id="checkout-ward" :disabled="!addressData.district" class="form-control" name="ward" placeholder="Phường 6">
                                                    <option value="" disabled selected>Select you ward</option>
                                                    <option v-for="ward in wards" :value="ward">{{ward.WardName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label" cfor="checkout-apt-number">Flat, House No:</label>
                                                <input type="text" v-model="addressData.apt_number" id="checkout-apt-number" class="form-control" name="apt-number" placeholder="49 Trần Hưng Đạo" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary btn-next delivery-address">Save And Deliver Here</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Customer Address Left ends -->

                            <!-- Checkout Customer Address Right starts -->
                            <div class="customer-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{addressData.full_name}}</h4>
                                    </div>
                                    <div class="card-body actions">
                                        <h5>{{addressData?.phone ? "Phone: " + addressData.phone : ""}}</h5>
                                        <p class="card-text mb-0">{{addressData.apt_number}}</p>
                                        <p class="card-text">{{printAddress()}}</p>
                                        <button type="button" class="btn btn-primary w-100 btn-next delivery-address mt-2">
                                            Deliver To This Address
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Customer Address Right ends -->
                        </form>
                    </div>
                    <!-- Checkout Customer Address Ends -->
                    <!-- Checkout Payment Starts -->
                    <div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
                        <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
                            <div class="payment-type">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Shipping options</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="other-payment-options list-unstyled">
                                            <li class="py-50" v-for="service in shippingServices" :key="service.service_id">
                                                <div class="form-check">
                                                    <input v-model="serviceOptionId" :value="service.service_id" type="radio" :id="`shipping-service-${service.service_id}`" name="serviceOptionId" class="form-check-input" />
                                                    <label class="form-check-label" :for="`shipping-service-${service.service_id}`">{{service.short_name}}</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Payment options</h4>
                                        <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
                                    </div>
                                    <div class="card-body">
                                        <div id="paypal-button-container"></div>
                                        <!-- <ul class="other-payment-options list-unstyled">
                                            <li class="py-50">
                                                <div class="form-check">
                                                    <input type="radio" id="customColorRadio2" name="paymentOptions" class="form-check-input" />
                                                    <label class="form-check-label" for="customColorRadio2">
                                                    </label>
                                                </div>
                                            </li>
                                        </ul> -->
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Place Order Right starts -->
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="price-details">
                                            <h6 class="price-title">Price Details</h6>
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title">Total MRP</div>
                                                    <div class="detail-amt">{{formatPrice(getTotalAmount())}}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Tax (10%)</div>
                                                    <div class="detail-amt">{{formatPrice(getTaxAmount())}}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Delivery Charges</div>
                                                    <div class="detail-amt">{{formatPrice(shippingFee)}}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Coupons Discount</div>
                                                    <div class="detail-amt">{{formatPrice(getTaxAmount())}}</div>
                                                </li>
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title detail-total">Total</div>
                                                    <div class="detail-amt fw-bolder">{{formatPrice(getFinalAmount())}}</div>
                                                </li>
                                            </ul>
                                            <!-- <button @click="createOrder()" type="button" class="btn btn-primary w-100 btn-next place-order">Confirm Order</button> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Place Order Right ends -->
                            </div>
                        </form>
                    </div>
                    <!-- Checkout Payment Ends -->
                    <!-- </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->

<!-- BEGIN: Page Vendor JS-->
<script src="theme-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="theme-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="theme-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
<!-- END: Page JS-->

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_CLIENT_ID ?>&components=buttons"></script>

<script type="module">
    // import Vue from "vue";
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        CartService
    } from '@services/CartService';
    import {
        WishlistService
    } from '@services/WishlistService';
    import {
        ShippingService
    } from '@services/ShippingService';
    import {
        OrderService
    } from '@services/OrderService';

    Object.keys(Rules).forEach(rule => {
        extend(rule, Rules[rule]);
    });

    document.vueCheckout = new Vue({
        el: "#app",
        vuetify: new Vuetify(),
        components: {
            'validation-provider': ValidationProvider,
            'validation-observer': ValidationObserver,
        },
        data: {
            wishlist: [],
            cartItems: [],
            addressData: {
                full_name: "",
                phone: "",
                province: "",
                district: "",
                ward: "",
                apt_number: ""
            },
            serviceOptionId: null,
            provinces: [],
            districts: [],
            wards: [],
            shippingServices: [],
            shippingFee: 0,
        },
        watch: {
            'addressData.province': function(province) {
                if (province) {
                    this.addressData.district = null;
                    this.addressData.ward = null;
                    this.getDistricts(province.ProvinceID);
                }
            },
            'addressData.district': function(district) {
                if (district) {
                    this.addressData.ward = null;
                    this.getWards(district.DistrictID);
                    this.getShippingServices(district.DistrictID);
                }
            },
            'addressData.ward': async function() {
                if (this.addressData.ward) {
                    if (this.serviceOptionId) {
                        await this.getShippingFee(
                            this.addressData.district.DistrictID,
                            this.addressData.ward.WardCode,
                            this.serviceOptionId,
                        )
                    }

                    this.renderPayPalButton()
                }
            },
            'serviceOptionId': async function() {
                if (this.addressData.ward) {
                    if (this.serviceOptionId) {
                        await this.getShippingFee(
                            this.addressData.district.DistrictID,
                            this.addressData.ward.WardCode,
                            this.serviceOptionId,
                        )
                    }

                    this.renderPayPalButton()
                }
            },
        },
        methods: {
            createOrder(paypal_order_id) {
                OrderService.create({
                    shipping_fee: this.shippingFee,
                    total_amount: this.getFinalAmount(),
                    quantity: this.getTotalItems(),
                    paypal_order_id
                }).then(() => {
                    return CartService.clearCart();
                }).then(() => {
                    Utils.delayNavigate('/order-success.php', 500);
                })
            },
            getList() {
                CartService.getAll().then(res => {
                    this.cartItems = res.data
                });
            },
            addToCart(productId) {
                CartService.addToCart(productId);
            },
            removeFromCart(productId, quantity = undefined) {
                CartService.removeFromCart(productId, quantity ? -quantity : undefined);
            },
            getTotalItems() {
                return this.cartItems.reduce((acc, i) => {
                    return acc + i.quantity
                }, 0)
            },
            getTotalAmount() {
                return this.cartItems.reduce((acc, i) => {
                    return acc + i.quantity * i.price
                }, 0)
            },
            getFinalAmount() {
                return this.getTotalAmount() + this.getTaxAmount() + this.shippingFee;
            },
            getTaxAmount() {
                return this.getTotalAmount() * 0.1;
            },
            formatPrice(num) {
                return Utils.formatPrice(num);
            },
            getProvinces() {
                ShippingService.getProvinces().then((data) => {
                    this.provinces = data;
                })
            },
            getDistricts(provinceId) {
                ShippingService.getDistricts(provinceId).then((data) => {
                    this.districts = data;
                })
            },
            getWards(wardId) {
                ShippingService.getWards(wardId).then((data) => {
                    this.wards = data;
                })
            },
            getShippingServices(districtId) {
                ShippingService.getShippingService({
                    to_district_id: districtId,
                }).then((data) => {
                    this.shippingServices = data;
                    this.serviceOptionId = data[0].service_id;
                })
            },
            getShippingFee(districtId, wardCode, shippingServiceId) {
                return ShippingService.getShippingFee({
                    to_district_id: districtId,
                    to_ward_code: wardCode,
                    service_id: shippingServiceId
                }).then((data) => {
                    this.shippingFee = data.total;
                });
            },
            addProductToWishlist(productId) {
                WishlistService.addToWishlist(productId).then(() => {
                    this.getWishlistProduct();
                });
            },
            getWishlistProduct() {
                WishlistService.getAll().then(({
                    rows,
                }) => {
                    this.wishlist = rows
                })
            },
            checkWishlistProduct(productId) {
                return this.wishlist.some((item) => {
                    if (item.product_id == productId) {
                        return true
                    }

                    return false;
                })
            },
            printAddress(productId) {
                if (this.addressData?.ward?.WardName) {
                    return [
                        this.addressData?.ward?.WardName,
                        this.addressData?.district?.DistrictName,
                        this.addressData?.province?.ProvinceName
                    ].join(", ")
                }

                return "";
            },
            renderPayPalButton() {
                const myNode = document.getElementById("paypal-button-container");
                myNode.innerHTML = '';

                paypal.Buttons({
                    createOrder: (data, actions) => {
                        let currency_code = "USD";
                        let items = this.cartItems.map((item) => {
                            return {
                                name: item.name,
                                unit_amount: {
                                    currency_code,
                                    value: Utils.roundToTwo(item.price / 23000),
                                },
                                quantity: item.quantity
                            }
                        })

                        let item_total = Utils.roundToTwo(items.reduce((acc, i) => {
                            return acc + i.quantity * i.unit_amount.value;
                        }, 0))

                        let tax = Utils.roundToTwo(item_total * 0.1);
                        let shipping = Utils.roundToTwo(this.shippingFee / 23000);

                        // Set up the transaction
                        return actions.order.create({
                            purchase_units: [{
                                intent: "CAPTURE",
                                items,
                                amount: {
                                    currency_code,
                                    value: Utils.roundToTwo(item_total + tax + shipping),
                                    breakdown: {
                                        item_total: {
                                            currency_code,
                                            value: item_total
                                        },
                                        shipping: {
                                            currency_code,
                                            value: shipping
                                        },
                                        tax_total: {
                                            currency_code,
                                            value: tax
                                        }
                                    }
                                },
                                shipping: {
                                    name: {
                                        full_name: this.addressData.full_name,
                                    },
                                    address: {
                                        address_line_1: this.addressData.apt_number.trim() + ', ' + this.addressData.ward.WardName,
                                        admin_area_2: this.addressData.district.DistrictName,
                                        admin_area_1: this.addressData.province.ProvinceName,
                                        country_code: "VN"
                                    }
                                }
                            }],
                        });
                    },
                    onApprove: (data, actions) => {
                        // This function captures the funds from the transaction.
                        return actions.order.capture().then((details) => {
                            this.createOrder(details.id);
                        });
                    }
                }).render('#paypal-button-container');
            }
        },
        mounted() {
            this.getList();

            this.$on('refetch_cart', function(data) {
                this.getList();
            })

            this.getProvinces();

            this.getWishlistProduct();
        },
    });
</script>