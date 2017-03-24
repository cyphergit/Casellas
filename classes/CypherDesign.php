<?php

class Cypher {

    private $pageURL;
    private $spacer = array("_");
    private $pageName;
    private $siteYearCreated;
    private $currentYear;
    private $baseUrl;

    public function site_host($dir) {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            //return $this->baseUrl = $_SERVER['SERVER_NAME'] . "/" . $dir;
            return $this->baseUrl = $_SERVER['SERVER_NAME'];
        } else {
            return $this->baseUrl = $_SERVER['SERVER_NAME'];
        }
    }

    public function get_current_page_url() {
        if ($_SERVER['HTTPS'] == "on") { $this->pageURL.= "s"; }

        $this->pageURL .= "//";

        if ($_SERVER["SERVER_PORT"] != "80") {
            $this->pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $this->pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        return $this->pageURL;
    }

    public function get_page_name() {
        $spacer = $this->spacer;
        $pageName = $this->pageName = $_GET['pg'];

        $trimmed_pageName = trim(str_replace($spacer, " ", $pageName));
        $updated_pageName = ucwords(strtolower($trimmed_pageName));

        if ($updated_pageName != null) {
            
            switch($updated_pageName) {
                case "About":
                    $updated_pageName = "About Us";
                    break;
                
                case "Vip":
                    $updated_pageName = "VIP";
                    break;                                    
            }
            echo "$updated_pageName |";            
        }
    }

    public function get_footer_date($y) {
        $yc = $this->siteYearCreated = $y;
        $cy = $this->currentYear = date('Y');

        if ($yc != $cy) {
            echo "&copy; $yc - $cy";
        } else {
            echo "&copy; $yc";
        }
    }

    public function aus_to_standard_date($date) {
        $date = explode('/', $date);
        $d = $date[0];
        $m = $date[1];
        $y = $date[2];
        $formattedDate = "$y-$m-$d";
        $n_date = date($formattedDate);

        return $n_date;
    }

    public function break_to_space($string) {
        $stripped_string = strip_tags($string, '<br>');
        $preg_string = preg_replace('/<br[^>]*>/', ' ', $stripped_string);
        $n_string = preg_replace('/[\ ]+/', ' ', $preg_string);

        return $n_string;
    }

}

class CypherEncryption {

    public function mc_encrypt($encrypt, $mc_key) {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($encrypt), MCRYPT_MODE_ECB, $iv));
        $encode = base64_encode($passcrypt);

        return $encode;
    }

    public function mc_decrypt($decrypt, $mc_key) {
        $decoded = base64_decode($decrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($decoded), MCRYPT_MODE_ECB, $iv));

        return $decrypted;
    }

}

class CypherTable {

    private $rows = array();
    private $table_string = '';

    public function __construct($id = null, $t_class = null, $border = 0, $cellspacing = null, $cellpadding = null, $attr_ar = array()) {
        $this->table_string = "\n<table" . (!empty($id) ? " id=\"$id\"" : '' ) .
                (!empty($t_class) ? " class=\"$t_class\"" : '' ) . $this->addAttribute($attr_ar) .
                " border=\"$border\" cellspacing=\"$cellspacing\" cellpadding=\"$cellpadding\">\n";
    }

    public function addAttribute($attr_ar) {
        $str = '';
        foreach ($attr_ar as $key => $val) {
            $str .= " $key=\"$val\"";
        }
        return $str;
    }

    public function addRow($t_class = null, $attr_ar = array()) {
        $row = new CypherTableRow($t_class, $attr_ar);
        array_push($this->rows, $row);
    }

    public function addCell($data = '', $t_class = null, $type = 'data', $attr_ar = array()) {
        $cell = new CypherTableCell($data, $t_class, $type, $attr_ar);
        $curRow = &$this->rows[count($this->rows) - 1]; // copy by reference
        array_push($curRow->cells, $cell);
    }

    public function display() {
        foreach ($this->rows as $row) {
            $this->table_string .=!empty($row->t_class) ? "  <tr class=\"$row->t_class\"" : "  <tr";
            $this->table_string .= $this->addAttribs($row->attr_ar) . ">\n";
            $this->table_string .= $this->getRowCells($row->cells);
            $this->table_string .= "  </tr>\n";
        }
        $this->table_string .= "</table>\n";
        return $this->table_string;
    }

    public function getRowCells($cells) {
        $str = '';
        foreach ($cells as $cell) {
            $tag = ($cell->type == 'data') ? 'td' : 'th';
            $str .=!empty($cell->t_class) ? "    <$tag class=\"$cell->t_class\"" : "    <$tag";
            $str .= $this->addAttribs($cell->attr_ar) . ">";
            $str .= $cell->data;
            $str .= "</$tag>\n";
        }
        return $str;
    }

}

class CypherTableRow {

    private function __construct($t_class = null, $attr_ar = array()) {
        $this->t_class = $t_class;
        $this->attr_ar = $attr_ar;
        $this->cells = array();
    }

}

class CypherTableCell {

    private function __construct($data, $t_class, $type, $attr_ar) {
        $this->data = $data;
        $this->t_class = $t_class;
        $this->type = $type;
        $this->attr_ar = $attr_ar;
    }

}

class CypherFiles {

    public $fileName;
    public $fileExtension;
    public $fileSize;

    public function get_file_extension($filename) {
        $this->fileName = strtolower($filename);
        $this->fileExtension = split("[/\\.]", $this->fileName);
        $n = count($this->fileExtension) - 1;
        $n_exts = $this->fileExtension[$n];

        return $n_exts;
    }

}

class CypherImages {

    var $image;
    var $image_type;

    public function load($filename) {

        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image, $filename);
        }
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
    }

    public function output($image_type = IMAGETYPE_JPEG) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image);
        }
    }

    public function getWidth() {

        return imagesx($this->image);
    }

    public function getHeight() {

        return imagesy($this->image);
    }

    public function resizeToHeight($height) {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    public function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

}