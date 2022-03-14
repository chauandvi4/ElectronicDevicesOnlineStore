<div id="app" v-cloak>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- products list start -->
                <section class="app-list">
                    <!-- list section start -->
                    <div class="card">
                        <h2 class="card-header"><?php echo $pagetitle; ?></h2>
                        <div class="pt-0 p-2">
                            <!-- products edit Info form start -->
                            <validation-observer v-slot="{ handleSubmit }">
                                <form class="form-validate" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="reset">
                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input
                                                        v-model="formData.name"
                                                        id="name"
                                                        name="name"
                                                        type="text"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric" v-slot="{ errors }">
                                                    <label class="form-label" for="price">Price</label>
                                                    <input
                                                        v-model="formData.price"
                                                        id="price"
                                                        name="price"
                                                        type="text"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select class="form-select" id="status" v-model="formData.status">
                                                        <option disabled value="">Please select one</option>
                                                        <option>In Stock</option>
                                                        <option>Pre-Order</option>
                                                        <option>Out Of Stock</option>
                                                    </select>
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="category">Category</label>
                                                    <select class="form-select" id="category" v-model="formData.category">
                                                        <option disabled value="">Please select one</option>
                                                        <option>iPhone</option>
                                                        <option>Mac</option>
                                                        <option>iPad</option>
                                                        <option>Watch</option>
                                                        <option>iPod</option>
                                                        <option>Accessories</option>
                                                    </select>
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric|min_value:0|max_value:5" v-slot="{ errors }">
                                                    <label class="form-label" for="rate">Rate</label>
                                                    <input
                                                        min={0}
                                                        max={5}
                                                        v-model="formData.rate"
                                                        id="rate"
                                                        name="rate"
                                                        type="number"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric|min_value:0" v-slot="{ errors }">
                                                    <label class="form-label" for="height">Height</label>
                                                    <input
                                                        min={0}
                                                        v-model="formData.height"
                                                        id="height"
                                                        name="height"
                                                        type="number"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric|min_value:0" v-slot="{ errors }">
                                                    <label class="form-label" for="length">Length</label>
                                                    <input
                                                        min={0}
                                                        v-model="formData.length"
                                                        id="length"
                                                        name="length"
                                                        type="number"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric|min_value:0" v-slot="{ errors }">
                                                    <label class="form-label" for="weight">Weight</label>
                                                    <input
                                                        min={0}
                                                        v-model="formData.weight"
                                                        id="weight"
                                                        name="weight"
                                                        type="number"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required|numeric|min_value:0" v-slot="{ errors }">
                                                    <label class="form-label" for="width">Width</label>
                                                    <input
                                                        min={0}
                                                        v-model="formData.width"
                                                        id="width"
                                                        name="width"
                                                        type="number"
                                                        class="form-control" />
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <div class="form-label" for="ship">Ship</div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="freeShip" v-model="formData.freeShip" />
                                                        <label class="form-check-label" for="freeShip">Freeship</label>
                                                    </div>
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
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <validation-provider rules="required" v-slot="{ errors }">
                                                    <label class="form-label" for="description">Description</label>
                                                    <textarea
                                                        v-model="formData.description"
                                                        id="description"
                                                        name="description"
                                                        type="text"
                                                        rows="6"
                                                        class="form-control"></textarea>
                                                    <span class="text-danger">{{ errors[0] }}</span>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex gap-1 flex-sm-row flex-column mt-2 justify-content-end">
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                            <!-- products edit Info form ends -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import Vue from 'vue';
    import {
        extend,
        ValidationProvider,
        ValidationObserver,
        Rules
    } from 'vee-validate';
    import {
        ProductService
    } from "@services/ProductService";


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
            id: null,
            initData: {},
            formData: {
                name: "",
                price: "",
                image_url: "",
                description: "",
                status: "",
                category: "",
                freeShip: false,
                rate: 5,
                height: 0,
                weight: 0,
                length: 0,
                width: 0
            }
        },
        methods: {
            onSubmit() {
                if (!this.id) {
                    ProductService.create(this.formData)
                        .then(res => {
                            Utils.delayNavigate('/admin/product/')
                        });
                } else {
                    ProductService.update(this.id, this.formData).then(res => {
                        // reload 
                        this.getFormData();
                        Utils.delayNavigate('/admin/product/')
                    });
                }
            },
            reset() {
                this.formData = {
                    ...this.initData
                }
            },
            getFormData() {
                ProductService.getOne(this.id).then(res => {
                    this.formData = {
                        ...res.data
                    }
                    this.initData = {
                        ...res.data
                    }
                })
            },
            async selected({
                target: {
                    files
                }
            }, validate) {
                this.formData.image_url = files[0];
                const {
                    valid
                } = await validate(files);
                console.log(files[0]);
            }
        },
        mounted() {
            const params = new URLSearchParams(location.search);
            this.id = params.get("id");

            if (this.id) {
                this.getFormData();
            }

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
        },
    });
</script>