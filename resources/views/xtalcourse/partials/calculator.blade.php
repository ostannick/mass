<div class="ui styled fluid accordion">
  <div class="title">
    <i class="dropdown icon"></i>
    Open Graphing Calculator
  </div>
  <div class="content">
    <script src="https://www.desmos.com/api/v1.4/calculator.js?apiKey=dcb31709b452b1cf9dc26972add0fda6"></script>
    <div id="calculator" style="width: 100%; height: 400px;"></div>
    <script>
      var elt = document.getElementById('calculator');
      var calculator = Desmos.GraphingCalculator(elt);
      calculator.setExpression({ id: 'graph1', latex: 'y=x^2' });
    </script>

</div>
</div>
