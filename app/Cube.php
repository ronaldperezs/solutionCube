<?php

namespace App;

class Cube
{
	private $matriz;
    private $nqueries;

	public function __construct($size,$nqueries)
	{
        $this->nqueries=$nqueries;
        for( $i=0; $i < $size*$size*$size ; $i++ ){
            $q = $i / ($size * $size);
            $r = $i % ($size * $size);
            $this->matriz[$q][$r/$size][$r % $size] = 0; 
        }  
	}

	public function update($x,$y,$z,$value)
    {
		if(is_int($x) && is_int($y) && is_int($z) && is_int($value)){
            $this->matriz[$x-1][$y-1][$z-1]=intval($value);
            $this->nqueries--;
            return true;
        }else{
            return false;
        }
	}

	public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        if(is_int($x1) && is_int($y1) && is_int($z1) 
        && is_int($x2) && is_int($y2) && is_int($z2)){
            $sum=0;
            for($x=$x1;$x >= $x1 and $x <= $x2;$x++){
                for($y=$y1;$y >= $y1 and $y <= $y2;$y++){
                    for($z=$z1;$z >= $z1 and $z <= $z2;$z++){
                        $sum = $sum + $this->matriz[$x-1][$y-1][$z-1];
                    }
                }
		    }
            $this->nqueries--;
		    return $sum;
        }else{
            return false;
        }		
	}

    public function getNqueries()
    {
        return $this->nqueries;
    }
}
