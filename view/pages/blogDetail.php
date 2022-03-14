<link rel="apple-touch-icon" href="../../../theme-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="../../../theme-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="../../../theme-assets/vendors/css/vendors.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="../../../theme-assets/css/pages/page-blog.css">
<!-- END: Page CSS-->






<!-- BEGIN: Content-->
<div class="app-content content" id="app" v-cloak>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Blog Detail</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="blog.php">Blog</a>
                                </li>
                                <li class="breadcrumb-item active">Detail
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">

            </div>
        </div>
        <div class="content-detached content-left">
            <div class="content-body">
                <!-- Blog Detail -->
                <div class="blog-detail-wrapper">
                    <div class="row">
                        <!-- Blog -->
                        <div class="col-12">
                            <div class="card">
                                <img :src="blog.image_url" class="img-fluid card-img-top" alt="Blog Detail Pic" />
                                <div class="card-body">
                                    <h4 class="card-title">{{blog.title}}</h4>
                                    <div class="d-flex">
                                        <div class="author-info">
                                            <small class="text-muted me-25">by</small>
                                            <small><a href="#" class="text-body">Admin</a></small>
                                            <span class="text-muted ms-50 me-25">|</span>
                                            <small class="text-muted"> <i class="bi bi-clock"></i> {{formatDate(blog.created_at.toString())}}</small>
                                        </div>
                                    </div>
                                    <div class="my-1 py-25">
                                        <a href="#">
                                            <span class="badge rounded-pill badge-light-danger me-50">{{blog.topic_name}}</span>
                                        </a>
                                    </div>
                                    <p class="card-text mb-2">
                                        {{blog.content}}
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                        <!--/ Blog -->
                    </div>
                </div>
                <!--/ Blog Detail -->

            </div>
        </div>
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
                <div class="blog-sidebar my-2 my-lg-0">
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
                </div>
            </div>
        </div>

        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
                <div class="blog-sidebar my-2 my-lg-0">
                    <!-- Recent Posts -->
                    <div class="blog-recent-posts mt-3">
                        <h6 class="section-label">You may also like</h6>
                        <div class="mt-75">
                            <div class="d-flex mb-2" v-for="post in relatedBlogList" :key="post.id">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>




<!-- BEGIN: Vendor JS-->
<script src="../../../theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../../../theme-assets/js/core/app-menu.js"></script>
<script src="../../../theme-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

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
            id: null,
            blog: {},
            recentPosts: [],
            relatedBlogList: [],
        },
        methods: {
            getBlog() {
                BlogService.getOne(this.id)
                    .then(res => {
                        console.log(res)
                        this.blog = res.data
                        if (res.data) {
                            this.getFilter(this.blog.topic_id);
                            console.log("get topic_id");
                            console.log(this.blog.topic_id);
                        }
                    });
            },
            getFilter(topic) {
                BlogService.getListFilter(1, 5, "",  topic)
                    .then(({
                        rows,
                        totalRecords
                    }) => {
                        this.relatedBlogList = rows;
                        console.log("related post", this.relatedBlogList);
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

            formatDate(string) {
                return string.split(" ")[0];
            }

        },
        mounted() {
            const params = new URLSearchParams(location.search)
            this.id = params.get("id");

            if (this.id) {
                this.getBlog()
            }
            this.getRecentPost();

        },
    });
</script>