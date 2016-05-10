<?php
namespace Wilsonshop\Utils;

class Upload{
	var $target_path;
	var $uploadFieldName;
	var $tmp_name;
	var $operationMsg;
	var $file_name;

	/**
	 * Upload constructor.
	 * @param $target_path Path where the file will get upload to
	 * @param $field name of the upload field
	 * @param null $tmp
	 */
	public function __construct($target_path,$field,$tmp=null)
	{
		$this->target_path=$target_path;
		$this->uploadFieldName=$field;
		
		if($tmp!=null){
			$this->tmp_name = $tmp;
		}else{
			$this->tmp_name = $_FILES[$field]['tmp_name'];
		}
		
	}

	/**
	 * @param string $successAction
	 * @param string $failAction
	 * @param null $renameto
	 * @return string
	 */
	public function uploadFile($successAction="",$failAction="",$renameto=null)
	{
		
		if($renameto!=null){
			$finalFileName = $renameto;
		}else{
			$finalFileName=$_FILES[$this->uploadFieldName]['name'];
		}

		if(move_uploaded_file($this->tmp_name,"$this->target_path/$finalFileName")){
			
			$this->operationMsg .= $successAction;
		}
		else{
			$this->operationMsg .= $failAction;
		}
		return $this->operationMsg;
	}
}
?>

