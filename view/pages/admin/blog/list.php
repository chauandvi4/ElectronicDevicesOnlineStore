<!-- BEGIN: Content-->
<div id="app" v-cloak>
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="vertical-layout vertical-menu-modern content-header row">
            </div>
            <div class="content-body">
                <!-- blogs list start -->
                <section class="app-blog-list">
                    <!-- list section start -->
                    <div class="card">
                        <div class="align-items-center d-flex ">
                            <div class="flex-grow-1">
                                <h2 class="card-header">List Blogs</h2>
                            </div>
                            <div class=" pe-2">
                                <a href="index_topic.php" class="text-decoration-none text-white">
                                    <button id="btn-topic" type="button" class="btn btn-light" style="color: #7367F0;">
                                        Manage topics
                                    </button>
                                </a>
                            </div>
                            <div class=" pe-2">
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
                                    <span v-else-if="props.column.field == 'status'">
                                        {{props.formattedRow['status']==1?"Published":"Draft"}}
                                    </span>
                                    <span v-else> {{ props.formattedRow[props.column.field] }} </span>
                                </template>
                            </vue-good-table>
                        </div>
                    </div>
            </div>
            <!-- list section end -->
            </section>
            <!-- blogs list ends -->
        </div>
    </div>
</div>
</div>

<script type="module">
    // import Vue from "vue";
    import VueGoodTablePlugin from 'vue-good-table';
    import {
        BlogService
    } from '@services/BlogService';

    Vue.use(VueGoodTablePlugin);
    new Vue({
        el: "#app",
        data: {
            columns: [{
                    label: 'ID',
                    field: 'id',
                },
                {
                    label: 'Title',
                    field: 'title',
                    width: '150px',

                },
                {
                    label: 'Created At',
                    field: 'created_at',
                    width: '150px',

                },
                {
                    label: 'Status',
                    field: 'status',
                },
                {
                    label: 'Image url',
                    field: 'image_url',
                    width: '150px',
                },
                {
                    label: 'Topic',
                    field: 'topic_id',
                },
                {
                    label: 'Action',
                    field: 'action',
                    width: '205px',

                }

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
                BlogService.delete(id).then(res => {
                    this.getList(this.page, this.limit);
                });
            },
            getList(page, limit) {
                BlogService.getAll(page, limit)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.rows = rows;
                        this.totalRecords = totalRecords;
                        console.log(this.rows)
                    });
            },
        },
        mounted() {
            this.getList(this.page, this.limit);
        },
    });
</script>

<style scoped>
    #btn-topic:hover {
        background-color: #E2E6EA;
    }
</style>