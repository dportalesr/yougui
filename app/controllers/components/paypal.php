<?php
class PaypalComponent  extends Object{
	var $components = array('Cookie');

	///

	var $business = array('GMX943TAMPMKQ','MF2PDFJL6UY4G');# live, sanbox
	var $auth_token = array('Bar4KV07fLUxd9S_utzVfu0j7TCgWyztWMGvki8rW_RNbkuIjVa3oCRH5mS','FzibgtYx9Fv20iFPsCeCpvUe1h1G92j8HJMq8A2gdseLujQHLotf5rDrjp0');
	var $sandbox = 1;
	var $pp_settings = array(
		'cmd'=>'_xclick',
		'charset'=>'UTF-8',
		'no_shipping'=>1,
		'no_note'=>1,
		'lc'=>'MX',
		'notify_url'=>'/pagos/verificar/',
		'cancel_return'=>'/pagos/cancelado/'
	);
	var $isvalid = 'ok'; # 'ok' = Sin problemas; 'verify' = Parcialmente verificada; false = Error fatal
	var $errors = false;
	var $errormsg = array(
		'nosessionpp' => 'El tiempo para realizar el pago se ha superado.',
		'nosession' => 'La sesión del usuario caducó mientras se hacía el pago en Paypal.',
		'nopostdata' => 'El redireccionamiento desde Paypal no ha sido correcto.',
		'incorrectpayer' => 'La sesión se ha cambiado mientras se realizaba el pago.',
		'invalidpayer' => 'El usuario que hizo el pago no existe.',
		'noconnection' => 'No se pudo conectar con Paypal para verificar los datos del pago.',
		'invalidresponse' => 'La respuesta de la verificación del pago tiene un formato inválido.',
		'txnfailed' => 'La transacción falló.',
		'txnexists' => 'La transacción ya había sido procesada.',
		'paynotcomplete' => 'La transacción no se ha completado.',
		'invalidpayreceiver' => 'El destinatario del pago posiblemente es incorrecto.',
		'invalidamount' => 'El monto del pago no es correcto.',
		'invalidcurrency' => 'El pago fue realizado en una moneda diferente de Pesos Mexicanos (MXN).'
	);
	function initialize(&$controller) {
		$this->controller =& $controller;
		$this->controller->Cookie->name = 'pp_session';
		$this->controller->Cookie->time = 3600; // or '1 hour'
		$this->controller->Cookie->path = '/';
		$this->controller->Cookie->domain = 'encuentros.pulsem.com.mx';
		$this->controller->Cookie->secure = false; //i.e. only sent if using secure HTTPS
		$this->controller->Cookie->key = 'MF2PDFJL6UY4G';
	}

