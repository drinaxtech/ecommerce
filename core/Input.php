<?php
namespace Core;
use Core\Router;

class Input {

  public function isPost(){
    return $this->getRequestMethod() === 'POST';
  }

  public function isPut(){
    return $this->getRequestMethod() === 'PUT';
  }

  public function isGet(){
    return $this->getRequestMethod() === 'GET';
  }

  public function getRequestMethod(){
    return strtoupper($_SERVER['REQUEST_METHOD']);
  }

  public function get($input=false) {
    if(!$input){
      // return entire request array and sanitize it
      $data = [];
      foreach($_REQUEST as $field => $value){
      }
      return $data;
    }

  }

}
