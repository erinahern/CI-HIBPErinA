This project has been build in php the framework is codeigniter with hibp API.
The Api auth key I couldnt figure out how to work with it so when inputting any email it wont would but adobe doesnt need the auth key to work so put in 'adobe' where the email input is. 
With codeigniter theres 3 main files that is usual work with is view (front pages), controller(the middle man), and the model(works with the database).
they will be found in /Source Files/application/... .
The functions with this appllication is that first you are meant to put in an email(just works with adobe)and the application will tell if the account is breached you can add it for later. Then you can see what accounts have the user have been saved for later and can delete what you have saved.
The database sql will be in a txt file next to this to set the database up it would be named hibp_check.

The project isnt on any hosting site so you have to have xampp to run the application you can be put the files in c:/xampp/htdoc and open up xampp application and make sure apache and mysql is running then put http://localhost:80/CI(HIBPErinA)/index.php/mainController/index into the url bar.