document.getElementById('admin-login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const form = e.target;
    const formData = new FormData(form);

    fetch('../auth/process_login.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to the admin dashboard on successful login
            window.location.href = 'index.php';
        } else {
            // Display error message
            const errorMsg = document.getElementById('error-msg');
            errorMsg.textContent = data.message || 'Invalid credentials';
            errorMsg.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
