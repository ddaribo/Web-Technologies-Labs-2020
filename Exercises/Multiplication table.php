<?php 

echo "<table border=\"3\">";
echo "<thead>";

for ($i = 1; $i<= 9; $i++)
{      
    echo "<tr>";
    for ($j = 1; $j<= 9; $j++)
    {
        if($i === 1)
        {
          echo "<th>" . $j . "</th>";
        }
        elseif($j === 1)
        {
          echo "<th>" . $i . "</th>";
        }
        else
        {
          echo "<td>" . $i*$j . "</td>";
         }
    }
    echo "</tr>";
}

echo "</thead>";
echo "</table>";
?>