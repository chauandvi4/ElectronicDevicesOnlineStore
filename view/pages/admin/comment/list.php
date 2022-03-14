<!-- BEGIN: Content-->
<div id="app" v-cloak>
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="vertical-layout vertical-menu-modern content-header row">
            </div>
            <div class="content-body">
                <!-- comments list start -->
                <section class="app-comments-list">
                    <!-- list section start -->
                    <div class="card">
                        <div class="align-items-center d-flex justify-content-between">
                            <h2 class="card-header">List comments</h2>

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
                                        <a v-bind:href="'/comment.php?id=' + props.formattedRow['id']" class="text-decoration-none text-white">
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
            <!-- comments list ends -->
        </div>
    </div>
</div>
</div>



<script type="module">
    // import Vue from "vue";
    import VueGoodTablePlugin from 'vue-good-table';
    import {
        CommentService
    } from '@services/CommentService';

    Vue.use(VueGoodTablePlugin);
    new Vue({
        el: "#app",
        data: {
            columns: [{
                    label: 'ID',
                    field: 'id',
                },
                {
                    label: 'Text',
                    field: 'text',
                },
                {
                    label: 'Star',
                    field: 'star',
                },
                {
                    label: 'User ID',
                    field: 'user_id',
                },
                {
                    label: 'Product ID',
                    field: 'product_id',
                },
                {
                    label: 'Created At',
                    field: 'created_at',
                },
                {
                    label: 'Updated At',
                    field: 'updated_at',
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
                this.getListUser(this.page, this.limit);
            },
            onPerPageChange(params) {
                this.limit = params.currentPerPage;
                this.page = 1;
                this.getListUser(this.page, this.limit);
            },
            handleDelete: function(id) {
                CommentService.delete(id).then(res => {
                    this.getList(this.page, this.limit);
                });
            },
            getList(page, limit) {
                CommentService.getAll(page, limit)
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