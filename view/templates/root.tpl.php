<?php
session_start();
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>
        <?php
        if (isset($pagetitle)) {
            echo $pagetitle;
        } else {
            echo "hello world";
        }
        ?>
    </title>

    <link rel="apple-touch-icon" href="/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap-extended.css" />
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-glyphicons.css" />
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/colors.css" />
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/components.css" />
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/themes/bordered-layout.css" />

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- LIBS CSS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/libs/vue-good-table.css" />
    <!-- LIBS CSS -->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- Vuetify -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <!-- Vuetify -->

    <!-- START: THEME script -->
    <script src="/theme-assets/vendors/js/vendors.min.js"></script>
    <script src="/theme-assets/vendors/js/extensions/toastr.min.js"></script>

    <!-- END: THEME script -->

    <script src="/app-assets/js/libs/axios.min.js"></script>
    <script src="/app-assets/js/app.js"></script>
    <script defer src="/app-assets/js/fontawesome/all.js"></script>
    <script type="importmap">
        {
            "imports": {
                "vue": "https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.esm.browser.js",
                "vue-router": "https://cdn.jsdelivr.net/npm/vue-router/+esm",
                "vee-validate": "https://cdn.jsdelivr.net/npm/vee-validate@3.4.13/dist/vee-validate.full.esm.js",
                "vue-good-table": "https://cdn.jsdelivr.net/npm/vue-good-table/+esm",
                "flatpickr":"https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js",
                "@services/UserService": "/app-assets/js/services/UserService.js",
                "@services/BlogService": "/app-assets/js/services/BlogService.js",
                "@services/ProductService": "/app-assets/js/services/ProductService.js",
                "@services/CartService": "/app-assets/js/services/CartService.js",
                "@services/WishlistService": "/app-assets/js/services/WishlistService.js",
                "@services/CouponService": "/app-assets/js/services/CouponService.js",
                "@services/ShippingService": "/app-assets/js/services/ShippingService.js",
                "@services/OrderService": "/app-assets/js/services/OrderService.js",
                "@services/CommentService": "/app-assets/js/services/CommentService.js"
            }
        }
    </script>

    <!-- START: Filepond -->
    <link
        href="https://unpkg.com/filepond/dist/filepond.css"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" />
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <!-- END: Filepond -->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
    <!-- BEGIN: Header-->
    <?php
    if (isset($headerTPL)) {
        include $headerTPL;
    }
    ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php
    if (isset($menuTPL)) {
        include $menuTPL;
    }
    ?>
    <!-- END: Main Menu-->

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <?php
    if (isset($contentTPL)) {
        include $contentTPL;
    }
    ?>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">

    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

</body>
<!-- END: Body-->

</html>