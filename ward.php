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
      </li><!-- End Components Nav -->
      

      <li class="nav-item">
        <a href="workorder.php">
          <i class="bi bi-journal-text"></i><span>Work Order</span>
        </a>
      </li>
      <!-- End Forms Nav -->

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
    <section class="equipment-section">
      <div class="content">
          <h2>Equipment</h2>
          <p>This section contains a list of all equipment items available for use. Click the button on the right to add new equipment.</p>
      </div>
      <div class="button-container">
        <button class="add-equipment-btn" onclick="openForm()">
            <i class="fas fa-plus"></i> Add Equipment
        </button>
    </div>
      <!-- Table wrapped in its own div -->
      <div class="table-container">
          <table class="equipment-table">
              <thead>
                  <tr>
                      <th>Name of Equipment</th>
                      <th>Manufacturers</th>
                      <th>Serial Number</th>
                      <th>Model Number</th>
                      <th>Type of Equipment</th>
                      <th>Guarantee</th>
                      <th>Date of Purchase</th>
                      <th>Amount</th>
                  </tr>
              </thead>
              <tbody id="equipment-table-body">
                <!-- Table body will be populated here -->
            </tbody>
          </table>
      </div>
  </section>
  <!-- Form Popup -->
  <div class="overlay" id="overlay" onclick="closeForm()"></div>
  <div class="form-popup" id="formPopup">
      <h3>Add New Equipment</h3>
      <form id="equipmentForm" onsubmit="return false;" action="add_equipment.php" method="post">
          <input type="text" id="name" name="name" placeholder="Name of Equipment" required>
          <input type="text" id="manufacturers" name="manufacturers" placeholder="Manufacturers" required>
          <input type="text" id="serialNumber" name="serialNumber" placeholder="Serial Number" required>
          <input type="text" id="modelNumber" name="modelNumber" placeholder="Model Number" required>
          <input type="text" id="type" name="type" placeholder="Type of Equipment" required>
          <input type="text" id="guarantee" name="guarantee" placeholder="Guarantee" required>
          <input type="date" id="dateOfPurchase" name="dateOfPurchase" required>
          <input type="number" id="amount" name="amount" placeholder="Amount" required>
          <button type="button" onclick="addEquipment()">Add Equipment</button>
          <button type="button" onclick="closeForm()">Cancel</button>
      </form>
  </div>


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
    // Load stored data and populate table on page load
    window.onload = function() {
        const storedData = JSON.parse(localStorage.getItem('equipmentData')) || [];
        storedData.forEach(item => {
            addRowToTable(item);
        });
    };
    
    // Open the form
    function openForm() {
        document.getElementById('formPopup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }
    
    // Close the form
    function closeForm() {
        document.getElementById('formPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    
    // Add new equipment
    function addEquipment() {
        const name = document.getElementById('name').value;
        const manufacturers = document.getElementById('manufacturers').value;
        const serialNumber = document.getElementById('serialNumber').value;
        const modelNumber = document.getElementById('modelNumber').value;
        const type = document.getElementById('type').value;
        const guarantee = document.getElementById('guarantee').value;
        const dateOfPurchase = document.getElementById('dateOfPurchase').value;
        const amount = document.getElementById('amount').value;
    
        if (!name || !manufacturers || !serialNumber || !modelNumber || !type || !guarantee || !dateOfPurchase || !amount) {
            alert('Please fill all fields');
            return;
        }
    
        // Create equipment data object
        const equipmentData = {
            name,
            manufacturers,
            serialNumber,
            modelNumber,
            type,
            guarantee,
            dateOfPurchase,
            amount
        };
    
        // Add the new equipment to the table and local storage
        addRowToTable(equipmentData);
        saveDataToLocalStorage(equipmentData);
    
        // Clear the form inputs
        clearFormInputs();
    
        // Close the form
        closeForm();
    }
    
    // Clear form inputs
    function clearFormInputs() {
        document.getElementById('name').value = '';
        document.getElementById('manufacturers').value = '';
        document.getElementById('serialNumber').value = '';
        document.getElementById('modelNumber').value = '';
        document.getElementById('type').value = '';
        document.getElementById('guarantee').value = '';
        document.getElementById('dateOfPurchase').value = '';
        document.getElementById('amount').value = '';
    }
    
    // Add a new row to the equipment table
    function addRowToTable(data) {
        const tableBody = document.getElementById('equipment-table-body');
        const newRow = tableBody.insertRow();
    
        // Insert new row with data
        newRow.innerHTML = `
            <td>${data.name}</td>
            <td>${data.manufacturers}</td>
            <td>${data.serialNumber}</td>
            <td>${data.modelNumber}</td>
            <td>${data.type}</td>
            <td>${data.guarantee}</td>
            <td>${data.dateOfPurchase}</td>
            <td>${data.amount}</td>
            <td class="action-icons">
                <i class="fas fa-edit" onclick="editEquipment(this)"></i>
                <i class="fas fa-trash" onclick="deleteEquipment(this)"></i>
            </td>
        `;
    }
    
    // Save equipment data to localStorage
    function saveDataToLocalStorage(data) {
        const existingData = JSON.parse(localStorage.getItem('equipmentData')) || [];
        existingData.push(data);
        localStorage.setItem('equipmentData', JSON.stringify(existingData));
    }
    
    // Delete equipment from the table and localStorage
    function deleteEquipment(element) {
        const row = element.closest('tr');
        const equipmentName = row.cells[0].innerText; // Assuming the first cell is the name
    
        // Remove from localStorage
        removeDataFromLocalStorage(equipmentName);
    
        // Remove the row from the table
        row.remove();
    }
    
    // Remove specific equipment data from localStorage
    function removeDataFromLocalStorage(equipmentName) {
        const existingData = JSON.parse(localStorage.getItem('equipmentData')) || [];
        const updatedData = existingData.filter(item => item.name !== equipmentName);
        localStorage.setItem('equipmentData', JSON.stringify(updatedData));
    }
    
    // Edit equipment data
    function editEquipment(element) {
        const row = element.closest('tr');
        const cells = row.getElementsByTagName('td');
    
        // Populate form with existing data for editing
        document.getElementById('name').value = cells[0].innerText;
        document.getElementById('manufacturers').value = cells[1].innerText;
        document.getElementById('serialNumber').value = cells[2].innerText;
        document.getElementById('modelNumber').value = cells[3].innerText;
        document.getElementById('type').value = cells[4].innerText;
        document.getElementById('guarantee').value = cells[5].innerText;
        document.getElementById('dateOfPurchase').value = cells[6].innerText;
        document.getElementById('amount').value = cells[7].innerText;
    
        // Remove the row for editing
        row.remove();
    
        // Remove the equipment from localStorage
        removeDataFromLocalStorage(cells[0].innerText);
    
        // Open the form for editing
        openForm();
    }
    </script>

</body>

</html>