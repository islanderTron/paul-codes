<?php
	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	
	// Include dependancy of the main model form
	jimport('joomla.application.component.modelform');
	// import Joomla modelitem library
	jimport('joomla.application.component.modelitem');
	// Include dependancy of the dispatcher
	jimport('joomla.event.dispatcher');
	
	/**
		* create message Model
	*/
	class CreateMessageModelCreateMessage extends JModelForm
	{
		protected $item;
		public function getForm($data = array(), $loadData = true)
		{
			
			$app = JFactory::getApplication('site');
			$form = $this->loadForm('com_createmessage.createmessage', 'createmessage', array('control' => 'jform', 'load_data' => true));
			if (empty($form)) {
				return false;
			}
			return $form;
		}
		
		/**
			* Get the message
			* @return object The message to be displayed to the user
		*/
		function &getItem()
		{
			
			if (!isset($this->_item))
			{
				$cache = JFactory::getCache('com_createmessage', '');
				$id = $this->getState('createmessage.id');
				$this->_item =  $cache->get($id);
				if ($this->_item === false) {
					
				}
			}
			return $this->_item;
			
		}
		public function getUserListCount($searchQuery){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  " SELECT COUNT(*) as total FROM sl_users INNER JOIN sl_user_usergroup_map on sl_user_usergroup_map.user_id=sl_users.id  where sl_user_usergroup_map.group_id=2 $searchQuery";
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data[0]->total;
		}
		public function getUserList($startpoint,$endpoint,$searchQuery){
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  " SELECT sl_users.*,sl_user_usergroup_map.* FROM sl_users INNER JOIN sl_user_usergroup_map on sl_user_usergroup_map.user_id=sl_users.id  where sl_user_usergroup_map.group_id=2 $searchQuery LIMIT $startpoint , $endpoint";
			
			$db->setQuery($query);
			$db->query();
			$num_rows = $db->getNumRows();
			if($num_rows>0){
				$data = $db->loadObjectList();
				return $data;
				}else{
				return false;
			}
			
		}
		public function updItem($data)
		{
			// set the variables from the passed data
			$id = $data['id'];
			$greeting = $data['greeting'];
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);
			$query->clear();
			$query->update(' #__helloworld ');
			$query->set(' greeting = '.$db->Quote($greeting) );
			$query->where(' id = ' . (int) $id );
			
			$db->setQuery((string)$query);
			
			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
				return false;
				} else {
				return true;
			}
		}
		
		
		/***********
			Function used to store message information in jommla's session table in json format.
		**************/
		public function insertItem($data)
		{
			$db = JFactory::getDbo();
			$object = new stdClass();
			$user = JFactory::getUser();
			$query  =  ' SELECT * FROM sl_user_session where userid='.$user->id;
			$db->setQuery($query);
			$db->query();
			$num_rows = $db->getNumRows();
			
			$object->json_data = $data;
			$object->userid = $user->id;
			if($num_rows>0){
				if (! JFactory::getDbo()->updateObject('#__user_session', $object, 'userid')) {
					echo "error"; die;
					} else {
					return true;
				}
				}else{
				if (! JFactory::getDbo()->insertObject('#__user_session', $object)) {
					echo  "error"; die;
					} else {
					return true;
				}
			}
			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
				return false;
				} else {
				return true;
			}
		}
		
		/************
			Function: Used to set the redemption_status
			to 1 if recipient has viewed the gift
		************/
		public function setIsViwed($msgId){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->redemption_status = 1;
				$object->id = $msgId;
				JFactory::getDbo()->updateObject('#__sil_message', $object,'id');
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		public function setIsRedeemed($msgId){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->redemption_status = 2;
				$object->is_redeemed = 1;
				$object->id = $msgId;
				JFactory::getDbo()->updateObject('#__sil_message', $object,'id');
				return true;
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		public function updateRedeemedMessage($data){
			/* echo "<pre>";
				print_r($data);
			echo "</pre>";
		 */
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->redemption_status = 2;
				$object->is_redeemed = 1;
				if(isset($data['RedeemedType']) && ($data['RedeemedType'] == "check" || $data['RedeemedType'] == "visa" || $data['RedeemedType'] == "dollar" || $data['RedeemedType'] == "bitcoin" || $data['RedeemedType'] == "money" )){
					$object->redeemed_gift_type =  $data['Data']['ShippingMoneyInfo'][0]['new_gift_type'];
					$object->reedemed_gift_amount = $data['redeemed_amount'];
				}
				else{
					$object->redeemed_gift_type =  $data['Data']['ShippingInfo'][0]['new_gift_type'];
					$object->reedemed_gift_amount = $data['redeemed_amount'];
					$object->redeemed_product_id = (int)$data['Data']['ShippingInfo'][0]['productId'];
					$object->redeemed_cat_id = (int)$data['Data']['ShippingInfo'][0]['category'];
				}
				
				$object->id = $data['msg_id'];
				if( JFactory::getDbo()->updateObject('#__sil_message', $object,'id')) {
					return true;
				} else {
					return false;
				}
			
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		public function updateMsgUserId($userId,$msgId,$isDraft){
			$db = JFactory::getDbo();
			$object = new stdClass();
			$object->user_id = $userId;
			$object->id = $msgId;
			$object->is_draft = ($isDraft= 1 ? $isDraft : 0);
			if($isDraft== 1) {
				$object->is_success = 0;
				} else {
				$object->is_success = 1;
			}
			
			JFactory::getDbo()->updateObject('#__sil_message', $object,'id');
		}
		
		
		public function updateMessageOnly($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->sender_name = $data['sender_name'];
				if($user->id>0){
					$object->sender_email=$user->email; 
				} else {
					$object->sender_email=$data['sender_email'];
				}
				$object->recipient_name = $data['recipient_name'];
				$object->recipient_email = $data['recipient_email'];
				$object->occasion = $data['occassion'];
				$object->recipient_relationship = $data['recipient_relationship'];
				$originalDate = $data['date_to_deliver_message'];
				$newDate = date("Y-m-d", strtotime($originalDate));
				$object->date_to_deliver_message = $newDate." 00:00:00";
				$object->message_subject = $data['message_subject'];
				$object->message_content = $data['message_content'];
				$object->template_name = $data['template_name'];
				$object->template_path = $data['template_path'];
				$object->file_attachment = $data['file_attachment'];
				$object->json_data = $data['json_data'];
				$object->id = $data['msg_id'];
				
				$isNotify = $this->isMessageUpdates($user->id);
				if($isNotify){
					$object->send_sender_status_updates = 1;
				}
	
				if(JFactory::getDbo()->updateObject('#__sil_message', $object,'id')){
					return true;
				} else {
					return false;
				}
				
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		/*********************
			Function: Used to save infomation
			related to message and selected product
		*********************/
		public function saveMessageOnly($data)
		{
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->sender_name = $data['sender_name'];
				if( $user->id > 0 ) {
					$object->sender_email = $user->email; 
					$user_id = $user->id;
				} else {
					$object->sender_email = $data['sender_email'];
					$user_id = 0;
				}
				$object->user_id = $user_id;
				$object->recipient_name = $data['recipient_name'];
				$object->recipient_email = $data['recipient_email'];
				$object->occasion = $data['occassion'];
				$object->recipient_relationship = $data['recipient_relationship'];
				$originalDate = $data['date_to_deliver_message'];
				$newDate = date("Y-m-d", strtotime($originalDate));
				$object->date_to_deliver_message = $newDate." 00:00:00";
				$object->message_subject = $data['message_subject'];
				$object->message_content = $data['message_content'];
				$object->template_name = $data['template_name'];
				$object->template_path = $data['template_path'];
				$object->file_attachment = $data['file_attachment'];
				$object->is_message_only = $data['is_message_only'];
				$object->is_gift_card = $data['is_gift_card'];
				$object->gift_cat_id = $data['gift_cat_id'];
				$object->selected_product_id = $data['selected_product_id'];
				$object->gift_price = str_replace(',', '', $data['gift_price']);
				$object->is_send_money = $data['is_send_money'];
				$object->is_give_stock = $data['is_give_stock'];
				$object->is_fiverr_service = $data['is_fiverr_service'];
				$object->is_tinggly_experiences = $data['is_tinggly_experiences'];
				$object->custom_gift_shipping_charges = $data['custom_gift_shipping_charges'];
				$object->tax_price = $data['tax_price'];
				$object->is_animated_card = $data['is_animated_card'];
				$object->animated_card_price = $data['animated_card_price'];
				if(isset($data['selected_country_to_deliver_gift'])){
					$object->selected_country_to_deliver_gift=$data['selected_country_to_deliver_gift'];
				} 
				if(isset($data['money_transfer_instrument'])){
					$object->money_transfer_instrument=$data['money_transfer_instrument'];
					} else {
					$object->money_transfer_instrument="";
				}
				if(isset($data['Bitcoin_summary'])){
					$object->Bitcoin_summary=$data['Bitcoin_summary'];
					} else {
					$object->Bitcoin_summary="";
				}
				if(isset($data['bitcoin_balance_redeemed_extra_charges'])){
					$object->bitcoin_balance_redeemed_extra_charges=$data['bitcoin_balance_redeemed_extra_charges'];
					} else {
					$object->bitcoin_balance_redeemed_extra_charges=0;
				}
				if(isset($data['saved_pay_type'])){
					$object->saved_pay_type=$data['saved_pay_type'];
					} else {
					$object->saved_pay_type= "credit card";
				}
				$gift_amount = $data['Amount'];
				$gift_amount = str_replace(',', '', $gift_amount);
				$object->amount = $gift_amount ;
				$object->gift_type = $data['gift_type'];
				$object->gift_redemption_code = $data['gift_redemption_code']; 
				$object->message_order_number = $data['message_order_number']; 
				$object->date_message_created = $data['date_message_created']; 
				$object->is_success = $data['is_success']; 
				$object->is_draft = 0; 

				if(isset($data['promo_id'])){
					$object->promo_id = $data['promo_id'];
					if($object->promo_id==2){
						$object->is_sent = 1;
						$object->is_message_only = 0;
						$object->gift_type = 'gift';
						$object->date_to_deliver_message = date('Y-m-d H:i:s');
					}
				}
				
				if( isset( $data['full_name'] ) ){
					$object->credit_card_full_name = $data['full_name']; 
					$object->credit_card_billing_address = $data['billing_address']; 
					$object->credit_card_billing_address2 = $data['billing_address2']; 
					$object->credit_card_city = $data['city']; 
					$object->credit_card_state = $data['state']; 
					$object->credit_card_postal_code = $data['zipcode'];
					$object->credit_card_country= $data['country']; 
					$object->credit_card_number = $data['card_number'];
					$object->credit_card_expiration_month = $data['expiration_month'];
					$object->credit_card_expiration_year = $data['expiration_year'];
				}
				
				$object->json_data = $data['json_data']; 
				if(isset($data['payment_complete']) && $data['payment_complete']){
					$object->payment_complete = 1;
				}
				if(isset($data['id'])){
					$object->previous_version_message_id = $data['id'];
				}
				$isNotify = $this->isMessageUpdates($user_id);
				if($isNotify){
					$object->send_sender_status_updates = 1;
				}
				JFactory::getDbo()->insertObject('#__sil_message', $object);
				return $db->insertid();
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		
		/*************************
			Function: used to  save massage as draft 
			if message drafting is successfull than
			templates and attachments will uploaded 
			on amazon cloud
		**************************/
		public function saveAsDraft($data)
		{
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->sender_name = $data['sender_name'];
				if($user->id>0){
					$object->sender_email = $user->email; 
					} else {
					$object->sender_email = $data['sender_email'];
				}
				$object->recipient_name = $data['recipient_name'];
				$object->recipient_email = $data['recipient_email'];
				$object->occasion = $data['occassion'];
				$object->recipient_relationship = $data['recipient_relationship'];
				$originalDate = $data['date_to_deliver_message'];
				$object->message_subject = $data['message_subject'];
				$object->message_content = $data['message_content'];
				$object->template_name = $data['template_name'];
				$object->template_path = $data['template_path'];
				$object->file_attachment = $data['file_attachment'];
				$object->is_message_only = $data['is_message_only'];
				$object->is_gift_card = $data['is_gift_card'];
				$object->gift_cat_id = $data['gift_cat_id'];
				$object->selected_product_id = $data['selected_product_id'];
				$object->gift_price = str_replace(',', '', $data['gift_price']);
				$object->is_send_money = $data['is_send_money'];
				$object->is_give_stock = $data['is_give_stock'];
				$object->is_fiverr_service = $data['is_fiverr_service'];
				$object->is_tinggly_experiences = $data['is_tinggly_experiences'];
				$object->custom_gift_shipping_charges = $data['custom_gift_shipping_charges'];
				$object->tax_price = $data['tax_price'];
				
				$newDate = date("Y-m-d", strtotime($originalDate));
				$object->date_to_deliver_message = $newDate." 00:00:00";
				if(isset($data['selected_country_to_deliver_gift'])){
					$object->selected_country_to_deliver_gift = $data['selected_country_to_deliver_gift'];
				} 
				if(isset($data['money_transfer_instrument'])){
					$object->money_transfer_instrument = $data['money_transfer_instrument'];
					} else {
					$object->money_transfer_instrument = "";
				}
				if(isset($data['Bitcoin_summary'])){
					$object->Bitcoin_summary = $data['Bitcoin_summary'];
					} else {
					$object->Bitcoin_summary = "";
				}
				$object->amount = str_replace(',', '',$data['Amount']);
				$object->gift_type = $data['gift_type'];
				$object->gift_redemption_code = $data['gift_redemption_code']; 
				$object->message_order_number = $data['message_order_number']; 
				$object->date_message_created = $data['date_message_created']; 
				$object->is_draft = $data['is_draft']; 
				$isNotify = $this->isMessageUpdates($user->id);
				if($isNotify){
					$object->send_sender_status_updates=1;
				}
				$object->json_data = $data['json_data']; 
				if(isset($data['payment_complete']) && $data['payment_complete']){
					$object->payment_complete = 1;
				}
				if(isset($data['id'])){
					$object->previous_version_message_id=$data['id'];
				}
				if(isset($data['msgId'])){
					$object->id = $data['msgId'];
					JFactory::getDbo()->updateObject('#__sil_message', $object, 'id');
				}
				else{
					JFactory::getDbo()->insertObject('#__sil_message', $object);
					return $db->insertid();
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
			}        
		}
		public function getCustId($uid){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  " SELECT * FROM sl_sil_processor_payment_profiles where user_id=$uid";
			
			$db->setQuery($query);
			$db->query();
			$num_rows = $db->getNumRows();
			if($num_rows>0){
				$data = $db->loadObjectList();
				return $data;
				}else{
				return "no";
			}
		}
		
		/*********
			Function : Used to get saved credit card data by card id
		**********/
		public function getCustIdByProfileId($pid){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  " SELECT * FROM sl_sil_processor_payment_profiles where id=$pid";
			
			$db->setQuery($query);
			$db->query();
			$num_rows = $db->getNumRows();
			if($num_rows>0){
				$data = $db->loadObjectList();
				return $data;
				}else{
				return "no";
			}
		}
		
		/***********************
			Funtion : used to save credit card
			information for further use
		**********************/
		public function saveCreditCardInfo($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				
				$object->user_id = $user->id;
				$object->processor_customer_name = $data['full_name'];
				$object->processor_cust_id = $data['processor_cust_id'];
				$object->processor_profile_id = $data['processor_profile_id'];
				$object->processor_shipping_id = $data['shippingId'];
				$object->processor_last_four_card_digits = $data['processor_last_four_card_digits'];
				$object->processor_card_type = $data['cardType'];
				$object->processor_customer_billing_address = $data['billing_address'];
				$object->processor_customer_billing_address_second = $data['billing_address2'];
				$object->processor_customer_city = $data['city'];
				$object->processor_customer_state = $data['state'];
				$object->processor_customer_zipcode = $data['zipcode'];
				$object->processor_customer_country = $data['country'];
				$object->processor_expiration_month = $data['expiration_month'];
				$object->processor_expiration_year = $data['expiration_year'];
				if(!isset ($data['card_id']) || $data['card_id'] == 0 ){
					JFactory::getDbo()->insertObject('#__sil_processor_payment_profiles', $object);
					return $db->insertid();
				} else {
					$object->id = $data['card_id'];
					JFactory::getDbo()->updateObject('#__sil_processor_payment_profiles', $object,'id');
					return $data['card_id'];
				}
				
				}catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		
		/***********************
			Funtion : used to save shipping methods
			information for further use
		**********************/
		public function saveShippingMethodsInfo($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->id = $data['id'];
				$object->user_id = $user->id;
				$object->shipping_address_holder_name = $user->name;
				$object->shipping_address = $data['shipping_address'];
				$object->shipping_address_second = $data['shipping_address_second'];
				$object->shipping_city = $data['shipping_city'];
				$object->shipping_state = $data['shipping_state'];
				$object->shipping_postal_code = $data['shipping_postal_code'];
				$object->shipping_country = $data['shipping_country'];
				$object->is_preferred_address = $data['is_preferred_address'];
				
				if( $data['id'] == 0 ){
					JFactory::getDbo()->insertObject('#__sil_shipping_profile', $object);
					return $db->insertid();
					} else {
					JFactory::getDbo()->updateObject('#__sil_shipping_profile', $object, 'id');
					return $data['id'];
				}
				}catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
			}
		}
		
		/***********************
			Funtion : used to save or update
			the contacts
		**********************/
		public function saveContact($data)
		{	
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				
				$object->user_id = $user->id;
				$object->first_name = $data['contact_name'];
				$object->email = $data['contact_email'];
				$object->relation = $data['contact_relation'];
				if($data['type'] == 'contact') {
					$object->is_contact = 1;
				}
				if( $data['id'] == 0 ){
					JFactory::getDbo()->insertObject('#__sil_address_book', $object);
					return $db->insertid();
					} else {
					$object->id = $data['id'];
					JFactory::getDbo()->updateObject('#__sil_address_book', $object, 'id');
					return $data['id'];
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		
		/***********************
			Funtion : used to save or update
			the dates
		**********************/
		public function saveEventDates($data)
		{	
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->contact_id = $data['contact_id'];
				$object->occasion = $data['occasion'];
				if(isset($data['event_date'])){
					$newDate = date("Y-m-d", strtotime($data['event_date']));
					$object->event_date = $newDate." 00:00:00";
				}
				$object->is_recurrence = $data['is_recurrence'];
				if( $data['id'] == 0 ){
						if($data['type'] == 'contact'){
							if(is_array($data['contact_dates']) && !empty($data['contact_dates'])){
								foreach($data['contact_dates'] as $date){
									if($date != ''){
										$newDate = date("Y-m-d", strtotime($date));
										$object->event_date = $newDate." 00:00:00";
										$data['event_date'] = $date; 
										JFactory::getDbo()->insertObject('#__sil_address_book_event', $object);
									}
								}
							}
						}else{
							JFactory::getDbo()->insertObject('#__sil_address_book_event', $object);
							return $db->insertid();
						}
				} else {
					if($data['type'] == 'contact'){
						$query = "DELETE from sl_sil_address_book_event where contact_id=".$data['contact_id']." AND occasion = ''";
						$db->setQuery($query);
						$db->execute();
						if(is_array($data['contact_dates']) && !empty($data['contact_dates'])){
							foreach($data['contact_dates'] as $date){
								if($date != ''){
									$newDate = date("Y-m-d", strtotime($date));
									$object->event_date = $newDate." 00:00:00";
									$data['event_date'] = $date; 
									JFactory::getDbo()->insertObject('#__sil_address_book_event', $object);
								}
							}
						}
						return $db->insertid();
					}else{
						$object->id = $data['id'];
						JFactory::getDbo()->updateObject('#__sil_address_book_event', $object, 'contact_id');
						return $data['id'];
					}
					
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		
		
		public function saveCCPayPal($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->paypal_id=$data['paypal_id'];
				$query  =  " SELECT * FROM sl_sil_processor_payment_profiles where user_id=$user->id and paypal_id!=''";
				
				$db->setQuery($query);
				$db->query();
				$num_rows = $db->getNumRows();
				if($num_rows>0){
					$records = $db->loadObjectList();
					$object->id=$records[0]->id;
					if (! JFactory::getDbo()->updateObject('#__sil_processor_payment_profiles', $object, 'id')) {
						
						echo "error"; die;
						} else {
						return true;
					}
					}else{
					
					JFactory::getDbo()->insertObject('#__sil_processor_payment_profiles', $object);
					return $db->insertid();
				}
				}catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		public function updateBasicMessageTemplate($data)
		{
			
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->message_subject=$data['message_subject'];
				$object->message_content=$data['customMessage'];
				$object->template_name=$data['imageName'];
				$object->template_path=$data['templatePath'];
				$object->file_attachment=$data['file_attachment'];
				
				
				//$object->date_to_deliver_message=$data['date_to_deliver_message'];
				
				$object->id=$data['msg_id'];
				if($user->id>0){
					$object->sender_email=$user->email; 
					}else{
					$object->sender_email=$data['sender_email'];
				}
				
				$object->json_data=$data['json_data']; 
				$isNotify=$this->isMessageUpdates($user->id);
				if($isNotify){
					$object->send_sender_status_updates=1;
				}
				if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
					echo "error"; 
					} else {
					
					return true;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		public function confirmPaypalPayment($messageId)
		{
			
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$query="select * from sl_sil_message where id=$messageId";
				$db->setQuery($query);
				$db->query();
				$num_rows = $db->getNumRows();
				if($num_rows>0){
					$data = $db->loadObjectList();
					
					if($data[0]->previous_version_message_id>0){
						
						
						$usrMsgUpdatePayment="update sl_sil_message set is_deleted=1 where id=".$data[0]->previous_version_message_id;
						$db->setQuery($usrMsgUpdatePayment);
						$db->query();
					}
				}
				$object->is_success=1;
				$object->is_draft=0;
				$object->id=$messageId;
				
				if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
					
					echo "error"; 
					} else {
					return true;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		public function updateBasicMessage($data)
		{
			
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->sender_name=$data['sender_name'];
				if($user->id>0){
					$object->sender_email=$user->email; 
					
					}else{
					$object->sender_email=$data['sender_email'];
				}
				$object->recipient_name=$data['recipient_name'];
				$object->recipient_email=$data['recipient_email'];
				$object->occasion=$data['occassion'];
				$object->recipient_relationship=$data['recipient_relationship'];
				$originalDate = $data['date_to_deliver_message'];
				$newDate = date("Y-m-d", strtotime($originalDate));
				
				
				$object->date_to_deliver_message=$newDate." 00:00:00";
				$object->id=$data['msg_id'];
				//$object->sender_email=$user->email;
				
				$object->json_data=$data['json_data']; 
				
				$isNotify=$this->isMessageUpdates($user->id);
				if($isNotify){
					$object->send_sender_status_updates=1;
				}
				if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
					echo "error"; 
					} else {
					return true;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}        
		}
		public function changeStatus($msgId){
			
			$db = JFactory::getDbo();
			$object = new stdClass();
			$object->payment_complete=1; 
			$object->is_success=1;
			$object->id=$msgId;
			
			
			if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
				
				echo "error"; 
				} else {
				
				return true;
			}
		}
		
		public function changeisDeleted($id){
			$db = JFactory::getDbo();
			$object = new stdClass();
			$object->is_deleted=1; 
			$object->is_success=0;
			$object->id=$id;
			
			if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
				echo "error"; 
				} else {
				return true;
			}
		}
		
		public function updateMessage($data,$recordId){
			
			$db = JFactory::getDbo();
			$object = new stdClass();
			$user = JFactory::getUser();
			$object->user_id = $user->id;
			
			$object->credit_card_billing_address=$data['billing_address']; 
			$object->credit_card_billing_address2=$data['billing_address2']; 
			$object->credit_card_billing_city=$data['city']; 
			$object->credit_card_billing_state=$data['state']; 
			$object->credit_card_phone_number=$data['zipcode'];
			$object->credit_card_billing_country=$data['country'];
			
			$object->payment_complete=1; 
			if($user->id>0){
				$object->sender_email=$user->email; 
			}
			else{
				$object->sender_email=$data['sender_email']; 
			}
			
			$object->id=$recordId;
			$isNotify=$this->isMessageUpdates($user->id);
			if($isNotify){
				$object->send_sender_status_updates=1;
			}
			try{
				if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
					echo "error"; 
					} else {
					return true;
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		/*****************
			Function: Used to update message after gift deletion
		******************/
		public function updateMessageAfterDelete($recordId){
			$db = JFactory::getDbo();
			$object = new stdClass();
			$user = JFactory::getUser();
			$object->user_id = $user->id;
			$object->is_message_only = 1;
			$object->is_gift_card = 0;
			$object->gift_cat_id = 0;
			$object->gift_price = 0;
			$object->selected_product_id = 0;
			$object->custom_gift_shipping_charges = 0;
			$object->tax_price = 0;
			$object->is_sent = 0;
			$object->is_send_money = 0;
			$object->is_give_stock = 0;
			$object->is_fiverr_service = 0;
			$object->amount = 0; 
			$object->gift_type = "msg"; 
			$object->payment_complete = 1; 
			$object->id = $recordId;
			
			$isNotify = $this->isMessageUpdates($user->id);
			if($isNotify){
				$object->send_sender_status_updates = 1;
			}
			if (! JFactory::getDbo()->updateObject('#__sil_message', $object, 'id')) {
				echo "error"; 
				} else {
				return true;
			}
		}
		public function saveMoneyClaim($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
			//	$objMsg = new stdClass();
				$object->message_id=$data['msg_id'];
				$object->amount=$data['amount'];
				$object->recipient_name=$data['name'];
				$object->recipient_email_address=$data['emailAddress'];
				if($data['Data']['ShippingMoneyInfo'][0]['new_gift_type']=="visa" || $data['Data']['ShippingMoneyInfo'][0]['new_gift_type']=="check")
				{
					//$object->recipient_last_name=$data['shipLastName'];
					$object->recipient_address_1=$data['billing1'];
					$object->recipient_address_2=$data['billing2'];
					$object->recipient_city=$data['city'];
					$object->recipient_state=$data['state'];
					$object->recipient_postal_code=$data['zip'];
					$object->recipient_phone=$data['phoneNumber'];
					$object->country_address=$data['shipCountry'];
				}
				$object->is_redeemed=1;
				$object->redemption_date=date("Y-m-d");
				if($db->insertObject('#__sil_money_redemption', $object))
				{
					/* $objMsg->id=$data['msg_id'];
					$objMsg->is_redeemed=1;
					$object->redemption_status = 2;
					JFactory::getDbo()->updateObject('#__sil_message', $objMsg, 'id'); */
					return true;
				} else {
					return false;
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		//function to save ship order deatils for hikashop products
		public function saveOrder($data){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$order = new stdClass();
				$orderProduct = new stdClass();
				$msgId=$data['msg_id'];
				$user = JFactory::getUser();
				
				$productId=$data['product_id'];
				$qry="select * from sl_sil_message where id=$msgId";
				$db->setQuery($qry);
				
				$msgData = $db->loadObjectList();
				$query="select * from sl_hikashop_product where product_id=$productId";
				$db->setQuery($query);
				$productData = $db->loadObjectList();
				$user_id=$msgData[0]->user_id;
				if(isset($data['isUserRedistered']) && $data['isUserRedistered']==1){
					$user_id = JFactory::getUser($data['user_id']);
				}
				$object->address_user_id = $user_id;
				$object->address_firstname = $data['sender_name'];
				$object->address_title = $data['sender_email'];
				
				if($data['new_gift_type'] == 'gift'){
					$object->address_lastname=$data['shipLastName'];
					$object->address_street=$data['shipAddr'];
					$object->address_street2=$data['shipAddr2'];
					$object->address_post_code=$data['shipZip'];
					$object->address_city=$data['shipCity'];
					$object->address_telephone=$data['shipPhone'];
					$object->address_state=$data['shipState'];
					$object->address_country=$data['shipCountry'];
				}
				if( JFactory::getDbo()->insertObject('#__hikashop_address', $object) ){
					$shippingAddrId = $db->insertid();
					
					$order->order_billing_address_id = $shippingAddrId;
					if($data['new_gift_type'] != 'card'){
						$order->order_shipping_address_id = $shippingAddrId;
					}
					$order->order_user_id=$user_id;
					$order->order_status="created";
					$order->order_number=$msgId;
					$order->order_created=time();
					$order->order_full_price=$data['productPrice'];
					$order->order_payment_method="";
					if(isset($data['order_invoice_number'])){
						$order->order_invoice_number=$data['order_invoice_number'];
					}
					
					if(JFactory::getDbo()->insertObject('#__hikashop_order', $order)){
						$orderId=$db->insertid();
						$orderProduct->order_id=$orderId;
						$orderProduct->product_id=$data['product_id'];
						$orderProduct->order_product_quantity=1;
						$orderProduct->order_product_name=$productData[0]->product_name;
						$orderProduct->order_product_code=$productData[0]->product_code;
						$orderProduct->order_product_price=$data['productPrice'];
						if( JFactory::getDbo()->insertObject('#__hikashop_order_product', $orderProduct)){
							return true;
						}  
					}
				} else {
					return false;
				}
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		public function savePaymentDetailsIpn($data)
		{
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				
				$object->user_id = $data['userId'];
				$object->message_id=$data['message_id'];
				$object->processor_response_code=$data['processor_response_code'];
				$object->processor_response_reason_code=$data['processor_response_reason_code'];
				$object->processor_response_reason_text=$data['processor_response_reason_text'];
				$object->processor_auth_code=$data['authorization_code'];
				$object->processor_invoice_number=$data['processor_invoice_number'];
				$object->paypal_transaction_id=$data['paypal_transaction_id'];
				$object->paypal_type=$data['Paytype'];
				$object->transaction_date_time= date("Y-m-d h:i:s");
				JFactory::getDbo()->insertObject('#__sil_message_orders', $object);
				return true;
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		/****************
			Function: used to save payment details
			of shceduled message
		****************/
		public function savePaymentDetails($data , $msgId)
		{
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				
				$object->user_id = $user->id;
				$object->message_id = $msgId;
				$object->processor_response_code = $data['processor_response_code'];
				$object->processor_response_reason_code = $data['processor_response_reason_code'];
				$object->processor_response_reason_text = $data['processor_response_reason_text'];
				$object->processor_auth_code = $data['authorization_code'];
				$object->processor_invoice_number = $data['processor_invoice_number'];
				$object->paypal_transaction_id = $data['paypal_transaction_id'];
				if( isset($data['card_number']) && ctype_digit($data['card_number']))  {
					$account_number = str_repeat("x", (strlen($data['card_number']) - 4)) . substr($data['card_number'],-4,4); 
					$accountNumber =  rtrim(chunk_split($account_number, 4, '-'), "-");
					} else {
					if(isset($data['card_number'])) {
						$accountNumber = $data['card_number'];
						} else {
						$accountNumber = $data['credit_card_account_number'];
					}
				}
				$object->credit_card_account_number = $accountNumber;
				if(isset($data['animated_card_price']) && $data['animated_card_price'] > 0  && $data['animated_card_price'] != ''){
					$object->amount = str_replace(',', '', $data['gift_price']+$data['animated_card_price']);
				} else {
					$object->amount = str_replace(',', '', $data['gift_price']);
				}
				$object->payment_method = $data['method'];
				$object->transaction_type = $data['transaction_type'];
				$object->credit_card_type = $data['cardType'];
				$object->paypal_type = "";
				$object->transaction_date_time = date("Y-m-d h:i:s");
				JFactory::getDbo()->insertObject('#__sil_message_orders', $object);
				return true;
			}
			catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;
			}
		}
		
		/*****************
			Functino: Used to get basic inforamtion
			about message and selected gift
		*****************/
		public function getBasicMessage($msgId){
			$db = JFactory::getDbo();
			$user = JFactory::getUser();
			$query = $db->getQuery(true);
			$query  =  " SELECT * FROM sl_sil_message where id=$msgId  AND user_id=$user->id";
			
			$db->setQuery($query);
			
			$data = $db->loadObjectList();
			return $data;
			
		}
		/**** ends here ****/
		
		public function getTemplateHtml(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "SELECT introtext FROM sl_content WHERE alias = 'message-preview-template'";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$content=$data[0]->introtext;
			return $content;
		}
		
		/*****************
			Function USed to get all the saved credit cards 
			matched with the given user id
		*****************/
		public function getSavedCreditCardData($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "SELECT * FROM sl_sil_processor_payment_profiles where user_id=$userId";
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data;
		}
		
		/*****************
			Function USed to get all the saved shiiping
			methods matched with the logged in user id
		*****************/
		public function getSavedShippingData($type, $id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();
			
			if($type == 'userId') {
				$query  =  "SELECT * FROM sl_sil_shipping_profile where user_id=$id";
				} else {
				$userId = $user->id;
				$query  =  "SELECT * FROM sl_sil_shipping_profile where user_id=$userId AND id=$id ";
			}
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data;
		}
		
		/*****************
			Function USed to get all the saved shiiping
			methods matched with the logged in user id
		*****************/
		public function getSavedContacts($type, $id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();
			
			if($type == 'userId') {
				$query  =  "SELECT * FROM sl_sil_address_book where user_id=$id AND is_contact=1";
				} else {
				$userId = $user->id;
				$query  =  "SELECT * FROM sl_sil_address_book where user_id=$userId AND id=$id  AND is_contact=1";
				
			}
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			if(!empty($data)){
				$contact_id = $data[0]->id;
				$query  =  "SELECT event_date FROM sl_sil_address_book_event where contact_id=$contact_id";
				$db->setQuery($query);
				$eventData = $db->loadObjectList();
				if(!empty($eventData)){
					foreach($eventData as $date){
						$data[0]->dates[] = date( 'M d, Y',strtotime($date->event_date));
					}
				}
			}
			return $data;
		}
		
		/*****************
			Function USed to get all the saved shiiping
			methods matched with the logged in user id
		*****************/
		public function getSavedEvents($type, $id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();
			$userId = $user->id;
			
			if($type == 'userId') {
				$query  =  "select sl_sil_address_book.*, sl_sil_address_book_event.* from sl_sil_address_book left join sl_sil_address_book_event on sl_sil_address_book_event.contact_id=sl_sil_address_book.id where sl_sil_address_book.user_id=$userId and sl_sil_address_book.is_contact=0";
				} else {				
				$query  =  "select sl_sil_address_book.*, sl_sil_address_book_event.* from sl_sil_address_book left join sl_sil_address_book_event on sl_sil_address_book_event.contact_id=sl_sil_address_book.id where sl_sil_address_book.id=$id and sl_sil_address_book.user_id=$userId and sl_sil_address_book.is_contact=0";
			}
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			foreach($data as $event){
				$data[0]->event_date = date( 'M d, Y',strtotime($event->event_date)); 
			}
			return $data;
		}
		public function getFilteredProducts($search, $filters, $sort, $start=0){
			$db = JFactory::getDbo();
			$search = $db->escape($search);

			$giftDisplayOrder = GIFT_DISPLAY_ORDER;

			$condition="";
			$setValue=false;
			if(isset($search) && $search!=""){
				$condition .=" (products.product_name LIKE '%".$search."%' ";
				$setValue=true;
				$condition .=" OR  MATCH (products.product_description) AGAINST ('$search' IN NATURAL LANGUAGE MODE) ";
				$condition .=" OR (sl_tags.title LIKE '%".$search."%' ";
				$condition .=" AND sl_contentitem_tag_map.type_alias='com_hikashop.product'))";
			}

			$categoryList = '';
			$brandList = '';
			$priceCondition = '';
			$cats_id=array();
			if(isset($filters)&&is_array($filters)){
				foreach($filters as $key => $filter){
					if($filter['type']=='category'){
						$cat_id = $db->escape($filter['id']);
						if($categoryList==''){
							$categoryList = "$cat_id";
						}
						else{
							$categoryList .= ", $cat_id";
						}

						$cats_id[] = $db->escape($filter['id']);
					}
					else if($filter['type']=='brand'){
						$brand_id = $db->escape($filter['id']);
						if($brandList==''){
							$brandList = "$brand_id";
						}
						else{
							$brandList .= ", $brand_id";
						}
					}
					else if($filter['type']=='price'){
						$low_price = $db->escape($filter['low']);
						$high_price = $db->escape($filter['high']);
						$priceCondition = " sl_hikashop_price.price_value >= $low_price AND sl_hikashop_price.price_value < $high_price ";
					}
				}
				if($categoryList!='')
				{
					

					if($condition=='')
					{
						$condition = " sl_hikashop_category.category_id IN($categoryList) ";
					}
					else{
						$condition .= " AND sl_hikashop_category.category_id IN($categoryList) ";
					}
				}
				if($brandList!=''){
					if($condition==''){
						$condition = " products.product_manufacturer_id IN($brandList) ";
					}
					else{
						$condition .= " AND products.product_manufacturer_id IN($brandList) ";
					}
				}

				if($priceCondition!=''){
					if($condition==''){
						$condition = $priceCondition;
					}
					else{
						$condition .= " AND $priceCondition ";
					}
				}
			}

			$orderBy = "";
			if($sort=='relevance'&&$giftDisplayOrder=='RAND()'){
				if(!isset($_SESSION))
					session_start();
				if(!isset($_SESSION['random_gift_seed']))
					$_SESSION['random_gift_seed'] = rand(0,100);
				$giftDisplayOrder = 'RAND('.$_SESSION['random_gift_seed'].')';
				$orderBy = $giftDisplayOrder;
			}
			else if($sort=='relevance'){
				$orderBy = $giftDisplayOrder;
			}
			else if($sort=='low_to_high'){
				$orderBy = "sl_hikashop_price.price_value ASC";
			}
			else if($sort=='high_to_low'){
				$orderBy = "sl_hikashop_price.price_value DESC";
			}

			if($categoryList != ''){
				$catJoin = '';
				$i = 0;
				$catArray = explode(', ', $categoryList);
				foreach($catArray as $cat){ $i++;
					if($catJoin==''){
						$catJoin = " INNER JOIN sl_hikashop_product_category as c1 ON (c1.product_id = products.product_id AND c1.category_id = $cat)";
					}
					else{
						$catJoin .= " OR (c1.product_id = products.product_id AND c1.category_id = $cat)";
					}
				}
				if($catJoin != ''){
					$catJoin .= " LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = c1.category_id";
				}
				$setValue=true;
			}else{
				$productParentCategoryID = PRODUCT_PARENT_CATEGORY;
				$catJoin = " INNER JOIN sl_hikashop_product_category AS c1 ON c1.category_id = $productParentCategoryID AND c1.product_id = products.product_id
				LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = c1.category_id ";
				// $categoriesList=$this->getProductCategories($productParentCategoryID);
				// $i=0;
				// foreach($categoriesList as $value) {
				// 	if($value[4] == '' && $value[2] == '' && $value[0] != ''){
				// 		$productCategoryArray[]=$value[0];
				// 	}else if($value[4] == '' && $value[2] != '' && $value[0] != ''){
				// 		$productCategoryArray[]=$value[2];
				// 		$productCategoryArray[]=$value[0];
				// 	}else{
				// 		$productCategoryArray[]=$value[4];	
				// 		$productCategoryArray[]=$value[0];	
				// 	}
				// 	$i++;
				// }
				// $categoryIdList = implode(', ', array_unique($productCategoryArray));
				// if($condition != '')
				// 	$condition .=" AND sl_hikashop_category.category_id IN($categoryIdList) ";
				// else
				// 	$condition .=" sl_hikashop_category.category_id IN($categoryIdList) ";
			}
			if(count($cats_id)>0)
			{
				$sql_cat="SELECT * FROM `sl_hikashop_product_category` WHERE category_id IN (".implode(",",$cats_id).") GROUP BY product_id HAVING count( product_id ) =".count($cats_id);
				$db->setQuery($sql_cat);
				$resCat=$db->loadObjectList();
				$product_ids=array();
				for($j=0;$j<count($resCat);$j++)
				{
					$product_ids[]=$resCat[$j]->product_id;
				}
				if(count($product_ids)>0)
				{
					$products_Ids=implode(",",$product_ids);
					if($condition=='')
					{
						$condition = " products.product_id IN($products_Ids) ";
					}
					else
					{
						$condition .= " AND products.product_id IN($products_Ids) ";
					}
				}
				else
				{
					if($condition=='')
					{
						$condition = " products.product_id IN('') ";
					}
					else
					{
						$condition .= " AND products.product_id IN('') ";
					}
				}
			}

			if($condition != '')
				$condition .=" AND sl_hikashop_category.category_published = 1 AND products.product_published = 1 ";
			else
				$condition .=" sl_hikashop_category.category_published = 1 AND products.product_published = 1 ";

			$limit = "LIMIT $start,".REDEEM_GIFT_RECORD_PER_PAGE;
			//$limit = "";
			$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * ,sl_contentitem_tag_map.*,sl_tags.*, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs, manufacturer_category.category_name as manufacturer
			FROM sl_hikashop_product AS products
			LEFT JOIN sl_hikashop_category AS manufacturer_category ON products.product_manufacturer_id = manufacturer_category.category_id
			LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			$catJoin
			LEFT JOIN sl_contentitem_tag_map ON sl_contentitem_tag_map.content_item_id  = products.product_id
			LEFT JOIN sl_tags ON sl_tags.id  = sl_contentitem_tag_map.tag_id
			WHERE $condition GROUP BY products.product_id ORDER BY $orderBy $limit";
			// $productTotalQry ="SELECT COUNT(DISTINCT products.product_id) as total
			// FROM sl_hikashop_product AS products
			// LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			// LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			// $catJoin
			// LEFT JOIN sl_contentitem_tag_map ON sl_contentitem_tag_map.content_item_id  = products.product_id
			// LEFT JOIN sl_tags ON sl_tags.id  = sl_contentitem_tag_map.tag_id
			// WHERE $condition";
			$db->setQuery($productQry);
			$prodData = $db->loadObjectList();
			// $db->setQuery($productTotalQry);
			// $totalProdData = $db->loadObjectList();
			$finalData=array();
			$i=0;
			
			foreach($prodData as $product=>$data){
				/*$parentCategory = $this->getParentCategory($data->category_id);
				$productType = '';
				if(GIFT_CARD_CATEGORY_ID ==  $parentCategory){
					$productType = 'giftCard';
				}elseif(TINGGLY_EXPERIENCES_ID == $parentCategory){
					$productType = 'tinggly';
				}elseif(PRODUCT_PARENT_CATEGORY == $parentCategory){
					$productType = 'physicalGift';
				}elseif(GIVE_STOCK_CATEGORY_ID == $parentCategory){
					$productType = 'stock';
				}elseif(FIVER_CATEGORY_ID == $parentCategory){
					$productType = 'fiver';
				}*/
				if($data->manufacturer==null)
					$data->manufacturer = '';

				$productType = 'physicalGift';
				$finalData[$i]['manufacturer']=$data->manufacturer;
				$finalData[$i]['product_likes']=$data->product_likes;
				$finalData[$i]['product_discount']=$data->product_discount;
				$finalData[$i]['product_name']=$data->product_name;
				$finalData[$i]['product_id']=$data->product_id;
				$finalData[$i]['image']=$data->file_path;  
				$finalData[$i]['category_id']=$data->category_id;
				$finalData[$i]['CatValue']=$data->price_value;  
				$finalData[$i]['product_description']=$data->product_description;  
				$finalData[$i]['brand']=$data->category_name;  
				$finalData[$i]['selectedCatIDs']=$data->selectedCatIDs;  
				$finalData[$i]['productType']=$productType;  
				$i++;
			}
			return array(
				'data'	=>	$finalData,
				'count'	=>	1
				// 'count'	=>	$totalProdData[0]->total
			);
		}
		/********* function used to delete the events ********/
		public function deleteEvents($contactID){
			$db = JFactory::getDbo();
			$object = new stdClass();
			$user = JFactory::getUser();
			$query  =  " delete FROM sl_sil_address_book_event where contact_id= $contactID and user_id=$user->id";
			$db->setQuery($query);
			$db->query();
			return true;
		}
		
		public function getCardDetailById($profileId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  " SELECT * FROM sl_sil_processor_payment_profiles where id=$profileId";
			
			$db->setQuery($query);
			
			$data = $db->loadObjectList();
			foreach ($data as $key => $cardData) {
				if($cardData->processor_card_type == 'amex') {
					$amexNumbers = explode('-',$cardData->processor_last_four_card_digits);
					$data[$key]->processor_last_four_card_digits = 'xxxx-xxxx-xxxx-'.$amexNumbers[3];
				}
			}
			return $data;
		}
		
		/*********************
			Function used to get product categories according to their parent category.
			$productParentCategory = Parent_Category_ID
		**********************/
		public function getProductCategories($productParentCategory){
			$sortOrder = SORT_ORDER_CATEGORY;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);


			
			if($productParentCategory==10)
			{
				$orderBy=' ORDER BY c2.category_name ASC';
			}
			else
			{
				$orderBy=' ORDER BY (c2.category_id*1) '.$sortOrder;
			}
			$query  =  " SELECT c1.category_id as 'parent_category_id', c1.category_name as 'parent_category_name', c2.category_id, c2.category_name, c3.category_id as 'child_category_id', c3.category_name as 'child_category_id' FROM sl_hikashop_category c1 LEFT JOIN sl_hikashop_category c2 ON c2.category_parent_id = c1.category_id LEFT JOIN sl_hikashop_category c3 ON c3.category_parent_id = c2.category_id WHERE c1.category_id = ".$productParentCategory." AND (c1.category_published = 1 OR c1.category_published IS NULL) AND (c2.category_published = 1 OR c2.category_published IS NULL )AND (c3.category_published = 1 OR c3.category_published IS NULL) ".$orderBy;
			$db->setQuery($query);
			$categories = $db->loadRowList();
			return $categories;
			
		}//End Function 
		
		
		public function getGiftCategories(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  ' SELECT * FROM sl_hikashop_category where category_parent_id=14';
			
			$db->setQuery($query);
			
			$categories = $db->loadRowList();
			return $categories;
			
		}//End Function 
		
		
		public function getSearchProducts($search, $giftDisplayOrder=""){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$searchText=$search['text'];
			$cats = array($search['parentCat'],$search['subCat']);
			$cats = array_filter($cats);
			$cats = implode(',',$cats);
			$cats = explode(',',$cats);
			$catArray =  array_filter($cats);
			$cats =  implode(',',$catArray);

			if($giftDisplayOrder=='RAND()'){
				if(!isset($_SESSION))
					session_start();
				if(!isset($_SESSION['random_gift_seed']))
					$_SESSION['random_gift_seed'] = rand(0,100);
				$giftDisplayOrder = 'RAND('.$_SESSION['random_gift_seed'].')';
			}
			
			$condition="";
			$setValue=false;
			if(isset($search['text']) && $search['text']!=""){
				$condition .=" (products.product_name LIKE '%".$searchText."%' ";
				$setValue=true;
				$condition .=" OR  MATCH (products.product_description) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE) ";
				$condition .=" OR (sl_tags.title LIKE '%".$searchText."%' ";
				$condition .=" AND sl_contentitem_tag_map.type_alias='com_hikashop.product'))";
			}
			if($cats != ''){
				$catJoin = '';
				$i = 0;
				foreach($catArray as $cat){ $i++;
					$catJoin .= " INNER JOIN sl_hikashop_product_category as c$i ON (c$i.product_id = products.product_id AND c$i.category_id = $cat)";
				}
				if($catJoin != ''){
					$catJoin .= " LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = c1.category_id";
				}
				/*if($setValue)
					$condition .="  AND sl_hikashop_product_category.category_id IN ($cats)";
				else
					$condition .="   sl_hikashop_product_category.category_id IN ($cats)";*/
				$setValue=true;
			}else{
				$productParentCategoryID = PRODUCT_PARENT_CATEGORY;
				$catJoin = " INNER JOIN sl_hikashop_product_category AS c1 ON c1.category_id = $productParentCategoryID AND c1.product_id = products.product_id
				LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = c1.category_id ";
				// $categoriesList=$this->getProductCategories($productParentCategoryID);
				// $i=0;
				// foreach($categoriesList as $value) {
				// 	if($value[4] == '' && $value[2] == '' && $value[0] != ''){
				// 		$productCategoryArray[]=$value[0];
				// 	}else if($value[4] == '' && $value[2] != '' && $value[0] != ''){
				// 		$productCategoryArray[]=$value[2];
				// 		$productCategoryArray[]=$value[0];
				// 	}else{
				// 		$productCategoryArray[]=$value[4];	
				// 		$productCategoryArray[]=$value[0];	
				// 	}
				// 	$i++;
				// }
				// $categoryIdList = implode(', ', array_unique($productCategoryArray));
				// if($condition != '')
				// 	$condition .=" AND sl_hikashop_category.category_id IN($categoryIdList) ";
				// else
				// 	$condition .=" sl_hikashop_category.category_id IN($categoryIdList) ";
			}
			if($search['price'] != ''){
				$price = explode('-',$search['price']); 
				$min = trim($price[0]);
				$max = trim($price[1]);
				if($condition != ''){
					if($max == '1111')
						$condition .=" AND sl_hikashop_price.price_value >= $min";
					else	
						$condition .=" AND sl_hikashop_price.price_value >= $min AND sl_hikashop_price.price_value <= $max";
				}else{
					if($max == '1111')
						$condition .=" sl_hikashop_price.price_value >= $min";
					else	
						$condition .=" sl_hikashop_price.price_value >= $min AND sl_hikashop_price.price_value <= $max";
				}
			}
			if($condition != '')
				$condition .=" AND sl_hikashop_category.category_published = 1 AND products.product_published = 1 ";
			else
				$condition .=" sl_hikashop_category.category_published = 1 AND products.product_published = 1 ";
			$limit = "LIMIT 0,".REDEEM_GIFT_RECORD_PER_PAGE;
			//$limit = "";
			$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * ,sl_contentitem_tag_map.*,sl_tags.*, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs, manufacturer_category.category_name as manufacturer
			FROM sl_hikashop_product AS products
			LEFT JOIN sl_hikashop_category AS manufacturer_category ON products.product_manufacturer_id = manufacturer_category.category_id
			LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			$catJoin
			LEFT JOIN sl_contentitem_tag_map ON sl_contentitem_tag_map.content_item_id  = products.product_id
			LEFT JOIN sl_tags ON sl_tags.id  = sl_contentitem_tag_map.tag_id
			WHERE $condition GROUP BY products.product_id ORDER BY $giftDisplayOrder $limit";
			$productTotalQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * ,sl_contentitem_tag_map.*,sl_tags.*, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs
			FROM sl_hikashop_product AS products
			LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			$catJoin
			LEFT JOIN sl_contentitem_tag_map ON sl_contentitem_tag_map.content_item_id  = products.product_id
			LEFT JOIN sl_tags ON sl_tags.id  = sl_contentitem_tag_map.tag_id
			WHERE $condition GROUP BY products.product_id";
			$db->setQuery($productQry);
			$prodData = $db->loadObjectList();
			$db->setQuery($productTotalQry);
			$totalProdData = $db->loadObjectList();
			$finalData=array();
			$i=0;
			
			foreach($prodData as $product=>$data){
				/*$parentCategory = $this->getParentCategory($data->category_id);
				$productType = '';
				if(GIFT_CARD_CATEGORY_ID ==  $parentCategory){
					$productType = 'giftCard';
				}elseif(TINGGLY_EXPERIENCES_ID == $parentCategory){
					$productType = 'tinggly';
				}elseif(PRODUCT_PARENT_CATEGORY == $parentCategory){
					$productType = 'physicalGift';
				}elseif(GIVE_STOCK_CATEGORY_ID == $parentCategory){
					$productType = 'stock';
				}elseif(FIVER_CATEGORY_ID == $parentCategory){
					$productType = 'fiver';
				}*/
				if($data->manufacturer==null)
					$data->manufacturer = '';

				$productType = 'physicalGift';
				$finalData[$i]['manufacturer']=$data->manufacturer;
				$finalData[$i]['product_likes']=$data->product_likes;
				$finalData[$i]['product_name']=$data->product_name;
				$finalData[$i]['product_id']=$data->product_id;
				$finalData[$i]['image']=$data->file_path;  
				$finalData[$i]['category_id']=$data->category_id;
				$finalData[$i]['CatValue']=$data->price_value;  
				$finalData[$i]['product_description']=$data->product_description;  
				$finalData[$i]['brand']=$data->category_name;  
				$finalData[$i]['selectedCatIDs']=$data->selectedCatIDs;  
				$finalData[$i]['productType']=$productType;  
				$i++;
			}
			return array(
				'data'	=>	$finalData,
				'count'	=>	count($totalProdData)
			);
		}

		
		/******************
			Function: Used to get description
			of selected product search based on array of product ids
		*****************/
		public function getProductDetailByIds($prodid){
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$ids=implode(",",$prodid);
			$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * ,GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs
			FROM sl_hikashop_product AS products
			LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			LEFT JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = products.product_id
			LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product_category.category_id
			WHERE products.product_id IN($ids) GROUP BY products.product_id";
			
			$db->setQuery($productQry);
			$prodData = $db->loadObjectList();
			
			$finalData=array();
			$i=0;
			
			foreach($prodData as $product=>$data){
				$finalData[$i]['product_name']=$data->product_name;
				$finalData[$i]['product_id']=$data->product_id;
				$finalData[$i]['image']=$data->file_path;  
				$finalData[$i]['category_id']=$data->category_id;
				$finalData[$i]['CatValue']=$data->price_value;  
				$finalData[$i]['product_description']=$data->product_description;  
				$finalData[$i]['brand']=$data->category_name;  
				$finalData[$i]['category_parent_id']=$data->category_parent_id;  
				$finalData[$i]['selectedCatIDs']=$data->selectedCatIDs;  
				$i++;
			}
			return $finalData;
		}
		/******************
			Function: Used to get description
			of selected product
		*****************/
		public function getProductDetailById($catid,$prodid,$prodType=""){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * 
			FROM sl_hikashop_product AS products
			LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
			LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
			LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = products.product_manufacturer_id
			WHERE products.product_id=$prodid";
			
			$db->setQuery($productQry);
			$prodData = $db->loadObjectList();
			$finalData=array();
			$i=0;
			
			foreach($prodData as $product=>$data){
				$db->setQuery("SELECT category_name FROM sl_hikashop_category WHERE category_id='".$data->product_manufacturer_id."'");
				$manufacturer = $db->loadObjectList();
				if(is_array($manufacturer)&&count($manufacturer)>0){
					$finalData[$i]['manufacturer']=$manufacturer[0]->category_name;
				}
				else{
					$finalData[$i]['manufacturer']='';
				}
				$finalData[$i]['product_likes']=$data->product_likes;
				$finalData[$i]['product_name']=$data->product_name;
				$finalData[$i]['product_id']=$data->product_id;
				$finalData[$i]['image']=$data->file_path;  
				$finalData[$i]['category_id']=$catid;  
				//	if($taskName=="getmessage" || $taskName=="paymentReview"  )
				//{
					 $shipping=(float)$data->shipping;
					
					$flat_tax=(float)$data->flat_tax;
					$cc_processing=(float)$data->cc_processing;
					$cc_fraud=(float)$data->cc_fraud;
					$margin=(float)$data->margin;
					$product_msrp=(float)$data->product_msrp;

					$shipping_handlingTotal=$shipping+$flat_tax+$cc_processing+$cc_fraud;

					$ActualProductPrice=(($product_msrp*$margin)/100)+$product_msrp;

					$ActualTax=($product_msrp*$margin)/100;
					
					$ActualTotal=$ActualProductPrice+$shipping_handlingTotal;
					$finalData[$i]['CatValue']=$data->price_value+$shipping+$cc_processing+$cc_fraud;  
				/*}
				else
				{
					$finalData[$i]['CatValue']=$data->price_value;  
				}*/
				$finalData[$i]['CatValue1']=$data->price_value; 
				$finalData[$i]['product_description']=$data->product_description;  
				$finalData[$i]['brand']=$data->category_name; 
				if($prodType == 'tinggly'){
					$finalData[$i]['tinggly_essential_price']=$data->tinggly_essential_price; 
					$finalData[$i]['tinggly_premium_price']=$data->tinggly_premium_price; 
					$finalData[$i]['tinggly_ultimate_price']=$data->tinggly_ultimate_price; 
					$finalData[$i]['tinggly_essential_description']=$data->tinggly_essential_description; 
					$finalData[$i]['tinggly_premium_description']=$data->tinggly_premium_description; 
					$finalData[$i]['tingglyultimatedescription']=$data->tingglyultimatedescription;  
				}				
				$i++;
			}
			return $finalData;
		}
		
		/*********************
			Function used to  get the count of hikashop products
			$categoryIdArray = products_category_ids
		**********************/
		public function getProductCount($categoryIdArray, $giftPrice=""){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$condition = "";
			if(is_array($categoryIdArray)){
				$categoryIdList = implode(', ', $categoryIdArray);
			} else {
				$categoryIdList = $categoryIdArray;
			}
			//$categoryIdList = implode(', ', $categoryIdArray);
			if($categoryIdList != '')
				$condition .=" sl_hikashop_category.category_id IN($categoryIdList)";
			if((isset($_GET['s']) && $_GET['s'] != '')){
				$searchText = $_GET['s'];
				if($searchText != ''){
					$condition .=" (products.product_name LIKE '%".$searchText."%' ";
				
					$setValue=true;
					$condition .=" OR  MATCH (products.product_description) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE) ";
					$condition .=" OR (sl_tags.title LIKE '%".$searchText."%' ";
					$condition .=" AND sl_contentitem_tag_map.type_alias='com_hikashop.product'))";
				}
			}
			if($condition != '')
				$condition .=" AND sl_hikashop_category.category_published = 1 AND products.product_published = 1";
			else
				$condition .=" sl_hikashop_category.category_published = 1 AND products.product_published = 1";
			if(isset($_GET['parentCatId']) && $_GET['parentCatId']!="" && $_GET['searchType']=='price'){
				$searchType = $_GET['searchType'];
				$price = explode('-',$_GET['parentCatId']); 
				$min = trim($price[0]);
				$max = trim($price[1]);
				if($max == '1111'){
					$condition .=" AND sl_hikashop_price.price_value >= ".$min ;
				}else{
					$condition .=" AND sl_hikashop_price.price_value >= ".$min." AND sl_hikashop_price.price_value <= ".$max ;
				}
			}
			if($giftPrice != ''){
				if($condition != '')
					$condition .= " AND sl_hikashop_price.price_value<=$giftPrice";
				else
					$condition .= " sl_hikashop_price.price_value<=$giftPrice";
			}
			$query ="SELECT COUNT(DISTINCT products.product_id) as total
				FROM sl_hikashop_product AS products
				LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
				LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
				LEFT JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = products.product_id
				LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product_category.category_id
				WHERE $condition";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			return $data[0]->total;
		}
		
		/***************
			Function: Used to get pahysical gifts 
			by using category id and price
		****************/
		public function getProductByCatAndPrice($searchCriteria,$categoryIdArray, $startPoint, $endPoint, $giftDisplayOrder,$giftType="physical",$listedProducts="",$pagination=true){
			$noOfGifts = REDEEM_GIFT_RECORD_PER_PAGE;
			$shipping_charges = 0;
			$tax= 0;
			$finalProductData=array();
			if(is_array($categoryIdArray)){
				$categoryIdList = implode(', ', $categoryIdArray);
			} else {
				$categoryIdList = $categoryIdArray;
			}
			$db = JFactory::getDbo();
			$limit = "";

			if($giftDisplayOrder=='RAND()'){
				if(!isset($_SESSION))
					session_start();
				if(!isset($_SESSION['random_gift_seed']))
					$_SESSION['random_gift_seed'] = rand(0,100);
				$giftDisplayOrder = 'RAND('.$_SESSION['random_gift_seed'].')';
			}
			
			if($pagination){
				if($endPoint >= $startPoint ){ 
					if(($endPoint - $startPoint) < $noOfGifts){
						$noOfGifts = $endPoint - $startPoint;
					}
				}else{
					return $finalProductData;
				}
				$limit = " LIMIT $startPoint, $noOfGifts";
			}
			$amount = $searchCriteria['amount'] - $shipping_charges - $tax;
			$condition = '';
			if($categoryIdList != ''){
				$condition .= " sl_hikashop_category.category_id IN($categoryIdList)";
			}
			/*if($listedProducts != ''){
				if($condition != '')
					$condition .= " AND products.product_id NOT IN($listedProducts)";
				else
					$condition .= " products.product_id NOT IN($listedProducts)";
			}*/
			//echo $giftType;
			if($giftType!="giftCardProducts"){
			if($amount != ''){
				if($condition != '')
					$condition .= " AND sl_hikashop_price.price_value<=$amount";
				else
					$condition .= " sl_hikashop_price.price_value<=$amount";
			}
			}
			if($condition != '')
					$condition .=" AND sl_hikashop_category.category_published = 1 AND products.product_published =1";
				else
					$condition .=" sl_hikashop_category.category_published = 1 AND products.product_published =1 ";
			
			if($giftType!="physical"){
				$limit="";
				}
			//$limit = "";
		 	 $productQry = "SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . *, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs 
				FROM sl_hikashop_product AS products
				LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
				LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
				LEFT JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = products.product_id
				LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product_category.category_id
				WHERE $condition GROUP BY products.product_id ORDER BY $giftDisplayOrder $limit";
			$db->setQuery($productQry);
			$productDescriptionData = $db->loadObjectList();
			
			if(!empty($productDescriptionData)){ $i=0;
				foreach($productDescriptionData as $product=>$data){
					$db->setQuery("SELECT category_name FROM sl_hikashop_category WHERE category_id='".$data->product_manufacturer_id."'");
					$manufacturer = $db->loadObjectList();
					if(is_array($manufacturer)&&count($manufacturer)>0){
						$finalProductData[$i]['manufacturer']=$manufacturer[0]->category_name;
					}
					else{
						$finalProductData[$i]['manufacturer']='';
					}
					$finalProductData[$i]['product_id'] = $data->product_id;
					$finalProductData[$i]['product_name'] = $data->product_name;
					$finalProductData[$i]['image'] = $data->file_path;  
					// if(is_array($categoryIdArray)){
						// $finalProductData[$i]['category_id']=$categoryIdArray[$i];  
					// } else {
						// $finalProductData[$i]['category_id']=$categoryIdArray;  
					// }
					$finalProductData[$i]['category_id']=$data->category_id;  
					$finalProductData[$i]['CatValue'] = $data->price_value;  
					$finalProductData[$i]['product_description'] = $data->product_description;  
					$finalProductData[$i]['brand'] = $data->category_name; 
					$finalProductData[$i]['tingglyEssentialPrice']=$data->tinggly_essential_price;  
					$finalProductData[$i]['tingglyPremiumPrice']=$data->tinggly_premium_price;
					$finalProductData[$i]['tingglyUltimatePrice']=$data->tinggly_ultimate_price;
					$finalProductData[$i]['selectedCatIDs']=$data->selectedCatIDs;
					$finalProductData[$i]['product_likes']=$data->product_likes;
					$finalProductData[$i]['productType']='physicalGift';
					$i++;
				}
			}
			
			return $finalProductData;
		}//End Function
		/*********************
			Function used to  get hikashop product's description
			$categoryIdArray = products_category_ids
		**********************/
		public function getProductByCat($categoryIdArray, $startPoint, $endPoint, $giftDisplayOrder,$type="physical",$listedProducts="",$pagination=true,$isSearch=false,$searchType='',$searchText='',$price=''){

			if($giftDisplayOrder=='RAND()'){
				if(!isset($_SESSION))
					session_start();
				if(!isset($_SESSION['random_gift_seed']))
					$_SESSION['random_gift_seed'] = rand(0,100);
				$giftDisplayOrder = 'RAND('.$_SESSION['random_gift_seed'].')';
			}

			$constantsValue =  constants::getInstance();
			$noOfGifts = $constantsValue -> getConstantValues("REDEEM_GIFT_RECORD_PER_PAGE");
			if(is_array($categoryIdArray)){
				$categoryIdList = implode(', ', $categoryIdArray);
			}
			else{
				$categoryIdList = $categoryIdArray;
			}
			$db = JFactory::getDbo();
			$finalProductData=array();
			$limit = "";
			if($pagination){
				if($endPoint >= $startPoint ){ 
					if(($endPoint - $startPoint) < $noOfGifts){
						$noOfGifts = $endPoint - $startPoint;
					}
				}else{
					return $finalProductData;
				}
				$limit = " LIMIT $startPoint, $noOfGifts";
			}
			$condition = $catJoin = '';
			if($categoryIdList != ''){
				if($isSearch){
					$i = 0;
					foreach($categoryIdArray as $cat){ $i++;
						$catJoin .= " INNER JOIN sl_hikashop_product_category as c$i ON (c$i.product_id = products.product_id AND c$i.category_id = $cat)";
					}
					if($catJoin != ''){
						$catJoin .= " LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = c1.category_id";
					}
				}else{
					$condition .=" sl_hikashop_category.category_id IN($categoryIdList) ";
					$catJoin = ' LEFT JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = products.product_id LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product_category.category_id ';
				}
			}else{
				$catJoin = ' LEFT JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = products.product_id LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product_category.category_id ';
			}
			/*if($listedProducts != ''){
				if($condition != '')
					$condition .= " AND products.product_id NOT IN($listedProducts)";
				else
					$condition .= " products.product_id NOT IN($listedProducts)";
			}*/
			//$limit = "";
			if($condition != '')
				$condition .=" AND sl_hikashop_category.category_published = 1 AND products.product_published =1";
			else
				$condition .=" sl_hikashop_category.category_published = 1 AND products.product_published =1";
			
			if($isSearch){
				if($searchText != ''){
					if($condition != '')
						$condition .=" AND (products.product_name LIKE '%".$searchText."%' ";
					else	
						$condition .=" (products.product_name LIKE '%".$searchText."%' ";
				
					$setValue=true;
					$condition .=" OR  MATCH (products.product_description) AGAINST ('$searchText' IN NATURAL LANGUAGE MODE) ";
					$condition .=" OR (sl_tags.title LIKE '%".$searchText."%' ";
					$condition .=" AND sl_contentitem_tag_map.type_alias='com_hikashop.product'))";
				}
				if($price != ''){
					$price = explode('-',$price); 
					$min = trim($price[0]);
					$max = trim($price[1]);
					if($condition != ''){
						if($max == '1111')
							$condition .=" AND sl_hikashop_price.price_value >= $min";
						else	
							$condition .=" AND sl_hikashop_price.price_value >= $min AND sl_hikashop_price.price_value <= $max";
					}else{
						if($max == '1111')
							$condition .=" sl_hikashop_price.price_value >= $min";
						else	
							$condition .=" sl_hikashop_price.price_value >= $min AND sl_hikashop_price.price_value <= $max";
					}
				}
				$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . * ,sl_contentitem_tag_map.*,sl_tags.*, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs
				FROM sl_hikashop_product AS products
				LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
				LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
				$catJoin
				LEFT JOIN sl_contentitem_tag_map ON sl_contentitem_tag_map.content_item_id  = products.product_id
				LEFT JOIN sl_tags ON sl_tags.id  = sl_contentitem_tag_map.tag_id
				WHERE $condition AND products.product_published=1 GROUP BY products.product_id ORDER BY $giftDisplayOrder $limit";
			}else{
				$productQry ="SELECT products . * , files . * , sl_hikashop_price . * , sl_hikashop_category . *, GROUP_CONCAT(DISTINCT CONCAT(sl_hikashop_category.category_parent_id ,',',sl_hikashop_category.category_id)  SEPARATOR ',') as selectedCatIDs 
				FROM sl_hikashop_product AS products
				LEFT JOIN sl_hikashop_file AS files ON files.file_ref_id = products.product_id
				LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = products.product_id
				$catJoin
				WHERE $condition GROUP BY products.product_id ORDER BY $giftDisplayOrder $limit"; 
			}
			$db->setQuery($productQry);
			
			$productDescriptionData = $db->loadObjectList();
			$i=0;
			foreach($productDescriptionData as $product=>$data){
				// Find manufacturer
				$db->setQuery("SELECT category_name FROM sl_hikashop_category WHERE category_id='".$data->product_manufacturer_id."'");
				$manufacturer = $db->loadObjectList();
				if(is_array($manufacturer)&&count($manufacturer)>0){
					$finalProductData[$i]['manufacturer']=$manufacturer[0]->category_name;
				}
				else{
					$finalProductData[$i]['manufacturer']='';
				}
				$finalProductData[$i]['product_likes']=$data->product_likes;
				$finalProductData[$i]['product_id']=$data->product_id;
				$finalProductData[$i]['product_name']=$data->product_name;
				$finalProductData[$i]['image']=$data->file_path;  
				/*if(is_array($categoryIdArray)){
					$finalProductData[$i]['category_id']=$categoryIdArray[$i];  
					}else{
					$finalProductData[$i]['category_id']=$categoryIdArray;  
				}*/
				$finalProductData[$i]['category_id']=$data->category_id;  
				$finalProductData[$i]['CatValue']=$data->price_value;  
				$finalProductData[$i]['product_description']=$data->product_description;  
				$finalProductData[$i]['brand']=$data->category_name; 
				$finalProductData[$i]['selectedCatIDs']=$data->selectedCatIDs; 
				$i++;
			}
			return $finalProductData;
			
		}//End Function
		
		public function getProductByCategory($categoryId){
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			if(is_array($categoryId)){
				$categoryIdList = implode(', ', $categoryId);
			}
			else{
				$categoryIdList = $categoryId;
			}
			$query  =  "SELECT * FROM sl_hikashop_product_category where category_id IN (".$categoryIdList.")";
			
			$db->setQuery($query);
			$products = $db->loadRowList();
			$productIds=array();
			
			foreach($products as $key=>$value){
				$productIds[]=$value[2];
			}
			$finalData=array();

			if(!empty($productIds)){
				$productid=implode(",",$productIds);
				$productQry ="SELECT products.*, files.*,sl_hikashop_price.* from sl_hikashop_product as products LEFT JOIN sl_hikashop_file as files on files.file_ref_id=products.product_id LEFT JOIN sl_hikashop_price on sl_hikashop_price.price_product_id=products.product_id where products.product_id IN($productid) AND products.product_published=1 ";
				
				$db->setQuery($productQry);
				$prodData = $db->loadObjectList();
				$i=0;
				foreach($prodData as $product=>$data){
					$finalData[$i]['product_name']=$data->product_name;
					$finalData[$i]['product_id']=$data->product_id;
					$finalData[$i]['image']=$data->file_path;  
					$finalData[$i]['category_id']=$categoryId;  
					$finalData[$i]['CatValue']=$data->price_value;  
					$finalData[$i]['product_description']=$data->product_description;
					$finalData[$i]['tingglyEssentialPrice']=$data->tinggly_essential_price;  
					$finalData[$i]['tingglyPremiumPrice']=$data->tinggly_premium_price;
					$finalData[$i]['tingglyUltimatePrice']=$data->tinggly_ultimate_price;
				//	$finalData[$i]['tingglyShortDiscription']=$data->tinggly_short_discription;
					$finalData[$i]['tinggly_essential_description']=$data->tinggly_essential_description; 
					$finalData[$i]['tinggly_premium_description']=$data->tinggly_premium_description; 
					$finalData[$i]['tingglyultimatedescription']=$data->tingglyultimatedescription;  
					$i++;
				}
			}
			return $finalData;
		}//End Function
		
		
		public function getMessageListPendingCount($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow= date("Y-m-d")." 00:00:00";
			$query  =  " SELECT * FROM sl_sil_message WHERE user_id =$userId AND is_sent = 0 AND is_deleted=0 and is_success=1 AND (gift_type = 'msg' OR (gift_type IN ('gift','money','card','stock','fiverr','perfect gift','tinggly') AND payment_complete = 1)) order by id desc";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			
			return count($pendingData);
			
		}//End Function 
		public function getMessageListDeliveredCount($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow= date("Y-m-d")." 00:00:00";
			$query  =  " SELECT count(*) as deliveredCount FROM sl_sil_message WHERE user_id=$userId AND is_sent = 1 AND payment_complete=1 AND is_success=1 AND date_to_deliver_message <='".$datenow."' order by date_to_deliver_message DESC,id";
			$db->setQuery($query);
			$deliveredCount = $db->loadObjectList();
			
			return $deliveredCount[0]->deliveredCount;
			
		}//End Function 
		
		public function getNewInboxCount(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow= date("Y-m-d")." 00:00:00";
			$user = JFactory::getUser();
			$userEmail=$user->email;
			$query  =  " SELECT count(*) as inboxCount FROM sl_sil_message WHERE recipient_email like '$userEmail' AND is_sent = 1 AND payment_complete=1 AND is_success=1 AND date_to_deliver_message <='".$datenow."'  AND is_redeemed IS NULL AND ( (gift_type != 'msg' AND redemption_status != 2) OR (gift_type = 'msg' AND  redemption_status = 0)) order by date_to_deliver_message DESC,id";
			$db->setQuery($query);
			$inboxCount = $db->loadObjectList();
			
			return $inboxCount[0]->inboxCount;
			
		}//End Function
		
		/***************
			Function : Used to get list of upcoming events			
		***************/
		public function getUpcomingDates($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow = new DateTime("now");
			$format = 'Y-m-d 00:00:00'; 
			$date = date ( $format ); 
			$constantsValue =  constants::getInstance();
			$upcomingDays = $constantsValue -> getConstantValues("UPCOMING_DAYS");
			$d = date ( $format, strtotime ( $upcomingDays ) );	
			$query="select sl_sil_address_book.*,sl_sil_address_book_event.*, CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00')  from sl_sil_address_book_event INNER JOIN  sl_sil_address_book on sl_sil_address_book.id=sl_sil_address_book_event.contact_id
			where CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00')  BETWEEN now() AND '".$d."' AND sl_sil_address_book.is_contact = 0  AND sl_sil_address_book.user_id=$userId order by sl_sil_address_book_event.event_date ASC LIMIT 2";
			
			$db->setQuery($query);
			$upcomingData = $db->loadObjectList();
			if(!empty($upcomingData)){
				$i = 0;
				foreach($upcomingData as $data){
					$upcomingData[$i]->eventDate = strtoupper(date("M j", strtotime($data->event_date)));
					$i++;
				}
			}
			return $upcomingData;
			
		}
		/***************
			Function : Used to get all dates of upcoming events			
		***************/
		public function getUpcomingDatesCalenderView($userId,$date){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			if(is_array($date))
				$date = $date[0];
			if($date == ''){
				$datenow = new DateTime("now");
				$format = 'Y-m-d 00:00:00';
				$constantsValue =  constants::getInstance();
				$upcomingDays = $constantsValue -> getConstantValues("UPCOMING_DAYS");
				$d = date ( $format, strtotime ( $upcomingDays ) );	
				$query="select sl_sil_address_book.*,sl_sil_address_book_event.*,CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00') as eventDate  from sl_sil_address_book_event INNER JOIN  sl_sil_address_book on sl_sil_address_book.id=sl_sil_address_book_event.contact_id
				where CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00')  > now() AND sl_sil_address_book.is_contact = 0  AND sl_sil_address_book.user_id=$userId order by sl_sil_address_book_event.event_date ASC ";
			}else{
				$d = date ( 'Y-m-d', strtotime($date) ).' 00:00:00';
				$query="select sl_sil_address_book.*,sl_sil_address_book_event.*,CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00') as eventDate  from sl_sil_address_book_event INNER JOIN  sl_sil_address_book on sl_sil_address_book.id=sl_sil_address_book_event.contact_id
				where CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00') = '$d' AND sl_sil_address_book.is_contact = 0  AND sl_sil_address_book.user_id=$userId order by sl_sil_address_book_event.event_date ASC ";
			}
			
			$db->setQuery($query);
			$upcomingData = $db->loadObjectList();
			$outputDates = '';
			if($date == ''){
				$dates = array();
				if(!empty($upcomingData)){
					foreach($upcomingData as $date){
						$dates[] = $date->eventDate;
					}
				}
				$outputDates = (!empty($dates) ? implode(',',$dates) : '' );
			}
			if(!empty($upcomingData)){
				$i = 0;
				foreach($upcomingData as $data){
					$upcomingData[$i]->eventDate = strtoupper(date("M j", strtotime($data->event_date)));
					$i++;
				}
			}
			return array('dates' => $outputDates, 'data' => $upcomingData );
			
		}
		/***************
			Function : Used to get list of contacts		
		***************/
		public function getContacts($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow = new DateTime("now");
			$format = 'Y-m-d 00:00:00'; 
			$date = date ( $format ); 
			$constantsValue =  constants::getInstance();
			$upcomingDays = $constantsValue -> getConstantValues("UPCOMING_DAYS");
			$d = date ( $format, strtotime ( $upcomingDays ) );	
			$query="select sl_sil_address_book.*,sl_sil_address_book_event.*, CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00')  from sl_sil_address_book_event INNER JOIN  sl_sil_address_book on sl_sil_address_book.id=sl_sil_address_book_event.contact_id
			where CONCAT(DATE_FORMAT(now(),'%Y'),'-',DATE_FORMAT(sl_sil_address_book_event.event_date,'%m') ,'-', DATE_FORMAT(sl_sil_address_book_event.event_date,'%d'),' 00:00:00')  BETWEEN now() AND '".$d."' AND sl_sil_address_book.is_contact = 1  AND sl_sil_address_book.user_id=$userId AND sl_sil_address_book_event.occasion = '' order by sl_sil_address_book_event.event_date ASC";
			
			$db->setQuery($query);
			$upcomingData = $db->loadObjectList();
			return $upcomingData;
			
		}
		
		public function getMsgDetail($msg_id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query= "select sl_sil_message.id as msgID, sl_sil_message.*,sl_sil_message_orders.* from sl_sil_message left join sl_sil_message_orders on sl_sil_message_orders.message_id=sl_sil_message.id where sl_sil_message.id=$msg_id";
			$db->setQuery($query);
			$messageDetail = $db->loadObjectList();
			return $messageDetail;
		}
		public function getGiftMoney($msg_id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query= "select amount from sl_sil_message  where id=$msg_id";
			$db->setQuery($query);
			$giftMoneyDeatils = $db->loadObjectList();
			
			return $giftMoneyDeatils;
		}
		
		public function getAuthProfile($id){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();
			$query= "select * from sl_sil_processor_payment_profiles where id=$id and user_id=$user->id";
			$db->setQuery($query);
			$profileDetail = $db->loadObjectList();
			
			return $profileDetail;
		}
		
		/**************
			Function : Used to set is_delete column to 1 
		**************/
		public function deleteMsg($msgId){
			$db = JFactory::getDbo();
			$query = "update  sl_sil_message_orders set is_deleted = 1 where message_id=$msgId";
			$db->setQuery($query);
			$db->query();
			
			$qry = "update sl_sil_message set is_deleted=1 where id=$msgId";
			$db->setQuery($qry);
			$db->query();
			return true;
		}
		
		/******************
			Function: Used tp delete drafted messages
		******************/
		public function deleteDraftedMessage($msgId){
			$db = JFactory::getDbo();
			//$query = $db->getQuery(true);
			$object = new stdClass();
			
			$object->id = $msgId;
			$object->is_deleted = 1;
			JFactory::getDbo()->updateObject('#__sil_message', $object, 'id');
			return true;
			
		}
		public function deleteSavedCC($id){
			$db = JFactory::getDbo();
		 	$query = "delete from  sl_sil_processor_payment_profiles where id=$id";
			$db->setQuery($query);
			$db->query();
			return true;
		}
		
		public function deleteSavedShippingProfiles($id){
			$db = JFactory::getDbo();
		 	$query = "delete from  sl_sil_shipping_profile where id=$id";
			$db->setQuery($query);
			$db->query();
			return true;
		}
		
		public function deleteSavedContact($id){
			$db = JFactory::getDbo();
		 	$query = "delete from  sl_sil_address_book where id=$id";
			$db->setQuery($query);
			$db->query();
			return true;
		}
		public function getMessageDetailGroupByPid($id, $type="")
		{
			$constantsValue =  constants::getInstance();
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			if($type == 'tinggly' || $type == 'card'){
				$query = "select sl_sil_message.*, sl_hikashop_product.*, sl_hikashop_file.*,sl_hikashop_price.* FROM sl_sil_message
				LEFT JOIN sl_hikashop_product on sl_hikashop_product.product_id = sl_sil_message.selected_product_id
				LEFT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = sl_sil_message.selected_product_id
				INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id = sl_sil_message.selected_product_id 
				where   sl_sil_message.id=$id";
			} else {
				$query = "select sl_sil_message.*, sl_hikashop_product.*,sl_hikashop_file.*,sl_hikashop_price.*,sl_hikashop_category . *   FROM sl_hikashop_product		
				INNER JOIN sl_sil_message on sl_sil_message.selected_product_id=sl_hikashop_product.product_id
				INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id 
				INNER JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id=sl_hikashop_product.product_id 
				LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product.product_manufacturer_id
				where   sl_sil_message.id=$id ";
			}
			
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}
		public function getProductByMsgIdRecep($id)
		{
			$noOfGift = REDEEM_GIFT_RECORD_PER_PAGE;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			$query= "select sl_sil_message.*, sl_hikashop_product.*,sl_hikashop_file.*,sl_hikashop_price.*,sl_hikashop_category . *   FROM sl_hikashop_product		
			INNER JOIN sl_sil_message on sl_sil_message.selected_product_id=sl_hikashop_product.product_id
			INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id INNER JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id=sl_hikashop_product.product_id LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product.product_manufacturer_id
			where   sl_sil_message.id=$id AND  sl_hikashop_product.product_published=1  Limit $noOfGift";
			
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}
		public function getMessageDetailMoney($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "SELECT * from sl_sil_message WHERE id=$msgId limit 10";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}//End Function 
		public function getMessageDetail($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "SELECT sl_sil_message . * , sl_hikashop_product_category. * , sl_hikashop_product. * , sl_hikashop_file . * , sl_hikashop_price . * , sl_hikashop_category . * 	FROM sl_hikashop_product_category
			LEFT JOIN sl_sil_message ON sl_sil_message.gift_cat_id = sl_hikashop_product_category.category_id
			RIGHT JOIN sl_hikashop_product ON sl_hikashop_product.product_id = sl_hikashop_product_category.product_id
			RIGHT JOIN sl_hikashop_file ON sl_hikashop_file.file_id = sl_hikashop_product.product_id
			RIGHT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id = sl_hikashop_product.product_id
			LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product.product_manufacturer_id
			WHERE sl_sil_message.id=$msgId limit 10";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}//End Function 
		
		public function getProductByMsgIdRecepAjax($msgId,$start){
			$noOfGifts = REDEEM_GIFT_RECORD_PER_PAGE;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$qry = "select * from sl_sil_message where id=$msgId";			
			$db->setQuery($qry);
			$pendingData = $db->loadObjectList();
			
			$catId = $pendingData[0]->gift_cat_id;
			$query = "select sl_hikashop_product_category.*,sl_hikashop_product.*,sl_hikashop_file.*,sl_hikashop_price.*,sl_hikashop_category . *   FROM sl_hikashop_product INNER JOIN sl_hikashop_product_category ON sl_hikashop_product_category.product_id = sl_hikashop_product.product_id 
			LEFT JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id INNER JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id=sl_hikashop_product.product_id LEFT JOIN sl_hikashop_category ON sl_hikashop_category.category_id = sl_hikashop_product.product_manufacturer_id where  sl_hikashop_product_category.category_id=$catId AND sl_hikashop_product.product_published=1 Limit $start, $noOfGifts";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			
			return $pendingData;
			
		}//End Function 
		public function getMessageDetailAjax($msgId,$start,$end){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "SELECT sl_sil_message.*, sl_hikashop_product_category . * , sl_hikashop_product . *,sl_hikashop_file.*,sl_hikashop_price.* FROM sl_hikashop_product_category
			LEFT JOIN sl_sil_message ON sl_sil_message.gift_cat_id = sl_hikashop_product_category.category_id
			RIGHT JOIN sl_hikashop_product ON sl_hikashop_product.product_id = sl_hikashop_product_category.product_id RIGHT JOIN sl_hikashop_file ON sl_hikashop_file.file_id=sl_hikashop_product.product_id RIGHT JOIN sl_hikashop_price ON sl_hikashop_price.price_product_id=sl_hikashop_product.product_id
			WHERE sl_sil_message.id=$msgId limit $start,10";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
		}//End Function 
		public function getProductDetailCard($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			 $query  =  "SELECT sl_hikashop_product . *,sl_hikashop_file.* FROM sl_hikashop_product INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id  WHERE sl_hikashop_product.product_id=$msgId";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}//End Function 
		public function getProductDetail($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			 $query  =  "SELECT sl_hikashop_product . *,sl_hikashop_price.*,sl_hikashop_file.* FROM sl_hikashop_product INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id INNER JOIN sl_hikashop_price on sl_hikashop_price.price_product_id=sl_hikashop_product.product_id WHERE sl_hikashop_product.product_id=$msgId";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}//End Function 
		public function getProductDetailTingly($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			 $query  =  "SELECT sl_hikashop_product . *,sl_hikashop_file.* FROM sl_hikashop_product INNER JOIN sl_hikashop_file ON sl_hikashop_file.file_ref_id=sl_hikashop_product.product_id  WHERE sl_hikashop_product.product_id=$msgId";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			return $pendingData;
			
		}//End Function 
		function getUserDetail($emailId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			 $query  =  "SELECT * FROM sl_users WHERE email = '$emailId'";
			$db->setQuery($query);
			$userData = $db->loadObjectList();
			return $userData;
			}
		/*******************
			Function: Used to get occasion list
		*******************/
		public function getOccasionList(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select id from sl_categories where alias LIKE '%template-images%' ";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$parentId = $data[0]->id;
			$query  =  "select * from sl_categories where parent_id=$parentId AND published=1 ";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			$catList=array();
			foreach($result as $key=>$value){
				$catList[$key]=$value->title;
			}
			
			return $catList;
		}
		/*******************
			Function: Used to pre populate contact information on create message view
		*******************/
		public function getPrepopulateContactData(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$data = array();
			if(isset($_GET['cid']) && isset($_GET['eid'])){
				$query  =  "SELECT sl_sil_address_book . * , sl_sil_address_book_event . * FROM sl_sil_address_book_event INNER JOIN sl_sil_address_book ON sl_sil_address_book.id = sl_sil_address_book_event.contact_id WHERE sl_sil_address_book_event.id =".$_GET['eid']." AND sl_sil_address_book.id=".$_GET['cid'];
				$db->setQuery($query);
				$data = $db->loadObjectList();
			}
			return $data;
		}
		public function removeAttachment($msgId){
			$db = JFactory::getDbo();
			$query = "update  sl_sil_message set file_attachment=NULL where id=$msgId";
			$db->setQuery($query);
			$db->query();
		}
		
		public function removeTemplate($msgId){
			$db = JFactory::getDbo();
			$query = "update  sl_sil_message set template_name='', template_path='' where id=$msgId";
			$db->setQuery($query);
			$db->query();
		}
		
		public function getOccasionListAddress(){
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select id from sl_categories where alias LIKE '%template-images%' ";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$parentId=$data[0]->id;
			$query  =  "select * from sl_categories where parent_id=$parentId AND published=1 and title!='All Cards'";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			$catList=array();
			foreach($result as $key=>$value){
				$catList[$key]=$value->title;
			}
			
			return $catList;
		}
		
		/****************
			Function: Used to get templates associated
			to various different occasions and value/ 
			price if any is animated card
		****************/
		public function getOccasionTemplByArticleId($CatId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select introtext, metakey, metadesc from sl_content where catid=$CatId AND state=1";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			
			$imageNames=array();
			foreach($data as $key=>$value){
				$imageNames[$key]['imageName'] = $value->introtext;
				$imageNames[$key]['price'] = $value->metakey;
				$imageNames[$key]['card_desc'] = $value->metadesc;
				//$imageNames[$key]['is_animated_card'] = $value->metadata['rights'];
			}
			return $imageNames;
		}
		
		public function getAllOccasionTemp(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select id from sl_categories where alias LIKE '%template-images%' AND published=1 ";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$parentId=$data[0]->id;
			$query  =  "select * from sl_categories where parent_id=$parentId AND published=1 order By alias ";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			$catList=array();
			foreach($result as $key=>$value){
				$catList[$key]=$value->id;
			}
			$ids=implode(",",$catList);
			//$query  =  "select introtext from sl_content where catid IN($ids) AND state=1 order by alias,introtext";
			$query  =  "select introtext, metakey, metadesc from sl_content where catid IN($ids) AND state=1 order by alias,introtext";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$imageNames=array();
			foreach($data as $key=>$value){
				$imageNames[$key]['imageName'] = $value->introtext;
				$imageNames[$key]['price'] = $value->metakey;
				$imageNames[$key]['card_desc'] = $value->metadesc;
				//$imageNames[$key]['is_animated_card'] = $value->metadata['rights'];
			}
			return $imageNames;
		}
		
		public function getCateIdByName($occasion){
			
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$type=addslashes($occasion);
			$query  =  "select id from sl_categories where title LIKE '%$type%' ";
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			if(!empty($data)) {
				return $parentId=$data[0]->id;
				} else {
				return ;
			}
			
		}
		
		/****************
			Function: Used to get templates according 
			to the selected occassion by using tag id
		****************/
		public function getOccasionTemplByTagId($tagid){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select content_item_id from sl_contentitem_tag_map where tag_id IN ($tagid)";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			$catList=array();
			foreach($result as $key=>$value){
				$catList[$key]=$value->content_item_id;
			}
			$ids = implode(",",$catList);
			/* $query  =  "select introtext from sl_content where id IN($ids) AND state=1 order by alias,introtext";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			$imageNames=array();
			foreach($data as $key=>$value){
				$imageNames[$key]=$value->introtext;
			} */
			$query  =  "select introtext, metakey, metadesc from sl_content where id IN($ids) AND state=1 order by alias,introtext";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			
			$imageNames=array();
			foreach($data as $key=>$value){
				$imageNames[$key]['imageName'] = $value->introtext;
				$imageNames[$key]['price'] = $value->metakey;
				$imageNames[$key]['card_desc'] = $value->metadesc;
				//$imageNames[$key]['is_animated_card'] = $value->metadata['rights'];
			}
			return $imageNames;
		}
		public function getTagIdByName($occasion){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			$condition = '';
			foreach($occasion as $tag){
				$tag = stripslashes($tag);
				$type=addslashes($tag);
				$condition .= ($condition != '' ? " OR " : "")."title LIKE '%$type%'";
			}
			$condition = '('.$condition.')'; 
			$query  =  "select GROUP_CONCAT(id) as tags from sl_tags where $condition AND published=1";
			
			$db->setQuery($query);
			$data = $db->loadObjectList();
			if(!empty($data)) {
				return $parentId=$data[0]->tags;
			}
		}
		
		function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $max_width, $max_height)
		{
			/* define('THUMBNAIL_IMAGE_MAX_WIDTH', $max_width);
			define('THUMBNAIL_IMAGE_MAX_HEIGHT', $max_height); */
			list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
			switch ($source_image_type) {
				case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
				case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
				case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
			}
			if ($source_gd_image === false) {
				return false;
			}
			$source_aspect_ratio = $source_image_width / $source_image_height;
			$thumbnail_aspect_ratio = $max_width / $max_height;
			if ($source_image_width <= $max_width && $source_image_height <= $max_height) {
				$thumbnail_image_width = $source_image_width;
				$thumbnail_image_height = $source_image_height;
			} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
				$thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);
				$thumbnail_image_height = $max_height;
			} else {
				$thumbnail_image_width = $max_width;
				$thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
			}
			$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
			imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
			imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
			return $thumbnail_image_path;
		} 
		
		
		public function setDeviceRotation($filePath)
		{
			$info   = getimagesize($filePath);
			$fileType = $info[2];
			if($fileType == '2' ){
				$exif = exif_read_data($filePath);
				} else {
				$exif = 0;
			}
			
			//if there is orientation change
			$exif_orient = isset($exif['Orientation']) ? $exif['Orientation'] : 0;
			$rotateImage = 0;
			
			//convert exif rotation to angles
			if (3 == $exif_orient)
			{
				$rotateImage = 180;
				$imageOrientation = 1;
			}
			else if (4 == $exif_orient)
			{
				$rotateImage = -180;
				$imageOrientation = 1;
			}
			elseif (5 == $exif_orient)
			{
				$rotateImage = -270;
				$imageOrientation = 1;
			}
			else if (6 == $exif_orient)
			{
				$rotateImage = 90;
				$imageOrientation = 1;
			}
			else if (7 == $exif_orient)
			{
				$rotateImage = -90;
				$imageOrientation = 1;
			}
			elseif (8 == $exif_orient)
			{
				$rotateImage = 270;
				$imageOrientation = 1;
				} else {
				$rotateImage = 0;
				$imageOrientation = 1;
			}
			//if the image is rotated
			if ($rotateImage)
			{
				$rotateImage = -$rotateImage;
				$info   = getimagesize($filePath);
				$fileType = $info[2];
				switch ($fileType)
				{
					case '2': //image/jpeg
					$source = imagecreatefromjpeg($filePath);
					$rotate = imagerotate($source, $rotateImage, 0);
					imagejpeg($rotate,$filePath);
					break;
					case '3': //image/png
					$source = imagecreatefrompng($filePath);
					$rotate = imagerotate($source, $rotateImage, 0);
					imagepng($rotate,$filePath);
					break;
					case '1':
					$source = imagecreatefromgif($filePath);
					$rotate = imagerotate($source, $rotateImage, 0);
					imagegif($rotate,$filePath);
					break;
					default:
					break;
				}
			}
			return $filePath;
			
		}
		
		public function getAdminEmail(){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query  =  "select email from sl_users where sendEmail=1";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			return $result;
		}
		
		public function isMessageUpdates($id){
			
			$db = JFactory::getDbo();
			$object = new stdClass();
			$user = JFactory::getUser();
			
			$query  =  "SELECT * FROM sl_user_profiles where user_id = $id AND profile_key = 'testprofile.send_status_updates' ";
			
			$db->setQuery($query);
			$db->query();
			$num_rows = $db->getNumRows();
			
			if($num_rows>0){
				return true;
				} else {
				return false;
			}
			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
				return false;
				} else {
				return true;
			}
		}
		public function activateUser($UserId){
			$db = JFactory::getDbo();
			
			$query = "update  sl_users set block=0 where id=$UserId";
			
			$db->setQuery($query);
			$db->query();
		}
		public function getSenderDetail($msgId){
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$query  =  "SELECT sender_name, sender_email, money_transfer_instrument FROM sl_sil_message where id = $msgId";
				$db->setQuery($query);
				$db->query();
				$result = $db->loadObjectList();
				return $result;
				
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		/*******************
			Function: Used to check if user is 
			trying to redeem valid gift
		*******************/
		public function checkValidMessage($msgId,$giftType){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			//$query  =  "select is_redeemed from sl_sil_message where id=$msgId and gift_type='$giftType'  and is_sent = 1 AND is_redeemed IS NULL";
			$query  =  "select * from sl_sil_message where id=$msgId and gift_type='$giftType'  and is_sent = 1";
			$db->setQuery($query);
			$messgaeData = $db->loadObjectList();

			if(count($messgaeData) > 0){
				if( $messgaeData[0]->is_redeemed != '' || $messgaeData[0]->is_redeemed!=NULL){
					if(isset($messgaeData[0]->is_animated_card) && $messgaeData[0]->is_animated_card == 1 ){
						return true;
					} else {
						return false;
					}
				}  else {
					return true;
				}
			} else {
				return false;
			}
		}
		
		/**************
			
		**************/
		public function checkValidRequest($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query  =  "select is_redeemed from sl_sil_message where id=$msgId";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			if(count($pendingData)>0){
				if($pendingData[0]->is_redeemed != null){
					return true;
				} else {
					return false;
				} 
			} else{
				return true;
			}
		}
		
		public function getDoNotMail($data){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query  =  "SELECT * FROM  `sl_sil_do_not_email` WHERE  `email_address` LIKE  '$data'";
			$db->setQuery($query);
			$emailList = $db->loadObjectList();
			if(count($emailList)>0){
				return 'true';
			} else {
				return 'false';
			} 
		}
		
		public function getEditedMsgDetail($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query= "select * from sl_sil_message_orders where message_id=$msgId";
			$db->setQuery($query);
			$messageDetail = $db->loadObjectList();
			return $messageDetail;
		}
		
		public function msgDetailSummary($msgId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow=new DateTime("now");
			$query= "select * from sl_sil_message where id=$msgId";
			$db->setQuery($query);
			$messageDetail = $db->loadObjectList();
			return $messageDetail;
		}
		/* public function insertContactEmail($email,$cid){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$user = JFactory::getUser();			
			$query = "update  sl_sil_address_book set email='$email' where user_id=$user->id and id=$cid";
			
			$db->setQuery($query);
			$db->query();
			
		} */
		public static function sanitizeFileName($filename)
		{
			$dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#");
			return str_replace($dangerous_characters, '_', $filename);
		}
		
		public function setBitcoinProfile($data)
		{
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();	
				$userID = $data['user_Id'];
				$msgID=$data['MsgId'];
				$object = new stdClass();
				$objMsg = new stdClass();
				$query = "select * from sl_sil_user_bitcoin_profile where user_id=$userID ";
				
				$db->setQuery($query);
				$bitcoinBalanceDetail = $db->loadObjectList();
				if(empty($bitcoinBalanceDetail)){
					$object->user_id = $userID;
					$object->user_email=$data['user_email'];
					$object->BTC_balance=$data['BTC'];
					$object->USD_balance=$data['USD'];
					JFactory::getDbo()->insertObject('#__sil_user_bitcoin_profile', $object);
					
					//set msg is redeemed
					$objMsg->id=$msgID;
					$objMsg->is_redeemed=1;
					JFactory::getDbo()->updateObject('#__sil_message', $objMsg, 'id');
					
					return true;
					} else {
					$total_btc = $data['BTC'] + $bitcoinBalanceDetail[0]->BTC_balance;	
					$total_usd = $data['USD'] + $bitcoinBalanceDetail[0]->USD_balance;	
					$object->user_id = $userID;
					$object->user_email=$data['user_email'];
					$object->BTC_balance=$total_btc;
					$object->USD_balance=$total_usd;
					JFactory::getDbo()->updateObject('#__sil_user_bitcoin_profile', $object, 'user_id');
					
					//set msg is redeemed
					$objMsg->id=$msgID;
					$objMsg->is_redeemed=1;
					JFactory::getDbo()->updateObject('#__sil_message', $objMsg, 'id');
					return true;
				}
				} catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;				
			}
		}
		
		public function refundBitcoins($data)
		{
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();	
				$object = new stdClass();
				$query = "select * from sl_sil_user_bitcoin_profile where user_id=$user->id ";
				
				$db->setQuery($query);
				$bitcoinBalanceDetail = $db->loadObjectList();
				$total_btc = $data['BTC'] + $bitcoinBalanceDetail[0]->BTC_balance;	
				$total_usd = $data['USD'] + $bitcoinBalanceDetail[0]->USD_balance;	
				$object->user_id = $user->id;
				$object->user_email=$user->email;
				$object->BTC_balance=$total_btc;
				$object->USD_balance=$total_usd;
				JFactory::getDbo()->updateObject('#__sil_user_bitcoin_profile', $object, 'user_id');
				return true;
				} catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;				
			}
		}
		
		public function getAccountBalance($uname, $uid){
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();
				$query = "select * from sl_sil_user_bitcoin_profile where user_id=$uid and user_email = '$uname'";
				
				$db->setQuery($query);
				$bitcoinBalanceDetail = $db->loadObjectList();
				return $bitcoinBalanceDetail;
				} catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;				
			}
		}
		

		/******************
			Function : Used to deduct balance from sender
			account if chose to pay using balance
		******************/
		public function chargeAccountBalance($newBalance,$paymentMode,$currentBitrate){
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();
				$object = new stdClass();	
				
				if ($paymentMode == 'BTC') {
					$newAmount = round(( $newBalance/ $currentBitrate ),2);
					$object->BTC_balance = $newAmount;
				}  else { 
					$object->USD_balance = $newBalance;
				} 
				$object->user_id = $user->id;
				$object->user_email = $user->email;
				JFactory::getDbo()->updateObject('#__sil_user_bitcoin_profile', $object, 'user_id');
				return true;
			} catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;				
			}
		}
		public function createUpdateAccountBalanceRedeem($balance,$data){
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();
				if(isset($data['isUserRedistered']) && $data['isUserRedistered']==1){
					
					$user = JFactory::getUser($data['user_id']);
				}
				
				$object = new stdClass();	
				$query = "select * from sl_sil_user_bitcoin_profile where user_id=$user->id ";
				
				$db->setQuery($query);
				$bitcoinBalanceDetail = $db->loadObjectList();
				$object->user_id = $user->id;
				$object->user_email=$user->email;
				if(isset($data['Data']['ShippingMoneyInfo'][0]['new_gift_type']) && $data['Data']['ShippingMoneyInfo'][0]['new_gift_type']=='bitcoin'){
					$object->BTC_balance=(isset($bitcoinBalanceDetail[0]->BTC_balance)?$bitcoinBalanceDetail[0]->BTC_balance:0)+$balance;
				} else {
					$object->USD_balance=(isset($bitcoinBalanceDetail[0]->USD_balance)?$bitcoinBalanceDetail[0]->USD_balance:0)+$balance;
				}
				if(empty($bitcoinBalanceDetail)){					
					JFactory::getDbo()->insertObject('#__sil_user_bitcoin_profile', $object);

					}else{
					JFactory::getDbo()->updateObject('#__sil_user_bitcoin_profile', $object, 'user_id');
				}
				
				return true;
				} catch (Exception $e){
				throw new Exception($e->getMessage(), 500);
				return false;				
			}
		}
		/***********************
			Function: Used to update user id of saved 
			credit card when user is registered after
			message creation 
		***********************/
		public function updateSavedCC($cardId,$newUserId){
			try{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$user = JFactory::getUser();
				$query = "update  sl_sil_processor_payment_profiles set user_id='$newUserId' where id=$cardId ";
				
				$db->setQuery($query);
				$db->query();
				return true;
				}catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		/******************
			Function used to update url of custom template 
			and attachment
		*******************/
		public function updateAmazonUrl($fileType , $msgId, $fileUrl) {
			try{
				$db = JFactory::getDbo();
				$object = new stdClass();
				if($fileType == 'template_path'){
					$object->template_path = $fileUrl;
					} else {
					$object->file_attachment = $fileUrl;
				}
				$object->id = $msgId;
				JFactory::getDbo()->updateObject('#__sil_message', $object,'id');
			}
			catch (Exception $e){
				if ($e->getCode() == 500)
				{
					throw new Exception($e->getMessage(), 500);
					return false;
				}
			}
		}
		
		
		/******************
			Function used to get list of
			delivered messages
		*******************/
		public function getMessagedelivered($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow = new DateTime("now");
			$datenow = date("Y-m-d")." 00:00:00";
			$query  =  " SELECT * FROM sl_sil_message WHERE user_id=$userId AND is_sent = 1 AND is_deleted=0 AND payment_complete=1 AND is_success=1 AND date_to_deliver_message <='".$datenow."' order by date_to_deliver_message DESC,id";
			
			
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			$finalData=array();
			$i=0;
			foreach($pendingData as $message=>$data){
				$recipientEmail = $this->getEmailSubstring($data->recipient_email);
				$finalData[$i]['msg_id'] = $data->id;
				$finalData[$i]['userId'] = $data->user_id;
				$finalData[$i]['recipient_email'] = $recipientEmail;
				$finalData[$i]['date_to_deliver_message'] = date("F d, Y", strtotime($data->date_message_sent_to_receipient));
				$finalData[$i]['recipient_name'] = $data->recipient_name;
				$finalData[$i]['message_subject'] = $data->message_subject; 
				$finalData[$i]['gift_type'] = $data->gift_type; 
				$finalData[$i]['money_transfer_instrument'] = $data->money_transfer_instrument; 
				$i++;
			}
			return $finalData;
		}//End Function
		
		
		/******************
			Function used to get list of
			drafted messages
		*******************/
		public function getMessageListPending($userId){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow= date("Y-m-d")." 00:00:00";
			$query  =  " SELECT * FROM sl_sil_message WHERE user_id =$userId AND is_sent = 0 AND is_deleted=0 and is_success=1 AND (gift_type = 'msg' OR (gift_type IN ('gift','money','card','stock','fiverr','perfect gift', 'tinggly') AND payment_complete = 1)) order by id desc";
			$db->setQuery($query);
			$pendingData = $db->loadObjectList();
			$finalData=array();
			$i=0;
			foreach($pendingData as $message=>$data){
				$recipientEmail = $this->getEmailSubstring($data->recipient_email);
				$finalData[$i]['msg_id'] = $data->id;
				$finalData[$i]['userId'] = $data->user_id;
				$finalData[$i]['recipient_email'] = $recipientEmail;
				$finalData[$i]['date_to_deliver_message'] = date("F d, Y", strtotime($data->date_to_deliver_message));
				$finalData[$i]['recipient_name'] = $data->recipient_name;
				$finalData[$i]['message_subject'] = $data->message_subject; 
				$finalData[$i]['payment_complete'] = $data->payment_complete; 
				$finalData[$i]['gift_type'] = $data->gift_type; 
				$finalData[$i]['money_transfer_instrument'] = $data->money_transfer_instrument; 
				
				$i++;
			}
			return $finalData;
			
		}//End Function 
		
		/******************
			Function used to get list of
			drafted messages
		*******************/
		public function getMessagesList($type , $userId, $userEmail){
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$datenow = date("Y-m-d")." 00:00:00";
			
			if( $type == 'drafts'){
				$query  =  " SELECT * FROM sl_sil_message WHERE user_id =$userId AND is_sent = 0 AND is_deleted=0 AND is_success=0 AND is_draft=1 ORDER BY id DESC";
				// AND date_to_deliver_message >='".$datenow."' order by id desc";
				} else  {
				//$query  =  "SELECT * FROM sl_sil_message WHERE recipient_email ='$userEmail' AND is_sent = 1 AND is_deleted=0 AND is_success=1 AND is_draft=0  AND date_to_deliver_message <='".$datenow."' AND is_redeemed=1 order by id desc";
				$query  =  "SELECT * FROM sl_sil_message WHERE recipient_email ='$userEmail' AND is_sent = 1 AND is_deleted=0 AND is_success=1 AND is_draft=0 AND date_to_deliver_message <='".$datenow."' order by id desc";
			}
			
			
			$db->setQuery($query);
			$messagesData = $db->loadObjectList();
			$finalData = array();
			$i = 0;

			foreach( $messagesData as $message => $data ){
				$recipientEmail = $this->getEmailSubstring($data->recipient_email);
				$senderEmail = $this->getEmailSubstring($data->sender_email);
				$finalData[$i]['msg_id'] = $data->id;
				$finalData[$i]['userId'] = $data->user_id;
				$finalData[$i]['recipient_email'] = $recipientEmail;
				$finalData[$i]['sender_email'] = $senderEmail;
				$finalData[$i]['date_to_deliver_message'] = date("F d, Y", strtotime($data->date_to_deliver_message));
				$finalData[$i]['recipient_name'] = $data->recipient_name;
				$finalData[$i]['message_subject'] = $data->message_subject; 
				$finalData[$i]['payment_complete'] = $data->payment_complete; 
				$finalData[$i]['gift_type'] = $data->gift_type; 
				$finalData[$i]['redemption_status'] = $data->redemption_status; 
				$finalData[$i]['money_transfer_instrument'] = $data->money_transfer_instrument; 
				
				$i++;
			}
			return $finalData;
		}
		
		/**************
			Function : Used to get substring if string is greater than 15 character 
		***************/
		public function getEmailSubstring($data){
			if (strlen($data) > 15) {
				// truncate string
				$stringCut = substr($data, 0, 15);
				// make sure it ends in a word so assassinate doesn't become ass...
				return $stringCut."...";//substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
				} else {
				return $data;
			}
			die;
		}
		
		/**
			*  insert profile pic url in sl_sil_profiles table
			*  @return object The message to be displayed to the user
		*/
		function updateUserProfilePicture($imagePath){
			try { 
				$db = JFactory::getDbo();
				$object = new stdClass();
				$user = JFactory::getUser();
				$object->user_id = $user->id;
				$object->profile_key = 'sil.profilePicture';
				$object->profile_value = $imagePath;
				$object->ordering = 1;
				$query = $db->getQuery(true);
				$query = "select * from sl_user_profiles where profile_key = 'sil.profilePicture' AND user_id =".$user->id;
				$db->setQuery($query);
				$results = $db->loadObjectList();
				if(empty($results) ){
					JFactory::getDbo()->insertObject('#__user_profiles', $object);
					return $db->insertid();
				} else {
					JFactory::getDbo()->updateObject('#__user_profiles', $object, array('user_id','profile_key'));
				}	
				return true;
				} catch (Exception $e){
				if ($e->getCode() == 500)
				{
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			} 
		}
		
		/**
			*  insert profile pic url in sl_sil_profiles table
			*  @return object The message to be displayed to the user
		*/
		function getProfilePicture($userId){
			try {
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query  =  " SELECT profile_value FROM sl_user_profiles WHERE user_id =$userId AND profile_key = 'sil.profilePicture'";
				$db->setQuery($query);
				$profilePictureName = $db->loadObjectList();
				return $profilePictureName;
				} catch (Exception $e){
				if ($e->getCode() == 500)
				{
					throw new Exception($e->getMessage(), 500);
					return false;
				}
			} 
		}
		
		public function getRecentProducts($userId){
			$db = JFactory::getDbo();
			$query="select DISTINCT * from sl_sil_recent_items_viewed where user_id=$userId ORDER BY id DESC";
			$db->setQuery($query);
			return $recentViewed = $db->loadObjectList();
		}
		
		/***********************
			Function: Used to save Recently viewed products
		***********************/
		function saveRecentViewed($catId,$ProductId,$userId){
			$db = JFactory::getDbo();
			$query="select * from sl_sil_recent_items_viewed where user_id=$userId";
			$db->setQuery($query);
			$recentViewed = $db->loadObjectList();
			$data=array();
			if(count($recentViewed)>9){
				$firstElement=$recentViewed[0]->id;
				
				$qry="delete from sl_sil_recent_items_viewed where id=$firstElement";
				$db->setQuery($qry);
				$db->query();
			}
			$query="select * from sl_sil_recent_items_viewed where user_id=$userId AND product_id=$ProductId";
			$db->setQuery($query);
			$ifExist = $db->loadObjectList();
			if(count($ifExist)>0 ){
				$qry="delete from sl_sil_recent_items_viewed where product_id=$ProductId and User_id=$userId";
				$db->setQuery($qry);
				$db->query();
			}
			$object = new stdClass();
			$object->user_id = $userId;
			$object->product_id = $ProductId;
			JFactory::getDbo()->insertObject('#__sil_recent_items_viewed', $object);
			
			
		}
		
		function addtoString($str, $item) {
			$parts = explode(',', $str);
			$parts[] = $item;
			
			return implode(',', $parts);
		}
		
		
		
		/***********************
			Function: Used to update password of user
		***********************/
		public function updateUserProfile($data, $type ){
			try {
				$db 	= JFactory::getDbo();
				$object	= new stdClass();
				$user   = JFactory::getUser();
				$object->id = $data['user_id'];
				if( $type == 'password'){
					$object->password = $data['new_password'];
					$object->lastResetTime  = date("Y-m-d");
				} else{
					$object->name = $data['userName'];
					$object->email  = $data['userEmail'];
				}
				if(JFactory::getDbo()->updateObject('#__users', $object,'id')){
					return true;
				} else {
					return false;
				}
				
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		
		
		/***********************
			Function: Used to update password of user
		***********************/
		public function checkValidProfile($data ){
			try {
				$userEmail = $data['userEmail'];
				$userID = $data['user_id'];
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query  = "SELECT * FROM sl_users WHERE id !=$userID AND email = '$userEmail'";
				$db->setQuery($query);
				$uniqueUserEmail = $db->loadObjectList();
				if(!empty ($uniqueUserEmail) ){
					return true;
					} else {
					return true;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		/***********************
			Function: Used to fetch author bio
		***********************/
		public function getArticleContent($data){
			try{
				$db = JFactory::getDbo();
				$alias = $data['alias'];
				$query="select introtext from sl_content where alias LIKE '$alias'";
				$db->setQuery($query);
				$msgData = $db->loadObjectList();
				if(!empty ($msgData) ){
					return $msgData;
					} else {
					return false;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		/***********************
			Function: Used to fetch open job positions
		***********************/
		public function getOpenPositions(){
			try{
				$db = JFactory::getDbo();
				$language = JFactory::getLanguage();
				$lang = str_replace('-GB', '', $language->getTag());
				$lang = str_replace('-ES', '', $lang);
				$query="select sl_content.title, sl_content.alias from sl_content INNER JOIN sl_categories ON (sl_content.catid = sl_categories.id) where sl_categories.alias LIKE 'open-positions' AND sl_content.alias LIKE '%-$lang'";
				$db->setQuery($query);
				$msgData = $db->loadObjectList();
				if(!empty ($msgData) ){
					return $msgData;
					} else {
					return false;
				}
			}
			catch (Exception $e){
				
				if ($e->getCode() == 500)
				{
					// Not found
					throw new Exception($e->getMessage(), 500);
					return false;
				}
				
			}
		}
		/***********************
			Function: Used to fetch parent category
		***********************/
		public function getParentCategory($catgory_id){
			$db = JFactory::getDbo();
			$query = "SELECT category_parent_id from sl_hikashop_category where category_id = $catgory_id";
			$db->setQuery($query);
			$data = $db->loadObjectList();
			if(!empty($data)){
				if($data[0]->category_parent_id == 0 || $data[0]->category_parent_id == 1){
					return $catgory_id;
				}else{
					$this->getParentCategory($data[0]->category_parent_id);
				} 
			}else{
				return '';
			}
		}
	}
	
