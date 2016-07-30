<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Input;
use DebugBar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DateHelper {

// My common functions
    public static function getQueryPagination($query) {

        if (Input::has('filterObj')) {

            $filterObjList = json_decode(urldecode(Input::get('filterObj')), true);
           
            //DebugBar::info($filterObjList);
            //Log::info('This is some useful information.'.Input::get('filterObj'));
            foreach ($filterObjList as $filterObj) {

                $field = $filterObj['Field'];
                $value = $filterObj['Value'];
                $sign = $filterObj['Sign'];

                if($field == '' ||$value == '' ||$sign == ''){
                  continue;  
                }
                
                if (isset($filterObj['Operator'])) {

                    switch (strtolower($filterObj['Operator'])) {
                        case "and":
                            $query->where($field, $sign, self::setValueQueryBySign($value, $sign));
                            break;
                        case "or":
                            $query->orWhere($field, $sign, self::setValueQueryBySign($value, $sign));
                            break;
                    }
                } else {
                    $query->where($field, $sign, self::setValueQueryBySign($value, $sign));
                }
            }
        }

        $page = Input::has('page') ? Input::get('page') : 1;
        $pageSize = Input::has('pageSize') ? Input::get('pageSize') : 10;
        $sortBy = Input::has('sortBy') ? Input::get('sortBy') : 'id';
        $sortDirection = Input::has('sortDirection') ? Input::get('sortDirection') : 'asc';

        $result = $query->orderBy($sortBy, $sortDirection)->paginate($pageSize, ['*'], 'page', $page);

        return ['content' => $result->items(),
            'totalRecords' => $result->total(),
            'currentPage' => $result->currentPage(),
            'pageSize' => $result->perPage(),
            'totalPages' => $result->lastPage()
        ];
    }

    public static function toAscii($str, $replace = array(), $delimiter = '-') {

        if (!empty($replace)) {
            $str = str_replace((array) $replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }

    private static function setValueQueryBySign($value, $sign) {

        $newValue = '';

        switch (strtoupper($sign)) {

            case 'LIKE':

                $newValue = '%' . $value . '%';
                break;

            default:
                $newValue = $value;
                break;
        }

        return $newValue;
    }

    public static function convertToListItem($query, $value, $text) {

        $result = $query->select(DB::raw('CAST(' . $value . ' as CHAR) as value'), $text . ' as text')->get();

        $collection = collect($result);

        return $collection;
    }

    public static function convertToDropDownList($query, $value, $text) {

        $result = $query->select(DB::raw('CAST(' . $value . ' as CHAR) as value'), $text . ' as text')->get();
        
        $collection = collect($result);
 
        $collection->prepend(['value' => '0', 'text' => '-- Select item --']);

        return $collection;
    }

    public static function convertToListImage($imagesList) {

        $collection = collect($imagesList);

        $images = $collection->map(function ($image) {
            return ['url' => 'https://drive.google.com/uc?export=view&id=' . $image['path'], 'thumbUrl' => 'https://drive.google.com/uc?export=view&id=' . $image['path'], 'caption' => $image['filename'] . '.' . $image['extension']];
        });

        return $images;
    }

}

?>