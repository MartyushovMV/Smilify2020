<?php 
	/**
	 * Обрезка фото
	 */
	class peopleSegmentator
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

		public function getToken() {
			$headers = ['Content-Type:multipart/form-data'];

			$options = [CURLOPT_URL => 'https://www.visionhub.ru/api/v2/auth/generate_token/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true];

			$this->token = json_decode($this->curl($options))->token;

			return $this->token;
		}


		function sendModel($token, $imgURI) {
			$headers = ['Content-Type:multipart/form-data', 'Authorization: Bearer '.$token];

			$params = [
				'model'=>'people_segmentator',
				'url'=>$imgURI];

			$options = array(
			CURLOPT_URL => 'https://www.visionhub.ru/api/v2/process/img2img/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			);
			//$this->id_task = json_decode($this->curl($options))->task_id;
				print_r($this->curl($options));
			//return $this->id_task;
		}

		function getModel($token, $id_task) {
			$headers = ['Content-Type:multipart/form-data', 'Authorization: Bearer '.$token];

			$options = array(
			CURLOPT_URL => 'https://www.visionhub.ru/api/v2/task_result/'.$id_task.'/',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_COOKIESESSION => true,
			CURLOPT_RETURNTRANSFER => true,
			);

			$stikersInfo = $this->curl($options);
			return $stikersInfo;
		}		
	}

	$peopleSegmentator = new peopleSegmentator();

	if (isset($_GET['get_token'])) {
		echo $peopleSegmentator->getToken();
	}

	if (isset($_GET['send_model']) && isset($_GET['token']) && isset($_GET['image'])) {
		echo $peopleSegmentator->sendModel($_GET['token'], $_GET['image']);
	}

	if (isset($_GET['get_model']) && isset($_GET['token']) && isset($_GET['id_task'])) {
		echo $peopleSegmentator->getModel($_GET['token'], $_GET['id_task']);
	}

	if (isset($_POST['file'])) {
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['file']));

		file_put_contents('/var/www/html/uploads/'.$_POST['name'], $data);
		echo $_POST['name'];
	}
?>