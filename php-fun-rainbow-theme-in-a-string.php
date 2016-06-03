<?php
function getRainbowStr($text)
{
    /*** initialize the return string ***/
    $ret = '';

    /*** an array of colors ***/
    $colors = array(
        'ff00ff',
        'ff00cc',
        'ff0099',
        'ff0066',
        'ff0033',
        'ff0000',
        'ff3300',
        'ff6600',
        'ff9900',
        'ffcc00',
        'ffff00',
        'ccff00',
        '99ff00',
        '66ff00',
        '33ff00',
        '00ff00',
        '00ff33',
        '00ff66',
        '00ff99',
        '00ffcc',
        '00ffff',
        '00ccff',
        '0099ff',
        '0066ff',
        '0033ff',
        '0000ff',
        '3300ff',
        '6600ff',
        '9900ff',
        'cc00ff');
    /*** a counter ***/
    $i = 0;

    /*** get the length of the text ***/
    $textlength = strlen($text);

    /*** loop over the text ***/
    while($i<=$textlength)
    {
        /*** loop through the colors ***/
        foreach($colors as $value)
        {
            if ($text[$i] != "")
            {
                $ret .= '<span style="color:#'.$value.';">'.$text[$i]."</span>";
            }
        $i++;
        }
    }
    /*** return the highlighted string ***/
return $ret;
}

$valMyString = 'Charlie is choosing when choosing his cheeses and cheeses are a challenge when charlie arrives';

/*** highlight the text ***/
echo getRainbowStr($valMyString);