<template>
    <section class="container py-5">

        <div class="row g-0 justify-content-center">
        <div class="col-md-8 p-5 bg-purple text-white rounded-3 shadow-lg">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row">
                <div class="col-md-7">
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-light">Submit →</button>
                    </form>
                </div>
                <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                    <img src="https://i.ibb.co.com/HYKXxRr/1dc73b548854c6f220ad24bd92d57c02.png" alt="Customer Service" class="img-fluid rounded mb-3">
                    <div>
                        <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-xing"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</template>

<script setup>

</script>

<style>
.bg-purple {
    background-color: #5c4ac7; /* Dark purple background */
}

body {
    background-color: #f4f4f4; /* Light gray background */
}

.btn-light {
    background-color: #ffffff;
    color: #5c4ac7; /* Match the dark purple theme */
}

@media (max-width: 768px) {
    .bg-purple {
        padding: 20px;
    }
}

</style>