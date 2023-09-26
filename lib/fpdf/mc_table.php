<?php

require_once ('fpdf.php');

class PDF_MC_Table extends FPDF {
        
    var $widths;
    var $aligns;
    var $fonts1;
    var $fontColor1;
    var $borders1;
    var $sizeRows;
    var $colorBackground;

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
    
    function setFontColors($fc) {
        //Set the array of column fonts        
        $this -> fontColor1 = $fc;
    }

    function setBorders($b) {
        //Set the array of column bordes
        $this -> borders1 = $b;
    }
    
    function setSizeRows($sr) {
        //Set the array of column bordes
        $this -> sizeRows = $sr;
    }
    
    function setColorBackground($cb) {
        //Set the array of column bordes
        $this -> colorBackground = $cb;
    }
    
    function SetFill($fill) {
        //Set the array of column fonts
        $this -> fill = $fill;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this -> NbLines($this -> widths[$i], $data[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this -> CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this -> widths[$i];
            $a = isset($this -> aligns[$i]) ? $this -> aligns[$i] : 'L';
            
            //Font Type
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '14';
            $this -> SetFont($f0, $f1, $f2);
            
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            
            //Font Color
            $fc = $this -> fontColor1[$i];
            $fc0 = isset($fc[0]) ? $fc[0] : '0';
            $fc1 = isset($fc[1]) ? $fc[1] : '0';
            $fc2 = isset($fc[2]) ? $fc[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);
            
            //Background Color
            $cb = $this -> colorBackground[$i];
            $cb0 = isset($cb[0]) ? $cb[0] : '0';
            $cb1 = isset($cb[1]) ? $cb[1] : '0';
            $cb2 = isset($cb[2]) ? $cb[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);            
            
            //Save the current position
            $x = $this -> GetX();
            $y = $this -> GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);
            //Print the text            
            $this -> MultiCell($w, 30, $data[$i], $b, $a);
            //Put the position to the right of the cell
            $this -> SetXY($x + $w, $y);
        }
        //Go to the next line
        $this -> Ln($h);
    }

