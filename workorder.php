<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Biomedical IQ</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    .edit-button, .delete-button {
        padding: 5px;
        margin: 2px;
        border: none;
        background-color: transparent; /* Make the background transparent */
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s; /* Smooth transition */
    }

    .edit-button:hover {
        background-color: #e0e0e0; /* Light grey on hover */
    }

    .delete-button:hover {
        background-color: #f44336; /* Light red on hover */
    }

    .edit-button i, .delete-button i {
        font-size: 16px; /* Adjust icon size */
        color: #4CAF50; /* Green for edit */
    }

    .delete-button i {
        color: #f44336; /* Red for delete */
    }
</style>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="img/logo.png" alt="">
        <span class="d-none d-lg-block">Biomedical IQ</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

        <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?></h6>
                    <span><?php echo isset($_SESSION['job']) ? htmlspecialchars($_SESSION['job']) : 'No Job Specified'; ?></span> <!-- Display the job title -->
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="profile.php">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <!-- Existing Wards -->
          <li>
            <a href="Equipment.php">
              <i class="bi bi-circle"></i>
              <span id="ward-a-name">Ward A</span>
            </a>
            <i class="bi bi-pencil edit-icon ms-2" onclick="enableEdit('ward-a-name')" style="cursor: pointer; font-size: 15px;"></i>
            <i class="bi bi-trash delete-icon ms-2" onclick="deleteWard('ward-a-name')" style="cursor: pointer; font-size: 15px;"></i>
          </li>
          <li>
            <a href="ward.php">
              <i class="bi bi-circle"></i>
              <span id="ward-b-name">Ward B</span>
            </a>
            <i class="bi bi-pencil edit-icon ms-2" onclick="enableEdit('ward-b-name')" style="cursor: pointer; font-size: 15px;"></i>
            <i class="bi bi-trash delete-icon ms-2" onclick="deleteWard('ward-b-name')" style="cursor: pointer; font-size: 15px;"></i>
          </li>
          <!-- Add New Ward Button -->
          <li>
            <a href="#" onclick="addNewWard()">
              <i class="bi bi-circle"></i><span>Add Ward +</span>
            </a>
          </li>
        </ul>
      </li>
      
      
<!-- End of Inventory nav       -->
      

      
<li class="nav-item">
  <a href="workorder.php">
    <i class="bi bi-journal-text"></i><span>Work Order</span>
  </a>
</li><!-- End Forms Nav -->

<li class="nav-item">
  <a  href="repair.php">
    <i class="bi bi-layout-text-window-reverse"></i><span>Repair & Maintainence</span>
  </a>
</li>
<!-- End Tables Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-bar-chart"></i>
    <span>Trends in Biomedical Engineering</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>

  <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="https://www.gilero.com/news/biomedical-engineering-inventions/" target="_blank">
        <i class="bi bi-circle"></i>
        <span>Gilero</span>
      </a>
    </li>
    <li>
      <a href="https://online-engineering.case.edu/blog/emerging-trends-in-biomedical-engineering" target="_blank">
        <i class="bi bi-circle"></i>
        <span>Case Western Reserve University</span>
      </a>
    </li>
    <li>
      <a href="https://www.bolton.ac.uk/blogs/biomedical-engineering-innovations-you-need-to-know" target="_blank">
        <i class="bi bi-circle"></i>
        <span>University Of Boston</span>
      </a>
    </li>
    <li>
      <a href="https://kahedu.edu.in/top-10-biomedical-engineering-innovations-in-the-last-decade/" target="_blank">
        <i class="bi bi-circle"></i>
        <span>Karpagam</span>
      </a>
    </li>
    <li>
      <a href="https://today.ucsd.edu/story/five-cutting-edge-advances-in-biomedical-engineering-and-their-applications-in-medicine" target="_blank">
        <i class="bi bi-circle"></i>
        <span>Uc San Diego</span>
      </a>
    </li>
    <li>
      <a href="https://fastercapital.com/content/Biomedical-engineering-innovation-Revolutionizing-Healthcare--Biomedical-Engineering-Innovations.html" target="_blank">
        <i class="bi bi-circle"></i>
        <span>Faster Capital</span>
      </a>
    </li>
  </ul>
</li>

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
<section>
  <div class="work-order-section">
    <h2 class="headers">Work Order</h2>
    <p class="content">This section provides details about the work order. Please review the information and proceed accordingly.</p>
    <div class="button-container">
      <button class="add-work-orderbtn" id="addWorkOrderBtn"><i class="fas fa-plus"></i> Add Work Order</button>
  </div>
</div>
<!-- Second div for table header -->
<div class="table-header">
  <div>
    <button id="downloadBtn" title="Download">
        <i class="fas fa-download"></i> Download Data
    </button>
