<?php

class Load{

public static $authors = [];
public static $names = [];
public static $songs = [];
#public static $chord_out = "";
public static $filenames = [];
public static $fc = 0;
public static $chords = [];

public static function m_generate(){
	$j = 0;
	foreach(self::$filenames as $blob){
		if(isset($_GET['i'])){
			if($j == $_GET['i']){
				echo "<li class='active nav-item'><a class='nav-link' href=?i=$j>".self::$names[$j]."</a></li>";
			}
			else{
				echo "<li class='nav-item'><a class='nav-link' href=?i=$j>".self::$names[$j]."</a></li>";
			}
		}
		else{
			echo "<li class='nav-item'><a class='nav-link' href=?i=$j>".self::$names[$j]."</a></li>";
		}
		$j++;
	}
}

public static function files(){
	$authors = [];
	$names = [];
	$songs = [];
	$chords = [];
	foreach(glob("songs/*.php") as $file)
	{
		array_push(self::$filenames, $file);
		require_once $file;
		self::$chords[self::$fc] = $chords;
        self::$fc++;
	}
	self::$authors = $authors;
	self::$names = $names;
	self::$songs = $songs;
}

public static function c_generate(){
$fc = self::$fc;
if(!isset($_GET['s'])){
	if(isset($_GET['i'])){
	$i = $_GET['i'];
}
else { $i = rand(0,$fc-1);}

if($i < $fc && is_numeric($i)){
#	include(self::$filenames[$i]);
	$chord_out = implode(' ', self::$chords[$i]);
	echo'
		<div id="song" class="post">
			<div class="post-title">
				<h2>'.self::$authors[$i].'</h2>
				<h1>'.self::$names[$i].'</h1>
			</div>
			<div>Akordy: 
			<span class="chords">'.$chord_out.'</span>
			</div>
			<div>'.self::$songs[$i].'</div>
		</div>';
        }
}
else{
	$s = $_GET['s'];
	$input = preg_quote($s, '~');
	$result = preg_grep('~'.$input.'~iu', self::$names);
	$pocet = count($result);
	$keys = array_keys($result);
	echo "<h1>Nalezeno: $pocet výsledků.</h1><hr>";
	foreach ($keys as $key)
		{
		echo "<div class='well'><ul class='navbar-nav nav pt>'";
		echo "<li><div class='card h-100 pl-2 border-left-primary mt-2' onmouseenter='this.className += \" shadow\";' onmouseleave='this.className = \"card h-100 pl-2 border-left-primary mt-2\";'><div class='card-body'><div class='row no-gutters align-items-center'><div class='col mr-2'><a href='?i=$key'>".self::$names[$key]."</a></div></div></div></div></li>";
		echo "</ul></div>";
		}
	}
}
}
?>