	function verify($pp_get){ 
		$this->errors = array();
		if(!$pp_get){
			$this->errors[] = 'nopostdata'; # No se pudo conectar con Paypal
			
		} elseif($this->controller->Cookie->read('pp')) {
			$pp_sent = $this->controller->Cookie->read('pp');

			$txn = array(); # Resultados de la transacción
			$req = 'cmd=_notify-synch&tx='.$pp_get['tx'].'&at='.($this->auth_token[$this->sandbox]);

			// post back to Paypal system to validate
			$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
			$fp = fsockopen ('www.'.($this->sandbox ? 'sandbox.' : '').'paypal.com', 80, $errno, $errstr, 30);


			$this->txn['payment_status'] = $pp_get['st'];
			$this->txn['mc_gross'] = $pp_get['amt'];
			$this->txn['mc_currency'] = $pp_get['cc'];
			
			if (!$fp) {
				$this->errors[] = 'noconnection'; # No se pudo conectar con Paypal

				$this->isvalid = 'verify';
				if($this->txn['payment_status']!='Completed'){
					$this->errors[] = 'paynotcomplete';
					$this->isvalid = false;
				}
					
				if($this->txn['mc_gross'] != $pp_sent['amount']){
					$this->isvalid = false;
					$this->errors[] = 'invalidamount';
				}

				if($this->txn['mc_currency'] != $pp_sent['currency_code']){
					$this->isvalid = false;
					$this->errors[] = 'invalidcurrency';
				}
				
			} else {

				fputs($fp, $header.$req);
				$res = '';
				$headerdone = false;
				while (!feof($fp)) {
					$line = fgets ($fp, 1024);
					if(strcmp($line, "\r\n") == 0){ // read the header
						$headerdone = true;
					} elseif($headerdone) { // header has been read. now read the contents
						$res.= $line;
					}
				}
				$this->details = $res = urldecode($res);
				$lines = explode("\n", $res);
				if (strcmp($lines[0], "SUCCESS") == 0){
					for($i=1;$i<sizeof($lines)-1;$i++){
						if(!empty($lines[$i])){
							list($key,$value) = explode('=', $lines[$i]);
							$this->txn[$key] = $value;
						}
					}
					
					/// Error
					if($this->txn['payment_status']!='Completed'){
						$this->errors[] = 'paynotcomplete';
						$this->isvalid = false;
					}
						
					if($this->txn['receiver_id']!= $this->business[$this->sandbox]){
						$this->errors[] = 'invalidpayreceiver';
						$this->isvalid = false;
					}
						
					if($this->txn['mc_gross'] != $pp_sent['amount']){
						$this->isvalid = false;
						$this->errors[] = 'invalidamount';
					}

					if($this->txn['mc_currency'] != $pp_sent['currency_code']){
						$this->isvalid = false;
						$this->errors[] = 'invalidcurrency';
					}

					$this->txn['payment_date'] = date('Y-m-d H:i:s',strtotime($this->txn['payment_date']));
					$this->txn['payer_name'] = $this->txn['first_name'].' '.$this->txn['last_name'];

				} else $this->errors[] = strcmp($lines[0], "FAIL") == 0 ? 'txnfailed':'invalidresponse';
				
			} # End Verificación
			fclose ($fp);
			
		} else $this->errors[] = 'nosessionpp';
		$this->controller->Cookie->delete('pp');
		
	}

	function detailerrors($errors=false) {
		if(!$errors)
			$errors = $this->errors;
		/// Compactamos Errores
		if(sizeof($errors)){
			$errorstemp = array();
			foreach($errors as $error)
				$errorstemp[] = $this->errormsg[$error];
				
			return $errorstemp;
		}
		return false;
	}
	
	function pay($sets=array()){
		$defaults = array(
			'name'=>'Item',
			'amount'=>1,
			'quantity'=>false,
			'custom'=>false,
			'currency'=>'MXN'
		);
		$sets = array_merge($defaults,$sets);
		
		$pp_url = 'http://www.'.($this->sandbox ? 'sandbox.' : '').'paypal.com/cgi-bin/webscr?';

		$this->pp_settings['business'] = $this->business[$this->sandbox];
		$this->pp_settings['notify_url'] = $_SERVER['SERVER_NAME'].$this->pp_settings['notify_url'];
		$this->pp_settings['cancel_return'] = $_SERVER['SERVER_NAME'].$this->pp_settings['cancel_return'];
		$this->pp_settings['currency_code'] = $sets['currency'];
		$this->pp_settings['amount'] = $sets['amount'];
		$this->pp_settings['item_name'] = $sets['name'];
		$this->pp_settings['item_number'] = $sets['id'] ? $sets['id']:'';
		$this->pp_settings['quantity'] = $sets['quantity'] ? $sets['quantity']:'';
		$this->pp_settings['custom'] = $sets['custom'] ? $sets['custom']:'';
		#fb('-- cookie settings');
		#fb($this->pp_settings);
		$this->controller->Cookie->write('pp',$this->pp_settings);
		
		foreach($this->pp_settings as $key => $value)
			$pp_url.= $key.'='.urlencode($value).'&';
		$this->controller->redirect($pp_url);
	}
}
?>