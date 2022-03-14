<link rel="apple-touch-icon" href="../../../../theme-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="../../../../theme-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/vendors/css/editors/quill/katex.min.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/vendors/css/editors/quill/monokai-sublime.min.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/vendors/css/editors/quill/quill.snow.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/../../../../theme-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/plugins/forms/form-quill-editor.css">
<link rel="stylesheet" type="text/css" href="../../../../theme-assets/css/pages/page-blog.css">
<!-- END: Page CSS-->




<div id="app" v-cloak>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- Blog Edit -->
                <!-- products list start -->
                <section class="app-list">
                    <div class="col-12">
                        <div class="card">
                            <h2 class="card-header"><?php echo $pagetitle; ?></h2>
                            <div class="card-body">
                                <!-- Form -->
                                <validation-observer v-slot="{ handleSubmit }">
                                    <form action="javascript:;" class="form-validate" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class=" col-12">
                                                <div class="mb-2">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="title">Title</label>
                                                        <input
                                                            @paste="onPaste"
                                                            type="text"
                                                            id="title"
                                                            class="form-control"
                                                            v-model="formData.title" />
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>

                                            <!-- Category -->
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="topic">Topic</label>
                                                        <select class="form-select" id="topic" v-model="formData.topic_id">
                                                            <option disabled value="">Please select one</option>
                                                            <option v-for="item in rows" :value="item.id" :key="item.id">
                                                                {{ item.name }}
                                                            </option>
                                                        </select>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>
                                            <!-- Status -->
                                            <!-- <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="status">Status</label>
                                                        <select class="form-select" id="status" v-model="formData.status">
                                                            <option disabled value="">Please select one</option>
                                                            <option value="Published">Published</option>
                                                            <option value="Draft">Draft</option>
                                                        </select>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>

                                                </div>
                                            </div> -->

                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <div class="form-label" for="status">Status</div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="published" v-model="formData.status" />
                                                            <label class="form-check-label" for="published">Publish</label>
                                                        </div>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>
                                            <!-- Content -->

                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <validation-provider rules="required" v-slot="{ errors }">
                                                        <label class="form-label" for="content">Content</label>
                                                        <textarea
                                                            @paste="onPaste"
                                                            v-model="formData.content"
                                                            id="content"
                                                            name="content"
                                                            type="text"
                                                            rows="6"
                                                            class="form-control"></textarea>
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="image_url">Image</label>
                                                    <input
                                                        type="file"
                                                        id="imagesFilepond"
                                                        class="filepond"
                                                        name="filepond[]"
                                                        @change="selected($event,validate)"
                                                        data-allow-reorder="true"
                                                        data-max-file-size="10MB"
                                                        data-max-files="5"
                                                        accepted-file-types="image/*" />
                                                </div>
                                            </div>

                                            <!-- Image -->
                                            <!-- <div class="col-12">
                                                <div class="mb-1">
                                                    <validation-provider rules="required" v-slot="{  errors,validate }">
                                                        <label class="form-label" for="image_url">Image Url</label>
                                                        <input
                                                            type="file"
                                                            id="image_url"
                                                            accept="image/*"
                                                            @change="selected($event,validate)"
                                                            name="image_url" class="form-control" />
                                                        <span class="text-danger">{{ errors[0] }}</span>
                                                    </validation-provider>
                                                </div>
                                            </div> -->



                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary me-1">Save Changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ Form -->
                                </validation-observer>
                            </div>
                        </div>
                    </div>

                </section>
                <!--/ Blog Edit -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
</div>

<!-- BEGIN: Vendor JS-->
<script src="../../../../theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../../../../theme-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../../../../theme-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="../../../../theme-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="../../../../theme-assets/vendors/js/editors/quill/quill.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../../../../theme-assets/js/core/app-menu.js"></script>
<script src="../../../../theme-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="../../../../theme-assets/js/scripts/pages/page-blog-edit.js"></script>
<!-- END: Page JS-->
<script>
    $(document).ready(function() {
        $(".backup_picture").on("error", function() {
            $(this).attr('src', '../../../../theme-assets/images/blog/addphoto.png');
        });
    });
</script>


