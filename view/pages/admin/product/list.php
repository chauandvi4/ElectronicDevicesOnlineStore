<!-- BEGIN: Content-->
<div id="app" v-cloak>
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="vertical-layout vertical-menu-modern content-header row">
            </div>
            <div class="content-body">
                <!-- products list start -->
                <section class="app-list">
                    <!-- list section start -->
                    <div class="card">
                        <div class="align-items-center d-flex justify-content-between">
                            <h2 class="card-header">List Products</h2>
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
                                    <span v-else-if="props.column.field == 'price'">
                                        {{formatNumberPrice(props.formattedRow['price'])}}
                                    </span>
                                    <span v-else-if="props.column.field == 'freeShip'">
                                        {{props.formattedRow['freeShip']==1?"True":"False"}}
                                    </span>
                                    <span v-else> {{ props.formattedRow[props.column.field] }} </span>
                                </template>
                            </vue-good-table>
                        </div>
                    </div>
            </div>
            <!-- list section end -->
            </section>
            <!-- products list ends -->
        </div>
    </div>
</div>
</div>

<script type="module">
    // import Vue from "vue";
    import VueGoodTablePlugin from 'vue-good-table';
    import {
        ProductService
    } from '@services/ProductService';

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
                    width: '200px',
                },
                {
                    label: 'Price',
                    field: 'price',
                    type: "number",
                    width: '150px',
                },
                {
                    label: 'Status',
                    field: 'status',
                },
                {
                    label: 'Category',
                    field: 'category',
                },
                {
                    label: 'Rate',
                    field: 'rate',
                },
                {
                    label: 'Freeship',
                    field: 'freeShip',
                },
                {
                    label: 'Height',
                    field: 'height',
                },
                {
                    label: 'Length',
                    field: 'length',
                },
                {
                    label: 'Weight',
                    field: 'weight',
                },
                {
                    label: 'Width',
                    field: 'width',
                },
                {
                    label: 'Image url',
                    field: 'image_url',
                    width: '150px',
                },
                {
                    label: 'Action',
                    field: 'action',
                    width: '205px',
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
                ProductService.delete(id).then(res => {
                    this.getList(this.page, this.limit);
                });
            },
            getList(page, limit) {
                ProductService.getAll(page, limit)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        console.log(rows);
                        this.rows = rows;
                        this.totalRecords = totalRecords;
                    });
            },
            formatNumberPrice(num) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(num)
            },
        },
        mounted() {
            this.getList(this.page, this.limit);
        },
    });
</script>