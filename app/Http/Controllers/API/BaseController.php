<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Serializers\NoDataKeySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;

class BaseController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($status,$message,$result = null,$code = 200,$errors = null,$extra = null)
    {
        $response = [
            'success' => $status,
            'message' => $message,
            'code' => $code,
        ];
        if(isset($errors) && !empty($errors)){
            $response['errors'] = $errors;
        }
        if(isset($extra) && !empty($extra)){
            $response['extra'] = $extra;
        }
        if(isset($result) && !empty($result)){
            $response = array_merge($response,$result);
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        return response()->json($response, 200);
    }

    /**
     * return Data array.
     *
     * @return array
     */
    public function sendData($currentCollection,$transformer,$key = 'data',$withPagination = false)
    {

        $response = array();

        $collection = null;
        $collectionPagination = null;

        if($withPagination){
            $collection = $currentCollection->getCollection();
            $collectionPagination = $currentCollection;
        }else{
            $collection = $currentCollection;
        }

        $resource = new Collection($collection, $transformer);

        $fractal  = new Manager();
        $fractal->setSerializer(new NoDataKeySerializer());
        $result = $fractal->createData($resource)->toArray();
        $response[$key] = $result;

        if($withPagination){
            $pagination = new IlluminatePaginatorAdapter($collectionPagination);
            $paginationArray = [
                'count'    => $pagination->getCount(),
                'current'  => $pagination->getCurrentPage(),
                'lastPage' => $pagination->getLastPage(),
                'total'    => $pagination->getTotal(),
                'perPage'  => $pagination->getPerPage(),
            ];
            $response['pagination'] = $paginationArray;
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        return $response;
    }

    /**
     * return Data array.
     *
     * @return array
     */
    public function margeData($data = array())
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $dataArray = [];
        if(isset($data) && !empty($data) && count($data) > 0){
            foreach ($data as $key => $value){
                $dataArray = array_merge($dataArray,$value);
            }
            return $dataArray;
        }
        return [];
    }

}