<script type="module">
    import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        BlogService
    } from "@services/BlogService";

    Object.keys(Rules).forEach(rule => {
        extend(rule, Rules[rule]);
    });

    Vue.use(Vuetify);

    new Vue({
        el: "#app",
        vuetify: new Vuetify(),
        components: {
            'validation-provider': ValidationProvider,
            'validation-observer': ValidationObserver,
        },
        data: {
            previewImage: '../../../../theme-assets/images/blog/addphoto.png',
            id: null,
            rows: [],
            initData: {},
            formData: {
                title: "",
                status: false,
                content: "",
                image_url: "",
                topic_id: ""
            }
        },
        methods: {
            onSubmit() {
                // console.log(this.formData);
                // console.log("on submit outside if");
                if (!this.id) {
                    // console.log(this.formData);
                    // console.log("print data submitted");
                    BlogService.create(this.formData)
                        .then(res => {
                            Utils.delayNavigate('/admin/blog/')
                        });
                } else {
                    // console.log("successfully go to on submit with available id");
                    BlogService.update(this.id, this.formData).then(res => {
                        // reload 
                        // console.log(this.formData);
                        // console.log("edit data");
                        this.getFormData();
                    });
                }
            },
            reset() {
                this.formData = {
                    ...this.initData
                }
            },
            fetchTopics(limit, page) {
                BlogService.getAllTopic(limit, page)
                    .then((
                        rows
                    ) => {
                        this.rows = rows.rows;
                        // console.log(this.rows);
                        // console.log("in fetch")
                    });
            },
            getFormData() {
                console.log("get formData")
                BlogService.getOne(this.id).then(res => {
                    this.formData = {
                        ...res.data
                    }
                    this.initData = {
                        ...res.data
                    }
                })
            },
            onPaste(evt) {
                console.log('on paste', evt)
                return true;
            },

            pickFile() {
                this.previewImage = this.formData.image_url
            }


        },
        mounted() {
            const params = new URLSearchParams(location.search);
            this.id = params.get("id");

            if (this.id) {
                this.getFormData();
            }
            this.fetchTopics(null, null);

            window.addEventListener("DOMContentLoaded", () => {
                // initializing file pond js
                FilePond.registerPlugin(
                    FilePondPluginImagePreview,
                    FilePondPluginImageExifOrientation,
                    FilePondPluginFileValidateSize,
                    FilePondPluginImageEdit,
                    FilePondPluginFileValidateType
                );

                // Select the file input and use
                // create() to turn it into a pond
                FilePond.create(document.querySelector("#imagesFilepond"), {
                    name: "filepond",
                    maxFiles: 5,
                    allowBrowse: true,
                    acceptedFileTypes: ["image/*"],
                    // server
                    server: {
                        load: (uniqueFileId, load, error, progress, abort, headers) => {
                            let controller = new AbortController();
                            let signal = controller.signal;

                            fetch(`/load.php?key=${uniqueFileId}`, {
                                    method: "GET",
                                    signal,
                                })
                                .then((res) => {
                                    window.c = res;
                                    return res.blob();
                                })
                                .then((blob) => {
                                    // const imageFileObj = new File([blob], `${uniqueFileId}.${blob.type.split('/')[1]}`, {
                                    //   type: blob.type
                                    // })
                                    // progress(true, size, size);
                                    load(blob);
                                })
                                .catch((err) => {
                                    error(err.message);
                                });

                            return {
                                abort: () => {
                                    // User tapped cancel, abort our ongoing actions here
                                    controller.abort();
                                    // Let FilePond know the request has been cancelled
                                    abort();
                                },
                            };
                        },
                        // remove:
                    },
                    //files array
                    files: [],
                });

                FilePond.setOptions({
                    server: {
                        // url: "/",
                        process: {
                            url: "/process.php",
                            method: "POST",
                            headers: {
                                "x-customheader": "Processing File",
                            },
                            onload: (response) => {
                                response = JSON.parse(response);
                                this.formData.image_url = response.url;
                                return response.key;
                            },
                            onerror: (response) => {
                                response = JSON.parse(response);
                                return response.msg;
                            },
                            ondata: (formData) => {
                                window.h = formData;
                                return formData;
                            },
                        },
                        revert: (uniqueFileId, load, error) => {
                            const formData = new FormData();
                            formData.append("key", uniqueFileId);

                            fetch(`/revert.php?key=${uniqueFileId}`, {
                                    method: "DELETE",
                                    body: formData,
                                })
                                .then((res) => res.json())
                                .then((json) => {
                                    if (json.status == "success") {
                                        // Should call the load method when done, no parameters required
                                        load();
                                    } else {
                                        // Can call the error method if something is wrong, should exit after
                                        error(err.msg);
                                    }
                                })
                                .catch((err) => {
                                    // Can call the error method if something is wrong, should exit after
                                    error(err.message);
                                });
                        },
                        remove: (uniqueFileId, load, error) => {
                            const formData = new FormData();
                            formData.append("key", uniqueFileId);

                            fetch(`/revert.php?key=${uniqueFileId}`, {
                                    method: "DELETE",
                                    body: formData,
                                })
                                .then((res) => res.json())
                                .then((json) => {
                                    if (json.status == "success") {
                                        // Should call the load method when done, no parameters required
                                        load();
                                    } else {
                                        // Can call the error method if something is wrong, should exit after
                                        error(err.msg);
                                    }
                                })
                                .catch((err) => {
                                    // Can call the error method if something is wrong, should exit after
                                    error(err.message);
                                });
                        },
                        restore: (uniqueFileId, load, error, progress, abort, headers) => {
                            let controller = new AbortController();
                            let signal = controller.signal;

                            fetch(`/load.php?key=${uniqueFileId}`, {
                                    method: "GET",
                                    signal,
                                })
                                .then((res) => {
                                    window.c = res;
                                    const headers = res.headers;
                                    const contentLength = +headers.get("content-length");
                                    const contentDisposition = headers.get("content-disposition");
                                    let fileName = contentDisposition.split("filename=")[1];
                                    fileName = fileName.slice(1, fileName.length - 1);
                                    progress(true, contentLength, contentLength);
                                    return {
                                        blob: res.blob(),
                                        size: contentLength,
                                    };
                                })
                                .then(({
                                    blob,
                                    size
                                }) => {
                                    // headersString = 'Content-Disposition: inline; filename="my-file.jpg"'
                                    // headers(headersString);

                                    const imageFileObj = new File(
                                        [blob],
                                        `${uniqueFileId}.${blob.type.split("/")[1]}`, {
                                            type: blob.type,
                                        }
                                    );
                                    progress(true, size, size);
                                    load(imageFileObj);
                                })
                                .catch((err) => {
                                    error(err.message);
                                });

                            return {
                                abort: () => {
                                    // User tapped cancel, abort our ongoing actions here
                                    controller.abort();
                                    // Let FilePond know the request has been cancelled
                                    abort();
                                },
                            };
                        },
                    },
                });
            });
        }
    });
</script>
<style scoped lang="scss">
    .imagePreviewWrapper {
        width: 170px;
        height: 110px;
        display: block;
        cursor: pointer;
        margin: 0px 20px 20px 0px;
        background-size: cover;
        background-position: left left;
    }
</style>

<!-- END: Body-->