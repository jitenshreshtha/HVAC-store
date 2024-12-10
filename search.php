<?php
$con = mysqli_connect('localhost:3306', 'root', '', 'Schemashapers_HimalayaStore');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchTerm = mysqli_real_escape_string($con, $_GET['searchTerm']);

$queries = [
    'customers' => [
        'sql' => "SELECT * FROM customers WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR customer_id LIKE '%$searchTerm%'",
        'form' => function($row) {
            return "
            <form id='updateCustomerForm' name='updateCustomerForm' method='post' action='update/update_customer.php'>
                <label for='customerID'>Customer ID:</label>
                <input type='text' id='customerID' name='customerID' value='" . htmlspecialchars($row['customer_id']) . "' required />

                <label for='firstName'>First Name:</label>
                <input type='text' id='firstName' name='firstName' value='" . htmlspecialchars($row['first_name']) . "' required />

                <label for='lastName'>Last Name:</label>
                <input type='text' id='lastName' name='lastName' value='" . htmlspecialchars($row['last_name']) . "' required />

                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' value='" . htmlspecialchars($row['customer_email']) . "' required />

                <label for='phone'>Phone Number:</label>
                <input type='tel' id='phone' name='phone' value='" . htmlspecialchars($row['customer_phone']) . "' required />

                <label for='address'>Address:</label>
                <textarea id='address' name='address' required>" . htmlspecialchars($row['address']) . "</textarea>

                <button type='submit'>Update Customer</button>
               <button type='button' onclick='deleteRecord(\"customer\", \"" . htmlspecialchars($row['customer_id']) . "\")'>Delete Customer</button>



            </form>";
        }
    ],
    'technicians' => [
        'sql' => "SELECT * FROM technicians WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR technician_id LIKE '%$searchTerm%'",
        'form' => function($row) {
            return "
            <form id='updateTechnicianForm' name='updateTechnicianForm' method='post' action='update/update_technician.php'>
                <label for='techID'>Technician ID:</label>
                <input type='text' id='techID' name='techID' value='" . htmlspecialchars($row['technician_id']) . "' required />

                <label for='firstName'>First Name:</label>
                <input type='text' id='firstName' name='firstName' value='" . htmlspecialchars($row['first_name']) . "' required />

                <label for='lastName'>Last Name:</label>
                <input type='text' id='lastName' name='lastName' value='" . htmlspecialchars($row['last_name']) . "' required />

                <label for='specialisation'>Specialisation:</label>
                <input type='text' id='specialisation' name='specialisation' value='" . htmlspecialchars($row['specialization']) . "' required />

                <label for='phone'>Phone Number:</label>
                <input type='tel' id='phone' name='phone' value='" . htmlspecialchars($row['technician_phone']) . "' required />

                <button type='submit'>Update Technician</button>
                <button type='button' onclick='deleteRecord(\"technician\", \"" . htmlspecialchars($row['technician_id']) . "\")'>Delete Technician</button>

            </form>";
        }
    ],
    'products' => [
        'sql' => "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%' OR product_id LIKE '%$searchTerm%'",
        'form' => function($row) {
            $categories = ['heating', 'cooling', 'plumbing', 'electrical'];
            $categoryOptions = '';
            foreach ($categories as $category) {
                $selected = ($row['product_category'] == $category) ? 'selected' : '';
                $categoryOptions .= "<option value='$category' $selected>".ucfirst($category)."</option>";
            }

            return "
            <form id='updateProductForm' name='updateProductForm' method='post' action='update/update_product.php'>
                <label for='productID'>Product ID:</label>
                <input type='text' id='productID' name='productID' value='" . htmlspecialchars($row['product_id']) . "' required />

                <label for='productName'>Product Name:</label>
                <input type='text' id='productName' name='productName' value='" . htmlspecialchars($row['product_name']) . "' required />

                <label for='category'>Category:</label>
                <select id='category' name='category' required>
                    $categoryOptions
                </select>

                <label for='price'>Price:</label>
                <input type='number' step='0.01' id='price' name='price' value='" . htmlspecialchars($row['price']) . "' required />

                <button type='submit'>Update Product</button>
                <button type='button' onclick='deleteRecord(\"product\", \"" . htmlspecialchars($row['product_id']) . "\")'>Delete Product</button>

            </form>";
        }
    ],
    'vendors' => [
        'sql' => "SELECT * FROM vendors WHERE vendor_name LIKE '%$searchTerm%' OR vendor_id LIKE '%$searchTerm%'",
        'form' => function($row) {
            return "
            <form id='updateVendorForm' name='updateVendorForm' method='post' action='update/update_vendor.php'>
                <label for='vendorID'>Vendor ID:</label>
                <input type='text' id='vendorID' name='vendorID' value='" . htmlspecialchars($row['vendor_id']) . "' required />

                <label for='vendorName'>Vendor Name:</label>
                <input type='text' id='vendorName' name='vendorName' value='" . htmlspecialchars($row['vendor_name']) . "' required />

                <label for='vendorPhone'>Vendor Phone:</label>
                <input type='tel' id='vendorPhone' name='vendorPhone' value='" . htmlspecialchars($row['vendor_phone']) . "' required />

                <label for='vendorEmail'>Vendor Email:</label>
                <input type='email' id='vendorEmail' name='vendorEmail' value='" . htmlspecialchars($row['vendor_email']) . "' required />

                <label for='vendorAddress'>Vendor Address:</label>
                <textarea id='vendorAddress' name='vendorAddress' required>" . htmlspecialchars($row['vendor_address']) . "</textarea>

                <button type='submit'>Update Vendor</button>
                <button type='button' onclick='deleteRecord(\"vendor\", \"" . htmlspecialchars($row['vendor_id']) . "\")'>Delete Vendor</button>

            </form>";
        }
    ]
];

$foundResults = false;

foreach ($queries as $table => $config) {
    $result = mysqli_query($con, $config['sql']);
    
    if (mysqli_num_rows($result) > 0) {
        $foundResults = true;
        
        while($row = mysqli_fetch_assoc($result)) {
            echo $config['form']($row);
        }
    }
}

if (!$foundResults) {
    echo "No results found.";
}

mysqli_close($con);
?>
<script>

function searchDatabase() {
  const searchTerm = document.getElementById('searchInput').value;
  fetch(`search.php?searchTerm=${encodeURIComponent(searchTerm)}`)
    .then(response => response.text())
    .then(data => {
      document.getElementById('searchResults').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

function deleteRecord(type, id) {
  if (confirm("Are you sure you want to delete this " + type + "?")) {
    fetch('update/delete_record.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `type=${encodeURIComponent(type)}&id=${encodeURIComponent(id)}`
    })
    .then(response => response.text())
    .then(data => {
      alert(data); 
      searchDatabase(); 
    })
    .catch(error => console.error('Error:', error));
  }
}
</script>