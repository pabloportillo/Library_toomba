<?php


namespace Resources\Models;
use \RedBeanPHP\SimpleModel;
use \RedBeanPHP\R as R;
use Slim\Http\Request;
use Slim\http\Response;
use Interop\Container\ContainerInterface;


class Category
{
    /**
     * Creating a Category
     */
    public static function insertar($request){ 

        if($request->getParam('name') !== null && $request->getParam('name') !== "" && $request->getParam('category_id') !== null && $request->getParam('category_id') !== ""){

            $category = R::dispense('categories');
            $category->category_id = $request->getParam('category_id');
            $category->name = $request->getParam('name');

            R::store($category);

            $result = [
                'status' => 201,
                'success' => true,
                'description' => 'Category created.'
            ]; 

        }else{
            $result = [
                'status' => 400,
                'body' => [
                    'status' => '400',
                    'error' => 'Problem with the request.',
                    'description' => 'Please enter name field and category_id field. These fields are mandatory.'	
                ]
            ];         
        }
        return $result;
    }

    /**
     * Edit Category
     */
    public static function modificar($request){

        if($request->getParam('category_id') !== null && $request->getParam('category_id') !== ""){

            $category_id = $request->getParam('category_id');
            $q = "SELECT id FROM categories WHERE category_id = '$category_id'";
            $id = R::getCell($q);

            if(isset($id) && $id){

                $category = R::load('categories',$id);

                if($request->getParam('name') !== null && $request->getParam('name') !== ""){
                    $category->name = $request->getParam('name');
                }
    
                if($request->getParam('category_id') !== null && $request->getParam('category_id') !== ""){
                    $category->category_id = $request->getParam('category_id');
                }

                if($request->getParam('author') !== null && $request->getParam('author') !== ""){
                    $category->author = $request->getParam('author');
                }

                R::store($category);
                $result = [
                    'status' => 204,
                    'success' => true,
                    'description' => 'Category edited'

                ];                                 

            }else{
                $result = [
                    'status' => 404,
                    'body' => [
                        'status' => '404',
                        'error' => 'Category not found. Please make sure you enter the correct category_id',
                    ]
                ];
            }

        }else{
            $result = [
                'status' => 400,
                'body' => [
                    'status' => '400',
                    'error' => 'Solicitud incorrecta.',
                    'description' => 'Please enter category_id field. This field is mandatory.'
                ]
            ];
        }
        return $result;
    }

    /**
     * Get category by category_id
     */
    public static function category($args){
       
        $q = "SELECT id FROM categories WHERE category_id = '$args'"; 
        $id = R::getCell($q);

        if(isset($id) && $id){
            $category = R::load('categories',$id);

            $result = [
                'success' => true,
                'data' => $category
            ];
        }else{
            $result = [
                'status' => 404,
                'body' => [
                    'status' => '404',
                    'error' => 'Category not found. Please make sure you enter the correct category_id.',
                ]
            ];
        }
        return $result;
    }

    /**
     * Delete category by category_id
     */
    public static function borrar($args){
        
        $q = "SELECT id FROM categories WHERE category_id = '$args'"; 
        $id = R::getCell($q);

        if(isset($id) && $id){
            $category = R::load('categories',$id);
            R::trash( $category );

            $result = [
                'success' => true
            ];
        }else{
            $result = [
                'status' => 404,
                'body' => [
                    'estado' => '404',
                    'error' => 'Category not found. Please make sure you enter the correct category_id.',
                ]
            ];
        }
        return $result;
    }

}