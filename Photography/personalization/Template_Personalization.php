<?php
ini_set("display_errors", "1"); // per mostrar els errors

class T_Personalization {
	var $about_me_title;
	var $about_me_text;
	var $my_work_title;
	var $my_work_text;
	var $bottom;
	var $title_page;
	var $header1;
	var $header2;
	
	// Social networks
	var $twitter;
	var $youtube;
	var $googleP;
	var $facebook;
	
	function __construct(){
		if(file_exists('personalization/pers.json')
		|| file_exists('../personalization/pers.json') 
		|| file_exists('pers.json')){
			$this -> copyJson();
		} else{
			$this -> createJson();
		}
	}
	
	private function copyJson(){
		if (file_exists('personalization/pers.json'))
			$obj = json_decode(file_get_contents('personalization/pers.json'));
		else if(file_exists('../personalization/pers.json'))
			$obj = json_decode(file_get_contents('../personalization/pers.json'));
		else if (file_exists(file_exists('pers.json')))
			$obj = json_decode(file_get_contents('pers.json'));
		
		$this -> about_me_text = $obj -> about_me_text;
		$this -> about_me_title = $obj -> about_me_title;
		$this -> title_page = $obj -> title_page;
		$this -> my_work_text = $obj -> my_work_text;
		$this -> my_work_title = $obj -> my_work_title;
		$this -> bottom = $obj -> bottom;
		$this -> twitter = $obj -> twitter;
		$this -> youtube = $obj -> youtube;
		$this -> googleP = $obj -> googleP;
		$this -> facebook = $obj -> facebook;
		$this -> header1 = $obj -> header1;
		$this -> header2 = $obj -> header2;
	}
	
	function modifyJson(){ // Lo vuelve a crear, realmente
		$jsonencoded = json_encode($this);
		if (file_exists('pers.json')){
			unlink('pers.json');
		}
		$fh = fopen("pers.json", 'w');
		//else echo '<alert> No existe la carpeta personalitzation</alert>';
		fwrite($fh, $jsonencoded);
		fclose($fh);
	}
	
	function print_about_me_title(){
		echo $this -> about_me_title;
	}
	
	function print_about_me_text(){
		echo $this -> about_me_text;
	}
	
	function print_my_work_title(){
		echo $this -> my_work_title;
	}
	
	function print_my_work_text(){
		echo $this -> my_work_text;
	}
	
	function print_bottom(){
		echo $this -> bottom;
	}
	
	function print_title_page(){
		echo $this -> title_page;
	}
	
	function print_facebook(){
		echo $this->facebook;
	}
	
	function print_twitter(){
		echo $this->twitter;
	}
	
	function print_youtube(){
		echo $this->youtube;
	}
	
	function print_googleP(){
		echo $this->googleP;
	}
	
	function print_header1(){
		echo $this->header1;
	}
	
	function print_header2(){
		echo $this->header2;
	}
	function createJson(){
		// About me
		$this -> about_me_text = utf8_encode("Hey there, my name is Mariam
		 and I am a photographer!
		 This is my brand new portfolio. It's super cool
		because it's completely responsive! That means
		 you can re-size it to whatever
		size you like and it always looks great. Have a look around and enjoy.");
		$this -> about_me_title = utf8_encode("About me");
		
		//header
		$this -> header1 = utf8_encode("Hello there, I'm <span>Mariam</span>. Welcome to my design portfolio!");
		$this -> header2 = utf8_encode(" Photographer ");
		
		// My work
		$this -> my_work_text = utf8_encode("Below, you will be able to find lots of my work. I take loads of pretty pictures and I also make websites. If you like what you see then you can contact me below! Maybe you would like to hire me or just have a chat, either way, I look forward to hearing from you.");
		$this -> my_work_title = utf8_encode("My work");
		
		// bottom
		$this -> bottom = utf8_encode("Thanks for looking at my new website!");
		// Title page
		$this -> title_page = utf8_encode("Mariam");
		
		// --> Social networks
		$this -> twitter = utf8_encode("https://twitter.com/Sra_Krueger");
		$this -> facebook = utf8_encode("https://www.facebook.com/mariam.martinezortiz");
		$this -> googleP = utf8_encode("http://plus.google.co.uk/");
		$this -> youtube = utf8_encode("http://www.youtube.com/user/esarabellissimo");
		
		$jsonencoded = json_encode($this);
		if (is_dir('personalization'))
			$fh = fopen("personalization/pers.json", 'w');
		else if(is_dir('../personalitzation'))
			$fh = fopen("../personalization/pers.json", 'w');
		else echo '<alert> No existe la carpeta personalitzation</alert>';
		fwrite($fh, $jsonencoded);
		fclose($fh);
		
	}
	
}
//$t = new T_Personalization();
//$t -> createJson();
?>