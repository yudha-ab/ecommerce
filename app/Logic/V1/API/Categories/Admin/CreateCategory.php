<?php
namespace App\Logic\V1\API\Categories;

use App\Models\Category;
use App\Structs\CategoryStruct;
use Str;

class CreateCategory {
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function createCategory(CategoryStruct $categoryStruct) {
        $errors = [];

        if (Str::of($categoryStruct->name)->trim()->isEmpty()) {
            $errors['name'] = 'column name should not be empty';
        }
        if (is_null($categoryStruct->user_creator) || $categoryStruct->user_creator == 0) {
            $errors['name'] = 'column user_creator should not be empty';
        }

        if (!empty($errors)) {
            return $errors;
        }

        $categoryStruct->slug = Str::slug($categoryStruct->slug, '-');

        $categoryStruct->created_at = date('Y-m-d H:i:s', strtotime($categoryStruct->created_at));
        dd($categoryStruct);
    }
}