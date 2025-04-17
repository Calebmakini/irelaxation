       // Update date and time
        function updateDateTime() {
            const now = new Date();
            const datetimeElement = document.getElementById('datetime');
            datetimeElement.textContent = now.toLocaleString();
        }
        
        // Update every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call
        
        // Popup functions
        function showPopup(id) {
            document.getElementById('popup-overlay').style.display = 'block';
            document.getElementById(id).style.display = 'block';
            
            // Initialize map if it's the map popup
            if (id === 'map-popup') {
                initMap();
            }
        }
        
        function hidePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
            const popups = document.getElementsByClassName('popup');
            for (let popup of popups) {
                popup.style.display = 'none';
            }
        }
        
        // Logout function
        function logout() {
            alert('Logging out... Redirecting to login page.');
            // In a real app, you would redirect to the login page
            // window.location.href = 'login.php';
        }
        
        // Initialize Google Map
        function initMap() {
            // This is just a placeholder. In a real app, you would use the Google Maps API
            const mapElement = document.getElementById('map');
            mapElement.innerHTML = '<div style="padding: 20px; text-align: center;">Google Map would appear here with your current location</div>';
            
            // Real implementation would look something like this:
            /*
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const map = new google.maps.Map(mapElement, {
                        center: {lat: position.coords.latitude, lng: position.coords.longitude},
                        zoom: 15
                    });
                    new google.maps.Marker({
                        position: {lat: position.coords.latitude, lng: position.coords.longitude},
                        map: map,
                        title: 'Your Location'
                    });
                });
            } else {
                mapElement.innerHTML = '<div style="padding: 20px; text-align: center;">Geolocation is not supported by this browser.</div>';
            }
            */
        }
        
        // Deposit cash timeout
        document.querySelector('#deposit-cash-popup .btn-success').addEventListener('click', function() {
            const statusElement = document.getElementById('deposit-status');
            statusElement.style.display = 'block';
            
            setTimeout(function() {
                if (confirm('No response received. Would you like to try again?')) {
                    // Try again
                } else {
                    hidePopup();
                }
            }, 60000);
        });
    
