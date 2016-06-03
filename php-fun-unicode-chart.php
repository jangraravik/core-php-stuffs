<table style="border:1px solid black;">
<tr><th> </th><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>F</th></tr>
<?php
    /*** from zero to 256 ***/
    for ($i=0; $i<256; $i++)
    {
        printf('<tr><td style="border:solid 1px black;">%04X</td>', $i);
        for ($j=0; $j<16; $j++)
        {
            printf('<td style="border:solid 1px black;">&#x%X%X;</td>', $i, $j);
        }
        echo "</tr>\n";
    }
?>
</table>