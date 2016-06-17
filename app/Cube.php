<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
	private $matriz;
    private $nqueries;

	public function Cube($size,$nqueries)
	{
        if(is_int($size) && is_int($nqueries)){
            $this->nqueries=$nqueries;
            for( $i=0; $i < $size*$size*$size ; $i++ ){
                $q = $i / ($size * $size);
                $r = $i % ($size * $size);
                $this->matriz[$q][$r/$size][$r % $size] = 0;
                return true;
            }
        }else{
            return false;
        }        
	}

	public function updateCell($x,$y,$z,$value)
    {
		if(is_int($x) && is_int($y) && is_int($z) && is_int($value)){
            $this->matriz[$x][$y][$z]=$value;
            return true;
        }else{
            return false;
        }
	}

	public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        if(is_int($x) && is_int($y) && is_int($z) && is_int($value)){
            $sum=0;
            for($x=$x1;$x >= $x1 and $x <= $x2;$x++){
                for($y=$y1;$y >= $y1 and $y <= $y2;$y++){
                    for($z=$z1;$z >= $z1 and $z <= $z2;$z++){
                        $sum = $sum + $this->matriz[$x][$y][$z];
                    }
                }
		    }
		    return $sum;
        }else{
            return false;
        }		
	}
}
