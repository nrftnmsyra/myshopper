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
$query = $conn->query("SELECT 
                      DATE_FORMAT(pt_date, '%Y-%m') AS month,
                      COUNT(DISTINCT pt_ct_email) AS total
                      FROM 
                      payment
                      JOIN 
                      customer ON payment.pt_ct_email = customer.ct_email
                      GROUP BY 
                      month
                      ORDER BY 
                      month;");

foreach ($query as $data) {
  $month[] = $data['month'];
  $total[] = $data['total'];
}
?>
<?php

$selectInsight = $conn->prepare("SELECT
(SELECT COUNT(*) FROM customer) AS Total_Customers,
(SELECT COUNT(DISTINCT ct.ct_email)
 FROM customer ct
 LEFT JOIN `orders` o ON ct.ct_email = o.order_ct_email
 LEFT JOIN payment p ON ct.ct_email = p.pt_ct_email
 WHERE o.order_date = CURDATE() OR p.pt_date = CURDATE()) AS Active_Customers_Today,
(SELECT COUNT(*) FROM personalshopper) AS Total_Personal_Shoppers,
(SELECT COUNT(DISTINCT ps.ps_email)
 FROM personalshopper ps
 LEFT JOIN `orders` o ON ps.ps_email = o.order_ps_email
 LEFT JOIN payment p ON ps.ps_email = p.pt_ct_email
 WHERE o.order_date = CURDATE() OR p.pt_date = CURDATE()) AS Active_Shoppers_Today");

$selectInsight->execute();
$resultInsight = $selectInsight->get_result();

if ($resultInsight->num_rows > 0) {
  // Fetch the username
  $rowInsight = $resultInsight->fetch_assoc();
  $customer = $rowInsight['Total_Customers'];
  $tcustomer = $rowInsight['Active_Customers_Today'];
  $ps = $rowInsight['Total_Personal_Shoppers'];
  $tps = $rowInsight['Active_Shoppers_Today'];
  ?>

  <body class="bg-gray-100">
    <div class="mt-24 p-4 sm:ml-52 bg-gray-100 h-100">
      <!-- wajib letak -->
      <div class="flex space-x-4">
        <!-- card1 -->
        <div class="w-6/12 bg-white rounded-2xl shadow mr-1">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 text-lg font-bold leading-normal">Customer</p>
                    <h5 class="mb-0 font-semibold">
                      <?php echo $customer; 
                      if ($tcustomer > 0) {
                      ?>
                      <span class="text-xs leading-normal text-lime-500 ml-1.5">
                      (<?php echo $tcustomer; ?> customer active today)
                      </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                      class="mx-auto mt-2.5 w-6 h-6 text-white">
                      <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card2 -->
        <div class="w-6/12 bg-white rounded-2xl shadow">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 text-lg font-bold leading-normal">Personal Shopper</p>
                    <h5 class="mb-0 font-semibold">
                      <?php echo $ps;
                      if ($tps > 0) {
                      ?>
                      <span class="text-xs leading-normal text-lime-500 ml-1.5">
                      (<?php echo $tps; ?> shopper active today)
                      </span>
                      <?php } ?>
                    </h5>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-700 to-blue-500">
                    <svg class="mx-auto mt-2.5 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12.079 4.839a3 3 0 0 0-4.255.1M11 18h1.083A3.916 3.916 0 0 0 16 14.083V7A6 6 0 1 0 4 7v7m7 4v-1a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4V8H3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1V8Z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
} ?>
    <div class="mt-3 flex space-x-4">
      <!-- card1 -->
      <div class="w-6/12 bg-white rounded-2xl shadow mr-1">
        <div class="items-center border-gray-700 justify-between p-4 pt-6">
          <p class="mb-0 text-lg font-bold leading-normal">Monthly Customer Rate</p>
          <span class="text-xs leading-normal text-lime-500">(Active User)
          </span>
          <div class="flex justify-between items-center pt-5">
            <div class="w-full h-1/2 bg-white text-white" style="height: 400px;">
              <canvas class="bg-white h-24" id="myChartDailySales"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="w-6/12 bg-white rounded-2xl shadow mr-1">
        <div class="items-center border-gray-700 justify-between p-4 pt-6">
          <p class="mb-0 text-lg font-bold leading-normal">Top 5 Shopper</p>
          <span class="text-xs leading-normal text-lime-500">(Monthly)
          </span>
          <div class="relative overflow-x-auto sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    Shopper
                  </th>
                  <th scope="col" class="text-center px-6 py-3">
                    Sales
                  </th>
                  <th scope="col" class="text-center px-6 py-3">
                    Rank
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'includes/db.php';

                // Select data from the table with the search condition
                $selectQuery = "SELECT ROW_NUMBER() OVER (ORDER BY SUM(o.order_total_price) DESC) AS rank,
                ps.ps_username AS username,
                ps.ps_img,
                ps.ps_email AS email,
                SUM(o.order_total_price) AS Total_Sales
                FROM
                personalshopper ps
                JOIN
                orders o ON ps.ps_email = o.order_ps_email
                GROUP BY
                ps.ps_email
                ORDER BY
                Total_Sales DESC
                LIMIT 5";
                $result = $conn->query($selectQuery);

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                  // Fetch data from each row
                  while ($row = $result->fetch_assoc()) {
                    // Process data or store it in an array for later use
                    $rank = $row['rank'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $img = $row['ps_img'];
                    $sales = $row['Total_Sales'];
                    ?>
                    <tr class="bg-white border-b">
                      <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <img class="w-10 h-10 rounded-full" src="<?php echo $img; ?>" alt="Jese image">
                        <div class="ps-3">
                          <div class="text-base font-semibold">
                            <?php echo $username; ?>
                          </div>
                          <div class="font-normal text-gray-500">
                            <?php echo $email; ?>
                          </div>
                        </div>
                      </th>
                      <td class="text-center px-6 py-4">
                        RM
                        <?php echo number_format($sales, 2); ?>
                      </td>
                      <?php if ($rank == 1) { ?>
                        <td class="text-center px-6 py-4">
                          <img class="mx-auto w-10 h-10 rounded-full" src="../assets/1st-prize.png">
                        </td>
                      <?php } else if ($rank == 2) { ?>
                          <td class="text-center px-6 py-4">
                            <img class="mx-auto w-10 h-10 rounded-full" src="../assets/2nd-place.png">
                          </td>
                      <?php } else if ($rank == 3) { ?>
                            <td class="text-center px-6 py-4">
                              <img class="mx-auto w-10 h-10 rounded-full" src="../assets/3rd-place.png">
                            </td>
                      <?php } else if ($rank == 4) { ?>
                              <td class="text-center px-6 py-4">
                          <?php echo $rank; ?>
                              </td>
                      <?php } else if ($rank == 5) { ?>
                                <td class="text-center px-6 py-4">
                          <?php echo $rank; ?>
                                </td>
                      <?php } ?>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
      // === include 'setup' then 'config' above ===
      const labels = <?php echo json_encode($month) ?>;
      const data = {
        labels: labels,
        datasets: [{
          label: 'Total Customer Monthly',
          data: <?php echo json_encode($total) ?>,
          backgroundColor: '#3F83F8',
          borderColor: '#3F83F8',
          borderWidth: 1,
          fill: false, // This makes it a line chart without filling the area under the line
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top'
            }
          },
          responsive: true,
          maintainAspectRatio: false, // Add this line to maintain aspect ratio
        },
      };

      var myChart = new Chart(
        document.getElementById('myChartDailySales'),
        config
      );

    </script>



</body>

</html>
<!-- wajib letak -->

</div>
</body>

</html>