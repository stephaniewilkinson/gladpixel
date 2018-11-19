<?php
/*-----------------------------------------------------------------------------------*/
/* BACKUP OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Backup Options' , 'bmd'),
					"type" => "heading",
					"icon" => "icon-hdd"
				);
                    
					
$of_options[] = array( 
					"name" => __('Backup and Restore Options' , 'bmd'),
					"id"   => "of_backup",
					"type" => "backup",
					"std"  => "",
					"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.' , 'bmd'),
				);
					
$of_options[] = array( 
					"name" => __('Transfer Theme Options Data' , 'bmd'),
					"id"   => "of_transfer",
					"type" => "transfer",
					"std"  => "",
					"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options"' , 'bmd'),
				);  