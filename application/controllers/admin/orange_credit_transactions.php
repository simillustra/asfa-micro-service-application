<?php

/*
* =======================================================================
* FILE NAME:        orange_credit_transactions.php
* DATE CREATED:  	05-03-2020
* FOR TABLE:  		orange_credit_transactions
* PRODUCED BY:		SIMILLUSTRA  PHP CODE GENERATOR
* AUTHOR:			SIMILLUSTRA  (http://simillustra.com) info@simillustra.com
* =======================================================================
*/

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include (APP_FOLDER . '/models/objects/orange_credit_transactions.php');
include (APP_FOLDER . '/models/objects/orange_credit_kyc.php');

class orange_credit_transactions_controller
{
    public $orange_credit_transactions_model;
    public $orange_credit_kyc_model;

    public function __construct()
    {
        $this->orange_credit_transactions_model = new orange_credit_transactions_model();
        $this->orange_credit_kyc_model = new orange_credit_kyc_model();
    }

    public function invoke_orange_credit_transactions()
    {
        $user_id = get('bid') ? get('bid') : $_SESSION['H_USER_SESSION_ID'];
        $user_role_id = (int)$_SESSION['H_USER_SESSION_POSITION'];
        $range_start = get('range_start') ? get('range_start') : date('2019-01-01');
        $range_end = get('range_end') ? get('range_end') : date('Y-m-d');

        $query_keys = array(
            'user_id' => $user_id,
            'user_role' => $user_role_id,
            'range_start' => $range_start,
            'range_end' => $range_end);

        //SELECT ALL //////////////////////////////////
        if (get('do') == 'viewall') {
            $kyc_approval = $this->orange_credit_kyc_model->checkApprovedKYC($user_id);
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->orange_credit_transactions_model->SelectAll($query_keys,
                    RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->orange_credit_transactions_model->CountRow($query_keys),
                    RECORD_PER_PAGE, '' . H_ADMIN .
                    '&view=orange_credit_transactions&do=viewall&bid=' . $user_id . '&range_start=' .
                    $range_start . '&range_end=' . $range_end);
            } else {
                $result = $this->orange_credit_transactions_model->SelectAll($query_keys);
            }
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////
        if (get('do') == 'export') {
            $result = $this->orange_credit_transactions_model->SelectAll($query_keys);
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/Export.php');
        } //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->orange_credit_transactions_model->SelectOne(get('id'));
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/Export2.php');
        } //SEARCH SUGGEST ////////////////////////////////////////////////////
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->orange_credit_transactions_model->AutoSearch(trim($qstring),
                    10, 'transactionid');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN .
                        '&view=orange_credit_transactions&id=' . $srow->id .
                        '&do=details"><li class="list-group-item">' . $srow->transactionid . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        } //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/Add.php');
        } //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('transactionid') == '') {
                    json_error('The field transactionid cannot be empty!');
                } elseif (post('sender_id') == '') {
                    json_error('The field sender id cannot be empty!');
                } elseif (post('sender_account') == '') {
                    json_error('The field sender account cannot be empty!');
                } elseif (post('receiver_id') == '') {
                    json_error('The field receiver id cannot be empty!');
                } elseif (post('receiver_account') == '') {
                    json_error('The field receiver account cannot be empty!');
                } elseif (post('payment_method') == '') {
                    json_error('The field payment method cannot be empty!');
                } elseif (post('amount') == '') {
                    json_error('The field amount cannot be empty!');
                } elseif (post('payment_status') == '') {
                    json_error('The field payment status cannot be empty!');
                } elseif (post('transaction_type') == '') {
                    json_error('The field transaction type cannot be empty!');
                } elseif (post('payment_date') == '') {
                    json_error('The field payment date cannot be empty!');
                } else {
                    $this->orange_credit_transactions_model->Insert(post('transactionid'), post('sender_id'),
                        post('sender_account'), post('receiver_id'), post('receiver_account'), post('payment_method'),
                        post('amount'), post('payment_status'), post('transaction_type'), post('payment_date'));
                    json_send('' . H_ADMIN . '&view=orange_credit_transactions&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        } //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->orange_credit_transactions_model->SelectOne(get('id'));
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/Update.php');
        } //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('transactionid') == '') {
                    json_error('The field transactionid cannot be empty!');
                } elseif (post('sender_id') == '') {
                    json_error('The field sender id cannot be empty!');
                } elseif (post('sender_account') == '') {
                    json_error('The field sender account cannot be empty!');
                } elseif (post('receiver_id') == '') {
                    json_error('The field receiver id cannot be empty!');
                } elseif (post('receiver_account') == '') {
                    json_error('The field receiver account cannot be empty!');
                } elseif (post('payment_method') == '') {
                    json_error('The field payment method cannot be empty!');
                } elseif (post('amount') == '') {
                    json_error('The field amount cannot be empty!');
                } elseif (post('payment_status') == '') {
                    json_error('The field payment status cannot be empty!');
                } elseif (post('transaction_type') == '') {
                    json_error('The field transaction type cannot be empty!');
                } elseif (post('payment_date') == '') {
                    json_error('The field payment date cannot be empty!');
                } else {
                    $this->orange_credit_transactions_model->Update(post('transactionid'), post('sender_id'),
                        post('sender_account'), post('receiver_id'), post('receiver_account'), post('payment_method'),
                        post('amount'), post('payment_status'), post('transaction_type'), post('payment_date'),
                        post('id'));
                    json_send('' . H_ADMIN . '&view=orange_credit_transactions&id=' . post('id') .
                        '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        } //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->orange_credit_transactions_model->SelectOne(get('id'));
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/Details.php');
        } //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->orange_credit_transactions_model->TruncateTable('' . H_ADMIN .
                '&view=orange_credit_transactions&do=viewall&msg=truncate');
            include (APP_FOLDER . '/views/admin/orange_credit_transactions/View.php');
        } //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->orange_credit_transactions_model->Delete(get('id'), '' . H_ADMIN .
                    '&view=orange_credit_transactions&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->orange_credit_transactions_model->Delete(get('id'), '' . H_ADMIN .
                    '&view=orange_credit_transactions&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=orange_credit_transactions&id=' . get('id') .
                    '&do=update&msg=delete');
            }
        }
    } //end invoke
} //end class

?>
	