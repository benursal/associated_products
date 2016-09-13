<?php
class Ben_Captcha{
	
	var $image;
	var $word = '';
	
	function __captcha(){
	
	}
	
	/* ************
	 * array('font_path', 'font1', 'font2')
	 */
	function config($config){
		$string = '';

		for ($i = 0; $i < 5; $i++) {
			$string .= chr(rand(97, 122));
		}

		$this->word = $string;

		$dir = $config['font_path'];

		$this->image = imagecreatetruecolor(165, 50);

		// random number 1 or 2
		$num = rand(1,2);
		if($num==1)
		{
			$font = $config['font1']; // font style
		}
		else
		{
			$font = $config['font2'];// font style
		}

		// random number 1 or 2
		$num2 = rand(1,2);
		if($num2==1)
		{
			$color = imagecolorallocate($this->image, 113, 193, 217);// color
		}
		else
		{
			$color = imagecolorallocate($this->image, 163, 197, 82);// color
		}

		$white = imagecolorallocate($this->image, 255, 255, 255); // background color white
		imagefilledrectangle($this->image,0,0,399,99,$white);

		imagettftext ($this->image, 30, 0, 10, 40, $color, $dir.$font, $this->word);

	}
	
	function show_image(){
		header("Content-type: image/png");
		imagepng($this->image);
	}
	
	function get_word(){
		return $this->word;
	}
}

?>