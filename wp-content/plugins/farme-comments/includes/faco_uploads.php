<?php 	
	add_action('faco_imagemValida','imagemValida');
	add_action('faco_uploadFile','uploadFile');
	add_action('faco_deleteFile','deleteFile');

	class faco_uploads{

	 	public static function imagemValida($imagem){
	 		if($imagem['type'] == 'image/jpeg' ||
	 			$imagem['type'] == 'image/jpg' ||
	 			$imagem['type'] == 'image/png' ||
	 			$imagem['type'] == 'image/svg+xml'){
	 			$tamanho = intval($imagem['size']/1024);
	 			if($tamanho < 10240){
	 				return true;
	 			} else{
	 				return false;
	 			}
	 		}
	 		else{
	 			return false;
	 		}
	 	}

	 	public static function uploadFile($file){
	 		$formatoarquivo = explode('.',$file['name']);
	 		$imagemnome = uniqid().'.'.$formatoarquivo[count($formatoarquivo) - 1];
	 		$wp_upload_dir = wp_upload_dir();
	 		if($local == null){
		 		if(move_uploaded_file($file['tmp_name'],$wp_upload_dir['path'].'/'.$imagemnome)){
		 			return $wp_upload_dir['path'].'/'.$imagemnome;
		 		}
		 		else{
		 			return false;
		 		}
	 		}
	 	}

	 	public static function deleteFile($file){
	 		@unlink($file);
	 	}

	}

 ?>