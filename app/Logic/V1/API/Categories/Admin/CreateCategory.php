<?php
namespace App\Logic\V1\API\Categories\Admin;

use App\Models\Category;
use App\Structs\CategoryStruct;
use Auth;
use Str;

class CreateCategory {
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * createCategory
     *
     * @param CategoryStruct $categoryStruct
     * @return array|mixed
     */
    public function createCategory(CategoryStruct $categoryStruct) {
        $errors = [];

        if (Str::of($categoryStruct->name)->trim()->isEmpty()) {
            $errors['name'] = 'column name should not be empty';
        }

        if (!empty($errors)) {
            return $errors;
        }

        $categoryStruct->name = Str::title($categoryStruct->name);
        $categoryStruct->user_creator = Auth::user()->id;
        $categoryStruct->slug = Str::slug($categoryStruct->name, '-');
        $save = Category::create((array)$categoryStruct);
        if ($save) {
            return true;
        }
        return false;
    }
}