</div>
  <table class="table">
      <thead>
          <tr>
              <th>Date</th>
              <th>Name of Equipment</th>
              <th>Manufacturer</th>
              <th>Serial Number</th>
              <th>Model Number</th>
              <th>Fault of the Equipment</th>
              <th>Troubleshooting Technique</th>
              <th>Repair</th>
              <th>Engineer In Charge</th>
          </tr>
      </thead>
      <tbody id="workOrderBody">

        </div>
        <!-- Dynamic table rows will be inserted here -->
    </tbody>
  </table>
</div>
<!-- The Modal -->
<div id="workOrderModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Add Work Order Details</h3>
    <form id="workOrderForm" action="submit_work_order.php" method="POST">
      <input type="date" id="date" name="date" required placeholder="Date">
      <input type="text" id="equipmentName" name="equipmentName" required placeholder="Name of Equipment">
      <input type="text" id="manufacturer" name="manufacturer" required placeholder="Manufacturer">
      <input type="text" id="serialNumber" name="serialNumber" required placeholder="Serial Number">
      <input type="text" id="modelNumber" name="modelNumber" required placeholder="Model Number">
      <textarea id="fault" name="fault" required placeholder="Fault of the Equipment" rows="3"></textarea>
      <textarea id="troubleshooting" name="troubleshooting" required placeholder="Troubleshooting Technique" rows="3"></textarea>
      <textarea id="repair" name="repair" required placeholder="Repair" rows="3"></textarea>
      <input type="text" id="engineer" name="engineer" required placeholder="Engineer In Charge">
      <div class="button-group">
          <button type="submit" class="btn">Submit</button>
          <button type="button" class="btn cancel" id="cancelButton">Cancel</button>
      </div>
    </form>
 </div>
 
</div>
</section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>AlagbeWidad</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="vendor/apexcharts/apexcharts.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/chart.umd.js"></script>
  <script src="vendor/echarts/echarts.min.js"></script>
  <script src="vendor/quill/quill.js"></script>
  <script src="vendor/simple-datatables/simple-datatables.js"></script>
  <script src="vendor/tinymce/tinymce.min.js"></script>
  <script src="vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
  <script>
    let wardCount = 2; // Track how many wards are added, starting after Ward A and Ward B

// Function to add a new ward
function addNewWard() {
  // Increment the ward count to create a unique ID
  wardCount++;
  const newWardId = `ward-${wardCount}-name`;
  const newWardName = `Ward ${String.fromCharCode(65 + wardCount - 1)}`; // Generate name: Ward C, Ward D, etc.

  // Create a new list item element for the ward
  const newWardItem = document.createElement('li');
  newWardItem.innerHTML = `
    <a href="#">
      <i class="bi bi-circle"></i>
      <span id="${newWardId}">${newWardName}</span>
    </a>
    <i class="bi bi-pencil edit-icon ms-2" onclick="enableEdit('${newWardId}')" style="cursor: pointer; font-size: 15px;"></i>
    <i class="bi bi-trash delete-icon ms-2" onclick="deleteWard('${newWardId}')" style="cursor: pointer; font-size: 15px;"></i>
  `;

  // Append the new ward item to the list
  const wardList = document.getElementById('components-nav');
  wardList.appendChild(newWardItem);
}

// Function to enable editing of the ward name
function enableEdit(wardId) {
  const wardElement = document.getElementById(wardId);

  // Store the original text in case the user wants to cancel
  const originalText = wardElement.textContent;

  // Create an input field to replace the ward name
  const input = document.createElement('input');
  input.type = 'text';
  input.value = originalText;
  input.style.width = '80px'; // Adjust input width to fit within the space
  input.style.backgroundColor = '#f0f0f0'; // Background color for edit mode

  // Replace the ward name with the input field
  wardElement.textContent = ''; // Clear the current ward name
  wardElement.appendChild(input);
  input.focus();

  // Save changes on Enter key or click outside the input field
  input.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
      saveWardName(wardId, input.value);
    }
  });

  // Handle saving if clicked outside the input box (blur event)
  input.addEventListener('blur', function() {
    saveWardName(wardId, input.value);
  });
}

// Function to save the ward name
function saveWardName(wardId, newName) {
  const wardElement = document.getElementById(wardId);

  // Remove the input field and set the new ward name
  wardElement.textContent = newName;
}

