<?php


namespace Resources\Models;
use \RedBeanPHP\SimpleModel;
use \RedBeanPHP\R as R;
use Slim\Http\Request;
use Slim\http\Response;
use Interop\Container\ContainerInterface;


class Book
{
    /**
     * Creating a Book
     */
    public static function insertar($request){ 

        if($request->getParam('name') !== null && $request->getParam('name') !== "" && $request->getParam('book_id') !== null && $request->getParam('book_id') !== ""){

            $book = R::dispense('books');

            if($request->getParam('category_id') !== null && $request->getParam('category_id') !== ""){

                $category_id = $request->getParam('category_id');

                $q = "SELECT id FROM categories WHERE category_id = '$category_id'";
                $cat_id = R::getCell($q);

                if(isset($cat_id) && $cat_id){
                    $book->category_id = $request->getParam('category_id');
                }else{
                    $result = [
                        'status' => 400,
                        'body' => [
                            'status' => '400',
                            'error' => 'Problem with the request.',
                            'description' => 'category_id Not found. Please enter a valid category_id.'	
                        ]
                    ];
                    
                    return $result;
                }
            }

            $book->book_id = $request->getParam('book_id');
            $book->name = $request->getParam('name');
            $book->author = $request->getParam('author');

            R::store($book);

            $result = [
                'status' => 201,
                'success' => true,
                'description' => 'Book created.'
            ]; 

        }else{
            $result = [
                'status' => 400,
                'body' => [
                    'status' => '400',
                    'error' => 'Problem with the request.',
                    'description' => 'Please enter name field and book_id field. These fields are mandatory.'	
                ]
            ];         
        }
        return $result;
    }

    /**
     * Edit Book
     */
    public static function modificar($request){

        if($request->getParam('book_id') !== null && $request->getParam('book_id') !== ""){

            $book_id = $request->getParam('book_id');
            $q = "SELECT id FROM books WHERE book_id = '$book_id'";
            $id = R::getCell($q);

            if(isset($id) && $id){

                $book = R::load('books',$id);

                if($request->getParam('name') !== null && $request->getParam('name') !== ""){
                    $book->name = $request->getParam('name');
                }
    
                if($request->getParam('category_id') !== null && $request->getParam('category_id') !== ""){

                    $category_id = $request->getParam('category_id');
    
                    $q = "SELECT id FROM categories WHERE category_id = '$category_id'";
                    $cat_id = R::getCell($q);
    
                    if(isset($cat_id) && $cat_id){
                        $book->category_id = $request->getParam('category_id');
                    }else{
                        $result = [
                            'status' => 400,
                            'body' => [
                                'status' => '400',
                                'error' => 'Problem with the request.',
                                'description' => 'category_id Not found. Please enter a valid category_id.'	
                            ]
                        ];
                        
                        return $result;
                    }
                }

                if($request->getParam('author') !== null && $request->getParam('author') !== ""){
                    $book->author = $request->getParam('author');
                }

                R::store($book);
                $result = [
                    'status' => 204,
                    'success' => true,
                    'description' => 'Book edited'

                ];                                 

            }else{
                $result = [
                    'status' => 404,
                    'body' => [
                        'status' => '404',
                        'error' => 'Book not found. Please make sure you enter the correct book_id',
                    ]
                ];
            }

        }else{
            $result = [
                'status' => 400,
                'body' => [
                    'status' => '400',
                    'error' => 'Solicitud incorrecta.',
                    'description' => 'Please enter book_id field. This field is mandatory.'
                ]
            ];
        }
        return $result;
    }

    /**
     * Get book by book_id
     */
    public static function book($args){
       
        $q = "SELECT id FROM books WHERE book_id = '$args'"; 
        $id = R::getCell($q);

        if(isset($id) && $id){
            $book = R::load('books',$id);

            $result = [
                'success' => true,
                'data' => $book
            ];
        }else{
            $result = [
                'status' => 404,
                'body' => [
                    'status' => '404',
                    'error' => 'Book not found. Please make sure you enter the correct book_id.',
                ]
            ];
        }
        return $result;
    }

    /**
     * Delete book by book_id
     */
    public static function borrar($args){
        
        $q = "SELECT id FROM books WHERE book_id = '$args'"; 
        $id = R::getCell($q);

        if(isset($id) && $id){
            $book = R::load('books',$id);
            R::trash( $book );

            $result = [
                'success' => true
            ];
        }else{
            $result = [
                'status' => 404,
                'body' => [
                    'estado' => '404',
                    'error' => 'Book not found. Please make sure you enter the correct book_id.',
                ]
            ];
        }
        return $result;
    }

}