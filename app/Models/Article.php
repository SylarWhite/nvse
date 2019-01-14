<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Article extends Model
{
    use SoftDeletes;

    public $cate = ['图片','视频','T台'];

    public function Columns()
    {
        return Schema::getColumnListing($this->getTable());
    }


    public function setTypeAttribute($type)
    {
        if (is_array($type)) {
            if(count($type) === 1){
                $this->attributes['type'] = $type[0];
            }else{
                $this->attributes['type'] = json_encode($type);
            }
        }
    }

    public function getTypeAttribute($type)
    {
        if (is_string($type)) {
            return json_decode($type, true);
        }

        return $type;
    }
}