// Function to delete the ward
function deleteWard(wardId) {
  const wardElement = document.getElementById(wardId).parentElement;

  if (confirm('Are you sure you want to delete this ward?')) {
    wardElement.remove();
  }
}
  </script>
 <script>
  const modal = document.getElementById("workOrderModal");
  const btn = document.getElementById("addWorkOrderBtn");
  const span = document.getElementsByClassName("close")[0];
  let currentEditIndex = -1; // Track the index of the row being edited

  btn.onclick = function() {
      modal.style.display = "block";
      currentEditIndex = -1; // Reset edit index
  }

  span.onclick = function() {
      modal.style.display = "none";
  }

  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }

  document.getElementById('workOrderForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

      // Get form values
      const date = document.getElementById('date').value;
      const equipmentName = document.getElementById('equipmentName').value;
      const manufacturer = document.getElementById('manufacturer').value;
      const serialNumber = document.getElementById('serialNumber').value;
      const modelNumber = document.getElementById('modelNumber').value;
      const fault = document.getElementById('fault').value;
      const troubleshooting = document.getElementById('troubleshooting').value;
      const repair = document.getElementById('repair').value;
      const engineer = document.getElementById('engineer').value;

      // Create a new row
      const newRow = {
          date,
          equipmentName,
          manufacturer,
          serialNumber,
          modelNumber,
          fault,
          troubleshooting,
          repair,
          engineer
      };

      let workOrders = JSON.parse(localStorage.getItem('workOrders')) || [];

      // Check if we're editing an existing row
      if (currentEditIndex > -1) {
          workOrders[currentEditIndex] = newRow; // Update existing row
      } else {
          workOrders.push(newRow); // Add new row to work orders
      }

      // Save updated work orders to local storage
      localStorage.setItem('workOrders', JSON.stringify(workOrders));

      // Add row to table
      addRowToTable(newRow, workOrders.length - 1); // Pass the new row's index

      // Reset form and hide modal
      document.getElementById('workOrderForm').reset();
      modal.style.display = "none";
  });

  function addRowToTable(rowData, index) {
      const tableBody = document.getElementById('workOrderBody');
      const newRow = document.createElement('tr');

      newRow.innerHTML = `
          <td>${rowData.date}</td>
          <td>${rowData.equipmentName}</td>
          <td>${rowData.manufacturer}</td>
          <td>${rowData.serialNumber}</td>
          <td>${rowData.modelNumber}</td>
          <td>${rowData.fault}</td>
          <td>${rowData.troubleshooting}</td>
          <td>${rowData.repair}</td>
          <td>${rowData.engineer}</td>
          <td>
              <button class="edit-button" onclick="editRow(${index})" title="Edit">
                  <i class="fas fa-edit"></i>
              </button>
              <button class="delete-button" onclick="deleteRow(${index})" title="Delete">
                  <i class="fas fa-trash-alt"></i>
              </button>
          </td>
      `;
      tableBody.appendChild(newRow);
  }

  function editRow(index) {
      const workOrders = JSON.parse(localStorage.getItem('workOrders')) || [];
      const rowData = workOrders[index];

      // Populate form with existing data
      document.getElementById('date').value = rowData.date;
      document.getElementById('equipmentName').value = rowData.equipmentName;
      document.getElementById('manufacturer').value = rowData.manufacturer;
      document.getElementById('serialNumber').value = rowData.serialNumber;
      document.getElementById('modelNumber').value = rowData.modelNumber;
      document.getElementById('fault').value = rowData.fault;
      document.getElementById('troubleshooting').value = rowData.troubleshooting;
      document.getElementById('repair').value = rowData.repair;
      document.getElementById('engineer').value = rowData.engineer;

      // Set currentEditIndex to the row being edited
      currentEditIndex = index;

      // Show the modal
      modal.style.display = "block";
  }

  function deleteRow(index) {
      let workOrders = JSON.parse(localStorage.getItem('workOrders')) || [];
      workOrders.splice(index, 1); // Remove the row from the array

      // Save updated work orders to local storage
      localStorage.setItem('workOrders', JSON.stringify(workOrders));

      // Reload the table
      loadWorkOrders();
  }

  function loadWorkOrders() {
      const workOrders = JSON.parse(localStorage.getItem('workOrders')) || [];
      const tableBody = document.getElementById('workOrderBody');
      tableBody.innerHTML = ''; // Clear existing rows

      workOrders.forEach((rowData, index) => {
          addRowToTable(rowData, index);
      });
  }

  // Load work orders on page load
  loadWorkOrders();

  document.getElementById('downloadBtn').addEventListener('click', function() {
      downloadTableAsCSV('work_orders.csv');
  });

  function downloadTableAsCSV(filename) {
      const table = document.getElementById('workOrderTable');
      const rows = Array.from(table.rows);
      const csvContent = rows.map(row => {
          const cells = Array.from(row.cells).map(cell => cell.innerText.replace(/,/g, '')); // Remove commas from data
          return cells.join(','); // Join cells with a comma
      }).join('\n'); // Join rows with a newline

      // Create a Blob from the CSV content
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.setAttribute('download', filename);
      document.body.appendChild(link);
      link.click(); // Trigger the download
      document.body.removeChild(link); // Clean up
  }
</script>


<script>
  document.getElementById('cancelButton').addEventListener('click', function() {
    // Clear form fields
    document.getElementById('workOrderForm').reset();
    
    // Hide the modal if applicable
    modal.style.display = "none"; // Uncomment this line if you're using a modal
});

</script>

</body>

</html>