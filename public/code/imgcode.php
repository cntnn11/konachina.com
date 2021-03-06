<?php
session_start();
/**
 *	一个简单的加乘验证码类
 *	@author 谭宁宁
 *	@datetime 2012-09-03
*/

class codeimg
{
	public $width	= 150;
	public $height	= 35;
	
	public $num_1	= 1;
	public $num_2	= 10;
	
	public $f_file	= 'consola.ttf';
	public $f_size	= 13;

	public $c_type	= 1;	//验证码类型：1加乘混合出现/2纯加法/3纯乘法。默认为1
	public $imgSourc= '';

	public $line	= true;
	public $lineNum	= 0;

	private $sess	= '';	//存入session的值
	private $dev	= FALSE;//调试模式，也就是不输出header("content-type: image/png;");也不生成图片。测试的

	function __construct()
	{
		$this->genImg();
	}

	function genImg()
	{
		$this->imgSourc	= $this->createImgSourc();
		if(!self::$this->dev)
		{
			header("content-type: image/png;");
			imagepng($this->imgSourc);
			imagedestroy($this->imgSourc);
		}
	}

	function createImgSourc()
	{
		$this->imgSourc	= imagecreate($this->width, $this->height);
		$bgcolor	= imagecolorallocate($this->imgSourc, 255, 255, 255);

		//是否生成干扰线
		if($this->line)
		{
			$this->genLine();
		}

		$text	= $this->genStr();
		$strlen	= mb_strlen($text);

		$y		= intval(($this->height-$this->f_size));
		$x		= intval(($this->height-$strlen));

		$textColor	= imagecolorallocate($this->imgSourc, rand(0, 125), rand(0, 125), rand(0, 125));
		imagettftext($this->imgSourc, $this->f_size, 0, $x, $y, $textColor, $this->f_file, $text);

		return $this->imgSourc;
	}

	/**
	 *	干扰线线的生成
	 *	根据$this->lineNum决定生成多少条线，默认为随机生成5~12条
	*/
	function genLine()
	{
		$lineNum	= empty($this->lineNum) ? rand(5, 12) : $this->lineNum;
		for($i = 1; $i <= $lineNum; $i++ )
		{
			$linecolor	= imagecolorallocate($this->imgSourc, rand(0 , 255), rand(0, 255), rand(0, 255));
			imageline($this->imgSourc, rand(1 , $this->width), rand(1, $this->height), rand(1, $this->width), rand(1, $this->height), $linecolor);
		}
	}

	/**
	 *	生成图片里的内容
	 *	@return string
	 */
	function genStr()
	{
		$operArr	= array('+', '*');
		$operNum	= $this->c_type === 2 ? 0 : ($this->c_type === 3 ? 1 : rand(0, 1));

		$numArr[0]	= rand(intval($this->num_1), intval($this->num_2));
		$numArr[1]	= rand(intval($this->num_1), intval($this->num_2));

		if($operNum === 1)
		{
			$numArr[2]	= intval($numArr[0])*intval($numArr[1]);
		}
		else
		{
			$numArr[2]	= intval($numArr[0])+intval($numArr[1]);
		}

		$temp_num	= rand(0, 2);
		self::$this->sess	= $numArr[$temp_num];
		$numArr[$temp_num]	= 'X';
		$string		= $numArr[0].' '.$operArr[$operNum].' '.$numArr[1].' = '.$numArr[2];
		return $string;
	}

	function getValue()
	{
		return self::$this->sess;
	}

}
header("content-type: text/html; charset=utf-8");
$objimg	= new codeimg();
$_SESSION['scode']	= $objimg->getValue();
?>