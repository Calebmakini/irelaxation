<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="jkl.css">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            background-color: #f5f5f5;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 60px;
            transition: all 0.3s;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 15px 20px;
            border-bottom: 1px solid #34495e;
            cursor: pointer;
            position: relative;
        }
        
        .sidebar-menu li:hover {
            background-color: #34495e;
        }
        
        .sidebar-menu li.active {
            background-color: #3498db;
        }
        
        .dropdown-menu {
            display: none;
            list-style: none;
            background-color: #34495e;
            position: absolute;
            left: 100%;
            top: 0;
            width: 200px;
            z-index: 1000;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }
        
        .sidebar-menu li:hover .dropdown-menu {
            display: block;
        }
        
        .dropdown-menu li {
            padding: 10px 15px;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
        }
        
        /* Top Bar Styles */
        .top-bar {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            width: calc(100% - 250px);
            z-index: 100;
        }
        
        .top-bar-left {
            display: flex;
            align-items: center;
        }
        
        .top-bar-right {
            display: flex;
            align-items: center;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .balance {
            background-color: #f1c40f;
            color: #2c3e50;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            margin-right: 20px;
        }
        
        .top-bar-item {
            margin-right: 20px;
            cursor: pointer;
            position: relative;
        }
        
        .top-bar-dropdown {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 10px 0;
            width: 200px;
            right: 0;
            z-index: 100;
        }
        
        .top-bar-item:hover .top-bar-dropdown {
            display: block;
        }
        
        .top-bar-dropdown li {
            padding: 8px 15px;
            list-style: none;
        }
        
        .top-bar-dropdown li:hover {
            background-color: #f5f5f5;
        }
        
        /* Content Area */
        .content-area {
            margin-top: 70px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            min-height: calc(100vh - 90px);
        }
        
        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            z-index: 1000;
            width: 80%;
            max-width: 500px;
        }
        
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .close-btn {
            cursor: pointer;
            font-size: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-success {
            background-color: #2ecc71;
            color: white;
        }
        
        /* Map Container */
        #map {
            height: 300px;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li class="active">Profile View
                <ul class="dropdown-menu">
                    <li onclick="showPopup('profile-details-popup')">Profile Details</li>
                    <li onclick="showPopup('edit-profile-popup')">Edit Profile</li>
                </ul>
            </li>
            <li>Messages
                <ul class="dropdown-menu">
                    <li onclick="showPopup('send-message-popup')">Send Message</li>
                    <li>Inbox</li>
                    <li>Drafts</li>
                    <li>Failed</li>
                </ul>
            </li>
            <li>Voice & Video Call</li>
            <li>Financial Activities
                <ul class="dropdown-menu">
                    <li onclick="showPopup('financial-report-popup')">Financial Report</li>
                    <li onclick="showPopup('deposit-cash-popup')">Deposit Cash</li>
                    <li onclick="showPopup('send-cash-popup')">Send Cash</li>
                </ul>
            </li>
            <li>Contacts
                <ul class="dropdown-menu">
                    <li onclick="showPopup('contacts-list-popup')">View Contacts</li>
                    <li onclick="showPopup('edit-contact-popup')">Edit Contact</li>
                    <li onclick="showPopup('add-contact-popup')">Add/Drop Contact</li>
                    <li onclick="showPopup('block-contact-popup')">Block Contact</li>
                </ul>
            </li>
            <li onclick="logout()">Logout</li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <div class="top-bar-item">
                    Settings
                    <ul class="top-bar-dropdown">
                        <li onclick="showPopup('change-password-popup')">Change Password</li>
                        <li>Save Settings</li>
                        <li>Update Profile</li>
                    </ul>
                </div>
                <div class="top-bar-item">
                    System View
                    <ul class="top-bar-dropdown">
                        <li id="datetime">Loading time...</li>
                        <li onclick="showPopup('calendar-popup')">Calendar</li>
                        <li onclick="showPopup('map-popup')">Location Map</li>
                    </ul>
                </div>
            </div>
            <div class="top-bar-right">
                <div class="balance">$1,250.00</div>
                <div class="top-bar-item">
                    <div class="avatar">JD</div>
                    <span>John Doe</span>
                    <ul class="top-bar-dropdown">
                        <li onclick="showPopup('profile-details-popup')">Profile</li>
                        <li>Account Settings</li>
                        <li onclick="logout()">Logout</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <h2>Dashboard Overview</h2>
            <p>Welcome back, John Doe! Here's a quick overview of your account.</p>
            <!-- Main content would go here -->
        </div>
    </div>

    <!-- Popup Overlay -->
    <div class="popup-overlay" id="popup-overlay" onclick="hidePopup()"></div>

    <!-- Popups -->
    <!-- Profile Details Popup -->
    <div class="popup" id="profile-details-popup">
        <div class="popup-header">
            <h3>Profile Details</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <div class="avatar" style="width: 80px; height: 80px; font-size: 24px; margin: 0 auto 15px;">JD</div>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <p>John Doe</p>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <p>john.doe@example.com</p>
        </div>
        <div class="form-group">
            <label>Date of Birth:</label>
            <p>January 15, 1985</p>
        </div>
        <div class="form-group">
            <label>Account Balance:</label>
            <p>$1,250.00</p>
        </div>
        <button class="btn btn-primary" onclick="showPopup('edit-profile-popup'); hidePopup()">Edit Profile</button>
    </div>

    <!-- Edit Profile Popup -->
    <div class="popup" id="edit-profile-popup">
        <div class="popup-header">
            <h3>Edit Profile</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" value="John Doe">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" value="john.doe@example.com">
        </div>
        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" value="1985-01-15">
        </div>
        <div class="form-group">
            <label>Upload Avatar:</label>
            <input type="file">
        </div>
        <button class="btn btn-success">Save Changes</button>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Change Password Popup -->
    <div class="popup" id="change-password-popup">
        <div class="popup-header">
            <h3>Change Password</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Current Password:</label>
            <input type="password">
        </div>
        <div class="form-group">
            <label>New Password:</label>
            <input type="password">
        </div>
        <div class="form-group">
            <label>Confirm New Password:</label>
            <input type="password">
        </div>
        <button class="btn btn-success">Update Password</button>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Financial Report Popup -->
    <div class="popup" id="financial-report-popup">
        <div class="popup-header">
            <h3>Financial Report</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <h4>Account Summary</h4>
            <p>Current Balance: $1,250.00</p>
            <p>Last 30 Days: +$500.00</p>
        </div>
        <div class="form-group">
            <h4>Recent Transactions</h4>
            <ul>
                <li>May 15: Payment to Amazon - $45.00</li>
                <li>May 10: Deposit +$200.00</li>
                <li>May 5: Transfer to Jane Smith - $100.00</li>
            </ul>
        </div>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <!-- Deposit Cash Popup -->
    <div class="popup" id="deposit-cash-popup">
        <div class="popup-header">
            <h3>Deposit Cash</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="number" placeholder="Enter amount">
        </div>
        <div class="form-group">
            <label>Payment Server:</label>
            <select>
                <option>Bank Transfer</option>
                <option>Credit Card</option>
                <option>PayPal</option>
                <option>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Payment Details:</label>
            <input type="text" placeholder="Enter reference or details">
        </div>
        <button class="btn btn-success">Generate Payment Link</button>
        <div id="deposit-status" style="margin-top: 15px; display: none;">
            <p>Waiting for payment confirmation...</p>
        </div>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Send Cash Popup -->
    <div class="popup" id="send-cash-popup">
        <div class="popup-header">
            <h3>Send Cash</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="number" placeholder="Enter amount">
        </div>
        <div class="form-group">
            <label>Recipient:</label>
            <input type="text" placeholder="Enter name or account">
        </div>
        <div class="form-group">
            <label>Transfer Method:</label>
            <select>
                <option>Bank Transfer</option>
                <option>MPesa</option>
                <option>Airtel Money</option>
                <option>Telkom Cash</option>
                <option>Internal Transfer</option>
            </select>
        </div>
        <div class="form-group">
            <label>Account/Phone Number:</label>
            <input type="text" placeholder="Enter recipient details">
        </div>
        <button class="btn btn-success">Send Money</button>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Contacts List Popup -->
    <div class="popup" id="contacts-list-popup">
        <div class="popup-header">
            <h3>Contacts List</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <ul>
                <li>Jane Smith - jane@example.com - 555-1234</li>
                <li>Robert Johnson - rob@example.com - 555-5678</li>
                <li>Sarah Williams - sarah@example.com - 555-9012</li>
                <li>Michael Brown - mike@example.com - 555-3456</li>
            </ul>
        </div>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <!-- Edit Contact Popup -->
    <div class="popup" id="edit-contact-popup">
        <div class="popup-header">
            <h3>Edit Contact</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Select Contact:</label>
            <select>
                <option>Jane Smith</option>
                <option>Robert Johnson</option>
                <option>Sarah Williams</option>
                <option>Michael Brown</option>
            </select>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" value="Jane Smith">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" value="jane@example.com">
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" value="555-1234">
        </div>
        <button class="btn btn-success">Save Changes</button>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Add Contact Popup -->
    <div class="popup" id="add-contact-popup">
        <div class="popup-header">
            <h3>Add/Drop Contact</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" placeholder="Enter phone">
        </div>
        <button class="btn btn-success">Add Contact</button>
        <div class="form-group" style="margin-top: 20px;">
            <label>Or select contact to remove:</label>
            <select>
                <option>Select contact to remove</option>
                <option>Jane Smith</option>
                <option>Robert Johnson</option>
                <option>Sarah Williams</option>
                <option>Michael Brown</option>
            </select>
        </div>
        <button class="btn btn-danger">Remove Contact</button>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <!-- Block Contact Popup -->
    <div class="popup" id="block-contact-popup">
        <div class="popup-header">
            <h3>Block/Unblock Contact</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>Select Contact:</label>
            <select>
                <option>Jane Smith</option>
                <option>Robert Johnson</option>
                <option>Sarah Williams</option>
                <option>Michael Brown</option>
            </select>
        </div>
        <div class="form-group">
            <p>Current Status: <span id="block-status">Not Blocked</span></p>
        </div>
        <button class="btn btn-danger">Block Contact</button>
        <button class="btn btn-success">Unblock Contact</button>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <!-- Send Message Popup -->
    <div class="popup" id="send-message-popup">
        <div class="popup-header">
            <h3>Send Message</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div class="form-group">
            <label>To:</label>
            <select>
                <option>Select contact</option>
                <option>Jane Smith</option>
                <option>Robert Johnson</option>
                <option>Sarah Williams</option>
                <option>Michael Brown</option>
            </select>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea rows="5" style="width: 100%;"></textarea>
        </div>
        <button class="btn btn-success">Send</button>
        <button class="btn btn-primary">Save Draft</button>
        <button class="btn btn-danger" onclick="hidePopup()">Cancel</button>
    </div>

    <!-- Calendar Popup -->
    <div class="popup" id="calendar-popup">
        <div class="popup-header">
            <h3>Calendar</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div id="calendar" style="width: 100%; height: 300px; background-color: #f9f9f9; display: flex; justify-content: center; align-items: center;">
            Calendar View Would Appear Here
        </div>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <!-- Map Popup -->
    <div class="popup" id="map-popup">
        <div class="popup-header">
            <h3>Your Location</h3>
            <span class="close-btn" onclick="hidePopup()">&times;</span>
        </div>
        <div id="map"></div>
        <button class="btn btn-primary" onclick="hidePopup()">Close</button>
    </div>

    <script src="veri.js"></script>
 
</body>
</html>
