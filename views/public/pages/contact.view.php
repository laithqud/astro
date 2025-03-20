<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Star Dust Elixirs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="public/css/contact.css">
    <link rel="stylesheet" href="public/css/style.css">


</head>

<body>
    <?php include_once('./views/layout/public/header.php'); ?>

    <header class="header text-center">
        <h1>Contact Intergalactic Support</h1>
        <p>Need assistance with your cosmic powers? Our support team is here to help!</p>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-section">
                    <h3>Send Us a Message</h3>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <select class="form-select">
                                <option>Product Inquiry</option>
                                <option>Technical Support</option>
                                <option>General Question</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="faq-section">
                    <h3>Frequently Asked Questions</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">How long do powers last?</button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show">
                                <div class="accordion-body">Most elixirs last 24-48 hours, depending on the dosage.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Are there any side effects?</button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse">
                                <div class="accordion-body">Each product has specific side effects. Generally, mild cosmic tingles are common.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Do you ship to other galaxies?</button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse">
                                <div class="accordion-body">Yes! We offer intergalactic shipping through wormhole express delivery.</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-light">
                        <i class="fa-solid fa-comments text-xl text-light1"></i>
                        <span>Live Chat</span>&nbsp
                        <i class="fa-solid fa-book text-xl text-light1"></i>
                        <span>Knowledge Base</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include_once('./views/layout/public/header.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/navbar.js"></script>
</body>

</html>