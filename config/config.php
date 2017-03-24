<?php
class Config {

    private $company = "Casellas Wine - Tapas - Grill";
    private $domain = "casellas.com.au";

    public function host($status) {
        switch ($status) {
            case "production":
                $host = $_SERVER['SERVER_NAME'];
                break;

            case "local":
                $host = 'localhost/Casellas_v2';
                break;
        }
        return $host;
    }

    public function company() {
        return $this->company;
    }

    public function domain() {
        return $this->domain;
    }

    public function fileDir($dir) {
        switch ($dir) {
            case "image":
                $file_directory = "images_products";
                break;

            case "article":
                $file_directory = "images_articles";
                break;

            case "file":
                $file_directory = "downloadables";
                break;
        }
        return $file_directory;
    }
}
