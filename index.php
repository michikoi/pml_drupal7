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
if(isset($_POST['submit'])) {
    $fileContents = array();
//get the current directory
    $dir = getcwd();

    //ascoconnect project
    if (isset($_POST['projectName']) && ($_POST['projectName'] == 'ascoconnect')) {

        //run the drush command to generate the pml text file for each site
        //asco_connection site
        exec('~/drush-8.1.18/drush @remote-prod-asco-connection  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_asco_connection.txt');
        //cancernet site
        exec('~/drush-8.1.18/drush @remote-prod-cancer-net  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_cancernet.txt');
        //practice central site
        //exec('~/drush-8.1.18/drush @remote-dev-practice-central  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_practicecentral.txt');
        //tapur site
        exec('~/drush-8.1.18/drush @remote-prod-tapur  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_tapur.txt');
        //volunteer portal site
        exec('~/drush-8.1.18/drush @remote-prod-volunteer-portal  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/ascoconnect/pml_volunteer.txt');

        //merge all pml text file into the pmls_ascoconeect.txt file
        //remove the previous text in the plms_ascoconnect.txt file
        exec(' > ' . $dir . '/pmls_ascoconnect.txt');
        exec('echo "asco_connection" > ' . $dir . '/pmls_ascoconnect.txt');
        exec('cat ' . $dir . '/ascoconnect/pml_asco_connection.txt >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('echo "cancernet" >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('cat ' . $dir . '/ascoconnect/pml_cancernet.txt >> ' . $dir . '/pmls_ascoconnect.txt');
        //exec('echo "practicecentral" >> ' . $dir . '/pmls_ascoconnect.txt');
        //exec('cat ' . $dir . '/ascoconnect/pml_practicecentral.txt >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('echo "tapur" >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('cat ' . $dir . '/ascoconnect/pml_tapur.txt >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('echo "volunteer" >> ' . $dir . '/pmls_ascoconnect.txt');
        exec('cat ' . $dir . '/ascoconnect/pml_volunteer.txt >> ' . $dir . '/pmls_ascoconnect.txt');

        $headers = array('Module', 'asco_connection', 'cancernet', 'tapur', 'volunteer');
        $sitesNames = array('asco_connection', 'cancernet', 'tapur', 'volunteer');

    } else { //asco project

        //run the drush command to generate the pml text file for each site
        /*

       // www.asco.org
       // quality.asco.org
      //  am.asco.org
       // ascodirect.org
        //boa.asco.org
       // cancerlinq.org
       // east-boa.asco.org
      //  west-boa.asco.org
       // central-boa.asco.org
       // gicasym.org
       // gucasym.org
      //  immunosym.org
      //  join.asco.org
        //conquer.org
      //  opc.asco.org
       // pallonc.org
       // survivorsym.org
       // university.asco.org
       // workload.asco.org
         *
         */
        //am microsite site
        exec('~/drush-8.1.18/drush  @remote-prod-am-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_ammicrosite.txt');
        //qc microsite
        exec('~/drush-8.1.18/drush  @remote-prod-qc-microsite pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_qcmicrosite.txt');
        //gi microsite
        exec('~/drush-8.1.18/drush @remote-prod-gi-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_gimicrosite.txt');
        //gu microsite
        exec('~/drush-8.1.18/drush @remote-prod-gu-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_gumicrosite.txt');
        //conquer.org site
        exec('~/drush-8.1.18/drush @remote-prod-ccf-org  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_ccforg.txt');
        //asco org site
        exec('~/drush-8.1.18/drush @remote-prod-asco-org  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_ascorg.txt');
        //asco university site
        exec('~/drush-8.1.18/drush @remote-prod-asco-university  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_ascouniversity.txt');
        // ascodirect.org site
        exec('~/drush-8.1.18/drush @remote-prod-ascodirect  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_ascodirect.txt');
        // boa.asco.org site
        exec('~/drush-8.1.18/drush @remote-prod-boa2-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_boa.txt');
        // cancerlinq site
        exec('~/drush-8.1.18/drush @remote-prod-cancerlinq  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_cancerlinq.txt');
        //east-boa.asco.orgsite
        exec('~/drush-8.1.18/drush @remote-prod-east-boa-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_eastboa.txt');
       //west-boa.asco.orgsite
        exec('~/drush-8.1.18/drush @remote-prod-west-boa-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_westboa.txt');
        //central-boa.asco.orgsite
        exec('~/drush-8.1.18/drush @remote-prod-central-boa-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_centralboa.txt');
        // immunosym.org site
        exec('~/drush-8.1.18/drush @remote-prod-immunosym-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_immunosym.txt');
        // join.asco.org site
        exec('~/drush-8.1.18/drush @remote-prod-benefits-microsite  pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_joinasco.txt');
        // opc.asco.org site
        exec('~/drush-8.1.18/drush @remote-prod-opc-microsite   pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_opcasco.txt');
        //pallonc.org site
        exec('~/drush-8.1.18/drush @remote-prod-pallonc-microsite   pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_pallonc.txt');
        // survivorsym.org site
        exec('~/drush-8.1.18/drush @remote-prod-survivorsym-microsite   pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_survivorsym.txt');
        //   workload.asco.org site
        exec('~/drush-8.1.18/drush @remote-prod-workload   pml --no-core --type=module --fields=name,status --status="disabled,not installed" --format=csv | cat > ' . $dir . '/asco/pml_workload.txt');



        //merge all pml text file into the pmls_asco.txt file
        //remove the previous text in the plms_asco.txt file
        exec(' > ' . $dir . '/pmls_asco.txt');
        exec('echo "am-microsite" > ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_ammicrosite.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "qc-microsite" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_qcmicrosite.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "gi-microsite" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_gimicrosite.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "gu-microsite" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_gumicrosite.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "ccf-org" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_ccforg.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "asco-org" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_ascorg.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "asco-university" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_ascouniversity.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "asco-direct" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_ascodirect.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "boa" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_boa.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "cancerlinq" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_cancerlinq.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "east-boa" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_eastboa.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "west-boa" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_westboa.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "central-boa" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_centralboa.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "immunosym" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_immunosym.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "joinasco" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_joinasco.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "opcasco" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_opcasco.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "pallonc" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_pallonc.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "survivorsym" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_survivorsym.txt >> ' . $dir . '/pmls_asco.txt');
        exec('echo "workload" >> ' . $dir . '/pmls_asco.txt');
        exec('cat ' . $dir . '/asco/pml_workload.txt >> ' . $dir . '/pmls_asco.txt');

        $headers = array('Module','am-microsite', 'qc-microsite', 'gi-microsite', 'gu-microsite', 'ccf-org', 'asco-org', 'asco-university','asco-direct',
                                        'boa','cancerlinq','east-boa','west-boa','central-boa','immunosym','joinasco','opcasco','pallonc','survivorsym','workload');
        $sitesNames = array('am-microsite', 'qc-microsite', 'gi-microsite', 'gu-microsite', 'ccf-org', 'asco-org', 'asco-university','asco-direct',
                            'boa','cancerlinq','east-boa','west-boa','central-boa','immunosym','joinasco','opcasco','pallonc','survivorsym','workload');

    }//else

    if (isset($_POST['projectName'])) {


        echo '<p>Project: ' . $_POST['projectName'] . '</p>';

        if ($_POST['projectName'] == 'ascoconnect') {

            $target_file = 'pmls_ascoconnect.txt';
            echo "The file pmls_ascoconnect.txt has been created.<br><br>";

        } else {

            $target_file = 'pmls_asco.txt';
            echo "The file pmls_asco.txt has been created.<br><br>";

        }//else


        $moduleNames = array();
        $texts = array();
        $status = array();

        //parse the text file here
        $txt_file = file_get_contents($target_file);
        $rows = explode("\n", $txt_file);
        $line = array();

        foreach ($rows as $row => $data) {

            //$data is string like this Fonts.com (fonts_com),Not installed.  so sprit the string with
            //the delimiter ","
            if ($data != '') {

                //if $data is a site name, set the sitename
                if (in_array($data, $sitesNames)) {

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

            //get the number of sites
            $siteCount = count($sitesNames);

            //if the count is the same number as the number of sites, output it.
            if ($count == $siteCount) {

                $siteStatus = array();

                //get module status for each site
                foreach ($sitesNames as $value) {

                    $siteStatus[] = $status[$name][$value];

                }//foreach

                //get the module status for each site
                array_unshift($siteStatus, $name);

                //add to the file content
                $fileContents[] = $siteStatus;

            } //if
        }//foreach

        $csvFileName = '';
        //generate the csv file name for ascoconnect project
        if ($_POST['projectName'] == 'ascoconnect') {

            $csvFileName = 'pml_ascoconnect_report.csv';
        } else {
            //generate the csv file name for asco project

            $csvFileName = 'pml_asco_report.csv';

        }//else
        //open the report file.
        $reportFile = fopen($csvFileName, "w");

        //write it to the file
        foreach ($fileContents as $fields) {
            fputcsv($reportFile, $fields);
        }
        //close the file
        fclose($reportFile);

        echo 'CSV file has been created in ' . $dir;

    }//if
}//if
?>

