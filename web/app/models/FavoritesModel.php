<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class FavoritesModel extends BaseModel
{
    public function getProductByIdFavorite(int $id): array|int|string|null
    {
        return R::getCell("SELECT `id` FROM `product` WHERE `id` = :id LIMIT 1", ['id' => $id]);
    }

    public function addToFavorites(int $id): void
    {
        $favorites = self::getFavoritesIds();
        if(!$favorites) {
            setcookie("favorites", $id, time() + (86400 * 30), "/");
            return;
        }

        if(!in_array($id, $favorites)){
            // максимум можно 5 товаров в избранном
            if(count($favorites) >= 5){
                array_shift($favorites); // 1 - первый убираем
            }
            $favorites[] = $id;
            $favoritesStr = implode(',', $favorites);
            setcookie("favorites", $favoritesStr, time() + (86400 * 30), "/");
        }
        return;
    }

    public function deleteFromFavorite(int $id): bool
    {
        $favorites = self::getFavoritesIds();
        if(!$favorites && !in_array($id, $favorites)) return false;

        $key = array_search($id, $favorites);
        if(false === $key) return false;

        unset($favorites[$key]);
        if(!$favorites){
            setcookie("favorites", '', time() - 3600, "/");
            return true;
        }

        $favoritesStr = implode(',', $favorites);
        setcookie("favorites", $favoritesStr, time() + (86400 * 30), "/");
        return true;
    }

    public static function getFavoritesIds(): array
    {
        $favorites = $_COOKIE["favorites"] ?? '';
        if($favorites){
            $favorites = explode(",", $favorites);
        }

        if(!is_array($favorites)) return [];

        $favorites = array_slice($favorites, 0, 5);
        return array_map('intval', $favorites);
    }

    public function getFavoritesProducts($languageId): array
    {
        $favorites = $this->getFavoritesIds();
        if(!$favorites) return [];

        $favorites = implode(",", $favorites);

        return R::getAll("SELECT p.*, pd.* FROM product AS p 
                       JOIN product_description AS pd on p.id = pd.product_id 
                       WHERE p.status = 1 AND p.id IN ({$favorites}) AND pd.language_id = :language_id",
                       [':language_id' => $languageId]
        );
    }

}
