<?
$filename = 'combined.txt';
$handle = fopen($filename, 'r');
set_time_limit(3000);
$result = [];
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $matchedArr;
        preg_match('~SUBSCRIPTION=(.*?)&~', $line, $matchedArr);
        if(count($matchedArr)<1) continue;
        $ippName = $matchedArr[1];
        $record_exist = false;
        foreach ($result as $key => $value) {
            if ($ippName == $key) {
                $record_exist = true;
                break;
            }
        }
        if($record_exist){
            $result[$ippName] += 1;
        }else{
            $result[$ippName] = 1;
        }
    }
    fclose($handle);
} else {
    echo "Could not open the file";
}
arsort($result);

printf('IPP Usage Analyzer');
?>


<table style="border-collapse: collapse;">
    <tr>
        <th style="border: 1px solid black;">IPP name</th>
        <th style="border: 1px solid black;">count</th>
    </tr>
    <?php foreach($result as $key => $value):?>
        <tr>
            <td style="border: 1px solid black;"><?php echo $key ?></td>
            <td style="border: 1px solid black;"><?php echo $value ?></td>
        </tr>
    <?php endforeach?>
</table>
