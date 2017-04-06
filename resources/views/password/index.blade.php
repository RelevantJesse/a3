<!DOCTYPE html>
<html>
<head>

  <title>XKCD Password Generator</title>

  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
  <link href='css/main.css' rel='stylesheet'>
  <script src="scripts/jquery-3.1.1.min.js"></script>
  <script>
  function ToggleSymbol() {
    var c = document.getElementById('chkSymbol');
    if (c.checked) {
      $("#ddlSymbols").prop('disabled', false);
    } else {
      $("#ddlSymbols").prop('disabled', true);
    }
  }
  </script>
</head>
<body class="col-md-12">
  <div class="col-md-3"></div>
  <div class="col-md-6 innerdiv">
    <?php if(count($errors) > 0){ ?>
    <div class="col-md-12 centerdiv">
      <div class="alert alert-danger">
        <ul>
        <?php foreach ($errors->all() as $error): ?>
          <li>{{ $error }}</li>
        <?php endforeach; ?>
      </ul>
      </div>
    </div>
    <?php } ?>

    <div class="centerdiv">
    <h1>XKCD Password Generator</h1>
  </div>
      <form method='GET' class="col-md-12">

        <br>
        <div class="col-md-6">
          <label for="ddlNumberOfWords">Number of words:</label>
          <select class="form-control" name="ddlNumberOfWords" id="ddlNumberOfWords">
            <option <?php if($numberOfWords == "3") echo "selected"; ?>>3</option>
            <option <?php if($numberOfWords == "4" || $numberOfWords == null) echo "selected"; ?>>4</option>
            <option <?php if($numberOfWords == "5") echo "selected"; ?>>5</option>
            <option <?php if($numberOfWords == "6") echo "selected"; ?>>6</option>
            <option <?php if($numberOfWords == "7") echo "selected"; ?>>7</option>
            <option <?php if($numberOfWords == "8") echo "selected"; ?>>8</option>
          </select>
          <br>
          <label for="ddlNumberOfWords">Word to include(optional):</label>
          <input class="form-control" name="IncludedWord" id="txtIncludedWord" maxlength="10"
            value="<?php if(old("IncludedWord")){ echo old("IncludedWord"); } else { echo $includedWord; } ?>" />

        </div>
        <div class="col-md-6">
          <label>Options:</label>
          <div class="checkbox">
            <label><input type="checkbox" name="chkNumber" <?php if(isset($_GET["chkNumber"])) echo "checked"; ?>>Include a number</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="chkSymbol" id="chkSymbol" onclick="ToggleSymbol();" <?php if(isset($_GET["chkSymbol"])) echo "checked"; ?>>Include a symbol</label>
          </div>
          <select class="form-control" name="ddlSymbols" id="ddlSymbols" <?php if(!isset($_GET["chkSymbol"])) echo "disabled"; ?>>
            <option <?php if($chosenSymbol == "!") echo "selected"; ?>>!</option>
            <option <?php if($chosenSymbol == "@") echo "selected"; ?>>@</option>
            <option <?php if($chosenSymbol == "#") echo "selected"; ?>>#</option>
            <option <?php if($chosenSymbol == "$") echo "selected"; ?>>$</option>
            <option <?php if($chosenSymbol == "%") echo "selected"; ?>>%</option>
            <option <?php if($chosenSymbol == "^") echo "selected"; ?>>^</option>
            <option <?php if($chosenSymbol == "&") echo "selected"; ?>>&amp;</option>
            <option>*</option>
          </select>
        </div>
        <div class="col-md-12 spacer"></div>
        <div class="col-md-12 centerdiv">
          <button type="submit" class="btn btn-primary">Generate Password</button>
        </div>

      </form>
    <div class="col-md-12 spacer"></div>
    <?php if($password && count($errors) == 0){ ?>
      <div class="col-md-12 centerdiv">
        <div class="alert alert-success" role="alert">
          Password Generated: {{ $password }}
        </div>
      </div>
      <?php } ?>
    </div>
  <div class="col-md-3"></div>
</body>
</html>
