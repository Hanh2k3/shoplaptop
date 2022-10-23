<?php 
use App\Models\Category;
use App\Models\Brand;

    function listCategory() {
        $db = new Category();
        $result = $db->getCategoryList();
        return $result;
    }

    function listBrand() {
        $db = new Brand();
        $result = $db->getBrandList();
        return $result;
    }
?>