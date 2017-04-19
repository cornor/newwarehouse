<?php
/**
 * Created by PhpStorm.
 * User: cornor
 * Date: 2017/4/9
 * Time: 下午12:25
 */
namespace App\Logic;

use App\Models\Category;

class CategoryLogic {


    public static function formatParentCategorySelect() {
        $categorys = Category::all();
        $pArr = [0 => ''];
        foreach ($categorys as $category) {
            if($category->pid == 0) {
                $pArr[$category->id] = $category->name;
            }
        }
        return $pArr;
    }

    public static function formatCategorySelect() {
        $categorys = Category::all();
        foreach ($categorys as $category) {
            $pArr[$category->id] = $category->name;
        }

        return $pArr;
    }

    public static function formatCanNoneCategorySelect() {
        $categorys = Category::all();
        $pArr = [0 => '请选择类别'];
        foreach ($categorys as $category) {
            $pArr[$category->id] = $category->name;
        }

        return $pArr;
    }

    public static function getCategorys()
    {
        $categorys = Category::all();
        $pArr = [];
        foreach ($categorys as $category) {
            $pArr[$category->id] = $category;
        }
        return $pArr;
    }
}