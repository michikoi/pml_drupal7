<html>

<body>

<form action="" method="post">
    <p>Select Project Name</p>
    <select id="projectName" name="projectName">
        <option value="asco">ASCO</option>
        <option value="ascoconnect">ASCOCONNECT</option>
    </select>
    <input type="submit" value="Submit" name="submit">
</form>
</body>
</html>


<?php

///create pml text file for each site

$fileContents = array();
//get the current directory
$dir = getcwd();

//ascoconnect project
if (isset($_POST['projectName']) && ($_POST['projectName'] == 'ascoconnect')) {


    //run the drush command to generate the pml text file for each site
    //asco_connection site
    exec('~/drush-8.1.18/drush @remote-dev-asco-connection  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_asco_connection.txt');
    //cancernet site
    exec('~/drush-8.1.18/drush @remote-dev-cancer-net  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_cancernet.txt');
    //practice central site
    exec('~/drush-8.1.18/drush @remote-dev-practice-central  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_practicecentral.txt');
    //tapur site
    exec('~/drush-8.1.18/drush @remote-dev-tapur  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_tapur.txt');
    //volunteer portal site
    exec('~/drush-8.1.18/drush @remote-dev-volunteer-portal  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_volunteer.txt');

    //merge all pml text file into the pmls_ascoconeect.txt file
    //remove the previous text in the plms_ascoconnect.txt file
    exec(' > ' . $dir . '/pmls_ascoconnect.txt');
    exec('echo "asco_connection" > ' . $dir . '/pmls_ascoconnect.txt');
    exec('cat ' . $dir . '/ascoconnect/pml_asco_connection.txt >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('echo "cancernet" >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('cat ' . $dir . '/ascoconnect/pml_cancernet.txt >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('echo "practicecentral" >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('cat ' . $dir . '/ascoconnect/pml_practicecentral.txt >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('echo "tapur" >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('cat ' . $dir . '/ascoconnect/pml_tapur.txt >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('echo "volunteer" >> ' . $dir . '/pmls_ascoconnect.txt');
    exec('cat ' . $dir . '/ascoconnect/pml_volunteer.txt >> ' . $dir . '/pmls_ascoconnect.txt');

    $headers = array('Module', 'asco_connection', 'cancernet', 'practicecentral', 'tapur', 'volunteer');
    $sitesNames = array('asco_connection', 'cancernet', 'practicecentral', 'tapur', 'volunteer');

} else { //asco project


}//else

if (isset($_POST['projectName'])) {


    echo '<p>Project: ' . $_POST['projectName'] . '</p>';

    if ($_POST['projectName'] == 'ascoconnect') {

        $target_file = 'pmls_ascoconnect.txt';
        echo "The file pmls_ascoconnect.txt has been created.<br><br>";

    } else {

        $target_file = 'pmls_asco.txt';
        echo "The file pmls_asco.txt has been created.";

    }//else


    $moduleNames = array();
    $texts = array();
    $status = array();

//parse the text file here
    $txt_file = file_get_contents($target_file);
    $rows = explode("\n", $txt_file);
    $line=array();

    foreach ($rows as $row => $data) {

        //$data is string like this Fonts.com (fonts_com),Not installed.  so sprit the string with
        //the delimiter ","
        if ($data != '') {

            //if $data is a site name, set the sitename
            if(in_array($data, $sitesNames)){

               $siteName = $data;
               continue;
            }

            //set the module name array and the status array
            $texts = explode(",", $data);
            $names[] = $texts[0];
            $status[$texts[0]][$siteName] = $texts[1];

        }//if
    }//foreach

    //remove any duplicate names in $names array
    $moduleNames = array_unique($names);

    //create headers for the csv file
    $fileContents[] = $headers;

    //loop thru the modulenames and create each row for the csv file
    foreach ($moduleNames as $key => $name) {

        //count the $name string in the text_file string.
        $count = substr_count($txt_file, $name);

        //if the count is the same number as the number of sites, output it.
        if ($count == 5) {

            $siteStatus=array();

            //get module status for each site
            foreach($sitesNames as $value){

               $siteStatus[]=$status[$name][$value];

            }//foreach

            //get the module status for each site
            array_unshift( $siteStatus,$name);

            //add to the file content
            $fileContents[] =$siteStatus;

        } //if
    }//foreach

//open the report file.
    $reportFile = fopen("pml_report.csv", "w");

//write it to the file
    foreach ($fileContents as $fields) {
        fputcsv($reportFile, $fields);
    }
//close the file
    fclose($reportFile);

    echo 'pml_report.csv has been created in ' . $dir;

}
?>

