<?php
    function subRemarks($mVar){
        
        $mVar = trim($mVar);
                
        if ($mVar == "2") 
            return "Less than Pass Marks";
        else        
        if ($mVar == "5")
            return "Absent";
        else
            return "&nbsp;";    
    }    
    //--------------------------------
    function subRemarksWAP($mVar){
        
        $mVar = trim($mVar);
        
        if ($mVar == "2") 
            return " (LTPM)";
        else        
        if ($mVar == "5")
            return " (Absent)";
        else
            return "&nbsp;";    
    }    
    //--------------------------------
    function isNumber($mVar){
        
        $mVar = trim($mVar);
        $len = strlen($mVar);
        
        if ($len == 0 || $len > 6 )
            return false;
        else {
            $i = 1;                
            while ( $i <= $len){                        
                $str = substr($mVar,$i,1);
                
                if ($str == "0" || $str == "1" || $str == "2" || $str == "3" || $str == "4" ||
                    $str == "5" || $str == "6" || $str == "7" || $str == "8" || $str == "9") {
                    $i++;
                    continue;
                } 
                else
                    break;
            } //end while
            
            if ($i > $len)
                return true;
            else
                return false;            
        } // end else
    } //end function
    //--------------------------------        
    function subStatus($mVar){
        if ($mVar == "1") return "P";
        else
        if ($mVar == "2") return "P*";
        else        
        if ($mVar == "3") return "F";
        else
            return "";    
    }
    //--------------------------------
    /*function subMaxMarks($mVar){
        if ($mVar == "70") return "200";
        else
        if ($mVar == "39" || $mVar == "71") return "150";
        else        
        if ($mVar == "80" || $mVar == "97") return "100";
        else
            return "";    
    }*/
    //---------------------------------------------------
    function mIsSubPr($mVar){
        //return true;
        switch (trim($mVar)){
            case '6':
            case '7':
            case '8':
            case '18':
            case '27':
            case '28':
            case '30':
            case '40':
            case '43':
            case '45':
            case '46':
            case '48':            
            case '68':
            case '69':
            case '70':
            case '72':    
            case '73':
            case '78':            
            case '79':
            case '83':
            case '88':    
            case '89':
            case '90':            
                return(true); break;
            default: 
                return (false);
        }
    }    
    //--------------------- Group ---------------------------
    function mGroup($mVar){
        switch (trim($mVar)){
            case '1': return "SCIENCE";    break;
            case '2': return "GENERAL";    break;
            case '3': return "TECHNICAL"; break;
            case '4': return "DARS-E-NAZAMI"; break;
            case '5': return "DEAF & DUMB"; break;
            default : "&nbsp;";            
        }
    }
    //--------------------- District_Old ---------------------------
    function mDistrict($mVar){
        switch (trim($mVar)){
            case '1': return "GUJRANWALA";             break;
            case '2': return "GUJRAT";                break;
            case '3': return "HAFIZABAD";             break;
            case '4': return "MANDI BAHA-UD-DIN";    break;
            case '5': return "NAROWAL";             break;
            case '6': return "SIALKOT";             break;            
            default : "&nbsp;";
        }
    }
    //--------------------- District_New ---------------------------
    function mDistrictNew($mVar){
        switch (trim($mVar)){
            case '341': return "GUJRANWALA";             break;
            case '342': return "GUJRAT";                break;
            case '345': return "HAFIZABAD";             break;
            case '346': return "MANDI BAHA-UD-DIN";    break;
            case '344': return "NAROWAL";             break;
            case '343': return "SIALKOT";             break;            
            default : "&nbsp;";
        }
    }
    //---------------------------------------------------------------------    
    function mSubName($mVar){
        switch (trim($mVar)){
            case '1': return('URDU'); break;
            case '2': return('ENGLISH'); break;
            case '3': return('ISLAMIYAT'); break;
            case '4': return('PAKISTAN STUDIES'); break;
            case '5': return('MATHEMATICS'); break;
            case '6': return('PHYSICS'); break;
            case '7': return('CHEMISTRY'); break;
            case '8': return('BIOLOGY'); break;
            case '9': return('GENERAL SCIENCE'); break;
            case '11': return('GEOGRAPHY OF PAKISTAN'); break;
            case '18': return('ART/ART & MODEL DRAWING'); break;
            case '22': return('ARABIC'); break;
            case '23': return('PERSIAN'); break;
            case '36': return('PUNJABI'); break;
            case '20': return('ISLAMIC HISTORY'); break;
            case '21': return('HISTORY OF PAKISTAN/ HISTORY OF INDO PAK'); break;
            case '78': return('COMPUTER SCIENCE'); break;
            case '12': return('HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS'); break;
            case '13': return('ELEMENTS OF HOME ECONOMICS'); break;
            case '14': return('PHYSIOLOGY & HYGIENE'); break;
            case '15': return('GEOMETRICAL & TECHNICAL DRAWING'); break;
            case '16': return('GEOLOGY'); break;
            case '17': return('ASTRONOMY & SPACE SCIENCE'); break;
            case '19': return('ISLAMIC STUDIES'); break;
            case '27': return('FOOD AND NUTRITION'); break;
            case '28': return('ART IN HOME ECONOMICS'); break;
            case '29': return('MANAGEMENT FOR BETTER HOME'); break;
            case '30': return('CLOTHING & TEXTILES'); break;
            case '31': return('CHILD DEVELOPMENT AND FAMILY LIVING'); break;
            case '32': return('MILITARY SCIENCE'); break;
            case '33': return('COMMERCIAL GEOGRAPHY'); break;
            case '34': return('URDU LITERATURE'); break;
            case '35': return('ENGLISH LITERATURE'); break;
            case '37': return('EDUCATION'); break;
            case '38': return('ELEMENTARY NURSING & FIRST AID'); break;
            case '39': return('PHOTOGRAPHY'); break;
            case '40': return('HEALTH & PHYSICAL EDUCATION'); break;
            case '41': return('CALIGRAPHY'); break;
            case '42': return('LOCAL (COMMUNITY) CRAFTS'); break;
            case '43': return('ELECTRICAL WIRING'); break;
            case '44': return('RADIO ELECTRONICS'); break;
            case '45': return('COMMERCE'); break;
            case '46': return('AGRICULTURE'); break;
            case '53': return('ANIMAL PRODUCTION'); break;
            case '54': return('PRODUCTIVE INSECTS AND FISH CULTURE'); break;
            case '55': return('HORTICULTURE'); break;
            case '56': return('PRINCIPLES OF HOME ECONOMICS'); break;
            case '57': return('RELATED ACT'); break;
            case '58': return('HAND AND MACHINE EMBROIDERY'); break;
            case '59': return('DRAFTING AND GARMENT MAKING'); break;
            case '60': return('HAND & MACHINE KNITTING & CROCHEING'); break;
            case '61': return('STUFFED TOYS AND DOLL MAKING'); break;
            case '62': return('CONFECTIONERY AND BAKERY'); break;
            case '63': return('PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS'); break;
            case '64': return('CARE AND GUIDENCE OF CHILDREN'); break;
            case '65': return('FARM HOUSE HOLD MANAGEMENT'); break;
            case '66': return('ARITHEMATIC'); break;
            case '67': return('BAKERY'); break;
            case '68': return('CARPET MAKING'); break;
            case '69': return('DRAWING'); break;
            case '70': return('EMBORIDERY'); break;
            case '71': return('HISTORY'); break;
            case '72': return('TAILORING'); break;
            case '24': return('GEOGRAPHY'); break;
            case '25': return('ECONOMICS'); break;
            case '26': return('CIVICS'); break;
            case '47': return('BOOK KEEPING & ACCOUNTANCY'); break;
            case '48': return('WOOD WORK (FURNITURE MAKING)'); break;
            case '49': return('GENERAL AGRICULTURE'); break;
            case '50': return('FARM ECONOMICS'); break;
            case '52': return('LIVE STOCK FARMING'); break;
            case '73': return('TYPE WRITING'); break;
            case '74': return('WEAVING'); break;
            case '75': return('SECRETARIAL PRACTICE'); break;
            case '76': return('CANDLE MAKING'); break;
            case '77': return('SECRETARIAL PRACTICE AND CORRESPONDANCE'); break;
            case '10': return('FOUNDATION OF EDUCATION'); break;
            case '51': return('ETHICS'); break;
            case '79': return('WOOD WORK (BOAT MAKING)'); break;
            case '80': return('PRINCIPLES OF ARITHMATIC'); break;
            case '81': return('SEERAT-E-RASOOL'); break;
            case '82': return('AL-QURAAN'); break;
            case '83': return('POULTRY FARMING'); break;
            case '84': return('ART & MODEL DRAWING'); break;
            case '85': return('BUSINESS METHODS'); break;
            case '86': return('HADEES & FIQAH'); break;
            case '87': return('ENVIRONMENTAL STUDIES'); break;
            case '88': return('REFRIGERATION AND AIR CONDITIONING'); break;
            case '89': return('FISH FARMING'); break;
            case '90': return('COMPUTER HARDWARE'); break;
            case '91': return('BEAUTICIAN'); break;
            case '92': return('GENERAL MATH'); break;            
            default: return ('&nbsp;');
        }                    
    }
    //------------------------------------------------------------------

