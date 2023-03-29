<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ParentTransformer extends TransformerAbstract {

    public $baseUrl = "https://almaridcars.com/almarid/public/uploads/";

    public $key;

}