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
		if(Session::has('cube')){
    		$this->cube = Session::get('cube');  
    	}    
    }

    public function entrada($texto){
    	Session::put('n', $this->n);
		if($this->n==1){
			$this->ntest=intval(substr($texto,0,1));			
			Session::put('ntest', $this->ntest);
			$this->n++;
			Session::put('n', $this->n);
			return response()->json(['valido' => true]);	
		}else if($this->n==2){
			$size = intval(substr($texto,0,1));
			$nqueries = intval(substr($texto,2,1));
			$this->cube = new Cube($size,$nqueries);
			$this->n++;
			Session::put('n', $this->n);
			Session::put('cube', $this->cube);
			return response()->json(['valido' => true]);
		}else{
			if($this->cube->getNqueries()>0){
				if(strpos($texto,"UPDATE")!==FALSE){
					$x = intval(substr($texto,7,1));
					$y = intval(substr($texto,9,1));
					$z = intval(substr($texto,11,1));
					$value = intval(substr($texto,13,2));
					$update=$this->cube->update($x,$y,$z,$value);
					if($update){
						$this->n++;
						Session::put('n', $this->n);
						return response()->json(['valido' => true]);
					}else{
						return response()->json(['valido' => false]);
					}					
				}else if(strpos($texto,"QUERY")!==FALSE){
					$x1 = intval(substr($texto,6,1));
					$y1 = intval(substr($texto,8,1));
					$z1 = intval(substr($texto,10,1));
					$x2 = intval(substr($texto,12,1));
					$y2 = intval(substr($texto,14,1));
					$z2 = intval(substr($texto,16,1));
					$query = $this->cube->query($x1,$y1,$z1,$x2,$y2,$z2);
					if($query!=false){
						$this->n++;
						Session::put('n', $this->n);
						return response()->json(['valido' => true,'mensaje' => $query]);
					}else{
						return response()->json(['valido' => false]);
					}					
				}else{
					return response()->json(['valido' => false]);
				}
			}else{
				$size = intval(substr($texto,0,1));
				$nqueries = intval(substr($texto,2,1));
				$this->cube = new Cube($size,$nqueries);
				$this->n++;
				Session::put('n', $this->n);
				Session::put('cube', $this->cube);
				return response()->json(['valido' => true]);
			}			
		}
    }

	public function reiniciar(){
		Session::flush();
	}
}