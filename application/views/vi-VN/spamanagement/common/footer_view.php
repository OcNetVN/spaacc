            </div>
        </div>
        <footer class="templatemo-footer">
            <div class="templatemo-copyright">
              <p>Copyright &copy; 2015 Thebooking.vn</p>
            </div>
        </footer>
    </div>
    <script src="<?php echo base_url("resources/spamanagement/js/common/jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("resources/spamanagement/js/common/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("resources/spamanagement/js/common/Chart.min.js"); ?>"></script>
    <script src="<?php echo base_url("resources/spamanagement/js/common/templatemo_script.js"); ?>"></script>
    
    <script type="text/javascript">
        // Line chart
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        var lineChartData = {
          labels : ["T1","T2","T3","T4","T5","T6","T7"],
          datasets : [
          {
            label: "Doanh Thu",
            fillColor : "rgba(220,220,220,0.2)",
            strokeColor : "rgba(220,220,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(220,220,220,1)",
            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
          },
          {
            label: "Lượng khách",
            fillColor : "rgba(151,187,205,0.2)",
            strokeColor : "rgba(151,187,205,1)",
            pointColor : "rgba(151,187,205,1)",
            pointStrokeColor : "#fff",
            pointHighlightFill : "#fff",
            pointHighlightStroke : "rgba(151,187,205,1)",
            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
          }
          ]
    
        }
    
        /*window.onload = function(){
          var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
          window.myLine = new Chart(ctx_line).Line(lineChartData, {
            responsive: true
          });
        };*/
    
        $('#myTab a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
        });
    
        $('#loading-example-btn').click(function () {
          var btn = $(this);
          btn.button('loading');
          // $.ajax(...).always(function () {
          //   btn.button('reset');
          // });
      });
  </script>
  <script src="<?php echo base_url("resources/spamanagement/js/common/common_function.js"); ?>"></script>
  <?php 
        echo isset($p_custom_js) ? $p_custom_js : "";
    ?>
</body>
</html>