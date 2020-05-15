<?php
namespace App\Logic\V1\API\Categories\Admin;

use App\Models\Category;

/**
 * To show category by specific id
 */
class ShowCategory {
    private $model;
    private int $id;

    public function __construct(int $id)
    {
        $this->model = new Category();
        $this->id = $id;
    }

    public function run() : array {
        $data = $this->model::with(['user' => function($q) {
            $q->select('id', 'name');
        }])
        ->whereId($this->id)
        ->first()
        ->toArray();
        return $data;
    }
}