<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use core\App;

class BreadCrumbsModel extends BaseModel
{
    public static function getBreadCrumbs($categoryId, $name = ''): string
    {
        $lang = App::$container->getProp('language');
        $categories = App::$container->getProp("categories_{$lang['code']}");

        $breadcrumbsArray = self::getParts($categories, $categoryId);
        $breadCrumbs = "<li class='breadcrumb-item'><a href='". baseUrl(). "'>".
            '<i class="fas fa-home"></i>'.
            "</a></li>"
        ;

        if ($breadcrumbsArray) {
            foreach ($breadcrumbsArray as $slug => $title) {
                $breadCrumbs .= "<li class='breadcrumb-item'><a href='category/{$slug}'>{$title}</a></li>";
            }
        }
        if ($name) {
            $breadCrumbs .= "<li class='breadcrumb-item active'>{$name}</li>";
        }

        return $breadCrumbs;
    }

    public static function getParts($categories, $id): array|false
    {
        if (!$id) return false;

        $breadCrumbs = [];
        foreach ($categories as $key => $value) {
            if (!isset($categories[$id])) {
                break;
            }

            $breadCrumbs[$categories[$id]['slug']] = $categories[$id]['title'];
            $id = $categories[$id]['parent_id'];
        }

        return array_reverse($breadCrumbs, true);
    }
}
