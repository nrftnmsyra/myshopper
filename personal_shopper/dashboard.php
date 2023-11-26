<!-- wajib letak -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myShopper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
</head>

<?php include 'includes/navigation.php'; ?>

<?php 
session_start();
// Get user input
$email = $_SESSION["email"];
  include 'includes/db.php';
  $query = $conn->query("SELECT DATE(payment.pt_date) as date, SUM(payment.pt_total_price) as total
                        FROM payment
                        JOIN orders ON payment.pt_id = orders.order_payment_id
                        WHERE orders.order_ps_email = '$email'
                        GROUP BY date");

  foreach($query as $data)
  {
    $date[] = $data['date'];
    $total[] = $data['total'];
  }
  $select = $conn->prepare("SELECT week(payment.pt_date) as week, sum(payment.pt_total_price) as sales FROM payment
  JOIN orders ON payment.pt_id = orders.order_payment_id
  WHERE orders.order_ps_email = ?");
  $select->bind_param("s", $email);
  $select->execute();
  $result = $select->get_result();

  if ($result->num_rows > 0) {
      // Fetch the username
      $row = $result->fetch_assoc();
      $week = $row['week'];
      $sales = $row['sales'];
      }
?>
<body class="bg-gray-900">
    <div class="mt-24 p-4 sm:ml-52 bg-gray-900 h-100">
        <!-- wajib letak --> 
        <div class="flex space-x-4">
    <!-- First div -->
            <div class="w-6/12 bg-white rounded-lg shadow dark:bg-gray-800 mr-1">
                <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">RM<?php echo number_format($sales,2); ?></h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
                    </div>
                </div>
                <div id="labels-chart" class="px-2.5"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
                    <div class="flex justify-between items-center pt-5">
                        <div class="w-full bg-gray-200 text-white">
                            <canvas class="bg-gray-800" id="myChartDailySales"></canvas>
                        </div>
                    </div>
                </div>
            </div>
<?php

$query1 = $conn->query("SELECT DATE(payment.pt_date) as date, COUNT(orders.order_code) as total_order
                        FROM payment
                        JOIN orders ON payment.pt_id = orders.order_payment_id
                        WHERE orders.order_ps_email = '$email'
                        GROUP BY date");

foreach($query1 as $data1)
{
$date1[] = $data1['date'];
$total_order[] = $data1['total_order'];
}

$select2 = $conn->prepare("SELECT week(payment.pt_date) as week, COUNT(orders.order_code) as total_order_week FROM payment
JOIN orders ON payment.pt_id = orders.order_payment_id
WHERE orders.order_ps_email = ?");
$select2->bind_param("s", $email);
$select2->execute();
$result2 = $select2->get_result();

if ($result2->num_rows > 0) {
    // Fetch the username
    $row2 = $result2->fetch_assoc();
    $week2 = $row2['week'];
    $order_week = $row2['total_order_week'];
    }
?>
            <div class="w-6/12 bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
                    <div class="flex items-baseline">
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white"><?php echo $order_week; ?></h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400 ml-2">Orders this week</p>
                    </div>
                </div>
                <div id="labels-chart" class="px-2.5"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
                    <div class="flex justify-between items-center pt-5">
                        <div class="w-full bg-gray-200 text-white">
                            <canvas class="bg-gray-800" id="myChartDailyOrder"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'My Daily Sales',
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
  const labels2 = <?php echo json_encode($date1) ?>;
  const data2 = {
    labels: labels2,
    datasets: [{
      label: '',
      data: <?php echo json_encode($total_order) ?>,
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