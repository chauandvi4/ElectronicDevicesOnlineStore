<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- BEGIN: Content-->
<div class="app-content content" id="app" v-cloak>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Blog List</h2>
                </div>
            </div>
        </div>
        <div class="content-detached content-left">
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">

                                <div class="search-results">{{totalRecords}} results found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="content-body">
                <!-- Blog List -->
                <div class="blog-list-wrapper">
                    <!-- Blog List Items -->
                    <section class="row">
                        <div class="col-md-6 col-12" v-for="item in blogList" :key="item.id">
                            <div class="card">
                                <a v-bind:href="'blogDetail.php?id='+item.id">
                                    <img class="card-img-top img-fluid" :src="item.image_url" alt="Blog Post pic" />
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a v-bind:href="'blogDetail.php?id='+item.id" class="blog-title-truncate text-body-heading">{{item.title}}</a>
                                    </h4>
                                    <div class="text-muted mb-0"> <i class="bi bi-clock"></i> {{formatDate(item.created_at.toString())}}</div>
                                    <div class="my-1 ">
                                        <a href="#">
                                            <span class="badge rounded-pill badge-light-primary">{{item.topic_name}}</span>
                                        </a>
                                    </div>
                                    <p class="card-text blog-content-truncate">
                                        {{formatContent(item.content)}}
                                    </p>
                                    <hr />
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="">
                                            <div class="d-flex align-items-center">

                                            </div>
                                        </a>
                                        <a v-bind:href="'blogDetail.php?id='+item.id" class="fw-bold">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <!--/ Blog List Items -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
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
                    <!--/ Pagination -->
                </div>
                <!--/ Blog List -->

            </div>
        </div>
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
                <div class="blog-sidebar my-2 my-lg-0">
                    <!-- Search bar -->
                    <div class="blog-search">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" placeholder="Search here" @input="debounceSearch" />
                            <span class="input-group-text cursor-pointer">
                                <i data-feather="search"></i>
                            </span>
                        </div>
                    </div>
                    <!--/ Search bar -->

                    <!-- Recent Posts -->
                    <div class="blog-recent-posts mt-3">
                        <h6 class="section-label">Recent Posts</h6>
                        <div class="mt-75">
                            <div class="d-flex mb-2" v-for="post in recentPosts" :key="post.id">
                                <a v-bind:href="'blogDetail.php?id='+post.id" class="me-2">
                                    <img class="rounded" :src="post.image_url" width="100" height="70" alt="Recent Post Pic" />
                                </a>
                                <div class="blog-info">
                                    <h6 class="blog-recent-post-title">
                                        <a v-bind:href="'blogDetail.php?id='+post.id" class="text-body-heading">{{post.title}}</a>
                                    </h6>
                                    <div class="text-muted mb-0"> <i class="bi bi-clock"></i> {{formatDate(post.created_at.toString())}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Recent Posts -->

                    <!-- Topics -->
                    <div class="blog-categories mt-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="section-label">Topics</h6>
                            </div>
                            <button  v-on:click.stop="getFilter(1,6,this.search)">
                               <h6 class="section-label" style="color: black;">View all</h6>
                            </button>

                        </div>

                        <div class="mt-1">
                            <div class="d-flex justify-content-start align-items-center mb-75" v-for="topic in topics" :key="topic.id">
                                <div style="width:30px;height:30px;background-color:#DAF3F6; border-radius: 5px" class="me-75">
                                    <p style="text-align: center; margin: auto auto; line-height: 30px;"><i class="bi bi-hash fa-lg" style="color: #00CFE8;"></i></p>
                                </div>
                                <button v-on:click.stop="blogFilter(topic.id)">
                                    <div class="blog-category-title text-body">{{topic.name}}</div>
                                </button>
                            </div>

                        </div>
                    </div>
                    <!--/ Categories -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- </div> -->
<!--</body> -->

<!-- BEGIN: Vendor JS-->
<script src="../../../theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->


<!-- BEGIN: Theme JS-->
<script src="../../../theme-assets/js/core/app-menu.js"></script>
<script src="../../../theme-assets/js/core/app.js"></script>
<!-- END: Theme JS-->



<script type="module">
    import Vue from "vue";

    // import VueFilterDateFormat from 'vue-filter-date-format';
    import {
        BlogService
    } from '@services/BlogService';
    // Vue.use(VueFilterDateFormat);
    document.vueBlogList = new Vue({
        el: "#app",
        data: {
            blogList: [],
            totalRecords: 0,
            page: 1,
            limit: 6,
            totalPage: 1,
            debounce: null,
            topics: [],
            recentPosts: [],
            search: "",
            filterTopic: 0
        },
        methods: {
            onPageChange(params) {
                this.page = params;
                this.getFilter(this.page, this.limit, this.search);
            },
            getFilter(page, limit, search, topic_id) {
                BlogService.getListFilter(page, limit, search, topic_id)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.blogList = rows;
                        this.totalRecords = totalRecords;
                        this.totalPage = Math.ceil(totalRecords / this.limit)
                    });
            },
            fetchTopics(limit, page) {
                BlogService.getAllTopic(limit, page)
                    .then((
                        rows
                    ) => {
                        this.topics = rows.rows;
                    });
            },
            getRecentPost() {
                BlogService.getRecent().then((
                    rows
                ) => {
                    this.recentPosts = rows.rows;


                    console.log(this.recentPosts[0].created_at);
                });
            },
            formatContent(string) {
                if (string.length > 100) {
                    string = string.substring(0, 99) + "...";
                }
                return string;
            },
            formatDate(string) {

                return string.split(" ")[0];
            },
            blogFilter(topic) {
                this.page = 1
                if (topic) {
                    this.filterTopic = topic;
                }
                if (this.filterTopic == 0) {
                    this.getFilter(this.page, this.limit, this.search, undefined);
                } else {
                    this.getFilter(this.page, this.limit, this.search, this.filterTopic);
                }
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
            this.fetchTopics(null, null);
            this.getRecentPost();

        },
    });
</script>