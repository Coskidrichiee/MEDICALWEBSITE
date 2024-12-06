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

  <style>
    .dropdown-section {
        padding: 20px;
        margin: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        width: 100%;
    }

    .dropdown-section h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .dropdown-section select {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .contact-info, .location-info {
        padding: 10px;
        background-color: #e0e0e0;
        border-radius: 5px;
    }

    .contact-info p, .location-info p {
        margin: 5px 0;
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

    <section>
      <!-- For contact info -->
      <div class="dropdown-section">
        <h2>Contact of Biomedical Engineers</h2>
        <select id="contactDropdown" onchange="showContactInfo()">
            <option value="default" disabled selected>Select Location</option>
            <option value="lagos">Lagos</option>
            <option value="abuja">Abuja</option>
            <option value="portharcourt">Portharcourt</option>
            <option value="edo">Edo</option>
        </select>
    
        <div id="contactInfo" class="contact-info">
            <!-- Contact info will be displayed here -->
        </div>
      </div>
    
      <!-- For location sourcing -->
      <div style="margin-top: 120px;" class="dropdown-section">
        <h2>Location For Component Sourcing</h2>
        <select id="locationDropdown" onchange="showLocationInfo()">
            <option value="default" disabled selected>Select Location</option>
            <option value="lagos">Lagos</option>
            <option value="abuja">Abuja</option>
            <option value="portharcourt">Portharcourt</option>
            <option value="edo">Edo</option>
        </select>
    
        <div id="locationInfo" class="location-info">
            <!-- Location info will be displayed here -->
        </div>
      </div>
    
      <!-- New Section with h tag and link -->
      <div style="margin-top: 120px;" class="extra-section">
        <h3>Online Manual</h3>
        <a href="https://www.ifixit.com/Device/Clinical_Equipment?srsltid=AfmBOoplQpX7819RYxaY0LqxFjwH7PV1_rz9U2m1Xu-MU-IIsNVXMDVP" target="_blank">Visit our official website for more details</a>
      </div>
    </section>
    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>AlagbeWidad</span></strong>. All Rights Reserved
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
    // Function to display contact information based on selected location
    function showContactInfo() {
        const contactDropdown = document.getElementById('contactDropdown');
        const contactInfoDiv = document.getElementById('contactInfo');
        
        // Define the contact info for each location
        const contacts = {
            lagos: { name: "Engineer A", phone: "+234 801 123 4567" },
            abuja: { name: "Engineer B", phone: "+234 802 765 4321" },
            portharcourt: { name: "Engineer C", phone: "+234 803 987 6543" },
            edo: { name: "Engineer D", phone: "+234 804 456 7890" }
        };

        const selectedLocation = contactDropdown.value;

        // Check if a valid location is selected and display the corresponding contact info
        if (contacts[selectedLocation]) {
            contactInfoDiv.innerHTML = `
                <p><strong>Name:</strong> ${contacts[selectedLocation].name}</p>
                <p><strong>Phone:</strong> ${contacts[selectedLocation].phone}</p>
            `;
        } else {
            contactInfoDiv.innerHTML = ''; // Clear the div if no valid location is selected
        }
    }

    // Function to display location information based on selected location
    function showLocationInfo() {
        const locationDropdown = document.getElementById('locationDropdown');
        const locationInfoDiv = document.getElementById('locationInfo');
        
        // Define the location info (addresses) for each state
        const locations = {
            lagos: [
                "123 Allen Avenue, Ikeja, Lagos",
                "45 Ozumba Mbadiwe Avenue, Victoria Island, Lagos",
                "78 Bode Thomas Street, Surulere, Lagos"
            ],
            abuja: [
                "Plot 56, Garki 2, Abuja",
                "23 Aminu Kano Crescent, Wuse 2, Abuja",
                "89 Ademola Adetokunbo Crescent, Maitama, Abuja"
            ],
            portharcourt: [
                "12 Trans Amadi Road, Port Harcourt",
                "67 Rumuola Road, Port Harcourt",
                "34 Aba Road, Port Harcourt"
            ],
            edo: [
                "5 Ring Road, Benin City, Edo",
                "23 Akpakpava Road, Benin City, Edo",
                "9 Sapele Road, Benin City, Edo"
            ]
        };

        const selectedLocation = locationDropdown.value;

        // Check if a valid location is selected and display the corresponding addresses
        if (locations[selectedLocation]) {
            locationInfoDiv.innerHTML = `
                <p><strong>Address 1:</strong> ${locations[selectedLocation][0]}</p>
                <p><strong>Address 2:</strong> ${locations[selectedLocation][1]}</p>
                <p><strong>Address 3:</strong> ${locations[selectedLocation][2]}</p>
            `;
        } else {
            locationInfoDiv.innerHTML = ''; // Clear the div if no valid location is selected
        }
    }
</script>


</body>

</html>