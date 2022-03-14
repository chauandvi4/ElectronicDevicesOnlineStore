<!-- BEGIN: Content-->
<div id="app" v-cloak>
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="vertical-layout vertical-menu-modern content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">
                    <!-- list section start -->
                    <div class="card">
                        <div class="align-items-center d-flex justify-content-between">
                            <h2 class="card-header">List Coupons</h2>
                            <div class="pe-2">
                                <a href="create.php" class="text-decoration-none text-white">
                                    <button type="button" class="btn w-100 btn-primary">
                                        Create
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="pt-0 p-2">
                            <vue-good-table
                                @on-page-change="onPageChange"
                                @on-per-page-change="onPerPageChange"
                                :total-rows="totalRecords"
                                :columns="columns"
                                :rows="rows"
                                :pagination-options="{
                                    enabled: true,
                                    perPage: limit,
                                    perPageDropdown: [5, 10, 20, 50]
                                }"
                                :search-options="{
                                    enabled: true
                                }">
                                <div slot="emptystate">
                                    No record
                                </div>
                                <template slot="table-row" slot-scope="props">
                                    <span v-if="props.column.field == 'action'">
                                        <a v-bind:href="'edit.php?id=' + props.formattedRow['id']" class="text-decoration-none text-white">
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </a>
                                        <button type="button" class="btn btn-danger" v-on:click="handleDelete(props.formattedRow['id'])">Delete</button>
                                    </span>
                                    <span v-else> {{ props.formattedRow[props.column.field] }} </span>
                                </template>
                            </vue-good-table>
                        </div>
                    </div>
            </div>
            <!-- list section end -->
            </section>
            <!-- users list ends -->
        </div>
    </div>
</div>
</div>

<script type="module">
    import Vue from "vue";
    import VueGoodTablePlugin from 'vue-good-table';
    import {
        CouponService
    } from '@services/CouponService';

    Vue.use(VueGoodTablePlugin);
    new Vue({
        el: "#app",
        data: {
            columns: [{
                    label: 'ID',
                    field: 'id',
                },
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Discount',
                    field: 'discount_amount',
                },
                {
                    label: 'Expiry Date',
                    field: 'expiry_date',
                },
                {
                    label: 'Status',
                    field: 'status',
                },
                {
                    label: 'Usage Times',
                    field: 'usage_times',
                },
                {
                    label: 'Action',
                    field: 'action',
                },
            ],
            rows: [],
            totalRecords: 0,
            page: 1,
            limit: 5
        },
        methods: {
            onPageChange(params) {
                this.page = params.currentPage;
                this.getListCoupon(this.page, this.limit);
            },
            onPerPageChange(params) {
                this.limit = params.currentPerPage;
                this.page = 1;
                this.getListCoupon(this.page, this.limit);
            },
            handleDelete: function(id) {
                CouponService.delete(id).then(res => {
                    this.getListCoupon(this.page, this.limit);
                });
            },
            getListCoupon(page, limit) {
                CouponService.getAll(page, limit)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.rows = rows;
                        this.totalRecords = totalRecords;
                    });
            },
        },
        mounted() {
            this.getListCoupon(this.page, this.limit);
        },
    });
</script>