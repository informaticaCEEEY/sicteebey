<?php

require_once ('fpdf.php');

class PDF_MC_Table extends FPDF {
    var $widths;
    var $aligns;
    var $fonts1;
    var $borders1;
    protected $B;
    protected $I;
    protected $U;
    protected $HREF;
    protected $fontList;
    protected $issetfont;
    protected $issetcolor;

    function SetWidths($w) {
        //Set the array of column widths
        $this -> widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this -> aligns = $a;
    }

    function SetFonts($f) {
        //Set the array of column fonts
        $this -> fonts1 = $f;
    }

    function setBorders($b) {
        //Set the array of column bordes
        $this -> borders1 = $b;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this -> NbLines($this -> widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this -> CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this -> widths[$i];
            $a = isset($this -> aligns[$i]) ? $this -> aligns[$i] : 'L';
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '14';
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            //Save the current position
            $x = $this -> GetX();
            $y = $this -> GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);
            //Print the text
            $this -> SetFont($f0, $f1, $f2);
            $this -> MultiCell($w, 12, $data[$i], $b, $a);
            //Put the position to the right of the cell
            $this -> SetXY($x + $w, $y);
        }
        //Go to the next line
        $this -> Ln($h);
    }

    function Row1($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++){
            $nb = max($nb, $this -> NbLines($this -> widths[$i], $data[$i]));
        }
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this -> CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this -> widths[$i];
            $a = isset($this -> aligns[$i]) ? $this -> aligns[$i] : 'L';
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '24';
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            //Save the current position
            $x = $this -> GetX();
            $y = $this -> GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this -> SetFont($f0, $f1, $f2);
            $this -> MultiCell($w, 5, $data[$i], $b, $a);
            //Put the position to the right of the cell
            $this -> SetXY($x + $w, $y);
        }
        //Go to the next line
        $this -> Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this -> GetY() + $h > $this -> PageBreakTrigger)
            $this -> AddPage($this -> CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this -> CurrentFont['cw'];
        if ($w == 0)
            $w = $this -> w - $this -> rMargin - $this -> x;
        $wmax = ($w - 2 * $this -> cMargin) * 1000 / $this -> FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }    

    function NbLines1($w, $txt) {        
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this -> CurrentFont['cw'];
        if ($w == 0)
            $w = $this -> w - $this -> rMargin - $this -> x;
        $wmax = ($w - 2 * $this -> cMargin) * 1000 / $this -> FontSize;
        print_r($wmax);
        exit;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }  

}
?>
