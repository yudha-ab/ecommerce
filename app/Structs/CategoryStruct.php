<?php
namespace App\Structs;

/**
 * class CategoryStruct
 * to define data struct from table categories
 */
class CategoryStruct {
    public int $id;
    public string $name;
    public string $slug;
    public int $user_creator;
    public string $source;
    public string $created_at;
    public ?string $updated_at;
    public ?string $deleted_at;
}