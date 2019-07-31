<?php
namespace uploadHelperClass;

class UploadFile
{
	protected $destination;
	protected $messages = array();
	protected $maxSize;
	protected $filetype;
	protected $file_extension;
	protected $hashValue;
	protected $hashwithvalue;
	protected $usehash=false;
	protected static $allow_file_type=['image'=>['jpg','jpeg','png','gif','pjpeg'],'video'=>['mp4','webm','ogg'],'audio'=>['mp3'],'application'=>["pdf","zip.msoffice"]];
	protected $newName;
	protected $typeCheckingOn = true;
	protected $notTrusted = array('bin', 'cgi', 'exe', 'js', 'pl', 'php', 'py', 'sh');
	protected $suffix = '.upload';
	protected $renameDuplicates;
	
	public function __construct($uploadFolder,$filetype)
	{
		//upload file type
	$filetype=strtolower($filetype);
		if(array_key_exists($filetype,self::$allow_file_type) ){
			$this->filetype=$filetype;
		}else{
		throw new \Exception("$filetype is an ivalid filetype.");
		}
		//upload folder
		if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
	

		if ($uploadFolder[strlen($uploadFolder)-1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}
	
	public function setMaxSize(int $bytes)
	{
		$serverMax = self::convertToBytes(ini_get('upload_max_filesize'));
		if ($bytes > $serverMax) {
			throw new \Exception('Maximum size cannot exceed server limit for individual files: ' .
	self::convertFromBytes($serverMax));
		}
		if (is_numeric($bytes) && $bytes > 0) {
			$this->maxSize = $bytes;
		}
	}
	public static function gethAllowfileType(String $typeoffile){
	return self::$allow_file_type[$typeoffile];
	}
	
	public function gethashfilename(){
		if($this->usehash){
			return trim($this->hashValue).".".$this->file_extension;
		}
		return trim($this->hashwithvalue).".".$this->file_extension;
	}
	public function setfileName(String $strvalue,bool $hash=true){
		$this->usehash=$hash;
		$this->hashwithvalue=$strvalue;
	}
	protected function sethash(){
		if($this->usehash){
			return substr(md5($this->hashwithvalue),0,20);
		}

		return $this->hashwithvalue;
	}
	public static function hash(String $value){
		
			return substr(md5($value),0,20);
		
	}
	public static function convertToBytes($val)
	{
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		if (in_array($last, array('g', 'm', 'k'))){
			$val=(int) substr($val,0,-1);
			switch ($last) {
				case 'g':
					$val *= 1024;
				case 'm':
					$val *= 1024;
				case 'k':
					$val *= 1024;
			}
		}
		return $val;
	}
	
	public static function convertFromBytes($bytes)
	{
		$bytes /= 1024;
		if ($bytes > 1024) {
			return number_format($bytes/1024, 1) . ' MB';
		} else {
			return number_format($bytes, 1) . ' KB';
		}
	}
	
	public function allowAllTypes($suffix = null)
	{
		$this->typeCheckingOn = false;
		if (!is_null($suffix)) {
			if (strpos($suffix, '.') === 0 || $suffix == '') {
				$this->suffix = $suffix;
			} else {
				$this->suffix = ".$suffix";
			}
		}
	}
	
	public function upload(Array $uploaded,bool $renameDuplicates = true)
	{
		$this->renameDuplicates = $renameDuplicates;
		if (is_array($uploaded['name'])) {
			foreach ($uploaded['name'] as $key => $value) {
				$currentFile['name'] = $uploaded['name'][$key];
				$currentFile['type'] = $uploaded['type'][$key];
				$currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
				$currentFile['error'] = $uploaded['error'][$key];
				$currentFile['size'] = $uploaded['size'][$key];
				if ($this->checkFile($currentFile)) {
					$this->moveFile($currentFile);
				}
			}
		} else {
			if ($this->checkFile($uploaded)) {
				$this->moveFile($uploaded);
			}
		}
	}
	
	public function getMessages()
	{
		return $this->messages;
	}
	
	protected function checkFile($file)
	{
		if ($file['error'] != 0) {
			$this->getErrorMessage($file);
			return false;
		}
		if (!$this->checkSize($file)) {
			return false;
		}
		if ($this->typeCheckingOn) {
		    if (!$this->checkType($file)) {
			    return false;
			}
		}
		$this->checkName($file);
		return true;
	}
	
	protected function getErrorMessage($file)
	{
		switch($file['error']) {
			case 1:
			case 2:
				$this->messages[] = $file['name'] . ' is too big: (max: ' . 
				self::convertFromBytes($this->maxSize) . ').';
				break;
			case 3:
				$this->messages[] = $file['name'] . ' was only partially uploaded.';
				break;
			case 4:
				$this->messages[] = 'No flyer file submitted.';
				break;
			default:
				$this->messages[] = 'Sorry, there was a problem uploading ' . $file['name'];
				break;
		}
	}
	
	protected function checkSize($file)
	{
		if ($file['size'] == 0) {
			$this->messages[] = $file['name'] . ' is empty.';
			return false;
		} elseif ($file['size'] > $this->maxSize) {
			$this->messages[] = $file['name'] . ' exceeds the maximum size for a file ('
					. self::convertFromBytes($this->maxSize) . ').';
			return false;
		} else {
			return true;
		}
	}
	
	protected function checkType($file) 
	{
		$allowtype=self::$allow_file_type[$this->filetype];
		$no_space=str_replace(' ','_',$file['name']);
		$file_info=pathinfo($no_space);
		$file_ext= $file_info['extension'];
		$file_type= substr($file['type'],strpos($file['type'],"/")+1);

		if (in_array($file_ext, $allowtype) && in_array($file_type, $allowtype)) {
			$this->file_extension=$file_ext;
			return true;
		} else {
			$this->messages[] = $file['name'] . ' is not permitted type of file.';
			return false;
		}

	}
	
	protected function checkName($file)
	{
		$this->newName = null;
		$nospaces = str_replace(' ', '_', $file['name']);
		$nameparts = pathinfo($nospaces);
		$extension = isset($nameparts['extension']) ? $nameparts['extension'] :$this->$file_extension;
		//with e.g .jpg
		$hash=$this->sethash();
		$this->hashValue=$hash;
		$hashwithExtension=$hash.".".$extension;
		$this->newName=$hashwithExtension;

		if (!$this->typeCheckingOn && !empty($this->suffix)) {
			if (in_array($extension, $this->notTrusted) || empty($extension)) {
				$this->newName = $hashwithExtension.$this->suffix;
			}
		}
		if ($this->renameDuplicates) {
			$name = isset($this->newName) ? $this->newName: $hashwithExtension;
			$existing = scandir($this->destination);
			if (in_array($name, $existing)) {
				$i = 1;
				do {
					$this->newName = $hash.'_' . $i++;
					if (!empty($extension)) {
						$this->newName .= ".$extension";
					}
					if (in_array($extension, $this->notTrusted)) {
						$this->newName .= $this->suffix;
					}
				} while (in_array($this->newName, $existing));
			}
		}
	}
	
	protected function moveFile($file)
	{
		$filename = isset($this->newName) ? $this->newName : $hashwithExtension;//possible error when file upload
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
		if ($success) {
			//do nothing after successful file upload
		} else {
			$this->messages[] = 'Could not upload ' . $file['name'];
		}
	}
}