@extends("layouts.master")

@section("title")
  XKCD Password Generator
@endsection

@section("content")
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
            <option {{ $numberOfWords == "3" ? "selected" : "" }}>3</option>
            <option {{ !$numberOfWords || $numberOfWords == "4" ? "selected" : "" }}>4</option>
            <option {{ $numberOfWords == "5" ? "selected" : "" }}>5</option>
            <option {{ $numberOfWords == "6" ? "selected" : "" }}>6</option>
            <option {{ $numberOfWords == "7" ? "selected" : "" }}>7</option>
            <option {{ $numberOfWords == "8" ? "selected" : "" }}>8</option>
          </select>
          <br>
          <label for="ddlNumberOfWords">Word to include(optional):</label>
          <input class="form-control" name="IncludedWord" id="txtIncludedWord" maxlength="10"
            value="{{ old("IncludedWord") ? old("IncludedWord") : $includedWord }}" />

        </div>
        <div class="col-md-6">
          <label>Options:</label>
          <div class="checkbox">
            <label><input type="checkbox" name="chkNumber" {{ $includeNumber ? "checked" : "" }}>Include a number</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="chkSymbol" id="chkSymbol" onclick="ToggleSymbol();"  {{ $includeSymbol ? "checked" : "" }}>Include a symbol</label>
          </div>
          <select class="form-control" name="ddlSymbols" id="ddlSymbols" {{ $includeSymbol ? "" : "disabled" }}>
            <option {{ $chosenSymbol == "!" ? "selected" : "" }}>!</option>
            <option {{ $chosenSymbol == "@" ? "selected" : "" }}>@</option>
            <option {{ $chosenSymbol == "#" ? "selected" : "" }}>#</option>
            <option {{ $chosenSymbol == "$" ? "selected" : "" }}>$</option>
            <option {{ $chosenSymbol == "%" ? "selected" : "" }}>%</option>
            <option {{ $chosenSymbol == "^" ? "selected" : "" }}>^</option>
            <option {{ $chosenSymbol == "&" ? "selected" : "" }}>&amp;</option>
            <option {{ $chosenSymbol == "*" ? "selected" : "" }}>*</option>
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
@endsection

@push("body")
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
@endpush
