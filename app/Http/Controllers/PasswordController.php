<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
  /**
  * GET
  */
  public function __invoke(Request $request){
    $numberOfWords = $request->input("ddlNumberOfWords", null);
    $includeNumber = $request->has("chkNumber");
    $includeSymbol = $request->has("chkSymbol");
    $chosenSymbol = $request->input("ddlSymbols", null);
    $includedWord = $request->input("IncludedWord", null);
    $password = "";

    if($_GET && $includedWord){
      $this->validate($request, [
        "IncludedWord" => "alpha_num|min:3|max:10"
      ]);
    }

    if($numberOfWords){
      $words = file(database_path()."/wordlist.txt") or die("Unable to open file!");

      $includedWordLocation = rand(0, $numberOfWords - 1);
      $includeNumberLocation = rand(0, $numberOfWords - 1);
      $includeSymbolLocation = rand(0, $numberOfWords - 1);

      for ($x = 0; $x < $numberOfWords; $x++) {
        if($includedWord && $x == $includedWordLocation){
          $password .= $includedWord;
        }
        else{
          $password .= trim($words[rand(0, count($words))]);
        }

        if($includeNumber && $includeNumberLocation == $x){
          $password .= rand(0,9);
        }

        if($includeSymbol && $includeSymbolLocation == $x){
          $password .= $chosenSymbol;
        }

        $password .= "-";
      }

      $password = rtrim($password, "-");
    }

    return view("password.index")->with([
      "numberOfWords" => $numberOfWords,
      "includeNumber" => $includeNumber,
      "includeSymbol" => $includeSymbol,
      "chosenSymbol" => $chosenSymbol,
      "includedWord" => $includedWord,
      "password" => $password
    ]);
  }
}
