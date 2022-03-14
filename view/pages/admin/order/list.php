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
                            <h2 class="card-header">List Orders</h2>
                            <!-- <div class="pe-2">
                                <a href="create.php" class="text-decoration-none text-white">
                                    <button type="button" class="btn w-100 btn-primary">
                                        Create
                                    </button>
                                </a>
                            </div> -->
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
                                        <!-- <a v-bind:href="'edit.php?id=' + props.formattedRow['id']" class="text-decoration-none text-white">
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </a> -->
                                        <!-- <button type="button" class="btn btn-primary" v-on:click="createShipping(props.formattedRow['id'])">Ship Order</button> -->
                                        <button v-if="props.formattedRow['status'] == 'Paid'" type="button" class="btn btn-primary" v-on:click="createShipping(props.formattedRow['id'])">Ship Order</button>
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
        OrderService
    } from '@services/OrderService';
    import {
        ShippingService
    } from '@services/ShippingService';

    Vue.use(VueGoodTablePlugin);
    new Vue({
        el: "#app",
        data: {
            columns: [{
                    label: 'ID',
                    field: 'id',
                },
                {
                    label: 'User Name',
                    field: 'user_name',
                },
                {
                    label: 'Shipping Id',
                    field: 'shipping_id',
                },
                {
                    label: 'Shipping Fee',
                    field: 'shipping_fee',
                },
                {
                    label: 'Total Amount',
                    field: 'total_amount',
                },
                {
                    label: 'Quantity',
                    field: 'quantity',
                },
                {
                    label: 'Status',
                    field: 'status',
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
                this.getList(this.page, this.limit);
            },
            onPerPageChange(params) {
                this.limit = params.currentPerPage;
                this.page = 1;
                this.getList(this.page, this.limit);
            },
            handleDelete: function(id) {
                OrderService.delete(id).then(res => {
                    this.getList(this.page, this.limit);
                });
            },
            createShipping: function(id) {
                ShippingService.createShipping(id).then(res => {
                    this.getList(this.page, this.limit);
                });
            },
            getList(page, limit) {
                OrderService.getAll(page, limit)
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
            this.getList(this.page, this.limit);
        },
    });
</script>