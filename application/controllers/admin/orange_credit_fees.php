
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        orange_credit_fees.php
	* DATE CREATED:  	05-03-2020
	* FOR TABLE:  		orange_credit_fees
	* PRODUCED BY:		SIMILLUSTRA  PHP CODE GENERATOR
	* AUTHOR:			SIMILLUSTRA  (http://simillustra.com) info@simillustra.com
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/orange_credit_fees.php');
	
	class orange_credit_fees_controller {
	public $orange_credit_fees_model;
	
	public function __construct()  
    {  
        $this->orange_credit_fees_model = new orange_credit_fees_model();
    } 
	
	public function invoke_orange_credit_fees()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->orange_credit_fees_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->orange_credit_fees_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=orange_credit_fees&do=viewall');
	}else{
	$result = $this->orange_credit_fees_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/orange_credit_fees/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->orange_credit_fees_model->SelectAll();
	include(APP_FOLDER.'/views/admin/orange_credit_fees/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->orange_credit_fees_model->SelectOne(get('fee_id'));
	include(APP_FOLDER.'/views/admin/orange_credit_fees/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->orange_credit_fees_model->AutoSearch(trim($qstring),10,'fee_name');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=orange_credit_fees&fee_id='.$srow->fee_id.'&do=details"><li class="list-group-item">'. $srow->fee_name.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/orange_credit_fees/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('fee_name')==''){
	json_error('The field fee name cannot be empty!');
	}
	elseif (post('fee_short')==''){
	json_error('The field fee short cannot be empty!');
	}
	elseif (post('fee_value')==''){
	json_error('The field fee value cannot be empty!');
	}
	else{
	$this->orange_credit_fees_model->Insert(post('fee_name'),post('fee_short'),post('fee_value'));
	json_send(''.H_ADMIN.'&view=orange_credit_fees&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->orange_credit_fees_model->SelectOne(get('fee_id'));
	include(APP_FOLDER.'/views/admin/orange_credit_fees/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('fee_id')==''){
	json_error('The field fee_id cannot be empty!');
	}
	elseif (post('fee_name')==''){
	json_error('The field fee name cannot be empty!');
	}
	elseif (post('fee_short')==''){
	json_error('The field fee short cannot be empty!');
	}
	elseif (post('fee_value')==''){
	json_error('The field fee value cannot be empty!');
	}
	else{
	$this->orange_credit_fees_model->Update(post('fee_name'),post('fee_short'),post('fee_value'),post('fee_id'));
	json_send(''.H_ADMIN.'&view=orange_credit_fees&fee_id='.post('fee_id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->orange_credit_fees_model->SelectOne(get('fee_id'));
	include(APP_FOLDER.'/views/admin/orange_credit_fees/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->orange_credit_fees_model->TruncateTable(''.H_ADMIN.'&view=orange_credit_fees&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/orange_credit_fees/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('fee_id') and $dfile==''){
	$del = $this->orange_credit_fees_model->Delete(get('fee_id'),''.H_ADMIN.'&view=orange_credit_fees&do=viewall&msg=delete');
	}
	elseif(get('fee_id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->orange_credit_fees_model->Delete(get('fee_id'),''.H_ADMIN.'&view=orange_credit_fees&do=viewall&msg=delete');
	}
	elseif(get('fee_id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=orange_credit_fees&fee_id='.get('fee_id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	