<?php

namespace app\modules\product\models;

use Swagger\Annotations as SWG;
/**
 * @SWG\Definition(required={"name", "photoUrls"}, type="object", @SWG\Xml(name="Swagger"))
 */
class Swagger
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;
    /**
     * @SWG\Property(example="doggie")
     * @var string
     */
    public $name;
    /**
     * @var Category
     * @SWG\Property()
     */
    public $category;
    /**
     * @var string[]
     * @SWG\Property(@SWG\Xml(name="photoUrl", wrapped=true))
     */
    public $photoUrls;
    /**
     * pet status in the store
     * @var string
     * @SWG\Property(enum={"available", "pending", "sold"})
     */
    public $status;
}