<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cube;
use App\Http\Requests;

class CubeController extends Controller
{
	private $n=0;
	private $ntest;
	private $cube;

	public function __construct()
    {
    	if(Session::has('n')){
    		$this->n = Session::get('n');  
    	}else{
    		Session::put('n', 1);
    	 	$this->n = 1;  
    	}  
		if(Session::has('ntest')){
    		$this->ntest = Session::get('ntest');  
    	}    
    }

    public function entrada($texto){
    	Session::put('n', $this->n);
		if($this->n==1){
			$this->ntest=intval(substr($texto,0,1));			
			Session::put('ntest', $this->ntest);
			$this->n++;
			Session::put('n', $this->n);	
		}else if($this->n==2){
			$size = intval(substr($texto,0,1));
			$nqueries = intval(substr($texto,2,1));
			$this->cube = new Cube($size,$nqueries);
			$this->n++;
			Session::put('n', $this->n);
		}else{
			$this->n++;
			Session::put('n', $this->n);
		}
    }

	public function reiniciar(){
		Session::flush();
	}
}