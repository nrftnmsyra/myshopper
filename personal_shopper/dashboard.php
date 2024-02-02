<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>myShopper</title>
  <link rel="icon" type="image/x-icon" href="../assets/logo1.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<?php
session_start();
// Get user input
$email = $_SESSION["email"];
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $selectedMonth = $_POST["month"];
  $selectedYear = $_POST["year"];
} else {
  // Default to the current month and year if not submitted
  $selectedMonth = date('n');
  $selectedYear = date('Y');
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $query = $conn->query("SELECT DATE(payment.pt_date) as date, SUM(payment.pt_total_price) as total
                          FROM payment
                          JOIN orders ON payment.pt_id = orders.order_payment_id
                          WHERE orders.order_ps_email = '$email'
                          AND MONTH(payment.pt_date) = '$selectedMonth'
                          AND YEAR(payment.pt_date) = '$selectedYear'
                          GROUP BY date");
} else {
  $query = $conn->query("SELECT DATE(payment.pt_date) as date, SUM(payment.pt_total_price) as total
  FROM payment
  JOIN orders ON payment.pt_id = orders.order_payment_id
  WHERE orders.order_ps_email = '$email'
  AND MONTH(payment.pt_date) = '$selectedMonth'
  AND YEAR(payment.pt_date) = '$selectedYear'
  GROUP BY date");
}

foreach ($query as $data) {
  $date[] = $data['date'];
  $total[] = $data['total'];
}

// Rest of your code...
?>





<body class="bg-gray-900">
  <div class="mt-24 p-4 sm:ml-52 bg-gray-900 h-100">
    <!-- wajib letak -->

    <?php
    $order_date = date("Y/m/d");
    $selectInsight = $conn->prepare("WITH TodaySales AS (
      SELECT
          ps.ps_email AS personalshopper_email,
          COUNT(DISTINCT o.order_ct_email) AS today_customers,
          COUNT(DISTINCT o.order_id) AS today_orders,
          SUM(p.pt_total_price) AS today_sales,
          ps.ps_fee * COUNT(DISTINCT o.order_id) AS total_fee
      FROM
          personalshopper ps
      LEFT JOIN orders o ON ps.ps_email = o.order_ps_email
      LEFT JOIN payment p ON o.order_payment_id = p.pt_id
      WHERE
          p.pt_date = '$order_date'
      GROUP BY
          ps.ps_email
  )
  
  SELECT
      ps.ps_email AS personalshopper_email,
      COALESCE(SUM(p.pt_total_price), 0) AS total_sales,
      COALESCE(COUNT(DISTINCT o.order_ct_email), 0) AS total_customers,
      COALESCE(COUNT(DISTINCT o.order_id), 0) AS total_orders,
      COALESCE(SUM(p.pt_total_price - ps.ps_fee), 0) AS total_sales_after_fee,
      COALESCE(ts.today_customers, 0) AS today_customers,
      COALESCE(ts.today_orders, 0) AS today_orders,
      COALESCE(ts.today_sales, 0) AS today_sales,
      COALESCE(ps.ps_fee * COUNT(DISTINCT o.order_id), 0) AS total_fee,
      COALESCE(ps.ps_fee * today_orders, 0) AS today_profit
  FROM
      personalshopper ps
  LEFT JOIN orders o ON ps.ps_email = o.order_ps_email
  LEFT JOIN payment p ON o.order_payment_id = p.pt_id
  LEFT JOIN TodaySales ts ON ps.ps_email = ts.personalshopper_email
  WHERE
      ps.ps_email = ?");
    $selectInsight->bind_param("s", $email);
    $selectInsight->execute();
    $resultInsight = $selectInsight->get_result();

    if ($resultInsight->num_rows > 0) {
      // Fetch the username
      $rowInsight = $resultInsight->fetch_assoc();
      $profit = $rowInsight['total_sales'] - $rowInsight['total_sales_after_fee'];
      $tprofit = $rowInsight['today_profit'];
      $sales = $rowInsight['total_sales'];
      $tsales = $rowInsight['today_sales'];
      $customer = $rowInsight['total_customers'];
      $tcustomer = $rowInsight['today_customers'];
      $order = $rowInsight['total_orders'];
      $torder = $rowInsight['today_orders'];
      ?>
      <div class="flex flex-wrap -mx-3 mb-5">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <div class="flex items-center">
                      <p class="mb-0 text-lg font-bold leading-normal">Profit</p>
                      <p class="ml-2 text-xs font-normal text-gray-400">(Shopper's Total Fee)</p>
                    </div>
                    <h5 class="mb-0 font-bold">
                      RM
                      <?php echo number_format($profit, 2); ?>
                      <?php if ($tprofit > 0) { ?>
                        <span class="text-xs leading-normal text-lime-500">+RM
                          <?php echo number_format($tprofit, 2); ?>
                        </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg class="mt-2.5 ml-2.5 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 19 20">
                      <path
                        d="M18.972.863a.913.913 0 0 0-.041-.207.956.956 0 0 0-.107-.19 1.01 1.01 0 0 0-.065-.116c-.008-.01-.02-.013-.028-.022a1.008 1.008 0 0 0-.174-.137 1.085 1.085 0 0 0-.141-.095 1.051 1.051 0 0 0-.171-.047.985.985 0 0 0-.207-.041C18.025.007 18.014 0 18 0h-3.207a1 1 0 1 0 0 2h.5l-4.552 3.9-3.5-.874a1 1 0 0 0-.867.189l-5 4a1 1 0 0 0 1.25 1.562L7.238 7.09l3.52.88a1 1 0 0 0 .892-.211L17 3.173v1.034a1 1 0 0 0 2 0V1a.9.9 0 0 0-.028-.137ZM13.5 9a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11Zm.24 4.591a3.112 3.112 0 0 1 1.935 1.374 2.036 2.036 0 0 1 .234 1.584 2.255 2.255 0 0 1-1.374 1.469.982.982 0 0 1-1.953.09 2.943 2.943 0 0 1-1.475-.92 1 1 0 0 1 1.536-1.283.953.953 0 0 0 .507.29.778.778 0 0 0 .831-.18 1.108 1.108 0 0 0-.714-.481 3.105 3.105 0 0 1-1.934-1.374 2.042 2.042 0 0 1-.233-1.584 2.264 2.264 0 0 1 1.45-1.493v-.03a1 1 0 0 1 2 0c.517.159.98.457 1.337.862a1.002 1.002 0 1 1-1.524 1.3.962.962 0 0 0-.507-.286.775.775 0 0 0-.829.18 1.113 1.113 0 0 0 .713.482ZM6 20a1 1 0 0 1-1-1v-6a1 1 0 1 1 2 0v6a1 1 0 0 1-1 1Zm-4 0a1 1 0 0 1-1-1v-4a1 1 0 1 1 2 0v4a1 1 0 0 1-1 1Z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 text-lg font-bold leading-normal">Customer</p>
                    <h5 class="mb-0 font-bold">
                      <?php echo $customer; ?>
                      <?php if ($tcustomer > 0) { ?>
                        <span class="text-xs leading-normal text-lime-500">+
                          <?php echo $tcustomer; ?> Customers
                        </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg class="mt-2.5 ml-2.5 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 20 20">
                      <path
                        d="M10 .5a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19ZM8.374 17.4a7.6 7.6 0 0 1-5.9-7.4c0-.83.137-1.655.406-2.441l.239.019a3.887 3.887 0 0 1 2.082 2.5 4.1 4.1 0 0 0 2.441 2.8c1.148.522 1.389 2.007.732 4.522Zm3.6-8.829a.997.997 0 0 0-.027-.225 5.456 5.456 0 0 0-2.811-3.662c-.832-.527-1.347-.854-1.486-1.89a7.584 7.584 0 0 1 8.364 2.47c-1.387.208-2.14 2.237-2.14 3.307a1.187 1.187 0 0 1-1.9 0Zm1.626 8.053-.671-2.013a1.9 1.9 0 0 1 1.771-1.757l2.032.619a7.553 7.553 0 0 1-3.132 3.151Z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 text-lg font-bold leading-normal">Order</p>
                    <h5 class="mb-0 font-bold">
                      <?php echo $order; ?>
                      <?php if ($torder > 0) { ?>
                        <span class="text-xs leading-normal text-lime-500">+
                          <?php echo $torder; ?> Orders
                        </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg class="mt-2.5 ml-2.5 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 18 21">
                      <path
                        d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <div class="flex items-center">
                      <p class="mb-0 text-lg font-bold leading-normal">Sale</p>
                      <p class="ml-2 text-xs font-normal text-gray-400">(Sale + Profit)</p>
                    </div>

                    <h5 class="mb-0 font-bold">
                      RM
                      <?php echo number_format($sales, 2); ?>
                      <?php if ($tsales > 0) { ?>
                        <span class="text-xs leading-normal text-lime-500">+RM
                          <?php echo number_format($tsales, 2); ?>
                        </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg class="mt-2.5 ml-2.5 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 11 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1.75 15.363a4.954 4.954 0 0 0 2.638 1.574c2.345.572 4.653-.434 5.155-2.247.502-1.813-1.313-3.79-3.657-4.364-2.344-.574-4.16-2.551-3.658-4.364.502-1.813 2.81-2.818 5.155-2.246A4.97 4.97 0 0 1 10 5.264M6 17.097v1.82m0-17.5v2.138" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }
    ?>
    <div class="">
      <form id="filterForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="flex items-center space-x-4">
          <select
            class="border text-sm rounded-lg block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
            name="month" id="month" onchange="updateSelectedValues();">
            <?php
            for ($i = 1; $i <= 12; $i++) {
              $monthName = date("F", mktime(0, 0, 0, $i, 1));
              $selected = ($i == date('n')) ? 'selected' : '';
              echo "<option value='$i' $selected>$monthName</option>";
            }
            ?>
          </select>

          <input type="number"
            class="border text-sm rounded-lg block p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
            name="year" id="year" value="<?php echo date('Y'); ?>" min="1900" max="2100"
            oninput="updateSelectedValues();">

          <input
            class="py-2.5 px-5 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-gray-700 bg-gray-800 text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700"
            type="submit" value="Filter">
        </div>
      </form>
    </div>
    <div class="mt-5 flex space-x-4">
      <!-- First div -->
      <div class="w-6/12 rounded-2xl shadow bg-gray-800 mr-1">

        <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
          <div class="flex items-baseline items-center">
            <p class="ml-2.5 text-base font-semibold text-white w-full text-center mx-auto">Monthly Sale for
              <?php echo date("F", mktime(0, 0, 0, $selectedMonth, 10)) . ' ' . $selectedYear; ?>
            </p>
          </div>
        </div>
        <div id="labels-chart" class="px-2.5"></div>
        <div class="items-center border-t border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
          <div class="flex justify-between items-center pt-5">
            <div class="w-full bg-gray-200 text-white">
              <canvas class="bg-gray-800" id="myChartDailySales"></canvas>
            </div>
          </div>
        </div>
      </div>
      <?php
      session_start();
      // Get user input
      $email = $_SESSION["email"];
      // Fetch data for total orders by week
      $selectW = $conn->prepare("SELECT week(payment.pt_date) as week, COUNT(orders.order_code) as total_order_week FROM payment
      JOIN orders ON payment.pt_id = orders.order_payment_id
      WHERE orders.order_ps_email = ?");
      $selectW->bind_param("s", $email);
      $selectW->execute();
      $resultW = $selectW->get_result();

      if ($resultW->num_rows > 0) {
        // Fetch the username
        $row = $resultW->fetch_assoc();
        $weekW = $row['week'];
        $order_week = $row['total_order_week'];
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedMonthO = $_POST["month"];
        $selectedYearO = $_POST["year"];
      } else {
        // Default to the current month and year if not submitted
        $selectedMonthO = date('n');
        $selectedYearO = date('Y');
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $stmt = $conn->query("SELECT DATE(payment.pt_date) as date, COUNT(orders.order_code) as total_order
        FROM payment
        JOIN orders ON payment.pt_id = orders.order_payment_id
        WHERE orders.order_ps_email = '$email' AND MONTH(payment.pt_date) = '$selectedMonth' AND YEAR(payment.pt_date) = '$selectedYear'
        GROUP BY date");

      } else {
        // Default values for Graph 2 (total orders by date)
        $stmt = $conn->query("SELECT DATE(payment.pt_date) as date, COUNT(orders.order_code) as total_order
        FROM payment
        JOIN orders ON payment.pt_id = orders.order_payment_id
        WHERE orders.order_ps_email = '$email' AND MONTH(payment.pt_date) = '$selectedMonth' AND YEAR(payment.pt_date) = '$selectedYear'
        GROUP BY date");
      }

      foreach ($stmt as $data2) {
        $date3[] = $data2['date'];
        $total3[] = $data2['total_order'];
      }
      ?>

      <div class="w-6/12 rounded-2xl shadow bg-gray-800">
        <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
          <div class="flex items-baseline">
            <p class="ml-2.5 text-base font-semibold text-white w-full text-center mx-auto">Monthly Order for
              <?php echo date("F", mktime(0, 0, 0, $selectedMonth, 10)) . ' ' . $selectedYear; ?>
            </p>
          </div>
        </div>
        <div id="labels-chart" class="px-2.5"></div>
        <div
          class="grid grid-cols-1 items-center border-t border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
          <div class="flex justify-between items-center pt-5">
            <div class="w-full text-white">
              <canvas class="bg-gray-800" id="myChartDailyOrder"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      // Function to update selected values for both graphs
      function updateSelectedValues() {
        // Update JavaScript variables with selected values
        selectedMonth = document.getElementById('month').value;
        selectedYear = document.getElementById('year').value;

        // Update localStorage for both sets of variables
        localStorage.setItem('selectedMonth', selectedMonth);
        localStorage.setItem('selectedYear', selectedYear);

        // Update selected values for both graphs
        selectedMonthO = selectedMonth;
        selectedYearO = selectedYear;

        // Update form elements for both graphs
        document.getElementById('month').value = selectedMonth;
        document.getElementById('year').value = selectedYear;
      }
    </script>







    <script>
      // === include 'setup' then 'config' above ===
      const labels = <?php echo json_encode($date) ?>;
      const data = {
        labels: labels,
        datasets: [{
          label: 'Daily Sales',
          data: <?php echo json_encode($total) ?>,
          backgroundColor: '#3F83F8',
          borderColor: '#3F83F8',
          borderWidth: 1,
          fill: false, // This makes it a line chart without filling the area under the line
          tension: 0.4,
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {
          plugins: {
            legend: {
              labels: {
                color: 'rgba(255, 255, 255)', // Change the color of the legend labels
              },
              title: {
                color: 'rgba(255, 255, 255)', // Change the color of the legend title
              },
            },
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: '#374151', // Change the color of the grid lines on the y-axis
              },
              ticks: {
                color: 'rgba(255, 255, 255)', // Change the color of the y-axis labels
              },
              title: {
                display: true,
                text: 'Sales (RM)', // Add label for the y-axis
                color: 'rgba(255, 255, 255)', // Set color for the label
              },
            },
            x: {
              grid: {
                color: '#374151', // Change the color of the grid lines on the x-axis
              },
              ticks: {
                color: 'rgba(255, 255, 255)', // Change the color of the x-axis labels
              },
              title: {
                display: true,
                text: 'Date', // Add label for the y-axis
                color: 'rgba(255, 255, 255)', // Set color for the label
              },
            },
          },
        },
      };

      var myChart = new Chart(
        document.getElementById('myChartDailySales'),
        config
      );
    </script>

    <script>
      // === include 'setup' then 'config' above ===
      const labels2 = <?php echo json_encode($date3); ?>;
      const data2 = {
        labels: labels2,
        datasets: [{
          label: '',
          data: <?php echo json_encode($total3); ?>,
          backgroundColor: [
            'rgba(63,131,248, 0.2)'
          ],
          borderColor: [
            'rgb(63,131,248)'
          ],
          borderWidth: 1
        }]
      };

      const config2 = {
        type: 'bar',
        data: data2,
        options: {
          title: {
            display: true,
            text: 'Bar Chart Title', // Your title here
          },
          plugins: {
            legend: {
              display: false, // Hide the legend
              labels: {
                color: 'rgba(255, 255, 255)', // Change the color of the legend labels
              },
              title: {
                color: 'rgba(255, 255, 255)', // Change the color of the legend title
              },
            },
          },
          scales: {
            y: {
              precision: 0,
              beginAtZero: true,
              grid: {
                color: '#374151', // Change the color of the grid lines on the y-axis
              },
              ticks: {
                color: 'rgba(255, 255, 255)', // Change the color of the y-axis labels
              },
              title: {
                display: true,
                text: 'Total Orders', // Add label for the y-axis
                color: 'rgba(255, 255, 255)', // Set color for the label
              },
            },
            x: {
              grid: {
                color: '#374151', // Change the color of the grid lines on the x-axis
              },
              ticks: {
                color: 'rgba(255, 255, 255)', // Change the color of the x-axis labels
              },
              title: {
                display: true,
                text: 'Date', // Add label for the y-axis
                color: 'rgba(255, 255, 255)', // Set color for the label
              },
            },
          },
        },
      };


      var myChart2 = new Chart(
        document.getElementById('myChartDailyOrder'),
        config2
      );
    </script>


</body>

</html>
<!-- wajib letak -->

</div>
</body>

</html>