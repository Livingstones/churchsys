<?php

class FileController extends Controller
{
	public function actionDownload()
	{
		if (Yii::app()->user->isGuest){
			echo "Permission Denied!!";
			return;
		}
		
		$p = urldecode($_REQUEST["p"]);
		$path = $_SERVER['DOCUMENT_ROOT']."/";
		$fullPath = $path . "file/" . $p;
		if (empty($p)){
			echo "Path is Empty!!";
			return;
		}
		if (!file_exists($fullPath)) {
			echo "File Not Found!!<br/>";
			echo urldecode($fullPath) . "<br/>";
			return;
		}
		
		if ($fd = fopen ($fullPath, "r")) {
		    $fsize = filesize($fullPath);
		    $path_parts = pathinfo($fullPath);
			$ext = strtolower($path_parts["extension"]);
			switch ($ext) {
				case "pdf":
					header("Content-type: application/pdf"); // add here more headers for diff. extensions
					header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
				break;
				default;
					header("Content-type: application/octet-stream");
					header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
				break;
		    }
		    header("Content-length: " . $fsize);
		    header("Cache-control: private"); //use this to open files directly
		    while(!feof($fd)) {
		        $buffer = fread($fd, 2048);
		        echo $buffer;
		    }
			fclose ($fd);
			Yii::app()->end();
		} else {
			echo "Download File Error Occur!";
			return;
		}
	}

	public function actionZip()
	{
		$this->render('zip');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