function get_gradeMA_oldSch($marks,$status) {
if($status == 1)    
{
    if($marks >= 840) {
        echo "A+";
    }else if($marks >= 735 and $marks <=839 ) {
        echo "A";
    }else if($marks >= 630 and $marks <=734 ) {
        echo "B";
    }else if($marks >= 525 and $marks <=629 ) {
        echo "C";
    }else if($marks >= 420 and $marks <=524 ) {
        echo "D";
    }else if($marks < 420) {
        echo "E";
    }else 
        echo "F";
}
else
echo "";
}

function get_gradeMA_newSch($marks,$cat1,$cat2,$status) {
    
    if($status== NULL){$marks=0;}

    if($cat1==4 or $cat2==4){$marks = $marks/400 *1100;}

if($status == 1)
{
    if($marks >= 880) {
    echo "A+";
    }else if($marks >=770 and $marks <=879 ) {
        echo "A";
    }else if($marks >=660 and $marks <=769 ) {
        echo "B";
    }else if($marks >=550  and $marks <=649 ) {
        echo "C";
    }else if($marks >=440  and $marks <=549 ) {
        echo "D";
    }else if($marks < 440  ) {
        echo "E";
    }else 
        echo "";
}
else
echo "";
    
}
function get_gradeMA($percentage) {
    if($percentage >= 80.00) {
        echo "A+";
    }else if($percentage <= 79.99 and $percentage >=70.00 ) {
        echo "A";
    }else if($percentage <= 69.99 and $percentage >=60.00 ) {
        echo "B";
    }else if($percentage <= 59.99 and $percentage >=50.00 ) {
        echo "C";
    }else if($percentage <= 49.99 and $percentage >=40.00 ) {
        echo "D";
    }else if($percentage <= 39.99 and $percentage >=30.00 ) {
        echo "E";
    }else if($percentage <= 29.99) {
        echo "F";
    }
}

