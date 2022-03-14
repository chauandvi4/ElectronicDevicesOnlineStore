<?php
define("DOMAIN_URL", "https://web.quangtuan.me/");

define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE_NAME", "web");

define("DEFAULT_PAGE_SIZE", 10);
define("DEFAULT_PAGE", 1);

define("GHN_TOKEN", '4d8f2d88-4613-11ec-ac64-422c37c6de1b');
define("GHN_SHOP_ID", 83118);
define("GHN_SHOP_DISTRICT_ID", 1442);
define("GHN_SHOP_WARD_ID", '20101');

define("PAYPAL_CLIENT_ID", "ASUt3Y567zXNJOhXUhEHjfgfG0VYOhg-7hpWLRMt0NX6JvVShjoURAJorWlIsNl6jw7WfSz2X60yli3F");
define("PAYPAL_CLIENT_SECRET", "EOBeUaeReLwvTnXCNGl3ivJmdKahbFQReOjIQHkyFAAnokgCrRXCfvWii52QwENwv2UWBC9wfofd7VM6");
define("PAYPAL_TOKEN", 'A21AAKc90CngudHemCg8n6sccQdZ4KNFAGB0eWlobPMRqEXH8Pw0sibBjmi7kWQNDeTfJpZdQS1O2gDQh3yw2qIdhHcGQ-K1A');

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');
// variables used for jwt
$key = "example_key";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost/CodeOfaNinja/RestApiAuthLevel1/";

// Start filepond config
// where to get files from
const ENTRY_FIELD = array('filepond');

// where to write files to
const TRANSFER_DIR = './tmp/';
const UPLOAD_DIR = './images/';
const DATABASE_FILE = './database.json';

// name to use for the file metadata object
const METADATA_FILENAME = '.metadata';

// this automatically creates the upload and transfer directories, if they're not there already
if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755);
if (!is_dir(TRANSFER_DIR)) mkdir(TRANSFER_DIR, 0755);
// End filepond config