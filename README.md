# WP Uptime Monitor REST API Endpoint

A WordPress plugin for adding a non-cacheable REST API endpoint to your website that can be used to monitor its uptime.

## Installation

1. Download and unzip the plugin files.
2. Upload the `wp-uptime-monitor-rest-api-endpoint` directory to your `/wp-content/mu-plugins/` directory.
3. The endpoint will now be live at `https://example.com/wp-json/uptime-monitor/v1/check`.

## Usage

Send a GET request to `https://example.com/wp-json/uptime-monitor/v1/check` to monitor the uptime of your website.

## Response

On successful communication with your website and the underlying database, the REST API will respond with "status" set to "online" and the current datetime "timestamp". The datetime format will be reflective of your SQL server's NOW() function output format.

If the website's server is not reachable or the database is inaccessible, you will receive an error message with HTTP status 503.

## License

The code is available under the [MIT License](https://github.com/tombonez/wp-uptime-monitor-rest-api-endpoint/blob/main/LICENSE).