function get_gradeMAPrac($marks,$mSub_cd) {

   if ($mSub_cd ==6 || $mSub_cd==7 || $mSub_cd==8 || $mSub_cd==78 || $mSub_cd==27 || $mSub_cd==43 || $mSub_cd==83 || $mSub_cd==48 || $mSub_cd==79 || $mSub_cd==18 || $mSub_cd==84 || $mSub_cd==40 || $mSub_cd==30 || $mSub_cd==89 || $mSub_cd==90 )
    {
            if($marks >= 18) 
            {
                return "(A+)";
            }else if($marks == 16 or $marks ==17 ) {
                return "(A)";
            }else if($marks == 14 or $marks ==15 ) {
                return "(B)";
            }else if($marks == 12 or $marks ==13 ) {
                return "(C)";
            }else if($marks == 10 or $marks ==11 ) {
                return "(D)";
            }else if($marks == 8 or $marks ==9 ) {
                return "(E)";
            }else if($marks < 8) {
                return "(F)";
            }
    }
    else 
     return "";
}

function get_gradeMAPrac_new($marks,$st,$mSub_cd) {

if($st != 2 && ($marks ==0 || $marks == null))
return "";

   if ($mSub_cd ==6 || $mSub_cd==7 || $mSub_cd==8 || $mSub_cd==78 || $mSub_cd==27 || $mSub_cd==43 || $mSub_cd==83 || $mSub_cd==48 || $mSub_cd==79 || $mSub_cd==18 || $mSub_cd==84 || $mSub_cd==40 || $mSub_cd==30 || $mSub_cd==89 || $mSub_cd==90 )
    {
            if($marks >= 18) 
            {
                return "(A+)";
            }else if($marks == 16 or $marks ==17 ) {
                return "(A)";
            }else if($marks == 14 or $marks ==15 ) {
                return "(B)";
            }else if($marks == 12 or $marks ==13 ) {
                return "(C)";
            }else if($marks == 10 or $marks ==11 ) {
                return "(D)";
            }else if($marks == 8 or $marks ==9 ) {
                return "(E)";
            }else if($marks < 8) {
                return "(F)";
            }
    }
    else 
     return "";
}

function getField($row, $field){
    if(is_array($row)){ // edition
        if(array_key_exists($field,$row)){
            $field = $row[$field];
            return $field;
        } else {
            echo "Invalid field name or number.".$field."</br>";
        }
    }
}

?>