    function Row1($data){
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            
            //Font Type
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '20';            
            $this -> SetFont($f0, $f1, $f2);
            
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            
            //Font Color
            $fc = $this -> fontColor1[$i];
            $fc0 = isset($fc[0]) ? $fc[0] : '0';
            $fc1 = isset($fc[1]) ? $fc[1] : '0';
            $fc2 = isset($fc[2]) ? $fc[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);
            
            $fill = isset($this -> fill[$i]) ? $this -> fill[$i] : '0';
            
            //Background Color
            $cb = $this -> colorBackground[$i];
            $cb0 = isset($cb[0]) ? $cb[0] : '0';
            $cb1 = isset($cb[1]) ? $cb[1] : '0';
            $cb2 = isset($cb[2]) ? $cb[2] : '0';
            $this -> setFillColor($cb0, $cb1, $cb2);
            
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,10,$data[$i],$b,$a,$fill);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        
        //Go to the next line
        $this->Ln($h);
    }

    
    function Row2($data){
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 13 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            
            //Font Type
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '20';            
            $this -> SetFont($f0, $f1, $f2);
            
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            
            //Font Color
            $fc = $this -> fontColor1[$i];
            $fc0 = isset($fc[0]) ? $fc[0] : '0';
            $fc1 = isset($fc[1]) ? $fc[1] : '0';
            $fc2 = isset($fc[2]) ? $fc[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);
            
            $fill = isset($this -> fill[$i]) ? $this -> fill[$i] : '0';
            
            //Background Color
            $cb = $this -> colorBackground[$i];
            $cb0 = isset($cb[0]) ? $cb[0] : '0';
            $cb1 = isset($cb[1]) ? $cb[1] : '0';
            $cb2 = isset($cb[2]) ? $cb[2] : '0';
            $this -> setFillColor($cb0, $cb1, $cb2);
            
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,12,$data[$i],$b,$a,$fill);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        
        //Go to the next line
        $this->Ln($h);
    }

    function Row3($data){
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 11 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            
            //Font Type
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '20';            
            $this -> SetFont($f0, $f1, $f2);
            
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            
            //Font Color
            $fc = $this -> fontColor1[$i];
            $fc0 = isset($fc[0]) ? $fc[0] : '0';
            $fc1 = isset($fc[1]) ? $fc[1] : '0';
            $fc2 = isset($fc[2]) ? $fc[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);
            
            $fill = isset($this -> fill[$i]) ? $this -> fill[$i] : '0';
            
            //Background Color
            $cb = $this -> colorBackground[$i];
            $cb0 = isset($cb[0]) ? $cb[0] : '0';
            $cb1 = isset($cb[1]) ? $cb[1] : '0';
            $cb2 = isset($cb[2]) ? $cb[2] : '0';
            $this -> setFillColor($cb0, $cb1, $cb2);
            
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,11,$data[$i],$b,$a,$fill);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        
        //Go to the next line
        $this->Ln($h);
    }
    
    function RowX($data){
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        
        $sr=$this->sizeRows;
        if($sr != ''){
            $h = $sr * $nb;
        }else{
            $sr = 12;
            $h = $sr * $nb;
        }
                
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            
            //Font Type
            $f = $this -> fonts1[$i];
            $f0 = isset($f[0]) ? $f[0] : 'Arial';
            $f1 = isset($f[1]) ? $f[1] : '';
            $f2 = isset($f[2]) ? $f[2] : '20';            
            $this -> SetFont($f0, $f1, $f2);
            
            $b = isset($this -> borders1[$i]) ? $this -> borders1[$i] : '0';
            
            //Font Color
            $fc = $this -> fontColor1[$i];
            $fc0 = isset($fc[0]) ? $fc[0] : '0';
            $fc1 = isset($fc[1]) ? $fc[1] : '0';
            $fc2 = isset($fc[2]) ? $fc[2] : '0';
            $this -> SetTextColor($fc0, $fc1, $fc2);
            
            //Background Color          
            $fill = $this -> fill[$i];
            
            if($fill == ''){
                $fill = 0;
            }
            
            $cb = $this -> colorBackground[$i];
            $cb0 = isset($cb[0]) ? $cb[0] : '0';
            $cb1 = isset($cb[1]) ? $cb[1] : '0';
            $cb2 = isset($cb[2]) ? $cb[2] : '0';
            $this -> setFillColor($cb0, $cb1, $cb2);
            
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,$sr,$data[$i],$b,$a,$fill);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this -> GetY() + $h > $this -> PageBreakTrigger)
            $this -> AddPage($this -> CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take      
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    function VCell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false)
    {
        //Output a cell
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak())
        {
            //Automatic page break
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0)
            {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation,$this->CurPageSize);
            $this->x=$x;
            if($ws>0)
            {
                $this->ws=$ws;
                $this->_out(sprintf('%.3F Tw',$ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
    // begin change Cell function 
        if($fill || $border>0)
        {
            if($fill)
                $op=($border>0) ? 'B' : 'f';
            else
                $op='S';
            if ($border>1) {
                $s=sprintf('q %.2F w %.2F %.2F %.2F %.2F re %s Q ',$border,
                            $this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
            }
            else
                $s=sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
        }
        if(is_string($border))
        {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border,'L')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'l')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
                
            if(is_int(strpos($border,'T')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            else if(is_int(strpos($border,'t')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            
            if(is_int(strpos($border,'R')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'r')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            
            if(is_int(strpos($border,'B')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'b')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if(trim($txt)!='')
        {
            $cr=substr_count($txt,"\n");
            if ($cr>0) { // Multi line
                $txts = explode("\n", $txt);
                $lines = count($txts);
                for($l=0;$l<$lines;$l++) {
                    $txt=$txts[$l];
                    $w_txt=$this->GetStringWidth($txt);
                    if ($align=='U')
                        $dy=$this->cMargin+$w_txt;
                    elseif($align=='D')
                        $dy=$h-$this->cMargin;
                    else
                        $dy=($h+$w_txt)/2;
                    $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
                    if($this->ColorFlag)
                        $s.='q '.$this->TextColor.' ';
                    $s.=sprintf('BT 0 1 -1 0 %.2F %.2F Tm (%s) Tj ET ',
                        ($this->x+.5*$w+(.7+$l-$lines/2)*$this->FontSize)*$k,
                        ($this->h-($this->y+$dy))*$k,$txt);
                    if($this->ColorFlag)
                        $s.=' Q ';
                }
            }
            else { // Single line
                $w_txt=$this->GetStringWidth($txt);
                $Tz=100;
                if ($w_txt>$h-2*$this->cMargin) {
                    $Tz=($h-2*$this->cMargin)/$w_txt*100;
                    $w_txt=$h-2*$this->cMargin;
                }
                if ($align=='U')
                    $dy=$this->cMargin+$w_txt;
                elseif($align=='D')
                    $dy=$h-$this->cMargin;
                else
                    $dy=($h+$w_txt)/2;
                $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
                if($this->ColorFlag)
                    $s.='q '.$this->TextColor.' ';
                $s.=sprintf('q BT 0 1 -1 0 %.2F %.2F Tm %.2F Tz (%s) Tj ET Q ',
                            ($this->x+.5*$w+.3*$this->FontSize)*$k,
                            ($this->h-($this->y+$dy))*$k,$Tz,$txt);
                if($this->ColorFlag)
                    $s.=' Q ';
            }
        }
    // end change Cell function 
        if($s)
            $this->_out($s);
        $this->lasth=$h;
        if($ln>0)
        {
            //Go to next line
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }

    function CellX($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Output a cell
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak())
        {
            //Automatic page break
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0)
            {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation,$this->CurPageSize);
            $this->x=$x;
            if($ws>0)
            {
                $this->ws=$ws;
                $this->_out(sprintf('%.3F Tw',$ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
    // begin change Cell function
        if($fill || $border>0)
        {
            if($fill)
                $op=($border>0) ? 'B' : 'f';
            else
                $op='S';
            if ($border>1) {
                $s=sprintf('q %.2F w %.2F %.2F %.2F %.2F re %s Q ',$border,
                    $this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
            }
            else
                $s=sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
        }
        if(is_string($border))
        {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border,'L')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'l')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
                
            if(is_int(strpos($border,'T')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            else if(is_int(strpos($border,'t')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            
            if(is_int(strpos($border,'R')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'r')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            
            if(is_int(strpos($border,'B')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            else if(is_int(strpos($border,'b')))
                $s.=sprintf('q 2 w %.2F %.2F m %.2F %.2F l S Q ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if (trim($txt)!='') {
            $cr=substr_count($txt,"\n");
            if ($cr>0) { // Multi line
                $txts = explode("\n", $txt);
                $lines = count($txts);
                for($l=0;$l<$lines;$l++) {
                    $txt=$txts[$l];
                    $w_txt=$this->GetStringWidth($txt);
                    if($align=='R')
                        $dx=$w-$w_txt-$this->cMargin;
                    elseif($align=='C')
                        $dx=($w-$w_txt)/2;
                    else
                        $dx=$this->cMargin;
    
                    $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
                    if($this->ColorFlag)
                        $s.='q '.$this->TextColor.' ';
                    $s.=sprintf('BT %.2F %.2F Td (%s) Tj ET ',
                        ($this->x+$dx)*$k,
                        ($this->h-($this->y+.5*$h+(.7+$l-$lines/2)*$this->FontSize))*$k,
                        $txt);
                    if($this->underline)
                        $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
                    if($this->ColorFlag)
                        $s.=' Q ';
                    if($link)
                        $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$w_txt,$this->FontSize,$link);
                }
            }
            else { // Single line
                $w_txt=$this->GetStringWidth($txt);
                $Tz=100;
                if ($w_txt>$w-2*$this->cMargin) { // Need compression
                    $Tz=($w-2*$this->cMargin)/$w_txt*100;
                    $w_txt=$w-2*$this->cMargin;
                }
                if($align=='R')
                    $dx=$w-$w_txt-$this->cMargin;
                elseif($align=='C')
                    $dx=($w-$w_txt)/2;
                else
                    $dx=$this->cMargin;
                $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
                if($this->ColorFlag)
                    $s.='q '.$this->TextColor.' ';
                $s.=sprintf('q BT %.2F %.2F Td %.2F Tz (%s) Tj ET Q ',
                            ($this->x+$dx)*$k,
                            ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,
                            $Tz,$txt);
                if($this->underline)
                    $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
                if($this->ColorFlag)
                    $s.=' Q ';
                if($link)
                    $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$w_txt,$this->FontSize,$link);
            }
        }
    // end change Cell function
        if($s)
            $this->_out($s);
        $this->lasth=$h;
        if($ln>0)
        {
            //Go to next line
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }

}
?>