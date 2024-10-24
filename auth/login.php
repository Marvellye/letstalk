<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: dashboard");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Vue 3 CDN -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- Axios CDN for HTTP requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <div v-if="!isLoggedIn">
            <h2>Login Page</h2>
            <form @submit.prevent="submitForm" autocomplete="off">
                <span class="error-text" v-if="error">{{ error }}</span>
                <input type="email" v-model="email" placeholder="email@gmail.com" required>
                <input type="password" v-model="password" placeholder="......." required>
                <button type="submit">Continue to Chat</button>
            </form>
        </div>
        <div v-else>
            <p>You are already logged in. Redirecting...</p>
        </div>
    </div>

    <script>
      const { createApp, ref } = Vue;

      createApp({
        setup() {
          const email = ref('');
          const password = ref('');
          const error = ref('');
          const isLoggedIn = ref(false);

          // Check session on mount
          const checkSession = () => {
            axios.get('core/session.php') // Replace with your actual session check API
              .then(response => {
                if (response.data === "logged_in") {
                  isLoggedIn.value = true;
                  window.location.href = "dashboard"; // Redirect if already logged in
                }
              });
          };

          // Submit form function
          const submitForm = () => {
            const formData = new FormData();
            formData.append('email', email.value);
            formData.append('password', password.value);

            axios.post('core/login.php', formData)
              .then(response => {
                if (response.data === 'success') {
                  window.location.href = "dashboard";
                } else {
                  error.value = response.data;
                }
              })
              .catch(() => {
                error.value = "An error occurred. Please try again.";
              });
          };

          // Call session check on component mount
          checkSession();

          return {
            email,
            password,
            error,
            isLoggedIn,
            submitForm
          };
        }
      }).mount('#app');
    </script>
</body>
</html>
