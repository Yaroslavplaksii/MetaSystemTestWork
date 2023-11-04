<?php
function checkExpression1($exp) {
	if(preg_match('/^[\w\+\-\*\/]*(\({1}[\w\+\-\*\/]*\{{1}[\w\+\-\*\/]*\[{1}[\w\+\-\*\/]*\]{1}[\w\+\-\*\/]*\}{1}[\w\+\-\*\/]*\){1}[\w\+\-\*\/]*|\{{1}[\w\+\-\*\/]*\({1}[\w\+\-\*\/]*\[{1}[\w\+\-\*\/]*\]{1}[\w\+\-\*\/]*\){1}[\w\+\-\*\/]*\}{1}|\[{1}[\w\+\-\*\/]*\({1}[\w\+\-\*\/]*\{{1}[\w\+\-\*\/]*\}{1}[\w\+\-\*\/]*\){1}[\w\+\-\*\/]*\]{1}|\[{1}[\w\+\-\*\/]*\{{1}[\w\+\-\*\/]*\({1}[\w\+\-\*\/]*\){1}[\w\+\-\*\/]*\}{1}[\w\+\-\*\/]*\]{1}|\({1}[\w\+\-\*\/]*\[{1}[\w\+\-\*\/]*\{{1}[\w\+\-\*\/]*\}{1}[\w\+\-\*\/]*\]{1}[\w\+\-\*\/]*\){1}|\{{1}[\w\+\-\*\/]*\[{1}[\w\+\-\*\/]*\({1}[\w\+\-\*\/]*\){1}[\w\+\-\*\/]*\]{1}[\w\+\-\*\/]*\}{1})[\w\+\-\*\/]*$/', $exp)) {
		echo $exp, " Correcr";
	} else {
		echo $exp, " Incorrect";
	}
}
function checkExpression2($exp) {	
	$charsOpen = [];
	$charsClose = [];
	if (strlen($exp)) {
		$addOpenSymb = true;
		for ($i=0; $i<strlen($exp); $i++) {		
			if ($addOpenSymb && $exp{$i} == '{' || $exp{$i} == '(' || $exp{$i} == '[') {	
				if ($addOpenSymb) {				
					array_push($charsOpen, $exp{$i});
				}
			} elseif ($exp{$i} == '}' || $exp{$i} == ')' || $exp{$i} == ']') {	
				$addOpenSymb = false;			
				array_push($charsClose, $exp{$i});
			} 			
		}
	}
	$isCoupleSymbol = false;
	if (count($charsClose) == count($charsOpen)) {
		for ($i=0,$j=count($charsClose)-1; $i<count($charsOpen); $i++,$j--) {
			if (ord($charsClose[$j]) - 1 == ord($charsOpen[$i]) || ord($charsClose[$j]) - 2 == ord($charsOpen[$i])) {
				$isCoupleSymbol = true;
			} else {
				$isCoupleSymbol = false;
				break;
			}
		}
	}
	if ($isCoupleSymbol) {
		echo $exp, " Correcr";
	} else {
		echo $exp, " Incorrect";
	}
}
function checkExpression3($exp) {	
	$charsArray = [];
	if (strlen($exp)) {
		for ($i=0; $i<strlen($exp); $i++) {		
			if ($exp{$i} == '{' || $exp{$i} == '(' || $exp{$i} == '[') {
				array_push($charsArray, $exp{$i});
			} elseif ($exp{$i} == '}' || $exp{$i} == ')' || $exp{$i} == ']') {
				if (ord($exp[$i]) - 1 == ord(end($charsArray)) || ord($exp[$i]) - 2 == ord(end($charsArray))) {
					array_pop($charsArray);	
				} else {
					array_push($charsArray, $exp{$i});
				}	
			}
		}
	}
	if (count($charsArray) == 0) {
		echo $exp, " Correcr";
	} else {
		echo $exp, " Incorrect";
	}
}

$exp = 'str(str{str[{}[])str]str}str))str';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = 'str(str[str{str}str]str)str';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = 'str{str(str[str]str)str}str';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = 'str{str[str(str)str]str}str';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = '({[[]]})';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = '({[[]]}';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = '2*3 +(5*{1-1}) * [6+-4]';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";
$exp = '{2*x + (3+y)- [4x-1]}';
checkExpression1($exp);
echo "<br>";
checkExpression2($exp);
echo "<br>";
checkExpression3($exp);
echo "<br>";

