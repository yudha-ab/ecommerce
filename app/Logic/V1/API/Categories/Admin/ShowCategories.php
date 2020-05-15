<?php
namespace App\Logic\V1\API\Categories\Admin;

use App\Models\Category;

/**
 * class ShowCategories
 * to show all categories in ecommerce
 */
class ShowCategories {
    private $model;

    /**
     * function __construct()
     */
    public function __construct()
    {
        $this->model = new Category();
    }

    /**
     * function run()
     * to get data
     *
     * @return array
     */
    public function run() : array {
        $data = $this->model::with(['user' => function($query) {
            $query->select('id', 'name');
        }])
        ->get()
        ->toArray();
        return $data;
    }
}