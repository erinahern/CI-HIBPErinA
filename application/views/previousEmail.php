<link rel="stylesheet" type="text/css" 
      href="<?php echo base_url(); ?>/assets/css/style.css">   
<a href="<?php echo site_url('mainController/index'); ?>" >Home</a>
<h1 align="center">Previous Emails</h1>
<br>
<?php
// the first one would let the user go back to the home page
if ($query->num_rows() > 0) {
    //this would be for when the query of the database comes into this page it would 
    //check if thes any info in the array and then will go through thr array to tie the indivual variables into a php variable
foreach ($query->result_array() as $contact) {
$email = $contact['Email'];
$name = $contact['Name'];
$domain = $contact['Domain'];
$BreachDate = $contact['BreachDate'];
$PwnCount = $contact['PwnCount'];
$Description = $contact['Description'];
$DataClasses = $contact['DataClasses'];
$IsVerified = $contact['IsVerified'];
$IsFabricated = $contact['IsFabricated'];
//this is a delete button with a href link onto it
$delete = '<a href='.site_url('mainController/deleteBreach/'.$email).' ><button class=\'delete\'>Delete</button></a>';
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
//long descriptions were messingup the result table so the description were cut down to up to 100 char
$shortdownDescription = substr($Description,0,100);
//this is creating rows of a table with the info that came in from the database and is still in the foreach so it would
//make a new row in the display table for each row in the database
$this->table->add_row($email, $name, $domain, $BreachDate, $PwnCount, $shortdownDescription, $DataClasses, $IsVerified, $IsFabricated, $delete);
}
// this creates headings for the table
$this->table->set_heading('Email', 'Name', 'domain', 'BreachDate', 'PwnCount', 'Description', 'DataClasses',
 'IsVerified', 'IsFabricated', ' ');
//this creates the table with all of the info above
echo $this->table->generate();
}
?>