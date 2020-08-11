<link rel="stylesheet" type="text/css" 
      href="<?php echo base_url(); ?>/assets/css/style.css">   
<link rel="stylesheet" type="text/css" href="style.css">
<a href="<?php echo site_url('mainController/index');?>" >Home</a>
<h1 align="center">Breach Account</h1>
<?php
//any info in the array that have been passed from the controller and then will go through the
// array to tie the indivual variables into a php variable
$data = array(
'Email' => $Email,
'Name' => $Name,
'Domain' => $Domain,
'BreachDate' => $BreachDate,
'PwnCount' => $PwnCount,
'Description' => $Description,
'DataClasses' => $DataClasses,
'IsVerified' => $IsVerified,
'IsFabricated' => $IsFabricated
);
// isVerified and isFabricated are boolean in the database and is saved as 0 = false and every else number is true so this would save the variables as 
//true or false so when they are display for the user the user would see false/true instead of being confused with 0 and 1
if ($IsVerified == 0){
$IsVerified = "False";
}else{
$IsVerified = "True";
}
if ($IsFabricated == 0){
$IsFabricated = "False";
}else{
$IsFabricated = "True";
}
//this is an Add button with a href link onto it
    $add ='<a href='.site_url('mainController/AddBreached/'.$Email).' ><button class=\'add\'>Add</button></a>';
    //this is creating rows of a table with the info that came in from the array and is still in the foreach so it would
//make a new row in the display table for each row in the array
             $this->table->add_row($Email,$Name,$Domain,$BreachDate, $PwnCount,$Description,$DataClasses,$IsVerified,$IsFabricated,$add);
            // this creates headings for the table
            $this->table->set_heading('Email','Name','Domain' ,'BreachDate', 'PwnCount','Description','DataClasses',
                    'IsVerified','IsFabricated',' '); 
            //this creates the table with all of the info above
            
           echo $this->table->generate();
           
?>
