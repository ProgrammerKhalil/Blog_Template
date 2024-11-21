<?php
// Database connection settings
$servername = "localhost"; // Your database server (usually localhost)
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "khalil_portfolio"; // The name of the database you want to use

// Create a connection to MySQL server
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $successMessage = "Message sent successfully!";
    } else {
        $errorMessage = "Error sending message: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalil - Programmer Portfolio</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f8ff;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Header Styles */
        header {
            background-color: #0074D9;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        header:hover {
            background-color: #005fa3;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
            animation: fadeInDown 1s ease;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: #fff;
            margin: 0 15px;
            font-size: 1.1em;
            transition: color 0.3s ease;
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav a:hover {
            color: #005fa3;
            background-color: #fff;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to right, #0066cc, #0099ff);
            color: #fff;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero h2 {
            font-size: 3em;
            margin-bottom: 20px;
            animation: zoomIn 1s ease;
        }

        .hero p {
            font-size: 1.3em;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease;
        }

        .scroll-down {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.5em;
            animation: bounce 2s infinite;
            cursor: pointer;
        }

        /* About Section */
        #about {
            padding: 80px 20px;
            background-color: #f8f9fa;
            text-align: center;
        }

        #about h2 {
            font-size: 2.5em;
            color: #005fa3;
            animation: fadeInLeft 1s ease;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            animation: fadeInRight 1s ease;
        }

        /* Projects Section */
        #projects {
            padding: 80px 20px;
            background-color: #e9ecef;
            text-align: center;
        }

        #projects h2 {
            font-size: 2.5em;
            color: #005fa3;
            animation: fadeInRight 1s ease;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 40px auto;
            animation: fadeInUp 1s ease;
        }

        .project {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
        }

        .project:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .project img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .project img:hover {
            transform: scale(1.05);
        }

        .project-info {
            padding: 20px;
        }

        .project-info h3 {
            margin-top: 0;
            color: #0074D9;
            animation: fadeIn 1s ease;
        }

        .project-info p {
            margin-bottom: 10px;
            animation: fadeIn 1s ease;
        }

        .project-info a {
            display: inline-block;
            margin-top: 10px;
            color: #0074D9;
            font-weight: bold;
            transition: color 0.3s ease;
            animation: fadeInUp 1s ease;
        }

        .project-info a:hover {
            color: #005fa3;
        }

        /* Videos Section */
        #videos {
            padding: 80px 20px;
            background-color: #f8f9fa;
            text-align: center;
        }

        #videos h2 {
            font-size: 2.5em;
            color: #005fa3;
            animation: fadeInRight 1s ease;
        }

        .video-container {
            max-width: 800px;
            margin: 40px auto;
            animation: fadeInUp 1s ease;
        }

        .video {
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Contact Section */
        #contact {
            padding: 80px 20px;
            background-color: #e9ecef;
            text-align: center;
        }

        #contact h2 {
            font-size: 2.5em;
            color: #005fa3;
            animation: fadeInLeft 1s ease;
        }

        .contact-content {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
            animation: fadeInRight 1s ease;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info a {
            color: #0074D9;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-info a:hover {
            color: #005fa3;
        }

        .contact-form {
            display: grid;
            gap: 20px;
            max-width: 500px;
            margin: 0 auto;
            animation: fadeInUp 1s ease;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .contact-form button {
            background-color: #0074D9;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #005fa3;
        }

        /* Footer Styles */
        footer {
            background-color: #0074D9;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        footer p {
            margin: 0;
            animation: fadeInUp 1s ease;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2em;
            }

            .hero h2 {
                font-size: 2.5em;
            }

            nav a {
                margin: 0 10px;
                font-size: 1em;
            }

            #about h2,
            #projects h2,
            #videos h2,
            #contact h2 {
                font-size: 2em;
            }

            .projects-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.5em;
            }

            .hero h2 {
                font-size: 2em;
            }

            nav a {
                margin: 0 5px;
                font-size: 0.9em;
            }

            #about h2,
            #projects h2,
            #videos h2,
            #contact h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Khalil's Portfolio</h1>
        <nav>
            <a href="#about">About Me</a>
            <a href="#projects">Projects</a>
            <a href="#videos">Videos</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <div class="hero">
        <h2>Hello, I'm Khalil</h2>
        <p>A passionate programmer who loves coding and creating innovative solutions. Explore my work and get in touch!</p>
        <div class="scroll-down">▼</div>
    </div>

    <section id="about">
        <h2>About Me</h2>
        <div class="about-content">
            <p>Hi, I'm Khalil, a programmer with a passion for coding and creating interactive web applications. With a strong background in HTML, CSS, JavaScript, and more, I love exploring new technologies and pushing the boundaries of what's possible in the digital world.</p>
            <p>Feel free to explore my projects and videos, and don't hesitate to reach out if you'd like to collaborate or just have a chat!</p>
        </div>
    </section>

    <section id="projects">
        <h2>Projects</h2>
        <div class="projects-grid">
            <div class="project">
                <img src="https://via.placeholder.com/300x200" alt="Project 1">
                <div class="project-info">
                    <h3>Project One</h3>
                    <p>A brief description of the project goes here. Highlight key features and technologies used.</p>
                    <a href="#">View Project</a>
                </div>
            </div>
            <div class="project">
                <img src="https://via.placeholder.com/300x200" alt="Project 2">
                <div class="project-info">
                    <h3>Project Two</h3>
                    <p>A brief description of the project goes here. Highlight key features and technologies used.</p>
                    <a href="#">View Project</a>
                </div>
            </div>
            <div class="project">
                <img src="https://via.placeholder.com/300x200" alt="Project 3">
                <div class="project-info">
                    <h3>Project Three</h3>
                    <p>A brief description of the project goes here. Highlight key features and technologies used.</p>
                    <a href="#">View Project</a>
                </div>
            </div>
        </div>
    </section>

    <section id="videos">
        <h2>Videos</h2>
        <div class="video-container">
            <div class="video">
                <iframe src="https://onedrive.live.com/embed?resid=YOUR_ONEDRIVE_VIDEO_ID1&authkey=YOUR_AUTH_KEY1" width="100%" height="400" frameborder="0" scrolling="no" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe src="https://onedrive.live.com/embed?resid=YOUR_ONEDRIVE_VIDEO_ID2&authkey=YOUR_AUTH_KEY2" width="100%" height="400" frameborder="0" scrolling="no" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section id="contact">
        <h2>Contact Me</h2>
        <p>If you want to reach out to me, feel free to send a message through the form below:</p>

        <?php if (isset($successMessage)): ?>
            <div class="message-success"><?php echo $successMessage; ?></div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="message-error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <div class="contact-info">
                <p>Email: <a href="mailto:programmerkhalil0@gmail.com">programmerkhalil0@gmail.com</a></p>
            </div>
            <div class="contact-form">
            <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <p>© 2024 Khalil. All rights reserved.</p>
    </footer>

    <script>
        // Scroll down functionality for hero section
        document.querySelector('.scroll-down').addEventListener('click', function() {
            document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>
