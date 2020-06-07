<?php 
	/**
	 * Обработка стикеров 
	 */
	class StikersApi
	{
		public $token = null;
		public $id_task = null;

		public function curl($options) {
			$ch = curl_init();
			curl_setopt_array($ch, $options);
			$content = curl_exec($ch);
			curl_close($ch);
			return $content;
		}

		public function __construct() {
			$headers = ['Content-Type:multipart/form-data'];

			$options = [CURLOPT_URL => 'https://www.visionhub.ru/api/v2/auth/generate_token/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true];

			$this->token = json_decode($this->curl($options))->token;

			return $this->token;
		}


		function sendModel() {
			$headers = ['Content-Type:multipart/form-data', 'Authorization: Bearer '.$this->token];

			$params = [
				'model'=>'people_segmentator',
				'url'=>'https://u.kanobu.ru/editor/images/46/028744ff-1505-4b9b-8f2b-46ca5fc8148a.jpg'];

			$options = array(
			CURLOPT_URL => 'https://www.visionhub.ru/api/v2/process/img2img/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			);

			$this->id_task = json_decode($this->curl($options))->task_id;
			return $this->id_task;
		}

		function getModel() {
			$headers = ['Content-Type:multipart/form-data', 'Authorization: Bearer '.$this->token];

			$options = array(
			CURLOPT_URL => 'https://www.visionhub.ru/api/v2/task_result/'.$this->id_task.'/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_COOKIESESSION => true,
			CURLOPT_RETURNTRANSFER => true,
			);

			$stikersInfo = $this->curl($options);
			var_dump($stikersInfo);
			//return $stikersInfo;
		}		
	}

	$obj = new StikersApi();
?>